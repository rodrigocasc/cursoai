<?php
namespace App\core;

use App\models\Session;
use Exception;
use App\models\User;

    class Security {
        
        static public function isAdministrator(): bool {
            try {
                Session::hasExpired();
                if(empty($_COOKIE['cursoai_session'])) {
                    throw new Exception("Sessão não encontrada");
                }

                $user = User::logged();
                if(!$user->is_administrator) {
                    throw new Exception("Você não tem permissão para esta operação");
                }
                return true;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }