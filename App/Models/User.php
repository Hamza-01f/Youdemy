<?php

namespace App\models;

abstract class User {
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $role;
    protected string $bio;
    protected string $imageUrl;

    public function __construct(string $username, string $email, string $password, string $role, string $bio, string $imageUrl) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->bio = $bio;
        $this->imageUrl = $imageUrl;
    }

    abstract public function save(): bool;

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
      
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getRole(): string {
        return $this->role;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    public function getBio(): string {
        return $this->bio;
    }

    public function setBio(string $bio): void {
        $this->bio = $bio;
    }

    public function getImageUrl(): string {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void {
        $this->imageUrl = $imageUrl;
    }
}
?>
