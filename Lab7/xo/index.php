<?php
session_start();

function checkWinner($field, $player) {
    for ($i = 0; $i < 3; $i++) {
        if ($field[$i][0] === $player && $field[$i][1] === $player && $field[$i][2] === $player) return true;
        if ($field[0][$i] === $player && $field[1][$i] === $player && $field[2][$i] === $player) return true;
    }
    if ($field[0][0] === $player && $field[1][1] === $player && $field[2][2] === $player) return true;
    if ($field[0][2] === $player && $field[1][1] === $player && $field[2][0] === $player) return true;
    return false;
}

if (!isset($_SESSION['field'])) {
    $_SESSION['field'] = array_fill(0, 3, array_fill(0, 3, ' '));
    $_SESSION['winner'] = null;
}

$field = $_SESSION['field'];
$winner = $_SESSION['winner'];

if (!$winner && isset($_GET['i']) && isset($_GET['j'])) {
    $i = intval($_GET['i']);
    $j = intval($_GET['j']);

    if ($field[$i][$j] === ' ') {
        $field[$i][$j] = 'X';
        if (checkWinner($field, 'X')) {
            $winner = 'Гравець';
        } else {
            // Хід бота
            for ($bi = 0; $bi < 3; $bi++) {
                for ($bj = 0; $bj < 3; $bj++) {
                    if ($field[$bi][$bj] === ' ') {
                        $field[$bi][$bj] = 'O';
                        if (checkWinner($field, 'O')) {
                            $winner = 'Бот';
                        }
                        break 2;
                    }
                }
            }
        }
    }
}

$_SESSION['field'] = $field;
$_SESSION['winner'] = $winner;
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Хрестики-Нолики</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }
        table {
            border-spacing: 10px;
        }
        td {
            width: 60px;
            height: 60px;
            background-color: #f0f0f0;
            font-size: 36px;
            text-align: center;
        }
        a {
            display: block;
            width: 100%;
            height: 100%;
            text-decoration: none;
            color: black;
        }
        .reset {
            margin-top: 20px;
            font-size: 18px;
        }
        .winner {
            font-size: 22px;
            margin-bottom: 10px;
            color: green;
        }
    </style>
</head>
<body>
    <h2>PHP Гра: Хрестики-Нолики</h2>

    <?php if ($winner): ?>
        <div class="winner">🏆 Переможець: <?=$winner?></div>
    <?php endif; ?>

    <table>
        <?php for ($i = 0; $i < 3; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < 3; $j++): ?>
                    <td>
                        <?php if ($field[$i][$j] === ' ' && !$winner): ?>
                            <a href="?i=<?=$i?>&j=<?=$j?>"></a>
                        <?php else: ?>
                            <?=$field[$i][$j]?>
                        <?php endif; ?>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
    <a class="reset" href="reset.php">🔄 Почати спочатку</a>
</body>
</html>
