<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("settings.php");
    include("mysqli.php");
    $db = new Db();

    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $message = trim($_POST["message"] ?? '');

    if ($name && $email && $message) {
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $message = str_replace(["\r", "\n", ";"], " ", htmlspecialchars($message));

        $timestamp = date("Y-m-d H:i:s");
        $line = "$timestamp;$name;$email;$message\n";
        file_put_contents("feedback.csv", $line, FILE_APPEND | LOCK_EX);

       
    } else {
        echo "<h3>Palun täida kõik väljad.</h3>";
        echo "<a href='javascript:history.back()'>Tagasi</a>";
    }

    // SQL insertion
    if (empty($errors)) {
        // Use dbFix() to sanitize data before inserting into the database
        $sql = "INSERT INTO feedback (name, email, message, added) VALUES (
            '" . $db->dbFix($name) . "',
            '" . $db->dbFix($email) . "',
            '" . $db->dbFix($message) . "',
            '" . $timestamp . "'
        )";

        if ($db->dbQuery($sql)) {
            echo "<div class='alert alert-success'>Aitäh! Teie tagasiside on salvestatud.</div>";
            echo "<a href='index.php'>Avalehele</a>";
        } else {
            echo "<div class='alert alert-danger'>Vabandust, tagasiside salvestamisel tekkis viga. Palun proovige hiljem uuesti.</div>";
            echo "<a href='contact.html'>Proovi uuesti</a>";
        }
    }
} else {
    header("Location: contact.html");
    exit;
}
?>