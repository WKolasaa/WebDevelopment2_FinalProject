<?php

namespace Repositories;

use DateTime;
use Models\User;
use PDO;
use PDOException;
use Repositories\Repository;

class UserRepository extends Repository
{
    function checkUsernamePassword($username, $password) // TODO: change password to hash
    {
        try {
            // retrieve the user with the given username
            $stmt = $this->connection->prepare("SELECT userID, userName, firstName, lastName, email, password, phone, address, address2, country, zip, dateOfBirth, role FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $this->createObject($stmt->fetch());

            // verify if the password matches the hash in the database
            $result = $this->verifyPassword($password, $user->getPassword());

            if($result){
                // do not pass the password hash to the caller
                $user->password = "";

                return $user;
            } else {
                $result = false;
            }

        } catch (PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function createObject($row)
    {
        $user = new \Models\User();
        $user->userID = $row['userID'];
        $user->username = $row['userName'];
        $user->firstName = $row['firstName'];
        $user->lastName = $row['lastName'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->phone = $row['phone'];
        $user->address = $row['address'];
        $user->address2 = $row['address2'];
        $user->country = $row['country'];
        $user->zip = $row['zip'];
        $user->dateOfBirth = $row['dateOfBirth'];
        $user->role = $row['role'];

        return $user;
    }

    // hash the password (currently uses bcrypt)
    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // verify the password hash
    function verifyPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }

    public function registerUser($user){
        try {
            $user->password = $this->hashPassword($user->password);

            $stmt = $this->connection->prepare("INSERT INTO users (userName, firstName, lastName, email, password, phone, address, address2, country, zip, dateOfBirth, role) VALUES (:userName, :firstName, :lastName, :email, :password, :phone, :address, :address2, :country, :zip, :dateOfBirth, :role)");
            $stmt->bindParam(':userName', $user->username);
            $stmt->bindParam(':firstName', $user->firstName);
            $stmt->bindParam(':lastName', $user->lastName);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':password', $user->password);
            $stmt->bindParam(':phone', $user->phone);
            $stmt->bindParam(':address', $user->address);
            $stmt->bindParam(':address2', $user->address2);
            $stmt->bindParam(':country', $user->country);
            $stmt->bindParam(':zip', $user->zip);
            $stmt->bindParam(':dateOfBirth', $user->dateOfBirth);
            $role = User::ROLE_USER;
            $stmt->bindParam(':role', $role);

            return $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function getUserByUserName($username){
        try {
            $stmt = $this->connection->prepare("SELECT userID, userName, firstName, lastName, email, password, phone, address, address2, country, zip, dateOfBirth, role FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            return $this->createObject($stmt->fetch());
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
