<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css>
    <style type="text/css">

    .wrapper{

        width: 500px;

        margin: 0 auto;

    }

    </style>
</head>
<body>
<div class="wrapper">

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="page-header">
    <h2>Maintenance Stok</h2>
    </div>
    <form action="stok.php" method="post">
    <br><label for="jenisTransaksi">Jenis Transaksi:</label>
        <select name="jenisTransaksi" id="jenisTransaksi">
            <option value="Masuk">Masuk</option>
            <option value="Keluar">Keluar</option>
        </select><br>

        <br><label for="bukti">Bukti:</label>
        <input type="text" name="bukti" id="bukti"><br>

        <br><label for="lokasi">Lokasi:</label>
        <input type="text" name="lokasi" id="lokasi"><br>

        <br><label for="kodeBarang">Kode Barang:</label>
        <input type="text" name="kodeBarang" id="kodeBarang"><br>

        <br><label for="tglTransaksi">Tgl Transaksi:</label>
        <input type="date" name="tglTransaksi" id="tglTransaksi"><br>

        <br><label for="quantity">Quantity:</label>
        <input type="text" name="quantity" id="quantity"><br>

        <!-- <br><label for="program">Program:</label>
        <input type="text" name="program" id="program"><br>

        <br><label for="user">User:</label>
        <input type="text" name="user" id="user"><br> -->

        <br><input type="submit" class="btn btn-dark" value="Submit"></input>
        <a href="dashboard.php" class="btn btn-dark">Back</a>
    </form>
</body>
</html>
<br>

<!-- Formulir HTML untuk Edit dan Delete -->
<!-- <form action="stok.php" method="post">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="idEdit" value="ID_TRANSAKSI_YANG_INGIN_DIEDIT">
    <input type="submit" value="Edit Transaksi">
</form>

<form action="stok.php" method="post">
    <input type="hidden" name="action" value="hapus">
    <input type="hidden" name="idHapus" value="ID_TRANSAKSI_YANG_INGIN_DIHAPUS">
    <input type="submit" value="Hapus Transaksi">
</form> -->

<!-- Tabel Transaksi History -->
<!-- <br><table border="1"> -->
    <!-- <tr> -->
        <!-- <th>Bukti</th>
        <th>Tgl</th>
        <th>Jam</th>
        <th>Lokasi</th>
        <th>Kode Barang</th>
        <th>Tgl Masuk</th>
        <th>Qty Trn</th>
        <th>Prog</th>
        <th>User</th> -->
    <!-- </tr> -->
    <!-- Loop untuk menampilkan data dari database -->
    <!-- <?php
    // $conn =new mysqli('localhost','root','','aplikasi');
    // if ($conn) {
    //     echo " ";
    // }
    // else {
    //     die(mysqli_error($conn));
    // }
    // $query = "SELECT * FROM transaksi
    //           JOIN lokasi ON transaksi.LokasiID = lokasi.ID
    //           JOIN barang ON transaksi.KodeBarangID = barang.ID";
    // $result = $conn->query($query);

    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         echo "<tr>";
    //         echo "<td>{$row['Bukti']}</td>";
    //         echo "<td>{$row['TglTransaksi']}</td>";
    //         echo "<td>{$row['WaktuTransaksi']}</td>";
    //         echo "<td>{$row['KodeLokasi']}</td>";
    //         echo "<td>{$row['KodeBarang']}</td>";
    //         echo "<td>{$row['TglMasuk']}</td>";
    //         echo "<td>{$row['Quantity']}</td>";
    //         echo "<td>{$row['Program']}</td>";
    //         echo "<td>{$row['User']}</td>";
    //         echo "</tr>";
    //     }
    // } else {
    //     echo "<tr><td colspan='9'>Data tidak ditemukan.</td></tr>";
    // }
    // ?>
</table>
