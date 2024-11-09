<?php

include("koneksi.php");
$id = $_GET['id'];


$sql = "DELETE FROM siswa where id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "Tugas Berhasil Dihapus";
    header('location: dasboard_admin.php');
} else {
    echo "error: " . $sql . "<br>" . mysqli_error($conn);

}

mysqli_close($conn);
?>