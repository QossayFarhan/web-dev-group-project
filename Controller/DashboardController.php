<?php

use Model\Code as CodeModel;
use Model\Attendance as AttendanceModel;
use Model\Employee as EmployeeModel;
use Model\Shift as ShiftModel;

 class DashboardController extends Controller
{

    public function dashboard()
    {
        $date = $_REQUEST['date'] ?? date('Y-m-d');

        if($_SESSION['admin'])
        {
            $employeeModel = new EmployeeModel;
            $employees = $employeeModel->getEmployees();
        }
        else
        {
            $employeeModel = new EmployeeModel;
            $employees = $employeeModel->getEmployees($_SESSION['id']);
        }
        

        $attendanceModel = new AttendanceModel;
        $attendances = $attendanceModel->getDayAttendances($date);

        $shiftModel = new ShiftModel;
        $shift = $shiftModel->getDetails(date('l', strtotime($date)));

        $result = [];
        if($shift)
        {
            for($i = 0; $i < count($employees); $i++)
            {
                $result[$i]['id'] = $employees[$i]['id'];
                $result[$i]['name'] = $employees[$i]['name'];
                $result[$i]['admin'] = $employees[$i]['admin'];
                for($j = 0; $j < count($attendances); $j++)
                {
                    if($attendances[$j]['employee_id'] == $employees[$i]['id'])
                    {
                        $result[$i]['checkin_time'] = $attendances[$j]['checkin_time'];
                        $result[$i]['checkout_time'] = $attendances[$j]['checkout_time'];
                        $result[$i]['break_checkout_time'] = $attendances[$j]['break_checkout_time'];
                        $result[$i]['break_checkin_time'] = $attendances[$j]['break_checkin_time'];

                        if($attendances[$j]['checkin_time'] > $shift[0]['start_time'] && $attendances[$j]['checkin_time'] != null)
                        {
                            $late_duration = $this->timeDifference($shift[0]['start_time'], $attendances[$j]['checkin_time']);
                            $result[$i]['late_to_work'] = $late_duration;
                        }

                        $break_duration = $this->timeDifference($attendances[$j]['break_checkout_time'], $attendances[$j]['break_checkin_time']);
                        if($break_duration > $shift[0]['break_duration'] && $attendances[$j]['break_checkout_time'] != null && $attendances[$j]['break_checkin_time'] != null)
                        {
                            $result[$i]['over_break'] = ($break_duration - $shift[0]['break_duration']);
                        }

                        if($attendances[$j]['checkout_time'] < $shift[0]['end_time'] && $attendances[$j]['checkout_time'] != null)
                        {
                            $early_duration = $this->timeDifference($attendances[$j]['checkout_time'], $shift[0]['end_time']);
                            $result[$i]['leave_early'] = $early_duration;
                        }
                        break;
                    }
                }
            }
        }
        $status = $attendanceModel->getStatus($_SESSION['id']);

        $this->render('Views/dashboard.php', ['result' => $result, 'status' => $status]);
    }

    public function checkIn()
    {
        $code = $_REQUEST['code'];
        $codeModel = new CodeModel;
        $validCode = $codeModel->validateCode($code);
        if(count($validCode) < 1)
        {
            header("Location: /".ROOT_FOLDER_NAME."/dashboard?invalid");
            return false;
        }
        $attendanceModel = new AttendanceModel;
        $attendanceModel->checkIn($_SESSION['id']);
        header("Location: /".ROOT_FOLDER_NAME."/dashboard");
    }

    public function codeDisplay()
    {
        $this->render('Views/code.php');
    }

    public function generateCode()
    {
        $new_code = $this->getRandomCode();
        $code = new CodeModel;
        $code->setCode($new_code);

        // return new code as json response
        $response = new stdClass();
        $response->new_code = $new_code;
        $json = json_encode($response);
        echo $json;
    }
    
    private function getRandomCode($length = 5) {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($chars);
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) 
        {
            $randomCode .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomCode;
    }

    private function timeDifference($to_time, $from_time)
    {
        return round(abs(strtotime($to_time) - strtotime($from_time)) / 60);
    }
}

?>