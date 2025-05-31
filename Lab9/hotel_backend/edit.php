<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Reservation</title>
    <link type="text/css" rel="stylesheet" href="media/layout.css" />
    <script src="js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
</head>
<body>
<?php
require_once '_db.php';
$is_id = is_numeric($_GET['id']) ? $_GET['id'] : die("Invalid ID");
$stmt = $db->prepare('SELECT * FROM reservations WHERE id = :id');
$stmt->bindParam(':id', $is_id);
$stmt->execute();
$reservation = $stmt->fetch();
$rooms = $db->query('SELECT * FROM rooms');
?>
<form id="f" action="backend_update.php" method="post" style="padding:20px;">
    <h1>Edit Reservation</h1>
    <input type="hidden" name="id" value="<?= $reservation['id'] ?>" />
    <div>Start:</div>
    <div><input type="text" name="start" value="<?= $reservation['start'] ?>" /></div>
    <div>End:</div>
    <div><input type="text" name="end" value="<?= $reservation['end'] ?>" /></div>
    <div>Room:</div>
    <div>
        <select name="room">
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room['id'] ?>" <?= $room['id'] == $reservation['room_id'] ? 'selected' : '' ?>>
                    <?= $room['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>Name:</div>
    <div><input type="text" name="name" value="<?= $reservation['name'] ?>" /></div>
    <div>Status:</div>
    <div>
        <select name="status">
            <?php
            $statuses = ["New", "Confirmed", "Arrived", "CheckedOut"];
            foreach ($statuses as $status):
                $selected = $status == $reservation['status'] ? 'selected' : '';
                echo "<option value='$status' $selected>$status</option>";
            endforeach;
            ?>
        </select>
    </div>
    <div>Paid:</div>
    <div>
        <select name="paid">
            <?php
            $paids = [0, 50, 100];
            foreach ($paids as $paid):
                $selected = $paid == $reservation['paid'] ? 'selected' : '';
                echo "<option value='$paid' $selected>$paid%</option>";
            endforeach;
            ?>
        </select>
    </div>
    <div class="space"><input type="submit" value="Save" /> <a href="javascript:close();">Cancel</a></div>
</form>
</body>
</html>
