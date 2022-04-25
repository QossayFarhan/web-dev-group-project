<?php

use Model\Employee as EmployeeModel;

 class EmployeeController extends Controller
{

    public function employeeList()
    {
        $success = $_REQUEST['success'] ?? null;
        $employee = new EmployeeModel;
        $result = $employee->getEmployees();

        $this->render('Views/employeeList.php', ["employees" => $result, "success" => $success]);
    }

    public function employeeCreatePage()
    {
        $this->render('Views/employeeCreate.php');
    }

    public function employeeCreate()
    {
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $password = md5($_REQUEST['password']); // encrypting password with md5 method
        $admin = $_REQUEST['admin'];

        $employee = new EmployeeModel;
        $employee_created = $employee->createEmployee($name, $email, $password, $admin);

        if($employee_created)
        {
            header("Location: /".ROOT_FOLDER_NAME."/employeeList?success=create");
        }
    }

    public function employeeDetails()
    {
        $success = $_REQUEST['success'] ?? null;
        $id = $_REQUEST['id'];
        $employee = new EmployeeModel;
        $result = $employee->getProfile($id);
        $this->render('Views/employeeDetails.php', ['employee' => $result, 'success' => $success]);
    }

    public function employeeUpdate()
    {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $admin = $_REQUEST['admin'];

        $employee = new EmployeeModel;
        $employee_created = $employee->updateEmployee($id, $name, $email, $admin);

        if($password != '')
        {
            $employee->updatePassword($id, md5($password));
        }

        header("Location: /".ROOT_FOLDER_NAME."/employeeDetails?success=update&id=".$id);
    }

    public function employeeDelete()
    {
        $id = $_REQUEST['id'];
        $employee = new EmployeeModel;
        $result = $employee->deleteEmployee($id);
        header("Location: /".ROOT_FOLDER_NAME."/employeeList?success=delete");
    }
    
}

?>