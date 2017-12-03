<?php

namespace App\Services;


class MoodleAuthentication
{
    public function authenticateUser(string $username, string $password)
    {
        if ($username == 'finn' && $password == 'finn') {
            return '3a8164713cd1a379bbade400c1a2ad7c';
        }
        return null;
    }
}