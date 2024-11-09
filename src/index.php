<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: dasboard_admin.php"); 
    exit();
}  else if (!isset($_SESSION['id'])) {
    header('location:login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



</head>

<body>

    <?php

    include('koneksi.php');

    $id = $_SESSION['id'];
    ?>

    <div>

        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="index.php"
                            class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline mt-4 fw-bold">Dashboard Siswa</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link align-middle px-0">
                                    <i class="fa-solid fa-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                                </a>
                            </li>


                            <li>
                                <a href="edit_data.php?id=<?= $_SESSION['id']; ?>" class="nav-link px-0 align-middle">
                                    <i class="fa-solid fa-pen-to-square"></i> <span class="ms-1 d-none d-sm-inline">Edit
                                        Data</span></a>
                            </li>
                        </ul>
                        <hr>
                        <?php
                        $sql = "SELECT * FROM siswa where id='$id'";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="dropdown pb-4">
                                <a href="#"
                                    class="d-flex d-block  align-items-center text-white text-decoration-none dropdown-toggle"
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="
                                        <?php
                                        if ($row['photo'] == '') {
                                            echo 'uploads/user.png';
                                        } else {
                                            echo 'uploads/' . $row['photo'];
                                        }
                                        ?>
                                        "  width="30" height="30" class="rounded-circle">
                                    <span class="d-none d-sm-inline mx-1"><?= $_SESSION['username']; ?></span>
                                </a>
                                <?php
                        }
                        ?>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col py-3">
                    <div class="container justify-content-center">
                        <input type="hidden" name="id" value=<?php $_SESSION['id']; ?>>

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card bg-grey p-4 h-100 shadow-lg">
                                    <div class="card-body">
                                        <div class="account-settings">
                                            <div class="user-profile">
                                                <?php
                                                $sql = "SELECT * FROM siswa where id='$id'";
                                                $result = mysqli_query($conn, $sql);

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <div class="text-center">
                                                        <div class="mb-2">

                                                            <img class="rounded-circle mx-auto d-block" src="
                                        <?php
                                        if ($row['photo'] == '') {
                                            echo 'uploads/user.png';
                                        } else {
                                            echo 'uploads/' . $row['photo'];
                                        }
                                        ?>
                                        " width="150px">
                                                        </div>
                                                        <h6 class="fw-bold fs-3"><?= $row['nama_siswa']; ?></h6>
                                                    </div>

                                                    <hr>
                                                    <div class="mt-4">
                                                        <h6>NIS (Nomor Induk Siswa)</h6>
                                                        <div class="border border-grey shadow-sm p-2">

                                                            <h6 class=" user-name"><?= $row['nis']; ?></h6>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4">
                                                        <h6>Kelas</h6>
                                                        <div class="border border-grey shadow-sm p-2">

                                                            <h6 class=" user-name"><?= $row['kelas']; ?></h6>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4">
                                                        <h6>Tanggal Lahir</h6>
                                                        <div class="border border-grey shadow-sm p-2">

                                                            <h6 class=" user-name">
                                                                <?php
                                                                if ($row['tanggal_lahir'] == '') {
                                                                    echo 'Data belum diisi';
                                                                } else {
                                                                    echo $row['tanggal_lahir'];
                                                                }
                                                                ?>
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4">
                                                        <h6>Alamat</h6>
                                                        <div class="border border-grey shadow-sm p-2">

                                                            <h6 class=" user-name">
                                                                <?php
                                                                if ($row['alamat'] == '') {
                                                                    echo 'Data belum diisi';
                                                                } else {
                                                                    echo $row['alamat'];
                                                                }
                                                                ?>
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4">
                                                        <h6>Nomor Handphone</h6>
                                                        <div class="border border-grey shadow-sm p-2">

                                                            <h6 class=" user-name">
                                                                <?php
                                                                if ($row['nomor'] == '') {
                                                                    echo 'Data belum diisi';
                                                                } else {
                                                                    echo $row['nomor'];
                                                                }
                                                                ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="mt-5 mb-4 grid gap-3 ">
                                                    <a href="edit_data.php?id=<?= $_SESSION['id']; ?>"
                                                        class="btn btn-dark">
                                                        <i class="fa-solid fa-pen-to-square"></i><span class="ms-3 d-none d-sm-inline">Edit
                                                        Data Siswa</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>

</body>

</html>