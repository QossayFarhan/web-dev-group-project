<?php

use Model\Employee as EmployeeModel;

 class LoginController extends Controller
{

    public function default1(){
        $employeeModel = new EmployeeModel;
        $employees = $employeeModel->getEmployees();
        echo  $employee;

    }


    public function default()
    {
        header("Location: /".ROOT_FOLDER_NAME."/login");
    }

    public function loginPage()
    {
        $this->render('Views/login.php');
    }

    public function login()
    {
        $email = $_REQUEST['email'];
        $password = md5($_REQUEST['password']); // encrypting password with md5 method

        $employee = new EmployeeModel;
        $employee = $employee->login($email, $password);
        if($employee)
        {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $employee[0]['id'];
            $_SESSION['admin'] = $employee[0]['admin'];
            header("Location: /".ROOT_FOLDER_NAME."/dashboard");
        }else 
        {
            header("Location: /".ROOT_FOLDER_NAME."/login?invalid");
        }
    }

    public function logout()
    {
        session_start();

        if(session_destroy()) {
            header("Location: /".ROOT_FOLDER_NAME."/login");
        }
    }
        
}

?>