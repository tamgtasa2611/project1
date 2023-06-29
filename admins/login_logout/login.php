<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: ../manager/index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">

    <title>Log in</title>
</head>
<body>
<section class="vh-100" style="background-color: #2d2d2d;">
    <div class="container vh-100">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="w-25">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Log in</h3>
                        <form action="loginProcess.php" method="post">
                            <div class="form-outline mb-2">
                                <input name="email" type="email" placeholder="Email"
                                       class="input-group"/>
                            </div>

                            <div class="form-outline mb-2">
                                <input name="password" type="password" placeholder="Password"
                                       class="input-group"/>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>