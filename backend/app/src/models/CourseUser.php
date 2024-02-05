<?php
namespace App\models;

use App\core\Model;
use App\models\User;
use App\core\Database;
use App\models\Course;
use App\repositories\CourseRepository;
use App\validators\CourseUserValidator;
use Exception;

    class CourseUser extends Model {

        public Course $course;

        public User $user;
        
        static public function fromMap(array $map): self {
            try {
                $courseUser = new self;
                $user = User::logged();
                $courseUser->course = CourseUserValidator::course($map['course_id']) ?? $courseUser->courseById($map['course_id']);
                $courseUser->user = CourseUserValidator::user($user->id) ?? $user;
                $courseUser->created_at = $map['created_at'] ?? date('Y-m-d H:i:s');
                return $courseUser;
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        private function courseById(int $id): Course {
            try {
                $courseRepository = new CourseRepository();
                $finder = $courseRepository->findById($id)[0];
                if(is_null($finder)) {
                    throw new Exception("Curso inválido");
                }
                return Course::fromMap($finder);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }