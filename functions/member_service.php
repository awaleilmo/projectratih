<?php

require_once 'koneksi.php';

if ((!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == true)) {
    header("location: ../admin");
}

function tambah_favorit($id_produk, $id_user)
{
    global $db_connect;
    return $db_connect->query("INSERT INTO favorit (`id_user`, `id_produk` ) VALUES ('$id_user', '$id_produk') ");
}

function hapus_favorit($id_produk, $id_user)
{
    global $db_connect;
    return $db_connect->query("DELETE FROM favorit WHERE `id_user` = '$id_user' AND `id_produk` = '$id_produk'");
}

function tambah_keranjang($id_produk, $id_user)
{
    global $db_connect;
    return $db_connect->query("INSERT INTO keranjang (`id_user`, `id_produk` ) VALUES ('$id_user', '$id_produk')");
}

function buang_dari_keranjang($id_produk, $id_user)
{
    global $db_connect;
    return $db_connect->query("DELETE FROM keranjang WHERE `id_user` = '$id_user' AND `id_produk` = '$id_produk'");
}

function is_hari_ini_lebih_besar($tanggal)
{
    $hariIni = date('Y-m-d'); // Mendapatkan tanggal hari ini dalam format Y-m-d

    if ($hariIni > $tanggal) {
        return true;
    } else {
        return false;
    }
}

function belum_beri_rating($id_produk, $id_user, $nomor_invoice)
{
    global $db_connect;
    $cheking = $db_connect->query("SELECT * FROM `rating` WHERE `id_user` = '$id_user' AND `id_produk`= '$id_produk' AND `nomor_invoice` = '$nomor_invoice'");
    if ($cheking->num_rows > 0) {
        return false;
    }

    return true;
}

function buat_komplain($data)
{
    global $db_connect;
    global $db_name;

    $id_user = $data['id_user'];
    $nomor_invoice = $data['nomor_invoice'];
    $media = $data['media'];
    $keterangan = $data['keterangan'];
    $date_now = date("Y-m-d H:i:s");
    $status = "pending";

    $targetDir = '../media_komplain/';
    $namaFile = date("ymdhis");

    // simpan media 
    $fileName = basename($media['name']);
    $fileExtensionFoto = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = $namaFile . '.' . $fileExtensionFoto;
    $targetPath = $targetDir . $newFileName;
    $id = $db_connect->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = 'komplain'")->fetch_assoc()['AUTO_INCREMENT'];


    $add_komplain = $db_connect->query("INSERT INTO `komplain`( `id_user`, `nomor_invoice`, `status`, `media`, `keterangan`, `created_at`, `updated_at`) VALUES ('$id_user','$nomor_invoice','$status','$newFileName','$keterangan','$date_now','$date_now')");

    $update_timeline = $db_connect->query("INSERT INTO `timeline_komplain` (`id_komplain`, `created_at`, `created_by`, `status`, `description`) VALUES ('$id', '$date_now', '$id_user', 'komplain dibuat', 'Membuat komplain invoice #$nomor_invoice')");

    return move_uploaded_file($media['tmp_name'], $targetPath) && $add_komplain && $update_timeline;
}

function edit_keterangan_komplain($data)
{
    global $db_connect;
    $id_komplain = $data['id_komplain'];
    $keterangan = $data['keterangan'];
    $date = date('Y-m-d H:i:s');

    return $db_connect->query("UPDATE `komplain` SET keterangan = '$keterangan', updated_at = '$date' WHERE id = '$id_komplain'");
}

function edit_media_komplain($data)
{
    global $db_connect;
    $media = $data['media'];
    $id_komplain = $data['id_komplain'];
    $targetDir = '../media_komplain/';
    $namaFile = date("ymdhis");

    // simpan foto 
    $fileName = basename($media['name']);
    $fileExtensionFoto = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = $namaFile . '.' . $fileExtensionFoto;
    $targetPath = $targetDir . $newFileName;

    $date = date('Y-m-d H:i:s');

    return move_uploaded_file($media['tmp_name'], $targetPath) && $db_connect->query("UPDATE `komplain` SET media = '$newFileName', , updated_at = '$date'  WHERE id = '$id_komplain'");
}
