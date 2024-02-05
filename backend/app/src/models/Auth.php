<?php
namespace App\models;
use App\core\Model;
use App\validators\UserValidator;

    class Auth extends Model {
        
        public string $email;
        public string $password;
        
        public static function fromMap(array $map): self { 
            try {
                $auth = new self();
                $auth->email = UserValidator::email($map['email']) ?? $map['email'];
                $auth->password = $map['password'];
                return $auth;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }