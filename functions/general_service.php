<?php

require_once 'koneksi.php';

function formatHarga($angka)
{
    if ($angka >= 1000000000) {
        return round($angka / 1000000000, 1) . 'M';
    } elseif ($angka >= 1000000) {
        return round($angka / 1000000, 1) . 'Jt';
    } elseif ($angka >= 1000) {
        return round($angka / 1000, 1) . 'K';
    }
    return $angka;
}

function convertDateTime($datetime)
{
    $current_time = new DateTime();
    $converted_time = new DateTime($datetime);

    $time_difference = $current_time->diff($converted_time);

    if ($time_difference->i < 1) {
        return $time_difference->s . " detik yang lalu";
    } elseif ($time_difference->h < 1) {
        return $time_difference->i . " menit yang lalu";
    } elseif ($time_difference->d < 1) {
        return $time_difference->h . " jam yang lalu";
    } elseif ($time_difference->days < 7) {
        return $time_difference->d . " hari yang lalu";
    } else {
        $weeks = floor($time_difference->days / 7);
        return $weeks . " minggu yang lalu";
    }
}

function isTanggal8HariKedepan($tgl)
{
    $tglSekarang = date('Y-m-d');
    $tgl8HariKedepan = date('Y-m-d', strtotime('+8 days'));

    return ($tgl >= $tgl8HariKedepan);
}

function update_profile($data_post, $data_files)
{
    global $db_connect;
    $length = 8; // Panjang string acak yang diinginkan
    $randomString = bin2hex(random_bytes($length));

    $file = $data_files['avatar'];

    if (!$file['name'] == '') {
        // Menentukan direktori tujuan penyimpanan file
        $targetDir = '../image/user_profile/';

        // Menentukan nama file baru
        $fileName = basename($file['name']);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = $randomString . '.' . $fileExtension;
        $targetPath = $targetDir . $newFileName;
        $move_data = move_uploaded_file($file['tmp_name'], $targetPath);

        // proses update data user 
        $update_user = $db_connect->query("UPDATE user SET nama = '" . $data_post['nama'] . "', email = '" . $data_post['email'] . "', alamat = '" . $data_post['alamat'] . "', no_telpon = '" . $data_post['no_telpon'] . "', jenis_kelamin = '" . $data_post['jenis_kelamin'] . "', tanggal_lahir = '" . $data_post['tanggal_lahir'] . "', photo = '$newFileName' WHERE `id`  = '" . $_SESSION['id_user'] . "'");

        //set session url_photo 
        $_SESSION['url_photo'] = $newFileName;
        return $move_data && $update_user;
    } else {
        return $db_connect->query("UPDATE user SET nama = '" . $data_post['nama'] . "', email = '" . $data_post['email'] . "', alamat = '" . $data_post['alamat'] . "', no_telpon = '" . $data_post['no_telpon'] . "', jenis_kelamin = '" . $data_post['jenis_kelamin'] . "', tanggal_lahir = '" . $data_post['tanggal_lahir'] . "' WHERE `id`  = '" . $_SESSION['id_user'] . "'");
    }
}

function update_password($data)
{
    global $db_connect;
    return $db_connect->query("UPDATE user SET password = '" . $data['password_baru'] . "' WHERE id = '" . $data['id_user'] . "'");
}
