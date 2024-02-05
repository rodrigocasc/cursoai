<?php
namespace App\models;

use App\core\Model;
use App\validators\CourseValidator;

    class Course extends Model {

        public string $name;
        public string $author;
        public string $description;
        public int $user_id;

        static public function fromMap(array $map, User $user): self {
            try {
                $course = new self;
                $course->id = $map['id'] ?? null;
                $course->name = CourseValidator::name($map['name']) ?? $map['name'];
                $course->author = CourseValidator::author($user->full_name) ?? $user->full_name;
                $course->description = CourseValidator::description($map['description']) ?? $map['description'];
                $course->user_id = $user->id;
                $course->created_at = $map['created_at'] ?? date('Y-m-d H:i:s');
                $course->updated_at = $map['updated_at'] ?? null;
                $course->deleted_at = $map['deleted_at'] ?? null;
                return $course;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }