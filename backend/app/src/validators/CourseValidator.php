<?php
namespace App\validators;

use Exception;

    class CourseValidator {

        static public function name(string | null $name): void {
            try {
                if(empty($name)) {
                    throw new Exception("Nome inválido");
                }

                if(preg_match_all('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $name)) {
                    throw new Exception("Nome não pode conter caracteres especiais");
                }

                if(strlen($name) > 50) {
                    throw new Exception("Nome ultrapassou o limite de 50 caracteres");
                }

                if(strlen($name) < 10) {
                    throw new Exception("Nome deve conter mais de 10 caracteres");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function author(string | null $author): void {
            try {
                if(empty($author)) {
                    throw new Exception("Autor inválido");
                }

                if(preg_match_all('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $author)) {
                    throw new Exception("Autor não deve conter caracteres especiais");
                }

                if(strlen($author) < 2) {
                    throw new Exception("Autor inválido");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function description(string | null $description): void {
            try {
                if(empty($description)) {
                    throw new Exception("Descrição inválida");
                }

                if(preg_match_all('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $description)) {
                    throw new Exception("Descrição não pode conter caracteres especiais");
                }

                if(strlen($description) < 15) {
                    throw new Exception("Descrição deve conter mais de 15 caracteres");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }