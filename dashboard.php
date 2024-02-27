<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Dashboard</title>

    <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css>

    <script src=https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js></script>

    <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js></script>

    <style type="text/css">

        .wrapper{

            width: 650px;

            margin: 0 auto;

        }

        .page-header h2{

            margin-top: 0;

        }

        table tr td:last-child a{

            margin-right: 15px;

        }

    </style>

    <script type="text/javascript">

        $(document).ready(function(){

            $('[data-toggle="tooltip"]').tooltip();

        });

    </script>

</head>

<body>

    <div class="wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <div class="page-header clearfix">

                        <h2 class="pull-left">APLIKASI STOK BARANG</h2>

                        <a href="form.php" class="btn btn-warning pull-right">Manage Data</a>

                    </div>

                    <!-- <h4>Search</h4>

                        <form action="index.php" method="get">

                        Tanggal <input type="date" name="tgl_cari"><br>

                        <br><input type="submit" class="btn btn-primary" value="Submit"> -->

                        <!-- <a href="Read.php" class="btn btn-default">Cancel</a> -->

                </div>

            </div>

        </div>

    </div>

</body>

</html>
<br>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

    <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css>
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js></script>
    <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js></script>

    <title>Dashboard</title>
    <style>
        body {
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        h2 {
            margin-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2><center>Stok Barang</center></h2><br>
    <form action="" method="get">
    <center>
    <label for="kodeBarang">Kode Barang:</label> 
    <input type="text" name="kodeBarang" id="kodeBarang">
    <label for="Lokasi">Lokasi:</label> <input type="text" name="lokasi" id="lokasi"></center>
    <br><center><input type="submit" class="btn btn-success" value="Search"></center>
    </form> 

<?php
    $conn =new mysqli('localhost','root','','baru_aplikasi');
    if ($conn) {
        echo " ";
    }
    else {
        die(mysqli_error($conn));
    }

    $lokasi = $_POST["lokasi"];
    $kodeBarang = $_POST["kodeBarang"];
    $namaBarang = $_POST["namaBarang"];
        // Query untuk mendapatkan data stok barang
        $queryStok = "SELECT * FROM saldo";
        $resultStok = $conn->query($queryStok);

        if ($resultStok->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>Lokasi</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Saldo</th>
                    <th>Tgl Masuk</th>
                </tr>";
            while ($rowStok = $resultStok->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$rowStok['Lokasi']}</td>";
                echo "<td>{$rowStok['KodeBarang']}</td>";
                echo "<td>{$rowStok['NamaBarang']}</td>";
                echo "<td>{$rowStok['Saldo']}</td>";
                echo "<td>{$rowStok['TglMasuk']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Data stok barang tidak ditemukan.</p>";
        }
    ?>

    <h2><center>Transaksi History</center></h2><br> 
    <form action="" method="get">
    <center><label for="Bukti">Bukti:</label> <input type="text" name="Bukti" id="Bukti">
    <label for="tglTransaksi">Tanggal Transaksi:</label> <input type="date" name="tglTransaksi" id="tglTransaksi">
    <label for="kodeBarang">Kode Barang:</label> <input type="text" name="kodeBarang" id="kodeBarang">     
    <label for="Lokasi">Lokasi:</label> <input type="text" name="Lokasi" id="Lokasi"></center>
    <br><center><input type="submit" class="btn btn-success" value="Search"></center>
    </form>  
    <?php
    $conn =new mysqli('localhost','root','','baru_aplikasi');
    if ($conn) {
        echo " ";
    }
    else {
        die(mysqli_error($conn));
    }
        // Query untuk mendapatkan data transaksi history
        $queryTransaksi = "SELECT * FROM transaksi";
        $resultTransaksi = $conn->query($queryTransaksi);

        if ($resultTransaksi->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Bukti</th><th>Tgl</th><th>Jam</th><th>Lokasi</th><th>Kode Barang</th><th>Tgl Masuk</th><th>Qty Trn</th><th>Prog</th><th>User</th></tr>";
            while ($rowTransaksi = $resultTransaksi->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$rowTransaksi['Bukti']}</td>";
                echo "<td>{$rowTransaksi['TglTransaksi']}</td>";
                echo "<td>{$rowTransaksi['WaktuTransaksi']}</td>";
                echo "<td>{$rowTransaksi['Lokasi']}</td>";
                echo "<td>{$rowTransaksi['KodeBarang']}</td>";
                echo "<td>{$rowTransaksi['TglMasuk']}</td>";
                echo "<td>{$rowTransaksi['Quantity']}</td>";
                echo "<td>{$rowTransaksi['Program']}</td>";
                echo "<td>{$rowTransaksi['User']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Data transaksi tidak ditemukan.</p>";
        }
    ?>
</body>
</html>
