<?php

require "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <div class="col-5">
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
    <h2>Data Pelanggan : </h2>
    <a href="form_pelanggan.php" class="add-button">Tambah Data Pelanggan</a>
    </div>
   
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <!-- untuk ngisi nampilin datanya -->
            <!-- untuk narik datanya -->
            <?php $i = 1; ?>
            <?php foreach (getCustomers() as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['alamat'] ?></td>

                    <td class="center-align">
                    <a href="form_pelanggan.php?id_pelanggan=<?= $row['id_pelanggan']?>" class="edit-button">Edit</a> |
                    <a href="action.php?id_pelanggan=<?= $row['id_pelanggan']?>&action=delete_customer" class="del-button">Hapus</a>
                    </td> 
                </tr>
            <?php $i++; ?>
            <?php endforeach; ?>

        </table>
    </div>
    </center>
</div>
</div>
</body>
</html>