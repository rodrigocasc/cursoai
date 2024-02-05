<?php

use App\models\Course;
use App\models\User;
use App\validators\CourseValidator;
use PHPUnit\Framework\TestCase;

    class CourseTest extends TestCase {

        private array $course = [
            "id" => 1,
            "name" => "PHP Unit Test Course",
            "author" => "PHP Unit",
            "description" => "Course to test units with PHPUnit",
            "user_id" => 1
        ];

        private array $user = [
            "id" => 1,
            "login" => "testunit",
            "is_administratator" => false,
            "full_name" => "Test Unit",
            "email" => "tests.unit@tests.com",
            "password" => "testpassword2024@",
            "birth" => "1975-10-30",
            "phone" => "21983623231",
            "address" => "Street Tests Units",
            "cep" => "00000000",
            "district" => "Tests",
            "city" => "PHP Tests Units",
            "state" => "RJ"
        ];
    

        public function testCanCreatedFromMap(): void {
            $course = Course::fromMap($this->course, User::fromMap($this->user));
            $this->assertInstanceOf(Course::class, $course);
        }

        public function testCanCreatedFromNameValid(): void {
            $this->assertNull(CourseValidator::name($this->course['name']));
        }

        public function testThrowErrorWhenNameIsEmpty(): void {
            $this->expectException(Exception::class);
            $name = "";
            CourseValidator::name($name);
        }

        public function testThrowErrorWhenNameHasSpecialCharacters(): void {
            $this->expectException(Exception::class);
            $name = "@!#$%¨&*()";
            CourseValidator::name($name);
        }

        public function testThrowErrorWhenNameLess10Characters(): void {
            $this->expectException(Exception::class);
            $name = "A23A56P89";
            CourseValidator::name($name);
        }

        public function testThrowErrorWhenNameMore50Characters(): void {
            $this->expectException(Exception::class);
            $name = "A23A56P89+A23A56P89+A23A56P89+A23A56P89+A23A56P89+51";
            CourseValidator::name($name);
        }

        public function testCanCreatedFromDescriptionValid(): void {
            $this->assertNull(CourseValidator::description($this->course['description']));
        }

        public function testThrowErrorWhenDescriptionLess15Characters(): void {
            $this->expectException(Exception::class);
            $description = "A23A56P8910";
            CourseValidator::description($description);
        }

        public function testThrowErrorWhenDescriptionHasSpecialCharacters(): void {
            $this->expectException(Exception::class);
            $description = "@!#$%¨&*()@!#$%¨&*()";
            CourseValidator::description($description);
        }

        public function testThrowErrorWhenDescriptionIsEmpty(): void {
            $this->expectException(Exception::class);
            $description = "";
            CourseValidator::description($description);
        }

        public function testCanCreatedFromAuthorValid(): void {
            $this->assertNull(CourseValidator::author($this->course['author']));
        }

        public function testThrowErrorWhenAuthorIsEmpty(): void {
            $this->expectException(Exception::class);
            $author = "";
            CourseValidator::author($author);
        }

        public function testThrowErrorWhenAuthorHasSpecialCharacters(): void {
            $this->expectException(Exception::class);
            $author = "@!#$%¨&*()";
            CourseValidator::author($author);
        }

        public function testThrowErrorWhenAuthorLess2Characters(): void {
            $this->expectException(Exception::class);
            $author = "A";
            CourseValidator::author($author);
        }
    }