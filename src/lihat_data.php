<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:login.php');
    exit;


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
</head>

<body>

    <div class="container mt-5">
        <a href="dasboard_admin.php" class="btn btn-warning">Kembali Ke Dashboard</a>
        <table class="table table-striped mt-2 table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>foto</th>
                    <th>Nama</th>
                    <th>NIS (Nomor Induk Siswa)</th>
                    <th>Kelas</th>
                    <th>tanggal lahir</th>
                    <th>Alamat</th>
                    <th>Nomor Handphone</th>
                </tr>
            </thead>
            <tbody id="task-list">
                <?php
                include ('koneksi.php');

                $id = $_GET['id'];


                $sql = "SELECT * FROM siswa where id='$id'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                    <tr>
                        <td><img src="
                                        <?php
                                        if ($row['photo'] == '') {
                                            echo 'uploads/user.png';
                                        } else {
                                            echo 'uploads/' . $row['photo'];
                                        }
                                        ?>
                                        " width="150px"></td>
                        <td><?= $row['nama_siswa']; ?></td>
                        <td><?= $row['nis']; ?></td>
                        <td><?= $row['kelas']; ?></td>
                        <td><?= $row['tanggal_lahir']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['nomor']; ?></td>
                    </tr>

                    <?php
                }
                ?>
                <!-- Tugas lain bisa ditambahkan di sini -->
            </tbody>
        </table>
    </div>

    </div>
</body>

</html>