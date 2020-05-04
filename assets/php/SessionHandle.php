<?php


class SessionHandle
{


    function startUser($id)
    {
        $_SESSION['user_id'] = $id;
        $hash = $this->random();
        $_SESSION['user_hash'] = $hash;
    }

    function getHash()
    {
        return $_SESSION['user_hash'];
    }

    function getUser()
    {
        return $_SESSION['user_id'];
    }

    function isLogged()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }

    function isAdmin()
    {
        global $DB;
        if ($this->isLogged()) {
            $DATA = $DB->query("SELECT rank FROM " . DB_PREFIX . "user WHERE id = " . $_SESSION['user_id']);

            if (!empty($DATA)) {
                $DATA = $DATA->fetch_array();
                if ($DATA['rank'] != 0) {
                    return true;
                }
            }
        }
        return false;
    }

    function random()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = 30;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function randomFTP()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = 10;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}