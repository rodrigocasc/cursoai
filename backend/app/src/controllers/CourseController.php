<?php
namespace App\controllers;
use App\models\Course;
use App\core\Controller;
use App\handlers\HandlerException;
use App\core\Security;
use App\models\Session;
use App\models\User;
use App\repositories\CourseRepository;

    class CourseController extends Controller {
        private CourseRepository $courseRepository;

        function __construct() {
            $this->courseRepository = new CourseRepository();
        }

        public function create(): void {
            try {
                Security::isAdministrator();
                $course = Course::fromMap($this->request(), User::logged());
                $this->courseRepository->save($course);
            } catch (\Throwable $th) {
                throw new HandlerException($th->getMessage(), 400);
            }
        }

        public function update(int $id): void {
            try {
                Security::isAdministrator();
                $course = Course::fromMap($this->request(), User::logged());
                $course->id = $id;
                $this->courseRepository->change($course);
            } catch (\Throwable $th) {
                throw new HandlerException($th->getMessage(), 404);
            }
        }

        public function delete(int $id): void {
            try {
                Security::isAdministrator();
                $this->courseRepository->remove($id);
            } catch (\Throwable $th) {
                throw new HandlerException($th->getMessage(), 400);
            }
        }

        public function findAll(): string | array {
            try {
                Session::hasExpired();
                return print json_encode($this->courseRepository->findAll());
            } catch (\Throwable $th) {
                throw new HandlerException($th->getMessage(), 400);
            }
        }

        public function findById(int $id): string | array {
            try {
                return print json_encode($this->courseRepository->findById($id));
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function findByUserId(int $user_id): string | array {
            try {
                return print json_encode($this->courseRepository->findByUserId($user_id));
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }