<?php

namespace App\Controllers;

class   StudentController{
    private string $username;
    private string $password;
    private string $email;
    private string $role;

    public function __construct(string $username, string $password, string $email, string $role) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
    }
}




?>