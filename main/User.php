<?php 
    include("Database.php");

    class User{

        private $userData;

        //Expects dictionary type arrays
        //If logging in, leave register empty
        //If registering, leave login empty
        public function __construct($login = [], $register = []){
            if(count($login) > 0 && count($register) == 0){
                
                $this->login($login['email'], $login['password']);
                
            } else if(count($register) > 0 && count($login) == 0){
                
                $this->createUser($register['first_name'], $register['last_name'], $register['username'], $register['email'], $register['password'], $register['password_repeat']);
                $this->login($register['email'], $register['password']);

            } else{
                throw new Exception("You can only login or register, not both. If you've passed two arrays, remove one and try again.");
            }
            
        }

        public function validate($username, $email, $password, $passwordRepeat){
            $errors = [];
            if(strlen($password) != strlen($passwordRepeat)){
                array_push($errors, "Passwords are not the same length!");
            }
            if(strlen($password) < 8 || strlen($password) > 255){
                array_push($errors, "Your password must be longer than 8 characters and shorter than 255 characters!");
            }
            if(strlen($email) > 255){
                array_push($errors, "Your email must be shorter than 255 characters!");
            }
            if(strlen($username) > 255){
                array_push($errors, "Your username must be shorter than 255 characters!");
            }
            if(!$this->checkUnique($email)){
                array_push($errors, "An account with that email already exists!");
            }
            return $errors;
        }

        //creates or gets user
        private function createUser($firstName, $lastName, $username, $email, $password, $passwordRepeat){
            $db = new Database();
            $errors = $this->validate($username, $email, $password, $passwordRepeat);
            if(count($errors) > 0){
                print_r($errors);
                return $errors;
            } else{
                $result = $db->insert('users', ['first_name', 'last_name', 'username', 'email', 'password', 'password_repeat'], [$firstName, $lastName, $username, $email, $password, $passwordRepeat]);
                if($result != 1){
                    printf("Error");
                }
            }
            $db->close();
        }

        //updates user info
        public function updateUser($fieldsToUpdate, $values){
            $db = new Database();
            $email = $this->userData['email'];
            $db->update('users', $fieldsToUpdate, $values, "`email` = '{$email}'");
            $db->close();
        }

        //deletes user given their correct password
        public function deleteUser($password){
            printf("Calling from session variable!");
            if($this->userData['password'] == $password){
                $db = new Database();
                $email = $this->userData['email'];
                $db->delete('users', "`email` = '{$email}'");
                $db->close();
            }
        }

        private function login($email, $password){
            $db = new Database();
            $result = $db->select("users", ['id', 'first_name', 'last_name', 'username', 'email', 'password', 'profile_picture'], "`email` = '{$email}' AND `password` = '{$password}'");
            if($row = $result->fetch_assoc()){
                $this->userData = $row;
                session_start();
                $_SESSION['user'] = $this->userData;
            }
            $db->close();
        }

        //gets user data and stores it in class field
        public function getUserData(){
            return $this->userData;
        }

        public function logout(){
            session_destroy();
            unset($_SESSION['user']);
        }

        //users are unique based on email
        //this checks if a user with the same email already exists
        private function checkUnique($email){
            $db = new Database();
            $result = $db->select("users", ["username"], "`email` = '{$email}'");
            $numRows = $result->num_rows;
            if($numRows > 0){
                return false;
            } else {
                return true;
            }
            $db->close();
        }

    }


?>