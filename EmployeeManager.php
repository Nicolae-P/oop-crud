<?php
require_once 'Database.php';
require_once 'Employee.php';

class EmployeeManager
{
    public function getAllEmployees()
    {
        $employees = [];
        $db = Database::getInstance()->getConnection();
        $result = $db->query("SELECT * FROM employees");
        while ($row = $result->fetch_assoc()) {
            $employees[] = new Employee($row['name'], $row['address'], $row['salary'], $row['id']);
        }
        return $employees;
    }

}
?>