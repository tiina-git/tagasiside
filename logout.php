<?php
setcookie("admin_auth", "", time() - 3600, "/"); // kustutab küpsise
header("Location: index.php");
exit;
