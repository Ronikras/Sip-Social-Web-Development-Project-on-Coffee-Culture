<?php
session_start();
session_destroy();
header('Location: vchod.php');
exit;
?>
