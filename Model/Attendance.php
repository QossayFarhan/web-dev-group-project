<?php
namespace Model;

class Attendance extends Model
{
    public function getDayAttendances($date = null, $employeeId = null)
    {
        $date = ($date != null) ? $date : date('Y-m-d');
        if($employeeId == null)
        {
            return $this->query("SELECT * FROM `attendance` where `date` = '". $date ."'");
        }
        else
        {
            return $this->query("SELECT * FROM `attendance` where `date` = '". $date ."' and `employee_id` = '". $employeeId ."'");
        }
    }

    public function checkIn($employeeId)
    {
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $record_exist = $this->query("SELECT * FROM `attendance` where `employee_id` = '". $employeeId ."' and `date` = '". $currentDate ."'");
        if($record_exist)
        {
            
            if($record_exist[0]['break_checkout_time'] == null)
            {
                $this->execute("UPDATE `attendance` SET `break_checkout_time` = '". $currentTime ."' where `employee_id` = '". $employeeId ."' and `date` = '". $currentDate ."'");
            }
            else if($record_exist[0]['break_checkin_time'] == null)
            {
                $this->execute("UPDATE `attendance` SET `break_checkin_time` = '". $currentTime ."' where `employee_id` = '". $employeeId ."' and `date` = '". $currentDate ."'");
            }
            else if($record_exist[0]['checkout_time'] == null)
            {
                $this->execute("UPDATE `attendance` SET `checkout_time` = '". $currentTime ."' where `employee_id` = '". $employeeId ."' and `date` = '". $currentDate ."'");
            }
            else{
                return false;
            }
        }
        else
        {
            $this->execute("INSERT INTO `attendance` (`date`, `employee_id`, `checkin_time`) VALUES ('". $currentDate ."', '". $employeeId ."', '". $currentTime ."')");
        }
        
        return true;
    }

    public function getStatus($employeeId)
    {
        $currentDate = date('Y-m-d');
        $record_exist = $this->query("SELECT * FROM `attendance` where `employee_id` = '". $employeeId ."' and `date` = '". $currentDate ."'");
        if($record_exist)
        {
            if($record_exist[0]['break_checkout_time'] == null)
            {
                return 'break check out';
            }
            else if($record_exist[0]['break_checkin_time'] == null)
            {
                return 'break check in';
            }
            else if($record_exist[0]['checkout_time'] == null)
            {
                return 'check out';
            }
            else{
                return "that's all for today";
            }
        }
        else
        {
            return 'check in';
        }
    }
}

?>