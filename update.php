<?php
require_once 'EmployeeManager.php';
require_once 'Employee.php';

$id = $name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $input_name)) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please enter an address.";
    } else {
        $address = $input_address;
    }

    $input_salary = trim($_POST["salary"]);
    if (empty($input_salary)) {
        $salary_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($input_salary)) {
        $salary_err = "Please enter a positive integer as salary.";
    } else {
        $salary = $input_salary;
    }

    if (empty($name_err) && empty($address_err) && empty($salary_err)) {
        $employee = new Employee($name, $address, $salary, $id);
        $manager = new EmployeeManager();
        $manager->updateEmployee($employee);
        header("location: index.php");
        exit();
    }
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $manager = new EmployeeManager();
        $employee = $manager->getEmployee($id);

        if ($employee != null) {
            $name = $employee->getName();
            $address = $employee->getAddress();
            $salary = $employee->getSalary();
        } else {
            // Employee ID is not found
            header("location: error.php"); // Redirect to an error page
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Update Employee Information</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name"
                                class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address"
                                class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary"
                                class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>