<?php
function generateRandomSmiley() {
    $smileys = ['😀', '😃', '😄', '😁', '😆', '😅', '😂', '🤣', '😊', '😇', '🙂', '🙃', '😉', '😌', '😍', '🥰'];
    return $smileys[array_rand($smileys)];
}

$perPage = 16;

$totalSmileys = 256;

$totalPages = ceil($totalSmileys / $perPage);

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = min(max(1, $_GET['page']), $totalPages);
} else {
    $currentPage = 1;
}

$startIndex = ($currentPage - 1) * $perPage;

$smileys = [];
for ($i = 0; $i < $perPage; $i++) {
    $row = [];
    for ($j = 0; $j < 16; $j++) {
        $row[] = generateRandomSmiley();
    }
    $smileys[] = $row;
}

if (isset($_POST['regenerate'])) {
    header("Location: ?page=$currentPage");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smiley Grid</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
            font-size: 24px;
        }
        button {
            font-size: 20px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <h1>Smiley Grid</h1>
    <form method="post">
        <button type="submit" name="regenerate">Régénérer</button>
    </form>
    <table>
        <?php foreach ($smileys as $row): ?>
            <tr>
                <?php foreach ($row as $smiley): ?>
                    <td><?php echo $smiley; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>
