<?php

require_once '../functions/koneksi.php';

if (isset($_POST['pengirim']) && $_POST['pesan']) {
    $db_connect->query("INSERT INTO pesan VALUES ('','" . $_POST['pengirim'] . "', '1', '" . $_POST['pesan'] . "', '" . date('y-m-d H:i:s') . "','0')");
}
