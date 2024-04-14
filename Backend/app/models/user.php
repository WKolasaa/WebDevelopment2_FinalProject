<?php
namespace Models;

class User {
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_MOD = 'mod';
    public  int $userID;
    public  string $username;
    public  string $firstName;
    public  string $lastName;
    public  string $email;
    public  string $password;
    public  string $phone;
    public  string $address;
    public string $address2;
    public string $country;
    public string $zip;
    public string $dateOfBirth;
    public string $role;

    public function __construct()
    {

    }

    public function getUserID()
    {
        return $this->userID;
    }
    public function getUserName()
    {
        return $this->username;
    }
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }
    public function getFullName(): string
    {
        return $this->firstName . " " . $this->lastName;
    }
    public function getRole(): string
    {
        return $this->role;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getAddress2(): string
    {
        return $this->address2;
    }
}

?>