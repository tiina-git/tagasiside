<?php
if ($_COOKIE["admin_auth"] !== "true") {
    header("Location: login.php");
    exit;
}

include("settings.php");
include("mysqli.php");
$db = new Db();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $sql = "DELETE FROM feedback WHERE id = ?";
    $types = "i";
    $params = [(int)$_POST["id"]];

    if ($db->prepareQuery($sql, $types, $params)) {
        echo "<div class='alert alert-success'>Tagasiside kustutatud.</div>";
    } else {
        echo "<div class='alert alert-danger'>Viga tagasiside kustutamisel.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Vigane päring.</div>";
}
echo "<a href='admin.php'>Tagasi admin lehele</a>";
?>