<?php

require_once '../functions/member_service.php';

if (isset($_GET['produk'])) {
    $id_produk = $_GET['produk'];
    $id_user = $_SESSION['id_user'];
    if (tambah_keranjang($id_produk, $id_user)) {
        echo "<script>alert('berhasil di tambahkan ke keranjang');location.href='detail_produk?produk=$id_produk'</script>";
    }
}
