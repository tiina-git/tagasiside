<?php
if ($_COOKIE["admin_auth"] !== "true") {
    header("Location: login.php");
    exit;
}

include("settings.php");
include("mysqli.php");
$db = new Db();

// Fetch feedback data from the database in reverse order
$sql = "SELECT name, email, message, added FROM feedback ORDER BY added DESC";
$rows = $db->dbGetArray($sql);

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Tagasiside haldus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Laekunud tagasiside</h2>
        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="index.php" class="btn btn-outline-success me-1">Avaleht</a>
            <a href="logout.php" class="btn btn-outline-danger">Logi välja</a>
        </div>
        <?php if ($rows): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Aeg</th>
                        <th>Nimi</th>
                        <th>E-post</th>
                        <th>Sõnum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['added']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['message']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-muted">Tagasisidet ei ole veel saabunud.</p>
        <?php endif; ?>
    </div>
</body>
</html>