<?php
if ($_COOKIE["admin_auth"] !== "true") {
    header("Location: login.php");
    exit;
}

include("settings.php");
include("mysqli.php");
$db = new Db();

// SQl andmete lugemine andmebaasist (viimasena lisatud eespool)
$sql = "SELECT id, name, email, message, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') as added FROM feedback ORDER BY added DESC";
$rows = $db->prepareGetArray($sql);

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Tagasiside haldus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
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
                        <th>Tegevus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['added']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['message']) ?></td>
                            <td>
                                <form action="delete_feedback.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="delete-btn" onclick="return confirm('Kas olete kindel, et soovite seda tagasisidet kustutada?')">Kustuta</button>
                                    
                                </form>
                            </td>
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