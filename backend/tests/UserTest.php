<?php

use App\models\User;
use App\validators\UserValidator;
use PHPUnit\Framework\TestCase;

    class UserTest extends TestCase {

        public function testCanBeCreatedFromMap(): void {
            $map = [
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

            $user = User::fromMap($map);
            $this->assertInstanceOf(User::class, $user);
        }

        public function testCanCreatedFromValidLogin(): void {
            $login = "phpunit";
            $this->assertNull(UserValidator::login($login));
        }

        public function testThrowExceptionCaseLoginHasSpecialCharacters() : void {
            $this->expectException(Exception::class);
            $login = "*#$@!^~#901295";
            UserValidator::login($login);
        }

        public function testThrowExceptionCaseLoginIsEmpty() : void {
            $this->expectException(Exception::class);
            $login = "";
            UserValidator::login($login);
        }

        public function testCanCreatedFromValidFullname(): void {
            $full_name = "PHP Unit tests";
            $this->assertNull(UserValidator::full_name($full_name));
        }

        public function testThrowExceptionCaseFullnameHasSpecialCharacters() : void {
            $this->expectException(Exception::class);
            $full_name = "*#$@!^~#901295";
            UserValidator::full_name($full_name);
        }

        public function testThrowExceptionCaseFullnameIsEmpty() : void {
            $this->expectException(Exception::class);
            $full_name = "";
            UserValidator::full_name($full_name);
        }

        public function testCanCreatedFromValidEmail(): void {
            $email = "tests.unit@ttests.com";
            $this->assertNull(UserValidator::email($email));
        }

        public function testThrowExceptionCaseEmailIsEmpty() : void {
            $this->expectException(Exception::class);
            $email = "";
            UserValidator::email($email);
        }

        public function testThrowExceptionFromInvalidEmail(): void {
            $this->expectException(Exception::class);
            $email = "çáã!#%¨&**()+-@ããáâ.com";
            UserValidator::email($email);
        }

        public function testCanCreatedFromValidPassword(): void {
            $password = "testpassword2024@";
            $this->assertNull(UserValidator::password($password));
        }

        public function testThrowExceptionCasePasswordLess8Characters() : void {
            $this->expectException(Exception::class);
            $password = "test";
            UserValidator::password($password);
        }

        public function testThrowExceptionCasePasswordDoesNotContainLettersNumbersAndSpecialCharacters() : void {
            $this->expectException(Exception::class);
            $password = "testpasswordtestpassword";
            UserValidator::password($password);
        }

        public function testThrowExceptionCasePasswordIsEmpty() : void {
            $this->expectException(Exception::class);
            $password = "";
            UserValidator::password($password);
        }

        public function testCanCreatedFromValidBirth(): void {
            $birth = "1975-10-30";
            $this->assertNull(UserValidator::birth($birth));
        }

        public function testThrowExceptionCaseBirthHasSpecialCharacters() : void {
            $this->expectException(Exception::class);
            $birth = "1@#$/+]/?!";
            UserValidator::birth($birth);
        }

        public function testThrowExceptionCaseBirthStringSizeIsDifferentThan10() : void {
            $this->expectException(Exception::class);
            $birth = "2023-10-10100";
            UserValidator::birth($birth);
        }

        public function testThrowExceptionCaseBirthEmpty() : void {
            $this->expectException(Exception::class);
            $birth = "";
            UserValidator::birth($birth);
        }

        public function testCanCreatedFromValidPhone(): void {
            $phone = "99999999999";
            $this->assertNull(UserValidator::phone($phone));
        }

        public function testThrowExceptionCasePhoneHasSpecialCharacters() : void {
            $this->expectException(Exception::class);
            $phone = "1@#$/+]/?!~";
            UserValidator::phone($phone);
        }

        public function testThrowExceptionCasePhoneIsEmpty() : void {
            $this->expectException(Exception::class);
            $phone = "";
            UserValidator::phone($phone);
        }

        public function testCanCreatedFromValidAddress(): void {
            $address = "Street Unit Tests, 254";
            $this->assertNull(UserValidator::address($address));
        }

        public function testThrowExceptionCaseAddressIsEmpty() : void {
            $this->expectException(Exception::class);
            $address = "";
            UserValidator::address($address);
        }

        public function testCanCreatedFromValidCep(): void {
            $cep = "00000000";
            $this->assertNull(UserValidator::cep($cep));
        }

        public function testThrowExceptionCaseCepStringSizeIsDifferentThan8() : void {
            $this->expectException(Exception::class);
            $cep = "000000000";
            UserValidator::cep($cep);
        }

        public function testThrowExceptionCaseCepHasSpecialCharacters() : void {
            $this->expectException(Exception::class);
            $cep = "1@#$/+]/?!~";
            UserValidator::cep($cep);
        }

        public function testCannotBeCreatedFromEmptyCep() : void {
            $this->expectException(Exception::class);
            $cep = "";
            UserValidator::cep($cep);
        }

        public function testCanCreatedFromValidDiscrict(): void {
            $district = "Bairro Bairro";
            $this->assertNull(UserValidator::district($district));
        }

        public function testThrowExceptionCaseDistrictHasSpecialCharacters() : void {
            $this->expectException(Exception::class);
            $district = "1@#$/+]/?!~";
            UserValidator::district($district);
        }
        
        public function testThrowExceptionCaseDistrictIsEmpty() : void {
            $this->expectException(Exception::class);
            $district = "";
            UserValidator::district($district);
        }

        public function testCanCreatedFromValidState(): void {
            $state = "RJ";
            $this->assertNull(UserValidator::state($state));
        }

        public function testThrowExceptionCaseStateHasSpecialCharacters() : void {
            $this->expectException(Exception::class);
            $state = "1@#$/+]/?!~";
            UserValidator::state($state);
        }

        public function testThrowExceptionCaseStateStringSizeIsDifferentThan2() : void {
            $this->expectException(Exception::class);
            $state = "RJJ";
            UserValidator::state($state);
        }
        
        public function testThrowExceptionCaseStateIsEmpty() : void {
            $this->expectException(Exception::class);
            $state = "";
            UserValidator::state($state);
        }

    }