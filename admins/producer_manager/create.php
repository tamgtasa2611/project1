<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login_logout/login.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">
    <title>Add a producer</title>
</head>
<body>
<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <?php
        include("../../layout/admin_menu.php");
        ?>

        <div class="content-container">
            <h4 class="content-heading">Add a new producer</h4>
            <form action="store.php" method="post" class="w-50 m-auto">
                <div class="dashboard-block w-100 h-75 mb-3">
                    <div class="db-title">
                        Enter new producer's information
                    </div>

                    <div class="dashboard-body" style="height: 100px">
                        <div class="d-flex justify-content-center h-100 align-items-center">
                            <div>
                                Name
                            </div>
                            <div class="w-50">
                                <input name="name" type="text" class="form-control-sm" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary nice-box-shadow" href="index.php">Back</a>
                    <button class="btn btn-primary nice-box-shadow" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>