<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Reservation</title>
    <link type="text/css" rel="stylesheet" href="media/layout.css" />
    <script src="js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
</head>
<body>
<?php
require_once '_db.php';
$rooms = $db->query('SELECT * FROM rooms');
$start = $_GET['start'];
$end = $_GET['end'];
?>
<form id="f" action="backend_create.php" method="post" style="padding:20px;">
    <h1>New Reservation</h1>
    <div>Name:</div>
    <div><input type="text" id="name" name="name" value="" /></div>
    <div>Start:</div>
    <div><input type="text" id="start" name="start" value="<?php echo $start ?>" /></div>
    <div>End:</div>
    <div><input type="text" id="end" name="end" value="<?php echo $end ?>" /></div>
    <div>Room:</div>
    <div>
        <select id="room" name="room">
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room['id'] ?>" <?= $_GET['resource'] == $room['id'] ? 'selected' : '' ?>>
                    <?= $room['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="space"><input type="submit" value="Save" /> <a href="javascript:close();">Cancel</a></div>
</form>
</body>
</html>
