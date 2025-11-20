<?php
include_once "koneksi.php";

if (isset($_POST['submit'])) {
    $nama       = $_POST['nama'];
    $kategori   = $_POST['kategori'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok       = $_POST['stok'];

    // upload gambar
    $file_gambar = $_FILES['file_gambar'];
    $gambar = '';

    if ($file_gambar['error'] == 0) {
        $filename = $file_gambar['name'];
        $destination = 'gambar/' . $filename;
        move_uploaded_file($file_gambar['tmp_name'], $destination);
        $gambar = $destination;
    }

    $sql = "INSERT INTO data_barang (nama, kategori, harga_beli, harga_jual, stok, gambar)
            VALUES ('$nama', '$kategori', '$harga_beli', '$harga_jual', '$stok', '$gambar')";

    mysqli_query($conn, $sql);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
</head>
<body>
    <h1>Tambah Barang</h1>

    <form action="tambah.php" method="post" enctype="multipart/form-data">
        <label>Nama Barang</label><br>
        <input type="text" name="nama"><br><br>

        <label>Kategori</label><br>
        <select name="kategori">
            <option value="Komputer">Komputer</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Hand Phone">Hand Phone</option>
        </select><br><br>

        <label>Harga Beli</label><br>
        <input type="number" name="harga_beli"><br><br>

        <label>Harga Jual</label><br>
        <input type="number" name="harga_jual"><br><br>

        <label>Stok</label><br>
        <input type="number" name="stok"><br><br>

        <label>File Gambar</label><br>
        <input type="file" name="file_gambar"><br><br>

        <button type="submit" name="submit">Simpan</button>
    </form>

</body>
</html>