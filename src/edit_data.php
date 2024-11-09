<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .back-link {
            margin-top: 20px;
            text-align: center;
        }

        a {
            color: #5cb85c;
            text-decoration: none;
        }

        body {
            margin: 0;
            padding-top: 40px;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }

        .account-settings .user-profile {
            margin: 0 0 1rem 0;
            padding-bottom: 1rem;
            text-align: center;
        }

        .account-settings .user-profile .user-avatar {
            margin: 0 0 1rem 0;
        }

        .account-settings .user-profile .user-avatar img {
            width: 150px;
            height: 150px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        .account-settings .user-profile h5.user-name {
            margin: 0 0 0.5rem 0;
        }

        .account-settings .user-profile h6.user-email {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 400;
            color: #9fa8b9;
        }

        .account-settings .about {
            margin: 2rem 0 0 0;
            text-align: center;
        }

        .account-settings .about h5 {
            margin: 0 0 15px 0;
            color: #007ae1;
        }

        .account-settings .about p {
            font-size: 0.825rem;
        }

        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-size: .825rem;
            background: #ffffff;
            color: #2e323c;
        }

        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }
    </style>
<body>

<?php

include 'func.php';
if (!$conn) {
    die("koneksi gagal :" . mysqli_connect_error());

}

$id = $_GET['id'];

$sql = "SELECT * FROM siswa where id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

} else {
    echo "tugas tidak ditemukan.";
    exit;
}

mysqli_close($conn);

?>

<div class="container justify-content-center">
<div class="col-xl-12 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100 shadow-lg p-4">
                    <div class="card-body">
                        <div class="row gutters">
                            <form action="func.php" method="post" enctype="multipart/form-data">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-dark text-center fw-bold">Perbarui Data Siswa</h6>
                                </div>

                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="username">Nama Siswa</label>
                                        <input type="text" name="nama_siswa" class="form-control w-full" value="<?= $row['nama_siswa']; ?>">
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail">NIS (Nomor Induk Siswa)</label>
                                        <input type="yyext" name="nis" class="form-control" value="<?= $row['nis']; ?>"
                                            placeholder="Enter email ID">
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Kelas</label>
                                        <input type="text" name="kelas" class="form-control" value="<?= $row['kelas']; ?>">
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Tanggal lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" value="<?= $row['tanggal_lahir']; ?>">
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="<?= $row['alamat']; ?>">
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Nomor Handphone</label>
                                        <input type="text" name="nomor" class="form-control" value="<?= $row['nomor']; ?>">
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="file">Pilih File Profile</label>
                                        <input class="form-control" type="file" name="photo" required>
                                    </div>
                                </div>

                                <div class="row gutters mt-4">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right ">
                                            <a href="index.php" class="btn btn-secondary w-100 ">Cancel</a>
                                            <button type="submit" name="update"
                                                class="btn btn-dark mt-3" id="showAlertButton" >Update</button>
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</body>
</html>