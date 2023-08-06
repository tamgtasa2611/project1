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
    <title>Edit a furniture</title>
</head>
<body>
<?php
$id = $_GET['id'];
include_once("../../connect/open.php");
$sql = "SELECT * FROM furnitures WHERE id = '$id'";
$furnitures = mysqli_query($connect, $sql);
$sql2 = "SELECT * FROM categories";
$categories = mysqli_query($connect, $sql2);
$sql3 = "SELECT * FROM producers";
$producers = mysqli_query($connect, $sql3);
include_once("../../connect/close.php");
$imgSource = "";
foreach ($furnitures as $furniture) {
    ?>

    <div id="content" class="">
        <div class="wrapper d-flex align-items-stretch">
            <div style="width: 250px"></div>
            <div class="position-fixed" style="height: 100%">
                <?php
                include("../../layout/admin_menu.php");
                ?>
            </div>

            <!--  content  -->

            <div class="content-container">
                <h4 class="content-heading">Edit furniture's information</h4>
                <form action="update.php" method="post" class="w-75 m-auto" enctype="multipart/form-data">
                    <div class="dashboard-block w-100 h-100 mb-3">
                        <div class="db-title">
                            Enter new furniture's information
                        </div>

                        <div class="dashboard-body" style="height: 400px">
                            <div class="d-flex justify-content-evenly align-items-center" style="height: 16%">
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Name
                                    </div>
                                    <div>
                                        <input name="id" type="number" class="form-control-sm d-none"
                                               value="<?= $furniture['id'] ?>" readonly/>
                                        <input name="name" type="text" class="form-control-sm"
                                               value="<?= $furniture['name'] ?>" required/>
                                    </div>
                                </div>
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Quantity
                                    </div>
                                    <div>
                                        <input name="quantity" type="number" class="form-control-sm"
                                               value="<?= $furniture['quantity'] ?>" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-evenly align-items-center" style="height: 16%">
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Price
                                    </div>
                                    <div>
                                        <input name="price" type="number" class="form-control-sm"
                                               value="<?= $furniture['price'] ?>" required/>
                                    </div>
                                </div>
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Material
                                    </div>
                                    <div>
                                        <input name="material" type="text" class="form-control-sm"
                                               value="<?= $furniture['material'] ?>" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-evenly align-items-center" style="height: 16%">
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Length (cm)
                                    </div>
                                    <div>
                                        <input name="length" type="number" class="form-control-sm"
                                               value="<?= $furniture['length'] ?>" required/>
                                    </div>
                                </div>
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Width (cm)
                                    </div>
                                    <div>
                                        <input name="width" type="number" class="form-control-sm"
                                               value="<?= $furniture['width'] ?>" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-evenly align-items-center" style="height: 16%">
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Height (cm)
                                    </div>
                                    <div>
                                        <input name="height" type="number" class="form-control-sm"
                                               value="<?= $furniture['height'] ?>" required/>
                                    </div>
                                </div>
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Room
                                    </div>
                                    <div>
                                        <input name="room" type="text" class="form-control-sm"
                                               value="<?= $furniture['room'] ?>" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-evenly align-items-center" style="height: 16%">
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Category
                                    </div>
                                    <div>
                                        <select name="category_id" id="" class="form-select-sm">
                                            <?php
                                            foreach ($categories as $category) {
                                                ?>
                                                <option value="<?= $category['id'] ?>"
                                                    <?php
                                                    if ($furniture['category_id'] == $category['id']) {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    <?= $category['name'] ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex w-50 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Producer
                                    </div>
                                    <div>
                                        <select name="producer_id" id="" class="form-select-sm">
                                            <?php
                                            foreach ($producers as $producer) {
                                                ?>
                                                <option value="<?= $producer['id'] ?>"
                                                    <?php
                                                    if ($furniture['producer_id'] == $producer['id']) {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    <?= $producer['name'] ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-evenly align-items-center" style="height: 16%">
                                <div class="d-flex w-100 justify-content-center align-items-center">
                                    <div style="margin-right: 12px">
                                        Image
                                    </div>
                                    <div>
                                        <input name="image" type="file" value="../images/<?= $furniture['image'] ?>"
                                               accept="image/*"/>
                                        <?php
                                        $imgSource = $furniture['image'];
                                        ?>
                                        <img height="80px" src="../images/<?= $furniture['image'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary nice-box-shadow" href="index.php">Back</a>
                        <button class="btn btn-primary nice-box-shadow" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>

<script>
    // Get a reference to our file input
    const fileInput = document.querySelector('input[type="file"]');

    // Create a new File object
    const myFile = new File(['strings'], '<?=$imgSource?>', {
        type: 'text/plain',
        lastModified: new Date(),
    });

    // Now let's create a DataTransfer to get a FileList
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(myFile);
    fileInput.files = dataTransfer.files;
</script>
</body>
</html>