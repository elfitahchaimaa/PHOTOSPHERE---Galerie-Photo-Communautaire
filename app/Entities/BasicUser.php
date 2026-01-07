<?php

require_once __DIR__ . '/User.php';

class BasicUser extends User
{
    public function __construct(string $username, string $email, string $password)
    {
        parent::__construct($username, $email, $password);
    }
}
