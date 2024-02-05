<?php
namespace App\handlers;

use Exception;

    class HandlerException extends Exception {
        public function __construct(string $message, int $code) {
            $this->message = $message;
            $this->code = $code;
            $this->handlers();
        }

        private function handlers(): void {
            if(str_contains($this->message, "for key 'email'")) {
                $this->code = 409;
                $this->message = "E-mail já registrado";
            }

            if(str_contains($this->message, "for key 'phone'")) {
                $this->code = 409;
                $this->message = "Celular já registrado";
            }

            if(str_contains($this->message, "for key 'login'")) {
                $this->code = 409;
                $this->message = "Login já registrado";
            }
            

            if(str_contains($this->message, "Sessão não encontrada")) {
                $this->code = 410;
            }

            if(str_contains($this->message, "Não encontrado")) {
                $this->code = 404;
            }

            if(str_contains($this->message, "Sessão expirada")) {
                $this->code = 410;
            }

            if(str_contains($this->message, "Você não tem permissão para esta operação")) {
                $this->code = 405;
            }

            if(str_contains($this->message, "Usuário já inscrito neste curso.")) {
                $this->code = 409;
            }

            if(str_contains($this->message, "SQLSTATE[42S02]")) {
                $this->code = 500;
            }

            if(str_contains($this->message, "SQLSTATE[HY000] [2002]")) {
                $this->code = 500;
            }
            
            if(str_contains($this->message, "SQLSTATE[HY000] [1045]")) {
                $this->code = 500;
            }

            if(str_contains($this->message, "SQLSTATE[23000]")) {
                $this->code = 409;
            }

            if(str_contains($this->message, "SQLSTATE[42S22]")) {
                $this->message = "Atributo inválido";
                $this->code = 500;
            }
            
            header("HTTP/1.1 ". $this->code);
            echo json_encode([
                "error" => $this->message,
            ]);
        }
    }