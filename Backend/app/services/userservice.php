<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function checkUsernamePassword($username, $password) {
        return $this->repository->checkUsernamePassword($username, $password);
    }

    public function registerUser($user) {
        return $this->repository->registerUser($user);
    }

    public function getUserByUserName($username) {
        return $this->repository->getUserByUserName($username);
    }
}

?>