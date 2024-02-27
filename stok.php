<?php
$conn =new mysqli('localhost','root','','baru_aplikasi');
if ($conn) {
    echo " ";
}
else {
    die(mysqli_error($conn));
}

// Mendapatkan data dari formulir
$jenisTransaksi = $_POST['jenisTransaksi'];
$bukti = $_POST['bukti'];
$lokasi = $_POST['lokasi'];
$kodeBarang = $_POST['kodeBarang'];
// $namaBarang = $_POST['namaBarang'];
$tglTransaksi = $_POST['tglTransaksi'];
$quantity = $_POST['quantity'];
// $program = $_POST['program'];
// $user = $_POST['user'];

if ($jenisTransaksi == 'Masuk') {
    tambahStok($jenisTransaksi, $bukti, $lokasi, $kodeBarang, $tglTransaksi, $quantity);
} elseif ($jenisTransaksi == 'Keluar') {
    kurangiStok($jenisTransaksi, $bukti, $lokasi, $kodeBarang, $tglTransaksi, $quantity);
}

// Program Menambah Stok (Masuk)
function tambahStok($jenisTransaksi, $bukti, $lokasi, $kodeBarang, $tglTransaksi, $quantity) {
    global $conn;

        // $query = "INSERT INTO barang (KodeBarang, NamaBarang) ";
        // $conn->query($query);

        $query = "SELECT * FROM saldo WHERE LokasiID = (SELECT ID FROM lokasi WHERE KodeLokasi = '$lokasi') 
              AND KodeBarangID = (SELECT ID FROM barang WHERE KodeBarang = '$kodeBarang') ORDER BY TglMasuk DESC LIMIT 1";
        $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // $tglMasuk = $tglTransaksi;
        $tglMasukTerakhir = $row['TglMasuk'];
        if ($tglTransaksi < $tglMasukTerakhir) {
            echo "Validasi Gagal: Tanggal transaksi tidak valid!";
            return;
        }
    }

    $query = "INSERT INTO transaksi (JenisTransaksi, Bukti, Lokasi, KodeBarang, TglTransaksi, Quantity) 
              VALUES ('$jenisTransaksi', '$bukti', (SELECT ID FROM lokasi WHERE KodeLokasi = '$lokasi'),
              (SELECT ID FROM barang WHERE KodeBarang = '$kodeBarang'), '$tglTransaksi', $quantity)";
    $conn->query($query);
    echo "Transaksi berhasil ditambahkan!";
}

// Program Mengurangi Stok (Keluar)
function kurangiStok($jenisTransaksi, $bukti, $lokasi, $kodeBarang, $tglTransaksi, $quantity) {
    global $conn;

    // Validasi tgl transaksi dan saldo
    $query = "SELECT * FROM saldo WHERE LokasiID = (SELECT ID FROM lokasi WHERE KodeLokasi = '$lokasi') 
              AND KodeBarangID = (SELECT ID FROM barang WHERE KodeBarang = '$kodeBarang') 
              ORDER BY TglMasuk DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tglMasukTerakhir = $row['TglMasuk'];
        $saldo = $row['Saldo'];

        if ($tglTransaksi < $tglMasukTerakhir) {
            echo "Validasi Gagal: Tanggal transaksi tidak valid!";
            return;
        }

        if ($quantity > $saldo) {
            echo "Validasi Gagal: Saldo barang tidak mencukupi!";
            return;
        }
    } else {
        echo "Validasi Gagal: Saldo barang tidak ditemukan!";
        return;
    }

    $query = "INSERT INTO transaksi (JenisTransaksi, Bukti, LokasiID, KodeBarangID, TglTransaksi, Quantity) 
              VALUES ('$jenisTransaksi', '$bukti', (SELECT ID FROM lokasi WHERE KodeLokasi = '$lokasi'), 
                      (SELECT ID FROM barang WHERE KodeBarang = '$kodeBarang'), '$tglTransaksi', -$quantity)";
    $conn->query($query);

    echo "Transaksi berhasil disimpan!";
}

// Program Edit Transaksi
function editTransaksi($id, $jenisTransaksi, $bukti, $lokasi, $kodeBarang, $tglTransaksi, $quantity, $program, $user) {
    global $conn;

    $query = "UPDATE transaksi SET JenisTransaksi = '$jenisTransaksi', Bukti = '$bukti', LokasiID = (SELECT ID FROM lokasi WHERE KodeLokasi = '$lokasi'), 
              KodeBarangID = (SELECT ID FROM barang WHERE KodeBarang = '$kodeBarang'), TglTransaksi = '$tglTransaksi', Quantity = $quantity, 
              Program = '$program', User = '$user' WHERE ID = $id";

    $conn->query($query);

    echo "Transaksi berhasil diubah!";
}

// // Program Hapus Transaksi
// function hapusTransaksi($id) {
//     global $conn;

//     $query = "DELETE FROM Transaksi WHERE ID = $id";

//     $conn->query($query);

//     echo "Transaksi berhasil dihapus!";
// }

// ...

// Mendapatkan data dari formulir
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Pemanggilan program berdasarkan aksi
switch ($action) {
    case 'tambah':
        // Pemanggilan program tambahStok atau kurangiStok
        break;
    case 'edit':
        $idEdit = $_POST['idEdit'];
        // Pemanggilan program editTransaksi
        editTransaksi($idEdit, $jenisTransaksi, $bukti, $lokasi, $kodeBarang, $tglTransaksi, $quantity, $program, $user);
        break;
    // // case 'hapus':
    // //     $idHapus = $_POST['idHapus'];
    // //     // Pemanggilan program hapusTransaksi
    // //     hapusTransaksi($idHapus);
    //     break;
    default:
        echo "\n Aksi tidak valid!";
}
?>
<br>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <!-- <h2>Maintenance Stok</h2>
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
        <input type="text" name="quantity" id="quantity"><br> -->

        <!-- <br><label for="program">Program:</label>
        <input type="text" name="program" id="program"><br>

        <br><label for="user">User:</label>
        <input type="text" name="user" id="user"><br> -->

        <!-- <br><a href ="dashboard.php" type="submit" value="Dashboard">Dashboard</a> -->
        <br><a href="dashboard.php" class="btn btn-primary">Dashboard</a>
    </form>
</body>
</html>
<br>