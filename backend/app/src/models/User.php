<?php
namespace App\models;

use App\core\Model;
use App\validators\UserValidator;
use App\controllers\SessionController;

    class User extends Model {
        
        public int $is_administrator = 0;
        public string $full_name;
        public string $login;
        public string $email;
        public string $password;
        public string $birth;
        public string $phone;
        public string $address;
        public string $cep;
        public string $district;
        public string $city;
        public string $state;
        public string | null $last_login_at;

        public static function fromMap(array $map): self {
            try {
                $user = new self(); 
                $user->id = $map['id'] ?? null; 
                $user->is_administrator = $map['is_administrator'] ?? 0;
                $user->full_name = UserValidator::full_name($map["full_name"]) ?? $map['full_name'];
                $user->login = UserValidator::login($map["login"]) ?? $map['login'];
                $user->email = UserValidator::email($map["email"]) ?? $map['email'];
                $user->password = UserValidator::password($map["password"]) ?? $map['password'];
                $user->birth = UserValidator::birth($map["birth"]) ?? $map['birth'];
                $user->phone = UserValidator::phone($map["phone"]) ?? $map['phone'];
                $user->address = UserValidator::address($map["address"]) ?? $map['address'];
                $user->cep = UserValidator::cep($map["cep"]) ?? $map['cep'];
                $user->district = UserValidator::district($map["district"]) ?? $map['district'];
                $user->city = UserValidator::city($map["city"]) ?? $map['city'];
                $user->state = UserValidator::state($map["state"]) ?? $map['state'];
                $user->created_at = $map['created_at'] ?? date('Y-m-d H:i:s');
                $user->updated_at = $map['updated_at'] ?? null;
                $user->deleted_at = $map['deleted_at'] ?? null;
                $user->last_login_at = $map['last_login_at'] ?? null;
                return $user;
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function logged(): self {
            try {
                $sessionController = new SessionController();
                return $sessionController->getUserLogged();
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }