<?php
class Employee
{
    private $id;
    private $name;
    private $address;
    private $salary;

    public function __construct($name, $address, $salary, $id = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->salary = $salary;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getSalary()
    {
        return $this->salary;
    }
}
