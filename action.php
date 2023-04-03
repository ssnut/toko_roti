<?php

require "koneksi.php";
$aksi = $_GET['action'];

switch ($aksi) {
    // aksi untuk insert ke data menu
    case 'insert_menu':
        //insertBook($gambar,$daftar_menu,$rasa,$harga)
        $daftar_menu = $_POST['daftar_menu'];
        $rasa = $_POST['rasa'];
        $harga = $_POST['harga'];

        // upload gambar
        $gambar = upload();
        if( !$gambar ) {
            return false;
        }
      
        $result = insertMenu($gambar,$daftar_menu,$rasa,$harga);
        if ($result > 0 ) {
            $msg = "Tambah Menu Berhasil";
            $loc = header("location:data_menu.php");
        } else {
            $msg = "Tambah Menu Gagal";
            $loc = header("location:data_menu.php");
        }
        break;
    

    // aksi untuk edit data menu
    case 'update_menu':
        $id_menu = $_POST['id_menu'];
        $daftar_menu = $_POST['daftar_menu'];
        $rasa = $_POST['rasa'];
        $harga = $_POST['harga'];
        $gambarLama = $_POST['gambarLama'];
         

    $result = updateMenu($id_menu, $gambarLama,$daftar_menu,$rasa,$harga);
    if ($result) {
        $msg = "Edit Menu Berhasil";
        $loc = header("location:data_menu.php");
    } else {
        $msg = "Edit Menu Gagal";
        $loc = header("location:data_menu.php");
    }
    break;

    //aksi untuk delete data menu
    case 'delete_menu':
    $result = deleteMenu($_GET['id_menu']);
    if ($result) {
        $msg = "Hapus Menu Berhasil";
        $loc = header("location:data_menu.php");
    } else {
        $msg = "Hapus Menu Gagal";
        $loc = header("location:data_menu.php");
    }
    break;

    //aksi untuk insert data pelanggan
    case 'insert_customer':
        $result = insertCustomers($_POST['nama_pelanggan'], $_POST['email'], $_POST['alamat']);
        if ($result) {
            $msg = "Tambah Pelanggan Berhasil";
            $loc = header("location:data_pelanggan.php");
        } else {
            $msg = "Tambah Pelanggan Gagal";
            $loc = header("location:data_pelanggan.php");
        }
        break;

    //aksi untuk edit data pelanggan
    case 'update_customer':
        $result = updateCustomer($_POST['id_pelanggan'], $_POST['nama_pelanggan'], $_POST['email'], $_POST['alamat']);
        if ($result) {
            $msg = "Edit Pelanggan Berhasil";
            $loc = header("location:data_pelanggan.php");
        } else {
            $msg = "Edit Pelanggan Gagal";
            $loc = header("location:data_pelanggan.php");
        }
        break;

    //aksi untuk delete data pelanggan
    case 'delete_customer':
        $result = deleteCustomer($_GET['id_pelanggan']);
        if ($result) {
            $msg = "Hapus Pelanggan Berhasil";
            $loc = header("location:data_pelanggan.php");
        } else {
            $msg = "Hapus Pelanggan Gagal";
            $loc = header("location:data_pelanggan.php");
        }
        break;

     //aksi untuk insert data transaksi
     case 'insert_transaction':
        $id_menu = $_POST['id_menu'];
        $row = getHargaMenu($id_menu);
        $harga = $row['harga'];
        $total_harga = $harga * $_POST['kuantitas'];
        $result = insertTransaction($_POST['id_menu'], $_POST['id_pelanggan'], $_POST['kuantitas'], $harga, $total_harga);
        if ($result) {
            $msg = "Tambah Transaksi Berhasil";
            $loc = header("location:data_transaksi.php");
        } else {
            $msg = "Tambah Transaksi Gagal";
            $loc = header("location:data_transaksi.php");
        }
        break;

    //aksi untuk edit data transaksi
    case 'update_transaction':
        $id_menu = $_POST['id_menu'];
        $row = getHargaMenu($id_menu);
        $harga = $row['harga'];
        $total_harga = $harga * $_POST['kuantitas'];
        $result = updateTransaction($_POST['id_transaksi'], $_POST['id_pelanggan'],  $_POST['id_menu'], $_POST['kuantitas'], $harga, $total_harga);
        if ($result) {
            $msg = "Edit Transaksi Berhasil";
            $loc = header("location:data_transaksi.php");
        } else {
            $msg = "Edit Transaksi Gagal";
            $loc = header("location:data_transaksi.php");
        }
        break;       

    //aksi untuk delete data transaksi
    case 'delete_transaction':
        $result = deleteTransaction($_GET['id_transaksi']);
        if ($result) {
            $msg = "Hapus Transaksi Berhasil";
            $loc = header("location:data_transaksi.php");
        } else {
            $msg = "Hapus Transaksi Gagal";
            $loc = header("location:data_transaksi.php");
        }
        break; 
 

if (!empty($msg)) {
            echo "<script>
                alert('$msg');
                location.href = '$loc';
            </script>";
}


}

?>