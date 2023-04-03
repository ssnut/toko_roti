<?php 
require "koneksi.php";
?>
<!DOCTYPE html>
<head>
 <link rel="stylesheet" href="style.css" class="css">
</head>
<body>
<div class="header">
    <div class="col-4">
        <div class="nav">
            <p>BAKERYS</p>
        </div>
        <div class="left-text">
               
        </div>
    </div>
    <div class="col-2">
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="data_menu.php">DATA MENU</a></li>
            <li><a href="data_pelanggan.php">DATA PELANGGAN</a></li>
            <li><a href="data_transaksi.php">DATA TRANSAKSI</a></li>
        </ul>
<center>

<div class="judul2">
    <h2>Data Transaksi : </h2>
    <a href="form_transaksi.php" class="add-button">Tambah Data Transaksi</a>
</div>

<table border="1" cellpadding="10" cellspacing="0" white>
    <tr>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Daftar Menu</th>
        <th>Harga Saat Ini</th>
        <th>Jumlah</th>
        <th>Total Pembayaran</th>
        <th>Aksi</th>
    </tr>
     
    <?php $i = 1; ?>
    <?php foreach (getTransactions() as $row) :
        $total_pembayaran = $row['kuantitas']*$row['harga_saat_ini'] 
    ?> 
   
    <tr>
            <td><?= $i; ?></td>
            <td><?=$row['nama_pelanggan']?></td>
            <td><?=$row['daftar_menu']?></td>
            <td><?=$row['harga_saat_ini']?></td>
            <td><?=$row['kuantitas']?></td>
            <td><?=$row['total_pembayaran']?></td>

            <td class="center-align">
            <a href="form_transaksi.php?id_transaksi=<?= $row['id_transaksi']?>" class="edit-button">Edit</a> |
            <a href="action.php?id_transaksi=<?= $row['id_transaksi']?>&action=delete_transaction" class="del-button">Hapus</a>
            </td> 
    </tr>

    <?php $i++; ?>
    <?php endforeach; ?>
</table>

    </div>
</center>
</div>
</body>
</html>