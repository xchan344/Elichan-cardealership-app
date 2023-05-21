<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Elichan Car Dealership App Cars</title>
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
                    <?php
                    require("config/db.php");
                    if (!isset($_GET['mode']) || $_GET['mode'] == 'view') {
                        $nresult = 15;
                        $query = "SELECT * FROM cars
                        JOIN manufacturer ON cars.m_id = manufacturer.m_id
                        ORDER BY cars.c_id";
                        $result = mysqli_query($db, $query);
                        $total_rows = mysqli_num_rows($result);
                        $total_pages = ceil($total_rows / $nresult);
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $offset = ($current_page - 1) * $nresult;
                        $query .= " LIMIT $nresult OFFSET $offset";
                        $result = mysqli_query($db, $query);

                        echo "<h1><img src='img/car-logo.png' height='50px' width='50px'>  Car Models</h1>";

                        if (mysqli_num_rows($result) > 0) {
                            echo "<div style='display:flex; align-items: center; justify-content: space-between;'>";
                            echo "</select></div>";
                            echo "</div>";
                            echo "<table style='width: 600px'>";
                            echo "<tr><th>ID</th><th>Car Model</th><th>Manufacturer</th><th>Actions</th></tr>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['c_id'] . "</td>";
                                echo "<td>" . $row['car_name'] . "</td>";
                                echo "<td>" . $row['m_name'] . "</td>";
                                echo "<td>";
                                echo "<form style='display:inline-block' action='cars-edit.php?id=" . $row['c_id'] . "' method='post'>";
                                echo "<button type='submit' name='edit' class='edit-button'>Edit</button>";
                                echo "</form>";

                                echo "<form style='display:inline-block; margin-left: 15px' action='cars-delete.php' method='post' 
                        onsubmit='return confirm(\"Are you sure you want to delete this employee?\")'>";
                                echo "<input type='hidden' name='id' value='" . $row['c_id'] . "'>";
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
                            echo "<div><button type='button' class='add-button' onclick=\"location.href='cars-add.php'\">Add Car Model</button></div>";
                        } else {
                            echo "<p>No employees found.</p>";
                        }
                    }
                    ?>
                </div>
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
