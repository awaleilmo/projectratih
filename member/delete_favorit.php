<?php

require_once '../functions/member_service.php';

if (isset($_GET['produk'])) {
    $id_produk = $_GET['produk'];
    $id_user = $_SESSION['id_user'];
    if (hapus_favorit($id_produk, $id_user)) {
        echo "<script>alert('berhasil di hapus dari favorit');location.href='detail_produk?produk=$id_produk'</script>";
    }
}
