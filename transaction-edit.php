<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Elichan Car Dealership Edit Transaction</title>
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
                    <h1><img src='img/transaction-logo.png' height='50px' width='50px'> Edit Transaction</h1>
                    <?php
                    require('config/db.php');
                    $id = $_GET['id'];
                    if (isset($_POST['update'])) {
                        $customer_fname = mysqli_real_escape_string($db, $_POST['customer_fname']);
                        $customer_lname = mysqli_real_escape_string($db, $_POST['customer_lname']);
                        $c_id = mysqli_real_escape_string($db, $_POST['c_id']);
                        $tt_id = mysqli_real_escape_string($db, $_POST['tt_id']);
                        $price = mysqli_real_escape_string($db, $_POST['price']);
                        $ts_id = mysqli_real_escape_string($db, $_POST['ts_id']);
                        $t_date = mysqli_real_escape_string($db, $_POST['t_date']);
                        $query = "UPDATE transaction SET 
                        customer_fname='$customer_fname', 
                        customer_lname='$customer_lname',
                        c_id='$c_id',
                        tt_id='$tt_id',
                        price='$price',
                        ts_id='$ts_id',
                        t_date='$t_date'
                        WHERE t_id='$id'";
                        if (mysqli_query($db, $query)) {
                            echo '<div class="alert alert-success" role="alert">
                            Successfully updated transaction!</div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">
                            Invalid! please fill out all the data!';
                            echo 'ERROR:' . mysqli_error($db);
                        }
                    }
                    $query = "SELECT * FROM transaction WHERE t_id='$id'";
                    $result = mysqli_query($db, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                </div>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <table>
                        <tr>
                            <td><label>Customer First name</label></td>
                            <td><input name="customer_fname" type="text" class="form-control" value="<?php echo $row['customer_fname'] ?>" required></td>
                        </tr>
                        <tr>
                        <tr>
                            <td><label>Customer Last name</label></td>
                            <td><input name="customer_lname" type="text" class="form-control" value="<?php echo $row['customer_lname'] ?>" required></td>
                        </tr>
                        <tr>
                            <td><label>Car Model</label></td>
                            <td>
                                <select name="c_id" class="form-control" required>
                                    <?php
                                    require("config/db.php");
                                    $query = "SELECT * FROM cars";
                                    $result = mysqli_query($db, $query);
                                    while ($m_row = mysqli_fetch_assoc($result)) {
                                        if ($m_row['c_id'] == $row['c_id']) {
                                            echo "<option value='" . $m_row['c_id'] . "' selected>" . $m_row['car_name'] . "</option>";
                                        } else {
                                            echo "<option value='" . $m_row['c_id'] . "'>" . $m_row['car_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Transaction Type</label></td>
                            <td>
                                <select name="tt_id" class="form-control" required>
                                    <?php
                                    require("config/db.php");
                                    $query = "SELECT * FROM transaction_type";
                                    $result = mysqli_query($db, $query);
                                    while ($m_row = mysqli_fetch_assoc($result)) {
                                        if ($m_row['tt_id'] == $row['tt_id']) {
                                            echo "<option value='" . $m_row['tt_id'] . "' selected>" . $m_row['transaction_type_name'] . "</option>";
                                        } else {
                                            echo "<option value='" . $m_row['tt_id'] . "'>" . $m_row['transaction_type_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Price</label></td>
                            <td><input name="price" type="number" class="form-control" value="<?php echo $row['price'] ?>" required></td>
                        </tr>
                        <tr>
                        <tr>
                            <td><label>Transaction Status</label></td>
                            <td>
                                <select name="ts_id" class="form-control" required>
                                    <?php
                                    require("config/db.php");
                                    $query = "SELECT * FROM transaction_status";
                                    $result = mysqli_query($db, $query);
                                    while ($m_row = mysqli_fetch_assoc($result)) {
                                        if ($m_row['ts_id'] == $row['ts_id']) {
                                            echo "<option value='" . $m_row['ts_id'] . "' selected>" . $m_row['transaction_status_name'] . "</option>";
                                        } else {
                                            echo "<option value='" . $m_row['ts_id'] . "'>" . $m_row['transaction_status_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Date</label></td>
                            <td><input name="t_date" type="date" class="form-control" value="<?php echo $row['t_date'] ?>" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="save">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" name="update" value="update" class="save-button" style="margin-top: 10px;">Save</button>
                                        <button type="button" value="submit" class="back-button" style="margin-top: 20px;" onclick="location.href='transaction.php'">Back</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</html>
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