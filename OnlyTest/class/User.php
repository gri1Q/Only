<?php

class User
{
    private DB $db;
    private $info = [];
    public function __construct($info = [], DB $db)
    {
        $this->info[] = $info;
        $this->db = $db;
    }

    public function getDB()
    {
        return $this->db;
    }
    public function getInfo()
    {
        return $this->info;
    }
    public function validation($name, $phone, $email, $password, $repeatPassword)
    {
        if (!empty($name) && !empty($phone) && !empty($email)) {
            if ($password === $repeatPassword) {
                return true;
            }
            return false;
        }
        return false;
    }
}
