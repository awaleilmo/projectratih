<?php
require_once '../functions/general_service.php';

// Mengambil data pesan dari database
$userID1 = $_GET['user_1']; // ID pengguna 1
$userID2 = $_GET['user_2']; // ID pengguna 2

$query = "SELECT * FROM pesan WHERE (id_user_1 = $userID1 AND id_user_2 = $userID2) OR (id_user_1 = $userID2 AND id_user_2 = $userID1)";
$result = $db_connect->query($query);

$admin_profile = $db_connect->query("SELECT * FROM user WHERE id = 1")->fetch_assoc()['photo'];

// Menampilkan data pesan dalam elemen HTML
while ($row = mysqli_fetch_assoc($result)) {
    $pengirim = $row['id_user_1'];
    $penerima = $row['id_user_2'];
    $isi = $row['isi']; // Menggunakan field "pesan" sebagai "isi"
    $created_at = $row['created_at']; // Menggunakan field "timestamp" sebagai "created_at"


    if ($penerima == $userID2 && $row['read'] == 0) {
        $db_connect->query("UPDATE pesan SET `read` = '1' WHERE id = '" . $row['id'] . "'");
    }

    // Menghitung selisih waktu dalam detik
    $selisih_waktu = convertDateTime($created_at);

    // Tentukan apakah pengguna saat ini adalah pengirim atau penerima pesan
    $isPengirim = ($pengirim == $userID2);

    // Tampilkan pesan dalam elemen HTML dengan menggunakan data yang diambil
    echo '<div class="d-flex justify-content-' . ($isPengirim ? 'end' : 'start') . ' mb-10">';
    echo '<div class="d-flex flex-column align-items-' . ($isPengirim ? 'end' : 'start') . '">';
    echo '<div class="d-flex align-items-center mb-2">';
    if (!$isPengirim) {
        echo '<div class="symbol symbol-35px symbol-circle">';
        echo '<img alt="Pic" src="../image/user_profile/' . $admin_profile . '">';
        echo '</div>';
    }
    echo '<div class="' . ($isPengirim ? 'me-3' : 'ms-3') . '">';
    if ($isPengirim) {
        echo '<span class="text-muted fs-7 mb-1"> ' . $selisih_waktu . '</span>';
    }
    echo '<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ' . ($isPengirim ? 'ms-1' : 'me-1') . '">' . ($isPengirim ? 'You' : 'Administrator') . '</a>';


    if (!$isPengirim) {
        echo '<span class="text-muted fs-7 mb-1"> ' . $selisih_waktu . '</span>';
    }
    echo '</div>';
    if ($isPengirim) {
        echo '<div class="symbol symbol-35px symbol-circle">';
        echo '<img alt="Pic" src="../image/user_profile/' . $_SESSION['url_photo'] . '">';
        echo '</div>';
    }
    echo '</div>';
    echo '<div id="isiPesan" class="p-5 rounded bg-' . ($isPengirim ? 'light-primary' : 'light-info') . ' text-dark fw-semibold mw-lg-400px text-' . ($isPengirim ? 'end' : 'start') . '" data-kt-element="message-text">';
    echo $isi; // Menggunakan field "pesan" sebagai "isi"
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

// Menutup koneksi ke database
mysqli_close($db_connect);
