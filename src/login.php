<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: dasboard_admin.php"); 
    exit();
} elseif (isset($_SESSION['siswa'])) {
    header("Location: index.php"); 
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .image-container {
            position: relative;
            display: inline-block;
        }

        .image-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        .image-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.9));
            z-index: 1;
        }

        .image-container img {
            position: relative;
            z-index: 0;
        }
    </style>
</head>

<body>
    <div class="container mt-5 d-flex justify-content-center">

        <div class="card shadow-lg " style="width:24rem">
            <div class="image-container">
                <img src="uploads/login.jpg" class="card-img-top img-fluid">
            </div>
            <div class="card-body p-4">
                <h2 class="fw-bold">LOGIN </h2>
                <hr>
                <form action="func.php" method="post">

                    <label class="form-label" for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>

                    <label class="form-label" for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>

                    <button type="submit" class="btn btn-dark w-100 rounded-pill mt-3" name="login">Login</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>