<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Elichan Car Dealership App Cars-Add</title>
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
<?php include "sidebar.php"?>
<div class=main-panel>
    <div class="content">
        <div class="container-fluid">
            <div class="card strpied-tabled-with-hover">
                <h1><img src='img/car-logo.png' height='50px' width='50px'> Add Car Model</h1>
                <?php 
    require('config/db.php');
    if(isset($_POST['submit'])){
        $car_name = mysqli_real_escape_string($db, $_POST['car_name']);
        $m_id = mysqli_real_escape_string($db, $_POST['m_id']);
        
        $query = "INSERT INTO cars (car_name, m_id) 
                    VALUES ('$car_name', '$m_id')";
        if (mysqli_query($db, $query)){
            echo '<div class="alert alert-success" role="alert">
            Successfully added new Car Model!</div>';
        }else{
            echo '<div class="alert alert-danger" role="alert">
            Invalid! please fill out all the data!';
            echo 'ERROR:'. mysqli_error($db);
        }
    }
?>
            </div>
            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                <table>
                    <tr>
                        <td><label>Car Model</label></td>
                        <td><input name="car_name" type="text" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td><label>Manufacturer</label></td>
                        <td>
                                <select name="m_id" class="form-control" required>
                                    <option value="">--Car Model--</option>
                                    <?php
                                    require("config/db.php");
                                    $query = "SELECT * FROM manufacturer";
                                    $result = mysqli_query($db, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['m_id'] . "'>" . $row['m_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="save">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" name="submit" value="submit" class="save-button" style="margin-top: 20px;">Save</button>
                                    <button type="button" value="submit" class="back-button" style="margin-top: 20px;" onclick="location.href='cars.php'">Back</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
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

