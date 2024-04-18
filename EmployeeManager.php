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
    public function addEmployee(Employee $employee)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)");

        // Get values from the employee object
        $name = $employee->getName();
        $address = $employee->getAddress();
        $salary = $employee->getSalary();

        // Bind parameters
        $stmt->bind_param("ssd", $name, $address, $salary);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
    }

}