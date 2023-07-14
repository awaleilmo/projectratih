<?php

require_once '../functions/member_service.php';

if (isset($_GET['produk'])) {
    $id_produk = $_GET['produk'];
    $id_user = $_SESSION['id_user'];
    if (buang_dari_keranjang($id_produk, $id_user)) {
        if (isset($_GET['redirect'])) {
            echo "<script>alert('berhasil di hapus dari keranjang');location.href='" . $_GET['redirect'] . "'</script>";
        } else {
            echo "<script>alert('berhasil di hapus dari keranjang');location.href='detail_produk?produk=$id_produk'</script>";
        }
    }
}
