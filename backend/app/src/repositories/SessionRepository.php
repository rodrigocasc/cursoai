<?php
namespace App\repositories;
use Exception;
use App\core\Repository;

    class SessionRepository extends Repository {

        function __construct() {
            $this->table = "sessions";
        }
        
        public function findByToken(string | null $token): array | null {
            try {
                if(is_null($token)) {
                    throw new Exception("Sessão expirada");
                }
                $finder = $this->select("*", $this->table)->where("token")->equals($token)->toArray();
                return $finder[0];
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }