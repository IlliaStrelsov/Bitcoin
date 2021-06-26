<?php

class User
{
    public $email;
    public $password;


    public function create()
    {
        if (!empty($this->email)  && !empty($this->password)) {
            $text = $this->email . "," . $this->password . "\n";
            $fp = fopen('accounts.txt', 'a+');
            if (fwrite($fp, $text)) {
                fclose($fp);
                return true;
            } else {
                return false;

            }

        }
    }

    public function signin()
    {
        $all_ids = explode("\n", file_get_contents("accounts.txt"));
        $check_value = $this->email . "," . $this->password;

        if (in_array($check_value, $all_ids)) {
            return true;
        } else {
            return false;
        }

    }

}