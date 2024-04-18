<?php
require_once 'EmployeeManager.php';
$manager = new EmployeeManager();
$employees = $manager->getAllEmployees();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Employees Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New
                            Employee</a>
                    </div>
                    <?php
                    if (count($employees) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Name</th>";
                        echo "<th>Address</th>";
                        echo "<th>Salary</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        foreach ($employees as $employee) {
                            echo "<tr>";
                            echo "<td>" . $employee->getId() . "</td>";
                            echo "<td>" . htmlspecialchars($employee->getName()) . "</td>";
                            echo "<td>" . htmlspecialchars($employee->getAddress()) . "</td>";
                            echo "<td>" . htmlspecialchars($employee->getSalary()) . "</td>";
                            echo "<td>";
                            echo '<a href="update.php?id=' . $employee->getId() . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="px-3 fa fa-pencil"></span></a>';
                            echo '<a href="delete.php?id=' . $employee->getId() . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo '</table>';
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>