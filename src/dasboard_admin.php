<?php
session_start();
include("koneksi.php");

if (isset($_SESSION['siswa'])) {
    header("Location: index.php");
    exit();
}

function searchSiswa($search = null, $searchKelas = null)
{
    global $conn; // Menggunakan koneksi global
    $sql = "SELECT * FROM siswa WHERE 1=1"; // Memulai dengan kondisi yang selalu benar

    // kondisi pencarian nama
    if ($search) {
        $sql .= " AND nama_siswa LIKE '%$search%'"; //memerika apakah parameter nama memiliki nilai
    }

    // kondisi pencarian kelas
    if ($searchKelas) {
        $sql .= " AND kelas LIKE '%$searchKelas%'"; //memerika apakah parameter kelas memiliki nilai
    }

    $result = mysqli_query($conn, $sql);

    $rows = []; //deklarasi yang digunakan menyimpan hasil pencarian
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    return $rows; 
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM admin where id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $searchKelas = $_POST["searchKelas"]; // Mengambil kelas dari input

    // Debugging
    // echo "Search: " . $search . "<br>";
    // echo "Search Kelas: " . $searchKelas . "<br>";
    $results = searchSiswa($search, $searchKelas); // Memanggil fungsi pencarian
} else {
    // Jika tidak ada pencarian, ambil semua data
    $postquery = "SELECT * from siswa";
    $result = mysqli_query($conn, $postquery);
    $results = mysqli_fetch_all($result, MYSQLI_ASSOC); // Mengambil semua hasil
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>


    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="dasboard_admin.php"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4 d-none d-sm-inline mt-4 fw-bold">Dashboard Admin</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="dasboard_admin.php" class="nav-link align-middle px-0">
                                <i class="fa-solid fa-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>


                        <li>
                            <a href="tambah_data.php" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-pen-to-square"></i> <span class="ms-1 d-none d-sm-inline">Tambah
                                    Data</span></a>
                        </li>
                    </ul>
                    <hr>

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
                                        " width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1"><?= $_SESSION['username']; ?></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <div class="card shadow-lg p-5">
                    <h2 class="fw-bold text-center">Dashboard Admin</h2>
                    <hr>

                    <div class="d-flex justify-content-between">

                        <form method="POST" action="" class="d-flex" role="search">
                            <input class="form-control  me-2" type="search" name="search" placeholder="Cari Nama"
                                aria-label="Search" >
                            <select name="searchKelas" class="form-select me-2" >
                                <option value="">Pilih Kelas</option>
                                <option value="XI PPLG A">XI PPLG A</option>
                                <option value="XI PPLG B">XI PPLG B</option>
                                <option value="XII RPL A">XII RPL A</option>
                                <option value="XII RPL B">XII RPL B</option>
                            </select>
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>


                        <a href="tambah_data.php" class="btn btn-success">Tambah Data</a>

                    </div>

                    <table class="table table-striped  mt-2 table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>NIS (Nomor Induk Siswa)</th>
                                <th>Kelas</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="task-list">
                            <?php if (count($results) > 0): ?>
                                <?php foreach ($results as $row): ?>
                                    <tr>
                                        <td><?= $row['nama_siswa']; ?></td>
                                        <td><?= $row['nis']; ?></td>
                                        <td><?= $row['kelas']; ?></td>
                                        <td><?= $row['username']; ?></td>
                                        <td>
                                            <a href="lihat_data.php?id=<?= $row['id'] ?>" class="btn btn-warning">Lihat
                                                Semua</a>
                                            <a href="edit_siswa.php?id=<?= $row['id']; ?>" class="btn btn-success">Edit</a>
                                            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Apakah Anda Yakin ingin menghapus?')" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
    <script>// Initialization for ES Users
        import { Dropdown, initMDB } from "mdb-ui-kit";

        initMDB({ Dropdown });
    </script>
</body>

</html>