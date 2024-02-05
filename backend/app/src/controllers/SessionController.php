<?php
namespace App\controllers;

use Exception;
use App\models\User;
use App\models\Session;
use App\core\Controller;
use App\handlers\HandlerException;
use App\repositories\SessionRepository;
use App\repositories\UserRepository;

    class SessionController extends Controller {

        private SessionRepository $sessionRepository;
        private UserRepository $userRepository;

        function __construct() {
            $this->sessionRepository = new SessionRepository();
            $this->userRepository = new UserRepository();
        }

        public function create(User $user): void {
            try {
                if(Session::hasCookie()) {
                    return;
                }

                $expire = strtotime("+1 day", strtotime(date('Y-m-d H:i:s')));
                $user->last_login_at = date('Y-m-d H:i:s');
                $this->userRepository->change($user);
                $token = base64_encode(json_encode((array) $user));
                $session = Session::fromMap([
                    "user_id" => $user->id,
                    "token" => $token,
                    "expired_at" => date("Y-m-d H:i:s", $expire),
                ]);

                $this->sessionRepository->save($session);
                setcookie('cursoai_session', $token, null, "/");
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function expired(): void {
            try {
                $token = $_COOKIE['cursoai_session'];
                $now = date('Y-m-d H:i:s');
                
                $finder = $this->sessionRepository->findByToken($token);
                $session = Session::fromMap($finder);

                if($now > $session->expired_at) {
                    unset($token);
                    setcookie('cursoai_session', '', -1, "/");
                    throw new Exception("Sessão expirada");
                }

            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function getUserLogged(): User {
            try {
                $token = $_COOKIE['cursoai_session'];
                return $this->getUserBySession($token);
            } catch (\Throwable $th) {
                throw new HandlerException($th->getMessage(), 500);
            }
        }

        public function getUser(): string {
            try {
                return print json_encode((array) User::logged());
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        private function getUserBySession(string | null $token): User {
            try {
                if(is_null($token)) {
                    throw new Exception("Sessão expirada");
                }

                $finder = $this->sessionRepository->findByToken($token);
                if(is_null($finder)) {
                    throw new Exception("Sessão não encontrada");
                }

                return User::fromMap($this->userRepository->findById($finder['user_id']));
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }