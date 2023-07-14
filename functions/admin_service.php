<?php

require_once 'koneksi.php';


if ((!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == false)) {
    header("location: ../login.php");
}

function hapus_user($id)
{
    global $db_connect;
    return $db_connect->query("DELETE FROM user WHERE id = $id");
}

function tambah_user_biasa($nama, $usernmae, $password,  $email, $alamat, $jenis_kelamin, $tanggal_lahir, $no_telpon)
{
    global $db_connect;
    return $db_connect->query("INSERT INTO user VALUES ('', '$nama', '$usernmae', '$password', '$email', '$alamat', '$jenis_kelamin', '$tanggal_lahir', '$no_telpon', 'default.jpg', '0')");
}

function tambah_user_administrator($nama, $usernmae, $password,  $email, $alamat, $jenis_kelamin, $tanggal_lahir, $no_telpon)
{
    global $db_connect;
    return $db_connect->query("INSERT INTO user VALUES ('', '$nama', '$usernmae', '$password', '$email', '$alamat', '$jenis_kelamin', '$tanggal_lahir', '$no_telpon', 'default.jpg', '1')");
}

function tambah_kategori($kategori)
{
    global $db_connect;
    return $db_connect->query("INSERT INTO jenis_produk VALUES ('','$kategori')");
}

function edit_kategori($id, $kategori)
{
    global $db_connect;
    return $db_connect->query("UPDATE jenis_produk SET jenis_produk = '$kategori' WHERE id = '$id'");
}

function hapus_kategori($id)
{
    global $db_connect;
    return $db_connect->query("DELETE FROM jenis_produk WHERE id = $id") && $db_connect->query("DELETE FROM produk WHERE jenis_produk = $id");
}

function tambah_produk($paket, $deskripsi, $jenis_produk, $harga, $foto, $video)
{
    global $db_connect;

    $namaFile = date("ymdhis");

    $targetDirFoto = '../image/galery/';
    $targetDirVideo = '../videos/';

    // simpan foto 
    $fileNameFoto = basename($foto['name']);
    $fileExtensionFoto = pathinfo($fileNameFoto, PATHINFO_EXTENSION);
    $newFileNameFoto = $namaFile . '.' . $fileExtensionFoto;
    $targetPathFoto = $targetDirFoto . $newFileNameFoto;

    // Mendapatkan ekstensi file
    $fileType = pathinfo($targetPathFoto, PATHINFO_EXTENSION);

    // Filter tipe file yang diizinkan (hanya JPG dan PNG)
    $allowedTypes = array('jpg', 'jpeg', 'png');

    if (in_array($fileType, $allowedTypes)) {
        move_uploaded_file($foto['tmp_name'], $targetPathFoto);
    }

    // simpan video 
    $fileNamevideo = basename($video['name']);
    $fileExtensionvideo = pathinfo($fileNamevideo, PATHINFO_EXTENSION);
    $newFileNamevideo = $namaFile . '.' . $fileExtensionvideo;
    $targetPathvideo = $targetDirVideo . $newFileNamevideo;

    // Mendapatkan ekstensi file
    $fileType = pathinfo($targetPathvideo, PATHINFO_EXTENSION);

    // Filter tipe file yang diizinkan (hanya JPG dan PNG)
    $allowedTypes = array('mp4');

    if (in_array($fileType, $allowedTypes)) {
        move_uploaded_file($video['tmp_name'], $targetPathvideo);
    }

    return $db_connect->query("INSERT INTO produk (nama, deskripsi, harga, jenis_produk, photo, video) VALUES ('$paket', '$deskripsi', '$harga', '$jenis_produk','$newFileNameFoto','$newFileNamevideo')");
}

function edit_produk($id, $paket, $deskripsi, $jenis_produk, $harga, $foto, $video, $edit_photo, $edit_video)
{
    global $db_connect;

    $namaFile = date("ymdhis");

    $targetDirFoto = '../image/galery/';
    $targetDirVideo = '../videos/';

    // simpan foto jika checkbox dicentang
    if ($edit_photo) {
        $fileNameFoto = basename($foto['name']);
        $fileExtensionFoto = pathinfo($fileNameFoto, PATHINFO_EXTENSION);
        $newFileNameFoto = $namaFile . '.' . $fileExtensionFoto;
        $targetPathFoto = $targetDirFoto . $newFileNameFoto;

        // Mendapatkan ekstensi file
        $fileType = pathinfo($targetPathFoto, PATHINFO_EXTENSION);

        // Filter tipe file yang diizinkan (hanya JPG dan PNG)
        $allowedTypes = array('jpg', 'jpeg', 'png');

        if (in_array($fileType, $allowedTypes)) {
            move_uploaded_file($foto['tmp_name'], $targetPathFoto);
        }
    } else {
        // jika checkbox tidak dicentang, tetap gunakan nama file yang ada
        $newFileNameFoto = $foto;
    }

    // simpan video jika checkbox dicentang
    if ($edit_video) {
        $fileNameVideo = basename($video['name']);
        $fileExtensionVideo = pathinfo($fileNameVideo, PATHINFO_EXTENSION);
        $newFileNameVideo = $namaFile . '.' . $fileExtensionVideo;
        $targetPathVideo = $targetDirVideo . $newFileNameVideo;

        // Mendapatkan ekstensi file
        $fileType = pathinfo($targetPathVideo, PATHINFO_EXTENSION);

        // Filter tipe file yang diizinkan (hanya MP4)
        $allowedTypes = array('mp4');

        if (in_array($fileType, $allowedTypes)) {
            // Memeriksa ukuran file
            $maxFileSizeInMB = 40; // Batas ukuran file dalam MB
            $maxFileSizeInBytes = $maxFileSizeInMB * 1024 * 1024; // Konversi batas ukuran file ke byte
            $fileSize = filesize($video['tmp_name']); // Ukuran file video dalam byte
            if ($fileSize > $maxFileSizeInBytes) {
                echo "<script>alert('Ukuran file melebihi batas $maxFileSizeInMB MB.');</script>";
                return false;
            } else {
                move_uploaded_file($video['tmp_name'], $targetPathVideo);
            }
        }
    } else {
        // jika checkbox tidak dicentang, tetap gunakan nama file yang ada
        $newFileNameVideo = $video;
    }

    return $db_connect->query("UPDATE produk SET nama = '$paket', deskripsi = '$deskripsi', jenis_produk = '$jenis_produk', harga = '$harga', photo = '$newFileNameFoto', video = '$newFileNameVideo' WHERE id = '$id'");
}

function hapus_produk($id)
{
    global $db_connect;

    $data_produk = $db_connect->query("SELECT * FROM produk WHERE id = '$id'")->fetch_assoc();
    $foto = $data_produk['photo'];
    $video = $data_produk['video'];

    unlink('../videos/' . $video);
    unlink('../image/galery/' . $foto);

    return $db_connect->query("DELETE FROM produk WHERE id = '$id'");
}

function tambah_foto($data)
{
    global $db_connect;
    global $db_name;
    $id = $db_connect->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = 'galery'")->fetch_assoc()['AUTO_INCREMENT'];
    // Mendapatkan informasi file yang diunggah
    $file = $_FILES['foto'];

    // Menentukan direktori tujuan penyimpanan file
    $targetDir = '../image/galery/';

    // Menentukan nama file baru
    $fileName = basename($file['name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = $id . '.' . $fileExtension;
    $targetPath = $targetDir . $newFileName;

    // Mendapatkan ekstensi file
    $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

    // Filter tipe file yang diizinkan (hanya JPG dan PNG)
    $allowedTypes = array('jpg', 'jpeg', 'png');

    if (in_array($fileType, $allowedTypes)) {
        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $db_connect->query("INSERT INTO galery VALUES ('$id', '" . $data['nama'] . "','" . $data['deskripsi'] . "','" . $data['jenis_produk'] . "', 'photo', '$newFileName')");
        } else {
            echo 'Terjadi kesalahan saat mengunggah file.';
        }
    } else {
        echo 'Tipe file tidak diizinkan. Hanya file JPG dan PNG yang diperbolehkan.';
    }
}

function tambah_video($data)
{
    global $db_connect;
    global $db_name;
    $id = $db_connect->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = 'galery'")->fetch_assoc()['AUTO_INCREMENT'];
    // Mendapatkan informasi file yang diunggah
    $file = $_FILES['video'];

    // Menentukan direktori tujuan penyimpanan file
    $targetDir = '../videos/';

    // Menentukan nama file baru
    $fileName = basename($file['name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    echo $newFileName = $id . '.' . $fileExtension;
    $targetPath = $targetDir . $newFileName;

    // Mendapatkan ekstensi file
    $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

    // Filter tipe file yang diizinkan (hanya MP4)
    $allowedTypes = array('mp4');

    // Batasan ukuran file (100MB)
    $maxFileSize = 100 * 1024 * 1024;

    // Memeriksa ukuran file yang diunggah
    if ($file['size'] > $maxFileSize) {
        echo "<script>alert('Ukuran file terlalu besar. Maksimum 10MB yang diperbolehkan.)</script>";
    }

    if (in_array($fileType, $allowedTypes)) {
        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $db_connect->query("INSERT INTO galery VALUES ('$id', '" . $data['nama'] . "','" . $data['deskripsi'] . "','" . $data['jenis_produk'] . "', 'video', '$newFileName')");
        } else {
            echo 'Terjadi kesalahan saat mengunggah file.';
        }
    } else {
        echo 'Tipe file tidak diizinkan. Hanya file MP4 yang diperbolehkan.';
    }
}

function hapus_galery($id, $jenis_media, $media)
{
    global $db_connect;
    if ($jenis_media == 'photo') {
        $filePath = '../image/galery/' . $media;
    } else {
        $filePath = '../videos/' . $media;
    }


    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            return $db_connect->query("DELETE FROM galery WHERE id = '$id'");
        } else {
            echo "<script>alert('Gagal menghapus file')</script>";
        }
    } else {
        echo "<script>alert('Media tidak ada')</script>";
    }
}

function ubah_galery($data)
{
    global $db_connect;
    $id = $data['id'];
    $nama = $data['judul'];
    $jenis_produk = $data['jenis_produk'];
    $deskripsi = $data['deskripsi'];
    $jenis_media = $data['jenis_media'];


    if ($jenis_media == 'photo') {
        if ($data['editPhoto']) {
            $file = $_FILES['media'];
            // Menentukan direktori tujuan penyimpanan file
            $targetDir = '../image/galery/';

            // Menentukan nama file baru
            $fileName = basename($file['name']);
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = $id . '.' . $fileExtension;
            $targetPath = $targetDir . $newFileName;

            // Mendapatkan ekstensi file
            $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

            // Filter tipe file yang diizinkan (hanya JPG dan PNG)
            $allowedTypes = array('jpg', 'jpeg', 'png');

            if (in_array($fileType, $allowedTypes)) {
                // Pindahkan file ke direktori tujuan
                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    return $db_connect->query("UPDATE galery SET nama = '$nama', deskripsi = '$deskripsi', jenis_produk = '$jenis_produk' WHERE id = '$id'");
                } else {
                    echo 'Terjadi kesalahan saat mengunggah file.';
                }
            } else {
                echo 'Tipe file tidak diizinkan. Hanya file JPG dan PNG yang diperbolehkan.';
            }
        } else {
            return $db_connect->query("UPDATE galery SET nama = '$nama', deskripsi = '$deskripsi', jenis_produk = '$jenis_produk' WHERE id = '$id'");
        }
    } else {
        if ($data['editVideo']) {
            $file = $_FILES['media'];
            // Menentukan direktori tujuan penyimpanan file
            $targetDir = '../videos/';

            // Menentukan nama file baru
            $fileName = basename($file['name']);
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = $id . '.' . $fileExtension;
            $targetPath = $targetDir . $newFileName;

            // Mendapatkan ekstensi file
            $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

            // Filter tipe file yang diizinkan (hanya JPG dan PNG)
            $allowedTypes = array('mp4');

            if (in_array($fileType, $allowedTypes)) {
                // Pindahkan file ke direktori tujuan
                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    return $db_connect->query("UPDATE galery SET nama = '$nama', deskripsi = '$deskripsi', jenis_produk = '$jenis_produk' WHERE id = '$id'");
                } else {
                    echo 'Terjadi kesalahan saat mengunggah file.';
                }
            } else {
                echo 'Tipe file tidak diizinkan. Hanya file JPG dan PNG yang diperbolehkan.';
            }
        } else {
            return $db_connect->query("UPDATE galery SET nama = '$nama', deskripsi = '$deskripsi', jenis_produk = '$jenis_produk' WHERE id = '$id'");
        }
    }
}

function terima_pembayaran($id)
{
    global $db_connect;

    // proses update sisa tagihan
    $data_payment = $db_connect->query("SELECT * FROM payment_penjualan WHERE id = '$id'")->fetch_assoc();
    $nominal_payment = $data_payment['pembayaran'];
    $nomor_invoice = $data_payment['nomor_invoice'];

    $proses_update_penjualan = $db_connect->query("UPDATE penjualan SET sisa = sisa - $nominal_payment WHERE nomor_invoice = '$nomor_invoice'");

    // proses update status approved 
    $proses_approv = $db_connect->query("UPDATE payment_penjualan SET status = 'diterima' WHERE id = '$id'");

    return $proses_update_penjualan && $proses_approv;
}

function tolak_pembayaran($id)
{
    global $db_connect;
    // data payment
    $data_pembyaran = $db_connect->query("SELECT * FROM payment_penjualan WHERE id = '$id'")->fetch_assoc();

    // proses update status approved 
    $proses_approv = $db_connect->query("UPDATE payment_penjualan SET status = 'ditolak' WHERE id = '$id'");

    $remove_tgl = $db_connect->query("UPDATE detail_penjualan SET tgl_acara = '0000-00-00' WHERE nomor_invoice = '" . $data_pembyaran['nomor_invoice'] . "'");

    return $proses_approv && $remove_tgl;
}

function accept_reschedule($id)
{
    global $db_connect;
    $data_reschedule = $db_connect->query("SELECT * FROM reschedule WHERE detail_penjualan = '$id'")->fetch_assoc();

    // update status approved
    $update_status = $db_connect->query("UPDATE reschedule SET status = 'diterima' WHERE detail_penjualan = '$id'");

    // update tgl acara 
    $tgl_acara = $db_connect->query("UPDATE detail_penjualan SET tgl_acara = '" . $data_reschedule['tgl_pengajuan'] . "' WHERE id = '" . $data_reschedule['detail_penjualan'] . "'");
    return $update_status && $tgl_acara;
}

function tolak_reschedule($id)
{
    global $db_connect;
    // update status approved
    $update_status = $db_connect->query("UPDATE reschedule SET status = 'ditolak' WHERE detail_penjualan = '$id'");
    return $update_status;
}
