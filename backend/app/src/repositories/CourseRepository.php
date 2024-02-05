<?php
namespace App\repositories;
use App\core\Repository;


    class CourseRepository extends Repository {
        
        function __construct() {
            $this->table = "courses";
        }

        public function findByUserId(int $user_id): array {
            try {
                $finders = $this->select("*", $this->table)->where("user_id")->equals($user_id)->and("deleted_at")->isNull()->toArray();
                return $finders;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }