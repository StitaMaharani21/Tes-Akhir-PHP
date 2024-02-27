<?php 
if (isset($_POST['op'])) {
    $op = $_POST['op'];
} else {
    $op = "";
}

//insert data
if (isset($_POST['posting'])) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $id = "";
    }
    
    $nama = $_POST['nama'];
    $jenis_transaksi = $_POST['jenis_transaksi'];
    $bukti = $_POST['bukti'];
    $kode_lokasi = $_POST['kode_lokasi'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $qty = $_POST['qty'];


    if ($nama && $jenis_transaksi && $bukti && $kode_lokasi && $kode_barang && $nama_barang && $tgl_transaksi && $qty) {
        $sql1 = "SELECT saldo FROM data_stok_barang WHERE kode_lokasi = '$kode_lokasi' AND kode_barang = '$kode_barang'";
        $q1 = mysqli_query($koneksi, $sql1);
        
        if ($q1) {
            $row = mysqli_fetch_assoc($q1);
            $existing_balance = $row['saldo'];
            if ($jenis_transaksi == 'keluar' && $qty > $existing_balance) {
                var_dump($existing_balance);
                $error = "Jumlah saldo tidak mencukupi";
            } else {
                $sql1 = "INSERT INTO data_stok_barang (nama, jenis_transaksi, kode_bukti, kode_lokasi, kode_barang, nama_barang, tgl_transaksi, qty) VALUES ('$nama', '$jenis_transaksi', '$bukti', '$kode_lokasi', '$kode_barang', '$nama_barang', '$tgl_transaksi', '$qty')";
                $q1 = mysqli_query($koneksi, $sql1);
                
                $saldo_update = ($jenis_transaksi == 'masuk') ? $qty : -$qty;
                $sql_update_balance = "UPDATE data_stok_barang SET saldo = saldo + $saldo_update WHERE kode_lokasi = '$kode_lokasi' AND kode_barang = '$kode_barang'";
                $q_update_balance = mysqli_query($koneksi, $sql_update_balance);
                if ($q1 && $q_update_balance) {
                    $sukses = "Berhasil memasukkan data";
                } else {
                    $error = "Gagal mengupdate saldo";
                }
            }
        } else {
            $error = "Gagal memeriksa saldo";
        }
    } else {
        $error = "Silahkan masukkan semua data";
    }
}
?>