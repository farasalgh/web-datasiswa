<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
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
    <div class="container mt-5 d-flex justify-content-center">
        <div class="row ">
            <h2 class="text-center fw-bold">Edit Data Siswa</h2>
            <form action="func.php" method="post">
                <label for="task_name">Nama :</label>
                <input type="text" id="task_name" class="form-control" name="nama_siswa" required>

                <label for="task_name">NIS :</label>
                <input type="text" id="task_name" class="form-control" name="nis" required>

                <label for="task_name">Kelas :</label>
                <input type="text" id="task_name" class="form-control" name="kelas" required>

                <label for="task_name">Username :</label>
                <input type="text" id="task_name" class="form-control" name="username" required>

                <label for="task_name">Password :</label>
                <input type="text" id="task_name" class="form-control" name="password" required>

                <button type="submit" name="create" class="btn btn-warning w-100 mt-2">Tambah Data</button>
            </form>
            <div class="back-link text-center mt-2">
                <a href="dasboard_admin.php" class="fw-bold text-secondary-emphasis">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
    </div>
</body>

</html>