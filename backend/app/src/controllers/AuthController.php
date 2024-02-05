<?php
namespace App\controllers;

use Exception;
use App\models\Auth;
use App\models\User;
use App\models\Session;
use App\core\Controller;
use App\handlers\HandlerException;
use App\repositories\UserRepository;

    class AuthController extends Controller {

        private UserRepository $userRepository;

        function __construct() {
            $this->userRepository = new UserRepository();
        }

        public function signIn(): void {
            try {
                $auth = Auth::fromMap($this->request());
                $email = $auth->email;
                $password = $auth->password;

                $finder = $this->userRepository->findByEmail($email);
                if(empty($finder)) {
                    throw new Exception("Email ou senha inválidos.");
                }

                $user = User::fromMap($finder[0]);
                if(!password_verify($password, $user->password)) {
                    throw new Exception("Email ou senha inválidos.");
                }

                $sessionController = new SessionController();
                $sessionController->create($user);

            } catch (\Throwable $th) {
               throw new HandlerException($th->getMessage(), 404);
            }
        }

        public function signUp(): void {
            try {
                $user = User::fromMap($this->request());
                $user->password = password_hash($user->password, PASSWORD_BCRYPT);
                $this->userRepository->save($user);
            } catch (\Throwable $th) {
               throw new HandlerException($th->getMessage(), 400);
            }
        }

        public function signOut(): void {
            try {
                Session::destroy();
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }