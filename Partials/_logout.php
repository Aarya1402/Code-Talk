<?php
session_start();
session_destroy();
header("Location: /Code-Talk/index.php");
exit();
?>