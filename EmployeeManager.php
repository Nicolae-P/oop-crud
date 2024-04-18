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
    public function getEmployee($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM employees WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return new Employee($row['name'], $row['address'], $row['salary'], $row['id']);
        }
        $stmt->close();
        return null;
    }
    public function updateEmployee(Employee $employee)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE employees SET name = ?, address = ?, salary = ? WHERE id = ?");

        // Get values from the employee object
        $name = $employee->getName();
        $address = $employee->getAddress();
        $salary = $employee->getSalary();
        $id = $employee->getId();

        // Bind parameters
        $stmt->bind_param("ssdi", $name, $address, $salary, $id);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
    }
    public function deleteEmployee($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM employees WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

}