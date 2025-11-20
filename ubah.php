<?php
include_once "koneksi.php";

$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang='$id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama       = $_POST['nama'];
    $kategori   = $_POST['kategori'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok       = $_POST['stok'];

    // Upload gambar baru jika ada
    $gambar = $data['gambar'];
    if ($_FILES['file_gambar']['error'] == 0) {
        $filename = $_FILES['file_gambar']['name'];
        $destination = 'gambar/' . $filename;
        move_uploaded_file($_FILES['file_gambar']['tmp_name'], $destination);
        $gambar = $destination;
    }

    $sql = "UPDATE data_barang 
            SET nama='$nama',
                kategori='$kategori',
                harga_beli='$harga_beli',
                harga_jual='$harga_jual',
                stok='$stok',
                gambar='$gambar'
            WHERE id_barang='$id'";
    mysqli_query($conn, $sql);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ubah Barang</title>
</head>
<body>
    <h1>Ubah Barang</h1>

    <form method="post" enctype="multipart/form-data">
        <label>Nama Barang</label><br>
        <input type="text" name="nama" value="<?= $data['nama']; ?>"><br><br>

        <label>Kategori</label><br>
        <select name="kategori">
            <option value="Komputer"   <?= $data['kategori']=='Komputer'?'selected':''; ?>>Komputer</option>
            <option value="Elektronik" <?= $data['kategori']=='Elektronik'?'selected':''; ?>>Elektronik</option>
            <option value="Hand Phone" <?= $data['kategori']=='Hand Phone'?'selected':''; ?>>Hand Phone</option>
        </select><br><br>

        <label>Harga Beli</label><br>
        <input type="number" name="harga_beli" value="<?= $data['harga_beli']; ?>"><br><br>

        <label>Harga Jual</label><br>
        <input type="number" name="harga_jual" value="<?= $data['harga_jual']; ?>"><br><br>

        <label>Stok</label><br>
        <input type="number" name="stok" value="<?= $data['stok']; ?>"><br><br>

        <label>Gambar</label><br>
        <img src="<?= $data['gambar']; ?>" width="100"><br><br>
        <input type="file" name="file_gambar"><br><br>

        <button type="submit" name="submit">Simpan</button>
    </form>

</body>
</html>