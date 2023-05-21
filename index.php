<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Elichan Car Dealership Sign in</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="style/bootstrap.min.css" rel="stylesheet" />
    <link href="style/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link href="style/demo.css" rel="stylesheet" />
    <link href="style/style.css" rel="stylesheet" />
    <link href="style/login.css" rel="stylesheet" />
    <link href="style/login-animation.css" rel="stylesheet" />
</head>

<body class="login-body" style="background-image: url('img/background.jpeg');">
    <?php require('config/db.php'); ?>
    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username == 'admin' && $password == 'admin') {
            $_SESSION['username'] = $username;
            header('Location: homepage.php');
            exit;
        } else {
            $error_msg = "Incorrect username or password.";
        }
    }
    ?>
    <div class="sign-in">
        <img src="img/logo.png" style="display: block; margin: auto; width: 300px; height: auto; box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2); padding-bottom: 30px" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
        <p onclick="document.getElementById('id01').style.display='block'" style="width:auto; font-size: larger; color: rgb(35, 18, 75); margin-top: -33px; width: 250px; text-align:center; align-items: center; margin-left: 80px" class="sign-in-text">Click here to sign in</p>
    </div>
    <div id="id01" class="modal">

        <form class="modal-content animate" action="homepage.php" method="post">
            <div class="container">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="form-signin">
                    <img src="img/logo.png" style="display: block; margin: auto; width: 50%; height: auto;">
                    <table>
                        <tr>
                            <td>
                                <h1 class="h3 mb-3 font-weight-normal">Elichan Car Dealership App</h1>
                            </td>
                        <tr>
                            <td>
                                <p style="text-align: center">Sign in</p>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="inputEmail">Username: </label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="inputPassword">Password: </label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><input type="checkbox" value="remember-me" style="text-align: center;"> Remember me</label>
                                <button type="submit" name="submit" value="Submit">Sign in</button>
                            </td>
                        </tr>
                    </table>
                </form>
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
<script>
    var modal = document.getElementById('id01');
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>