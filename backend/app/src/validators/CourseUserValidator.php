<?php
namespace App\validators;

use Exception;

    class CourseUserValidator {

        static public function user(int | null $user_id): void {
            try {
                if(empty($user_id) || !is_int($user_id)) {
                    throw new Exception("Usuário inválido");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        static public function course(int | null $course_id): void {
            try {
                if(empty($course_id)) {
                    throw new Exception("Curso inválido");
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }