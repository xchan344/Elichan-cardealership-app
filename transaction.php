<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Elichan Car Dealership App Transactions</title>
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
    <?php include "sidebar.php"; ?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="card striped-tabled-with-hover" style="background-color: rgb(35, 18, 75);">
                    <?php
                    require("config/db.php");

                    $customerFnameFilter = isset($_GET['customer_fname']) ? $_GET['customer_fname'] : "";
                    $customerLnameFilter = isset($_GET['customer_lname']) ? $_GET['customer_lname'] : "";
                    $carNameFilter = isset($_GET['car_name']) ? $_GET['car_name'] : "";
                    $transactionTypeNameFilter = isset($_GET['transaction_type_name']) ? $_GET['transaction_type_name'] : "";
                    $transactionStatusNameFilter = isset($_GET['transaction_status_name']) ? $_GET['transaction_status_name'] : "";
                    $tDateFilter = isset($_GET['t_date']) ? $_GET['t_date'] : "";

                    if (!isset($_GET['mode']) || $_GET['mode'] == 'view') {
                        $nresult = 15;

                        $query = "SELECT *
                            FROM transaction
                            JOIN cars ON transaction.c_id = cars.c_id
                            JOIN transaction_type ON transaction.tt_id = transaction_type.tt_id
                            JOIN transaction_status ON transaction.ts_id = transaction_status.ts_id";

                        $filters = array();
                        if (!empty($customerFnameFilter)) {
                            $filters[] = "customer_fname LIKE '%$customerFnameFilter%'";
                        }
                        if (!empty($customerLnameFilter)) {
                            $filters[] = "customer_lname LIKE '%$customerLnameFilter%'";
                        }
                        if (!empty($carNameFilter)) {
                            $filters[] = "car_name LIKE '%$carNameFilter%'";
                        }
                        if (!empty($transactionTypeNameFilter)) {
                            $filters[] = "transaction_type_name LIKE '%$transactionTypeNameFilter%'";
                        }
                        if (!empty($transactionStatusNameFilter)) {
                            $filters[] = "transaction_status_name LIKE '%$transactionStatusNameFilter%'";
                        }
                        if (!empty($tDateFilter)) {
                            $filters[] = "t_date LIKE '%$tDateFilter%'";
                        }

                        if (!empty($filters)) {
                            $query .= " WHERE " . implode(" AND ", $filters);
                        }
                    }
                    $total_rows_result = mysqli_query($db, $query);
                    $total_rows = mysqli_num_rows($total_rows_result);
                    $total_pages = ceil($total_rows / $nresult);
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($current_page - 1) * $nresult;
                    $query .= " ORDER BY transaction.t_id LIMIT $nresult OFFSET $offset";

                    $result = mysqli_query($db, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }

                    echo "<h1><img src='img/transaction-logo.png' height='50px' width='50px'> Transactions</h1>";
                    echo "</div>";

                    echo "<form method='GET' action='transaction.php'>";
                    echo "<div class='filter-container'>";
                    echo "<input type='text' name='customer_fname' placeholder='First Name'  style='width: 150px' value='" . htmlspecialchars($customerFnameFilter, ENT_QUOTES) . "'>";
                    echo "<input type='text' name='customer_lname' placeholder='Last Name' style='width: 150px' value='" . htmlspecialchars($customerLnameFilter, ENT_QUOTES) . "'>";
                    echo "<input type='text' name='car_name' placeholder='Car Name' style='width: 150px' value='" . htmlspecialchars($carNameFilter, ENT_QUOTES) . "'>";
                    echo "<input type='text' name='transaction_type_name' placeholder='Transaction Type' style='width: 150px' value='" . htmlspecialchars($transactionTypeNameFilter, ENT_QUOTES) . "'>";
                    echo "<input type='text' name='transaction_status_name' placeholder='Transaction Status' style='width: 150px' value='" . htmlspecialchars($transactionStatusNameFilter, ENT_QUOTES) . "'>";
                    echo "<input type='text' name='t_date' placeholder='Date' style='width: 150px; margin-right: 3px' value='" . htmlspecialchars($tDateFilter, ENT_QUOTES) . "'>";
                    echo "<button type='submit' class='filter-button'>Filter</button>";
                    echo "</div>";
                    echo "</form>";

                    if (mysqli_num_rows($result) > 0) {
                        echo "<div style='display:flex; align-items: center; justify-content: space-between;' class='col-lg-12 col-md-6 mb-md-0 mb-4'></div>";
                        echo "<table>";
                        echo "<tr><th>ID</th><th>Customer</th><th>Car</th><th>Transaction type</th><th>Price</th><th>Transaction Status</th><th>Date</th><th>Actions</th></tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['t_id'] . "</td>";
                            echo "<td>" . $row['customer_fname'] . " " . $row['customer_lname'] . "</td>";
                            echo "<td>" . $row['car_name'] . "</td>";
                            echo "<td>" . $row['transaction_type_name'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo "<td>" . $row['transaction_status_name'] . "</td>";
                            echo "<td>" . $row['t_date'] . "</td>";
                            echo "<td>";
                            echo "<form style='display:inline-block' action='transaction-edit.php?id=" . $row['t_id'] . "' method='post'>";
                            echo "<button type='submit' name='edit' class='edit-button'>Edit</button>";
                            echo "</form>";

                            echo "<form style='display:inline-block; margin-left: 15px' action='transaction-delete.php' method='post' onsubmit='return confirm(\"Are you sure you want to delete this transaction?\")'>";
                            echo "<input type='hidden' name='id' value='" . $row['t_id'] . "' />";
                            echo "<button type='submit' name='delete' class='delete-button'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        if ($total_pages > 1) {
                            echo "<div class='pagination'>";
                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($i == $current_page) {
                                    echo "<span class='current-page'>$i</span>";
                                } else {
                                    echo "<a href='?page=$i'>&nbsp;$i</a>";
                                }
                            }
                            echo "</div>";
                        }
                        echo "<div><button type='button' class='add-button' onclick=\"location.href='transaction-add.php'\">Add Transaction</button></div>";
                    } else {
                        echo "<p>No transaction found.</p>";
                    }
                    ?>
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