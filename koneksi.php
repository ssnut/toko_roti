<?php 

/** fungsi untuk connect ke database */
function conn(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_tokoroti";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }
    return $conn;
}

/** fungsi untuk menampilkan data menu */
function getMenu() {
    $conn = conn();
    $sql = "SELECT * FROM tb_menu";
    $result = mysqli_query($conn,$sql);
    //biar ketika data di table buku kosong, $rows tidak undefined
    $rows = [];
    while ($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

/** fungsi untuk query insert data menu */
function insertMenu($gambar, $daftar_menu, $rasa, $harga){
    $conn = conn();
    $sql = "INSERT INTO tb_menu (gambar, daftar_menu, rasa, harga) VALUES ('$gambar','$daftar_menu', '$rasa', '$harga')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name']; //tempat gambarnya

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) { 
        echo "<script>
            alert('pilih gambar terlebih dahulu!');
            </script>";
            return false;
    }

    // cek yang diuplod gambar apa bukan
    $ekstensiGambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarvalid)) {
        echo "<script>
        alert('yang anda upload bukan gambar!');
        </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    // lolos pengecekan, gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/'. $namaFileBaru);


    return $namaFileBaru;

}


/** fungsi untuk menampilkan data menu berdasarkan id_menu tertentu */
function getMenubyID($id_menu){
    $conn = conn();
    $sql = "SELECT * FROM tb_menu WHERE id_menu = '$id_menu'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

/** fungsi untuk query edit data Menu*/
function updateMenu($id_menu,$gambarLama,$daftar_menu,$rasa,$harga){
    // cek apakah admin milih gambar baru apa gak
    if( $_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }


    $conn = conn();
    $sql = "UPDATE tb_menu SET gambar ='$gambar', daftar_menu ='$daftar_menu', rasa = '$rasa', harga ='$harga' WHERE id_menu ='$id_menu'";
    $result = mysqli_query($conn, $sql); 
    return $result;

}


/** fungsi untuk query hapus data Menu*/
function deleteMenu($id_menu){
    $conn = conn();
    $sql = "DELETE FROM tb_menu WHERE id_menu = '$id_menu'";
    $result = mysqli_query($conn,$sql);
    return $result;
}

/** fungsi untuk menampilkan data pelanggan */
function getCustomers() {
    $conn = conn();
    $sql = "SELECT * FROM tb_pelanggan";
    $result = mysqli_query($conn,$sql);
    $rows = [];
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

/** fungsi untuk query insert data pelanggan */
function insertCustomers($nama_pelanggan, $email, $alamat){
    $conn = conn();
    $sql = "INSERT INTO tb_pelanggan (nama_pelanggan, email, alamat) VALUES ('$nama_pelanggan', '$email', '$alamat')";
    $result = mysqli_query($conn,$sql);
    return $result;
}

/** fungsi untuk menampilkan data pelanggan berdasarkan id_pelanggan tertentu */
function getCustomerbyID($id_pelanggan){
    $conn = conn();
    $sql = "SELECT * FROM tb_pelanggan WHERE id_pelanggan = '$id_pelanggan'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

/** fungsi untuk query edit data pelanggan */
function updateCustomer($id_pelanggan, $nama_pelanggan, $email, $alamat){
    $conn = conn();
    $sql = "UPDATE tb_pelanggan SET nama_pelanggan = '$nama_pelanggan', email = '$email', alamat = '$alamat' WHERE id_pelanggan = '$id_pelanggan'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/**fungsi untuk query hapus data pelanggan */
function deleteCustomer($id_pelanggan) {
    $conn = conn();
    $sql = "DELETE FROM tb_pelanggan WHERE id_pelanggan = '$id_pelanggan'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/** fungsi untuk menampilkan data transaksi */
function getTransactions(){
    $conn = conn();
    $sql = "SELECT tb_transaksi.id_transaksi, tb_transaksi.kuantitas, tb_transaksi.harga_saat_ini, tb_transaksi.total_pembayaran, tb_pelanggan.id_pelanggan, tb_pelanggan.nama_pelanggan, tb_menu.id_menu, tb_menu.daftar_menu FROM tb_pelanggan INNER JOIN tb_transaksi on tb_pelanggan.id_pelanggan = tb_transaksi.id_pelanggan INNER JOIN tb_menu ON tb_menu.id_menu = tb_transaksi.id_menu ORDER by id_transaksi";
    $result = mysqli_query($conn,$sql);
    $rows = [];
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

/** fungsi untuk mendapatkan nilai id_menu, daftar_menu dan harga dari tabel menu untuk digunakan sebagai option di form*/
function fetchMenu(){
    $conn = conn();
    $sql = "SELECT id_menu, daftar_menu, harga, rasa FROM tb_menu ";
    $result = mysqli_query($conn, $sql);
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $options;
}

/** fungsi untuk mendapatkan nilai id_pelanggan, nama_pelanggan  dari tabel pelanggan untuk digunakan sebagai option di form*/
function fetchCustomers(){
    $conn = conn();
    $sql = "SELECT id_pelanggan, nama_pelanggan, email, alamat FROM tb_pelanggan";
    $result = mysqli_query($conn, $sql);
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $options;
}

/** fungsi untuk menampilkan data transaksi berdasarkan id_transaksi tertentu */
function getTransactionbyID($id_transaksi){
    $conn = conn();
    $sql = "SELECT tb_transaksi.id_transaksi, tb_pelanggan.id_pelanggan, tb_menu.id_menu, tb_pelanggan.nama_pelanggan, tb_menu.daftar_menu, tb_transaksi.kuantitas, tb_transaksi.harga_saat_ini, tb_transaksi.total_pembayaran FROM tb_pelanggan INNER JOIN tb_transaksi ON tb_pelanggan.id_pelanggan = tb_transaksi.id_pelanggan INNER JOIN tb_menu ON tb_menu.id_menu = tb_transaksi.id_menu WHERE tb_transaksi.id_transaksi = '$id_transaksi'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

/** fungsi untuk mendapat harga menu */
function getHargaMenu($id_menu){
    $conn = conn();
    $sql = "SELECT harga FROM tb_menu WHERE id_menu = '$id_menu'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

/** fungsi untuk query insert data transaksi */
function insertTransaction( $id_menu, $id_pelanggan, $kuantitas, $harga_saat_ini, $total_harga){
    $conn = conn();
    $sql = "INSERT INTO tb_transaksi VALUES ('', '$id_pelanggan', '$id_menu','$kuantitas','$harga_saat_ini', '$total_harga')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/** fungsi untuk query edit data transaksi */
function updateTransaction($id_transaksi, $id_pelanggan, $id_menu,  $kuantitas, $harga_saat_ini, $total_harga){
    $conn = conn();
    $sql = "UPDATE tb_transaksi SET id_pelanggan = '$id_pelanggan', id_menu = '$id_menu', kuantitas = '$kuantitas', harga_saat_ini = '$harga_saat_ini', total_pembayaran = '$total_harga' WHERE id_transaksi = '$id_transaksi'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/** fungsi untuk query hapus data transaksi */
function deleteTransaction($id_transaksi){
    $conn = conn();
    $sql = "DELETE FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'";
    $result = mysqli_query($conn, $sql);
    return $result;
}


?>