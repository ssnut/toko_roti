<?php

require "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menu</title>
    <link rel="stylesheet" href="style.css" class="css">
</head>
<body>
<div class="header">
    <div class="col-3">
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
    <h2>Data Menu : </h2>
    <a href="form_menu.php" class="add-button">Tambah Data Menu</a>
</div>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
      
       <th>No</th>
       <th>Gambar</th>
       <th>Daftar Menu</th>
       <th>Rasa</th>
       <th>Harga</th>
       <th>Aksi</th>
    </tr>
    <!-- untuk ngisi nampilin datanya -->
    <!-- buat untuk narik datanya -->
    <!--  array associative
      definisinya sama seperti array numerik, kecuali
      key-nya adalah string yg kita buat sendiri -->
    <?php $i = 1; ?>
    <?php foreach (getMenu() as $row) : ?>
    <tr>
       
       
        <td><?= $i; ?></td>  
        <td><img src="img/<?= $row["gambar"]; ?>" width="150px">
        <td><?= $row['daftar_menu'] ?></td>
        <td><?= $row['rasa'] ?></td>
        <td><?= $row['harga'] ?></td>
        
        <td class="center-align">
        <a href="form_menu.php?id_menu=<?= $row['id_menu']?>" class="edit-button">Edit</a> |
        <a href="action.php?id_menu=<?= $row['id_menu']?>&action=delete_menu" class="del-button">Hapus</a>
        </td> 
    </tr>
   
    <?php $i++; ?>
    <?php endforeach; ?>

</table>
    </center>

</div>
</body>
</html>

<!-- loop adalah perulangan -->