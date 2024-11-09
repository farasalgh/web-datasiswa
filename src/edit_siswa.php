<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    input,
    select,
    textarea {
        width: calc(100% - 16px);
        /* Mengurangi lebar untuk padding */
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    label {
        display: block;
    }
</style>
</head>

<body>
    <?php

    include 'koneksi.php';
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

    <div class="container mt-5 d-flex justify-content-center">
        <div class="row">
            <h2 class="text-center fw-bold">Edit Data Siswa</h2>
            <form action="func.php" method="post">
                <input type="hidden" name="id" value=<?php echo $row['id']; ?>>
                <label for="task_name" class="form-label">Nama Siswa:</label>
                <input type="text" id="task_name" class="form-control" name="nama_siswa"
                    value="<?= $row['nama_siswa']; ?>" required>

                <label for="task_name" class="form-label">NIS:</label>
                <input type="text" id="task_name" class="form-control" name="nis" value="<?= $row['nis']; ?>"
                    required>

                <label for="task_name" class="form-label">Kelas:</label>
                <input type="text" id="task_name" class="form-control" name="kelas" value="<?= $row['kelas']; ?>"
                    required>

                <label for="task_name" class="form-label">Tanggal Lahir:</label>
                <input type="text" id="task_name" class="form-control" name="tanggal_lahir"
                    value="<?= $row['tanggal_lahir']; ?>" required>

                <label for="task_name" class="form-label">Alamat :</label>
                <input type="text" id="task_name" class="form-control" name="alamat" value="<?= $row['alamat']; ?>"
                    required>

                <label for="task_name" class="form-label">Nomor Telepon:</label>
                <input type="text" id="task_name" class="form-control" name="nomor" value="<?= $row['nomor']; ?>"
                    required>

                <button type="submit" class="mt-3 w-100 btn btn-warning" name="simpan">Simpan
                    Perubahan</button>
            </form>
            <div class="text-center mt-2 fw-bold">
                <a class="text-secondary-emphasis" href="dasboard_admin.php">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>

    </div>
</body>

</html>