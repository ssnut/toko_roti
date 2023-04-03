<?php 
require "koneksi.php";

$id_menu = $_GET["id_menu"] ?? 0 ; 

if ($id_menu > 0) {
    $row = getMenubyID($id_menu);
    $id_menu = $row['id_menu'];
    $gambar = $row['gambar'];
    $daftar_menu = $row['daftar_menu'];
    $rasa = $row['rasa'];
    $harga = $row['harga'];
    
   
    
    $form_action = "action.php?action=update_menu";
    $title = "Edit Data Menu";
}
else {
    $id_menu = '';
    $gambar = '';
    $daftar_menu = '';
    $rasa = '';
    $harga = '';
    $form_action = 'action.php?action=insert_menu';
    $title = "Tambah Data Menu";
}
?>

<!DOCTYPE html> 
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Penjualan</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather+Sans&family=Roboto+Condensed&display=swap"
      rel="stylesheet"
    />
</head>

<body>
<nav>
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="data_menu.php">DATA MENU</a></li>
        <li><a href="data_pelanggan.php">DATA PELANGGAN</a></li>
        <li><a href="data_transaksi.php">DATA TRANSAKSI</a></li>
    </ul>
</nav>
    <h2 style="margin-bottom:20px"><?=$title; ?></h2>
    <form action="<?=$form_action?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_menu" value="<?=$id_menu?>" />
        <input type="hidden" name="gambarLama" value="<?=$gambar?>" />
        <label for="gambar">Gambar :</label>
        <img src="img/<?= $row['gambar']; ?>" width="20%"> <br>
        <input type="file" name="gambar"/><br><br>
        <label for="daftar_menu">Daftar Menu :</label>
        <input type="text" name="daftar_menu" value="<?=$daftar_menu?>"/><br><br>
        <label for="rasa">Rasa :</label>
        <input type="text" name="rasa" value="<?=$rasa?>"/><br><br>
        <label for="harga">Harga :</label>
        <input type="number" name="harga" value="<?=$harga?>"/><br><br>
        <input type="submit" value="Simpan"/>
    </form>
</body>
</html>
