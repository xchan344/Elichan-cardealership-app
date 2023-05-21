<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Elichan Car Dealership Edit Employees</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="style/bootstrap.min.css" rel="stylesheet" />
    <link href="style/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link href="style/demo.css" rel="stylesheet" />
    <link href="style/style.css" rel="stylesheet" />
    <link href="style/tables-buttons.css" rel="stylesheet" />
</head>



<body>
    <?php include "sidebar.php" ?>
    <div class=main-panel>
        <div class="content">
            <div class="container-fluid">
                <div class="card strpied-tabled-with-hover">
                    <h1><img src='img/team-logo.png' height='50px' width='50px'> Edit Employees</h1>
                    <?php
require('config/db.php');
$id = $_GET['id'];
if (isset($_POST['update'])) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $birthdate = mysqli_real_escape_string($db, $_POST['birthdate']);
    $p_id = mysqli_real_escape_string($db, $_POST['p_id']);
    $contact = mysqli_real_escape_string($db, $_POST['contact']);

    $query = "UPDATE employee SET 
                fname='$fname', 
                lname='$lname',
                birthdate='$birthdate', 
                p_id='$p_id', 
                contact='$contact'
                WHERE e_id='$id'";
    if (mysqli_query($db, $query)) {
        echo '<div class="alert alert-success" role="alert">
            Successfully updated employee!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
            Invalid! please fill out all the data!';
        echo 'ERROR:' . mysqli_error($db);
    }
}
$query = "SELECT * FROM employee WHERE e_id='$id'";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    $error_msg = 'No data found for this employee!';
    exit;
}
?>
                </div>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <table>
                            <tr>
                                <td><label>First Name</label></td>
                                <td><input name="fname" type="text" class="form-control" value="<?php echo $row['fname'] ?>" required></td>
                            </tr>
                            <tr>
                                <td><label>Last Name</label></td>
                                <td><input name="lname" type="text" class="form-control" value="<?php echo $row['lname'] ?>" required></td>
                            </tr>
                            <tr>
                                <td><label>Birth Date</label></td>
                                <td><input name="birthdate" type="date" class="form-control" value="<?php echo $row['birthdate'] ?>" required></td>
                            </tr>
                            <tr>
                                <td><label>Position</label></td>
                                <td>
                                    <select name="p_id" class="form-control" required>
                                        <?php
                                        $query = "SELECT * FROM position";
                                        $result = mysqli_query($db, $query);
                                        while ($pos_row = mysqli_fetch_assoc($result)) {
                                            if ($pos_row['p_id'] == $row['p_id']) {
                                                echo "<option value='" . $pos_row['p_id'] . "' selected>" . $pos_row['position_type'] . "</option>";
                                            } else {
                                                echo "<option value='" . $pos_row['p_id'] . "'>" . $pos_row['position_type'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Contact</label></td>
                                <td><input name="contact" type="number" class="form-control" value="<?php echo $row['contact'] ?>" required></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="save">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" name="update" value="update" class="save-button" style="margin-top: 10px;">Update</button>
                                            <button type="button" value="submit" class="back-button" style="margin-top: 20px;" onclick="location.href='employee.php'">Back</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <?php
        mysqli_close($db);
        ?>
        <?php if (isset($success_msg)) : ?>
            <div class="alert alert-success"><?php echo $success_msg ?></div>
        <?php elseif (isset($error_msg)) : ?>
            <div class="alert alert-danger"><?php echo $error_msg ?></div>
        <?php endif; ?>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<script src="assets/js/plugins/chartist.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<script src="assets/js/demo.js"></script>

</html>