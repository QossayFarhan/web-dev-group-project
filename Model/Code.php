<?php
namespace Model;

class Code extends Model
{
    public function validateCode($code)
    {
        return $this->query("SELECT * FROM `code` where `code` = '". $code ."'");
    }

    public function setCode($code = "AB123")
    {
        return $this->execute("UPDATE `code` SET `code` = '". $code ."'");
    }
}

?>