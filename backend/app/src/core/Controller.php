<?php

namespace App\core;

use Exception;

    class Controller {
        
        public function request(): mixed {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data)) {
                header("HTTP/1.1 400");
                throw new Exception("Erro ao enviar os dados");
            }

            return $data;
        }
    }