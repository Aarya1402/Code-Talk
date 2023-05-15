<?php
session_start();
session_destroy();
header("Location: /PHP project/index.php");
exit();
?>