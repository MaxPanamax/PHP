<?php
include_once("./pages/classes/employee.php");

if (isset($_POST['logon'])) {
    $employee = Employee::fromDb($_POST['login'], $_POST['pass']);
    if ($employee != null) {
        $_SESSION['ruser'] = $employee->Login;
        if ($employee->RoleId == 1) {
            $_SESSION['radmin'] = $employee->Login;
        }
    }
}
if (isset($_POST['logout'])) {
    unset($_SESSION['ruser']);
    unset($_SESSION['radmin']);
}
