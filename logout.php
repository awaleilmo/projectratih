<?php
session_start();
session_unset();
unset($_SESSION['id_user']);
unset($_SESSION['is_admin']);
unset($_SESSION['url_photo']);
session_destroy();

echo "<script>location.href='login.php'</script>";
