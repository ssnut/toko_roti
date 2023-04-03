<?php
 require "koneksi.php";

 $id_transaksi = $_GET['id_transaksi'] ?? 0 ;

 if($id_transaksi > 0) {
    $row = getTransactionbyID($id_transaksi);
    $id_transaksi = $row['id_transaksi'];
    $id_pelanggan = $row['id_pelanggan'];
    $id_menu = $row['id_menu'];
    $nama_pelanggan = $row['nama_pelanggan'];
    $daftar_menu = $row['daftar_menu'];
    $kuantitas = $row['kuantitas'];
    $form_action = "action.php?action=update_transaction";
    $title = "Edit Data Transaksi";
 } else {
    $id_transaksi = '';
    $id_pelanggan = '';
    $id_menu = '';
    $nama_pelanggan = '';
    $daftar_menu = '';
    $kuantitas = '';
    $form_action = "action.php?action=insert_transaction";
    $title = "Tambah Data Transaksi";
 }

?>

<!DOCTYPE html> 
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Penjualan</title>
    <link rel="stylesheet" href="css/bootstrap-grid.css" type="text/css" />
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
    <div class="container">
    <h2 style="margin-bottom:20px"><?=$title; ?></h2>
    <form action="<?=$form_action?>" method="post">
        <input type="hidden" name="id_transaksi" value="<?=$id_transaksi?>">
        <!-- pilih nama pelanggan -->
        <label for="nama_pelanggan">Nama Pelanggan</label>
        <select name="id_pelanggan" id="nama_pelanggan">
            <option disabled selected>Pilih nama pelanggan...</option>
            <?php foreach (fetchCustomers() as $options) {
                //tanda (?) untuk if, tanda (:) untuk else
                $selected = $options['id_pelanggan']==$id_pelanggan ? 'selected': '';
            ?>
            <option value = "<?=$options['id_pelanggan']?>" <?=$selected?>>
                <?=$options['nama_pelanggan'] . ' - ' . $options['alamat']?>
            </option>
            <?php } ?>
        </select>

        <!-- pilih nama menu -->
        <label for="nama_menu">Nama Menu</label>
        <select name="id_menu" id="daftar_menu">
            <option disabled selected>Pilih Menu...</option>
            <?php foreach (fetchMenu() as $options) { 
                $selected = $options['id_menu']==$id_menu ? 'selected' : '';
            ?>
            <option value="<?=$options['id_menu']?>" <?=$selected?>>
                <?=$options['daftar_menu']. ' - ' . $options['harga']?>
            </option>
            <?php } ?>
        </select>
        <!-- input kuantitas -->
        <label for="kuantitas">Kuantitas</label>
        <input type="number" id="kuantitas" name="kuantitas" value="<?=$kuantitas?>">
        <input type="submit" value="Simpan">
    </form>
</body>
</html