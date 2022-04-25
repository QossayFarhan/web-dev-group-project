<?php
namespace Model;

class Employee extends Model
{
    public function getEmployees($employeeId = null)
    {
        if($employeeId)
        {
            return $this->query("SELECT * FROM employee where `id` = ". $employeeId);
        }
        return $this->query("SELECT * FROM employee");
    }

    public function getProfile($id = 0)
    {
        return $this->query("SELECT * FROM employee WHERE id ='$id' ")[0]; // Return the first element from the query result (array)
    }

    public function createEmployee($name = "", $email = "", $password = "", $admin = 0)
    {
        return $this->execute("INSERT INTO `employee`(`name`, `email`, `password`, `admin`) VALUES ('". $name ."','". $email ."','". $password ."','". $admin ."')");
    }

    public function updateEmployee($id = 0, $name = "", $email = "", $admin = null)
    {
        if($admin == null)
        {
            return $this->execute("UPDATE `employee` SET `name` = '". $name ."', `email` = '". $email ."' where `id` = ". $id);
        }
        return $this->execute("UPDATE `employee` SET `name` = '". $name ."', `email` = '". $email ."', `admin` = '". $admin ."' where `id` = ". $id);
    }

    public function updateProfile($id = 0, $name = "", $email = "")
    {
        return $this->execute("UPDATE `employee` SET `name` = '". $name ."', `email` = '". $email ."' where `id` = ". $id);
    }

    public function updatePassword($id = 0, $password = "")
    {
        return $this->execute("UPDATE `employee` SET `password` = '". $password ."' where `id` = ". $id);
    }

    public function deleteEmployee($id)
    {
        return $this->execute("DELETE FROM `employee` where id = ". $id);
    }

    public function login($email = "", $password = "")
    {
        return $this->query("SELECT * FROM employee where email='". $email ."' and password = '". $password ."'");
    }
}
?>