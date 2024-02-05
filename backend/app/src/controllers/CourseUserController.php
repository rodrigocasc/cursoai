<?php
namespace App\controllers;
use App\repositories\CourseUserRepository;
use Exception;
use App\models\User;
use App\core\Controller;
use App\core\Security;
use App\handlers\HandlerException;
use App\models\Course;
use App\repositories\CourseRepository;

    class CourseUserController extends Controller {

        private CourseUserRepository $courseUserRepository;
        private CourseRepository $courseRepository;
        private User $user;

        function __construct() {
            $this->courseUserRepository = new CourseUserRepository();
            $this->courseRepository = new CourseRepository();
            $this->user = User::logged();
        }

        public function findSubscribeByUserId(int $userId): string | array {
            try {
                $finders = $this->courseUserRepository->findSubscribeByUserId($userId);

                if($userId == $this->user->id || Security::isAdministrator()) {
                    return print json_encode($finders);
                }

                throw new Exception("Você não tem permissão para esta operação");
                
            } catch (\Throwable $th) {
                throw new HandlerException($th->getMessage(), 405);
            }
        }

        public function subscribe(int $course_id): void {
            try {
                $findCourseById = $this->courseRepository->findById($course_id);

                if(empty($findCourseById)) {
                    throw new Exception("Não encontrado");
                }

                $course = Course::fromMap($findCourseById, $this->user);

                $this->courseUserRepository->hasUserSubscribe($this->user, $course);

                $object = [
                        "user_id" => $this->user->id,
                        "course_id" => $course->id,
                    ];

                $this->courseUserRepository->save((object) $object);
            } catch (\Throwable $th) {
                throw new HandlerException($th->getMessage(), 400);
            }
        }

        public function unsubscribe(int $course_id): void {
             try {
                $findByUserId = $this->courseUserRepository->findByUserId($this->user->id);
                $course = Course::fromMap($this->courseRepository->findById($course_id), $this->user);
                
                if(empty($findByUserId)) {
                    throw new Exception("Não encontrado");
                }
                $this->courseUserRepository->destroyByCourseAndUser($course, $this->user);
             } catch (\Throwable $th) {
                throw new HandlerException($th->getMessage(), 400);
             }
        }
    }