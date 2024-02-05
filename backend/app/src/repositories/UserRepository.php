<?php
namespace App\repositories;
use App\core\Repository;
use Exception;

    class UserRepository extends Repository {

        function __construct(){
            $this->table = "users";
        }

        public function findByEmail(string $email): array {
            try {
                $finder = $this->select("*", $this->table)->where("email")->equals($email)->toArray();
                return $finder;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }