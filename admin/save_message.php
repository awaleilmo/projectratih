<?php

require_once '../functions/koneksi.php';

if (isset($_POST['pengirim']) && isset($_POST['penerima']) && isset($_POST['pesan'])) {
    $db_connect->query("INSERT INTO pesan VALUES ('','" . $_POST['pengirim'] . "', '" . $_POST['penerima'] . "', '" . $_POST['pesan'] . "', '" . date('y-m-d H:i:s') . "',0)");
}
