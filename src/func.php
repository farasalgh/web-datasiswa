<?php


$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'datasiswa';

// Membuat koneksi menggunakan mysqli prosedural
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Periksa koneksi
if (!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}

session_start();


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek login tabel admin
    $queryAdmin = "SELECT * FROM admin WHERE username='$username'";
    $resultAdmin = mysqli_query($conn, $queryAdmin);

    if (mysqli_num_rows($resultAdmin) > 0) {
        $rowAdmin = mysqli_fetch_assoc($resultAdmin);
        
        if (mysqli_num_rows($resultAdmin) > 0) {
            $_SESSION['username'] = $rowAdmin['username'];
            $_SESSION['id'] = $rowAdmin['id'];

            $_SESSION['admin'] = $username; 
            header("Location:dasboard_admin.php");
            exit();
    
    
        }
    } else {
        // Jika bukan admin, cek tabel siswa
        $querySiswa = "SELECT * FROM siswa WHERE username='$username'";
        $resultSiswa = mysqli_query($conn, $querySiswa);

        if (mysqli_num_rows($resultSiswa) > 0) {
            $rowSiswa = mysqli_fetch_assoc($resultSiswa);
            
            
            if (password_verify($password, $rowSiswa['password'])) {
                $_SESSION['username'] = $rowSiswa['username'];
                $_SESSION['id'] = $rowSiswa['id'];

                $_SESSION['siswa'] = $username;

                header("Location: index.php");
                exit();
            } else {
                echo "Password untuk siswa salah.";
            }
        } else {
            echo "Pengguna tidak ditemukan.";
        }
    }
}



if (isset($_POST['create'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO siswa (nama_siswa, nis,  kelas, username, password) VALUES ('$nama_siswa','$nis', '$kelas', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "Tugas Berhasil Ditambah";
        header('location: dasboard_admin.php');
    } else {
        echo "error:" . $sql . "<br>" . mysqli_error($conn);
    }

}


if (isset($_POST["update"])) {

    $id = $_SESSION['id'];
    $nama_siswa = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['nomor'];

    $target_dir = "uploads/"; // folder untuk menyimpan foto
    $target_file = $_FILES["photo"]["name"];


    // Cek jika folder uploads ada, jika tidak buat
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }


    // Cek apakah file adalah gambar
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        exit;
    }


    // Cek ukuran file
    if ($_FILES["photo"]["size"] > 5000000) {
        echo "Maaf, file terlalu besar.";
        exit;
    }


    // Izinkan hanya format file tertentu
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        exit;
    }

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $target_file)) {
        $sql = "UPDATE siswa SET 
			nama_siswa =  '$nama_siswa',
			nis = '$nis',
			kelas = '$kelas',
			tanggal_lahir = '$tanggal_lahir', 
			alamat = ' $alamat', 
			nomor = '$notelp',
			photo = '$target_file'
			WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            header("Location: index.php");
        }
    }

}

if (isset($_POST["simpan"])) {

    $id = $_POST["id"];
    $nama_siswa = $_POST["nama_siswa"];
    $nis = $_POST["nis"];
    $kelas = $_POST["kelas"];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $nomor = $_POST['nomor'];

    $sql = "UPDATE siswa set
        nama_siswa='$nama_siswa',
        nis='$nis',
        kelas='$kelas', 
        tanggal_lahir='$tanggal_lahir',
        alamat = '$alamat', 
        nomor='$nomor' 
        where id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "data berhasil diperbarui";
        header('location: dasboard_admin.php');
    } else {
        echo "error: " . $sql . "<br>" . mysqli_error($conn);

    }
}


?>