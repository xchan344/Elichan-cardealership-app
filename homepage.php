<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Elichan Car Dealership App</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="style/bootstrap.min.css" rel="stylesheet" />
    <link href="style/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link href="style/demo.css" rel="stylesheet" />
    <link href="style/style.css" rel="stylesheet" />
</head>
<?php
require("config/db.php");

$query = "SELECT car_name, COUNT(*) AS total_sold
          FROM transaction
          JOIN cars ON transaction.c_id = cars.c_id
          GROUP BY cars.c_id
          ORDER BY total_sold DESC";
$result = mysqli_query($db, $query);

$dataPoints = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataPoints, array("label" => $row['car_name'], "y" => $row['total_sold']));
}

mysqli_close($db);
?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="script/chart1-script.js"></script>
<style>
    #chartContainer {
        height: 370px;
        width: 100%;
    }
</style>

<body>
    <?php include "sidebar.php"; ?>
    <div class="main-panel" style="background-color: #cbcdcf">
        <div  style="margin-left: 10px; margin-right: 10px; border: solid; border-width: 1px; padding: 3px; background-color: #f2f2f2;">
            <table>
                <tr>
                    <td style="padding-left: 100px;">Total earnings</td>
                    <td style="padding-left: 100px;">Total sales earnings</td>
                    <td style="padding-left: 100px;">Total repair earnings</td>
                    <td style="padding-left: 100px;">Total consult earnings</td>
                </tr>
                <tr>
                    <td style="padding-left: 100px;">
                        <?php
                        require("config/db.php");
                        $query = "SELECT SUM(price) as total_earn FROM transaction;";
                        $result = mysqli_query($db, $query);
                        if ($result) {
                            $total = mysqli_fetch_assoc($result);
                            echo "₱" . number_format($total['total_earn'], 2, '.', ',');
                        } else {
                            echo "Error retrieving last client ID: " . mysqli_error($db);
                        }
                        mysqli_close($db);
                        ?>
                    </td>
                    <td style="padding-left: 100px; ">
                        <?php
                        require("config/db.php");
                        $query = "SELECT SUM(price) as total_earn_sales FROM transaction WHERE ts_id='1'";
                        $result = mysqli_query($db, $query);
                        if ($result) {
                            $total = mysqli_fetch_assoc($result);
                            echo "₱" . number_format($total['total_earn_sales'], 2, '.', ',');
                        } else {
                            echo "Error retrieving last client ID: " . mysqli_error($db);
                        }
                        mysqli_close($db);
                        ?>
                    </td>
                    <td style="padding-left: 100px; ">
                        <?php
                        require("config/db.php");
                        $query = "SELECT SUM(price) as total_earn_repairs FROM transaction WHERE ts_id='2'";
                        $result = mysqli_query($db, $query);
                        if ($result) {
                            $total = mysqli_fetch_assoc($result);
                            echo "₱" . number_format($total['total_earn_repairs'], 2, '.', ',');
                        } else {
                            echo "Error retrieving last client ID: " . mysqli_error($db);
                        }
                        mysqli_close($db);
                        ?>
                    </td>
                    <td style="padding-left: 100px; ">
                        <?php
                        require("config/db.php");
                        $query = "SELECT SUM(price) as total_earn_consult FROM transaction WHERE ts_id='3'";
                        $result = mysqli_query($db, $query);
                        if ($result) {
                            $total = mysqli_fetch_assoc($result);
                            echo "₱" . number_format($total['total_earn_consult'], 2, '.', ',');
                        } else {
                            echo "Error retrieving last client ID: " . mysqli_error($db);
                        }
                        mysqli_close($db);
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card striped-tabled-with-hover" style="background-color: rgb(35, 18, 75);">
                    <div id="chartContainer"></div>
                    <script>
                        window.onload = function() {
                            var chart = new CanvasJS.Chart("chartContainer", {
                                animationEnabled: true,
                                title: {
                                    text: "Total transactions per car model"
                                },
                                axisY: {
                                    includeZero: false
                                },
                                data: [{
                                    type: "bar",
                                    yValueFormatString: "#,###",
                                    indexLabel: "{y}",
                                    indexLabelPlacement: "inside",
                                    indexLabelFontWeight: "bolder",
                                    indexLabelFontColor: "white",
                                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            chart.render();
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="content2">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript" src="script/chart2-script.js"></script>
            <style>
                #chart_div {
                    height: 400px;
                    width: 100%;
                }
            </style>
            <div class="content2">
                <div class="container-fluid">
                    <div class="card striped-tabled-with-hover" style="background-color: rgb(35, 18, 75);">
                        <div id="chart_div"></div>
                        <script>
                            google.charts.load('current', {
                                'packages': ['bar']
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Car', 'Total Price'],
                                    <?php
                                    require("config/db.php");
                                    $query = "SELECT car_name, SUM(price) AS total_price FROM transaction JOIN cars ON transaction.c_id = cars.c_id GROUP BY car_name ORDER BY total_price DESC LIMIT 10";
                                    $result = mysqli_query($db, $query);
                                    if (!$result) {
                                        printf("Error: %s\n", mysqli_error($db));
                                        exit();
                                    }
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "['" . $row['car_name'] . "', " . $row['total_price'] . "],";
                                    }
                                    ?>
                                ]);

                                var options = {
                                    chart: {
                                        title: 'Top 10 Cars by Total Price Sold',
                                        subtitle: 'in PHP'
                                    },
                                    bars: 'vertical',
                                    height: 400,
                                    legend: {
                                        position: 'none'
                                    },
                                    chartArea: {
                                        left: '15%',
                                        top: 50,
                                        width: '70%',
                                        height: '80%'
                                    }
                                };

                                var chart = new google.charts.Bar(document.getElementById('chart_div'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>
                    </div>
                </div>
</body>

</html>
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