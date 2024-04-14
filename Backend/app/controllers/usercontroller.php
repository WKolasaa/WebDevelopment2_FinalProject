<?php

namespace Controllers;

use Exception;
use Services\UserService;
use \Firebase\JWT\JWT;

class UserController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new UserService();
    }

    public function login() {
        try{
            // read user data from request body
            $userdata = $this->createObjectFromPostedJson("Models\\User");

            // get user from db
            $user = $this->service->checkUsernamePassword($userdata->getUserName(), $userdata->getPassword());

            // if the method returned false, the username and/or password were incorrect
            if($user){
                // generate jwt
                $jwt = $this->generateJwt($user);

                // return jwt
                $array = array(
                    "jwt" => $jwt,
                    "user" => $user
                );
                $this->respond($array);
            }
            else{
                echo("Username and/or password incorrect");
            }
        } catch (Exception $e) {
            echo("Error while logging in");
        }
    }

    private function generateJwt($user){
        $payload = array(
            "iss" => "localhost",
            "aud" => "localhost",
            "iat" => time(),
            "nbf" => time() + 10,
            "exp" => time() + 3600,
            "data" => array(
                "id" => $user->getUserID(),
                "username" => $user->getUserName(),
                "email" => $user->getEmail(),
            ),
            "key" => getenv("secret_key")
        );

        return JWT::encode($payload, getenv("secret_key"), "HS256");
    }

    private function getJwtSecret() :string{
        return "secret";
    }

    public function register() {
        // read user data from request body
        $userdata = $this->createObjectFromPostedJson("Models\\User");

        // get user from db
        if($this->service->registerUser($userdata)){
            $user = $this->service->getUserByUserName($userdata->getUserName());
        }
        else {
            echo("Error while registering user");
        }

        // generate jwt
        $jwt = $this->generateJwt($user);

        // return jwt
        $array = array(
            "jwt" => $jwt,
            "user" => $user
        );
        $this->respond($array);
    }

}
