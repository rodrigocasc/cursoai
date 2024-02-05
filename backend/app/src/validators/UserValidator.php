<?php
namespace App\validators;

use DateTime;
use Exception;

    class UserValidator {

        static public function full_name(string | null $full_name): void {
            try {
                if(empty($full_name)) { 
                    throw new Exception("Nome completo inválido.");
                }

                if(preg_match_all('/[0-9]/', $full_name)) {
                    throw new Exception("Nome não pode conter números.");
                }

                if(preg_match_all('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $full_name)) {
                    throw new Exception("Nome não pode conter caracteres especiais.");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function login(string | null $login): void {
            try {
                if(empty($login)) { 
                    throw new Exception("Login inválido.");
                }

                if(preg_match_all('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $login)) {
                    throw new Exception("Login não pode conter caracters especiais");
                }

                if(strlen($login) < 5) {
                    throw new Exception("Login deve conter mínimo de 5 caracteres");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function email(string | null $email): void {
            try {
                if(empty($email)) { 
                    throw new Exception("Email inválido.");
                }

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Email inválido.");
                }

                if(strlen($email) < 5) { 
                    throw new Exception("Email muito curto.");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function password(string | null $password): void {
            try {
                if(empty($password)) { 
                    throw new Exception("Senha inválido.");
                }

                if(!preg_match_all('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$.\/!%*#?&]{8,}$/', $password)) {
                    throw new Exception("Senha deve conter mínimo de 8 caracteres com letra, números e caracteres especiais");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function birth(string | null $birth): void {
            try {
                if(empty($birth) || strlen($birth) != 10) { 
                    throw new Exception("Data de nascimento inválida.");
                }

                if(!preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $birth)) {
                    throw new Exception("Data de nascimento inválida.");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function phone(string | null $phone): void {
            try {
                if(empty($phone)) { 
                    throw new Exception("Telefone inválido.");
                }

                if(!preg_match_all('/^(\d{11})$/', $phone)) {
                    throw new Exception("Telefone inválido.");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function address(string | null $address): void {
            try {
                if(empty($address)) { 
                    throw new Exception("Endereço inválido.");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function cep(string | int | null $cep): void {
            try {
                if(empty($cep)) { 
                    throw new Exception("Cep inválido.");
                }

                if(!preg_match_all('/^(\d{8})$/', $cep)) {
                    throw new Exception("Cep inválido");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function district(string | null $district): void {
            try {
                if(empty($district)) { 
                    throw new Exception("Bairro inválido.");
                }

                if(!preg_match_all('/^[A-Za-z0-9á-úÁ-Ú[:space:]]{2,}$/', $district)) {
                    throw new Exception("Bairro inválido.");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function city(string | null $city): void {
            try {
                if(empty($city)) { 
                    throw new Exception("Cidade inválido.");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        static public function state(string | null $state): void {
            try {
                if(empty($state)) { 
                    throw new Exception("Estado inválido.");
                }

                if(!preg_match_all('/^[A-Za-z]{2}$/', $state)) {
                    throw new Exception("Estado inválido.");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }