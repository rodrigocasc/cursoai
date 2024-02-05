<?php
    
    header('Access-Control-Allow-Origin: http://localhost:3000');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
    header('Access-Control-Max-Age: 86400');

    $router->mount("/api", function() use ($router) {

        $router->setNamespace("\App\controllers");

        // Browser check methdod OPTIONS before request
        $router->options('/(.*)', function() {
            header("HTTP/1.1 200 OK");
        });

        // Auth
        $router->mount("/auth", function() use ($router) {
            $router->post("/signIn","AuthController@signIn");
            $router->post("/signUp","AuthController@signUp");
            $router->post("/signOut","AuthController@signOut");
            $router->get("/session", "SessionController@expired");
        });

         // Users
         $router->mount("/users", function() use ($router) {
            $router->get("/all","UserController@findAll");
            $router->get("/id/(.*)","UserController@findById");
            $router->post("/create","UserController@create");
            $router->patch("/update/(.*)","UserController@update");
            $router->delete("/delete/(.*)","UserController@delete");
        });

        // Courses
        $router->mount("/courses", function() use ($router) {
            $router->get("/all","CourseController@findAll");
            $router->get("/id/(.*)","CourseController@findById");
            $router->get("/manager/(.*)","CourseController@findByUserId");
            $router->post("/create","CourseController@create");
            $router->patch("/update/(.*)","CourseController@update");
            $router->delete("/delete/(.*)","CourseController@delete");
            $router->post("/subscribe/(.*)","CourseUserController@subscribe");
            $router->post("/unsubscribe/(.*)","CourseUserController@unsubscribe");
            $router->get("/subscribe/user/(.*)","CourseUserController@findSubscribeByUserId");
        });

    });