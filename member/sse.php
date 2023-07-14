<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

require_once '../functions/member_service.php';


// Fungsi untuk mengambil jumlah pesan belum dibaca dari database
function getUnreadMessageCount()
{
    global $db_connect;

    $id_user = trim($_SESSION['id_user']);
    // Implementasikan logika pengambilan jumlah pesan belum dibaca dari database di sini
    // Misalnya, menggunakan query ke database dan mengembalikan hasilnya
    return $jumlah_pesan_belum_dibaca = $db_connect->query("SELECT * FROM pesan WHERE id_user_1 = 1 AND id_user_2 = '$id_user' AND `read` = '0'")->num_rows;
}

echo getUnreadMessageCount();
