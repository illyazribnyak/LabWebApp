<?php
ini_set('display_errors', 0);
error_reporting(0);

require_once '_db.php';

$stmt = $db->prepare("SELECT * FROM rooms ORDER BY name");
$stmt->execute();
$rooms = $stmt->fetchAll();

class Room {
    public int $id;
    public string $name;
    public int $capacity;
    public string $status;
}

$result = array();

foreach($rooms as $room) {
  $r = new Room();
  $r->id = $room['id'];
  $r->name = $room['name'];
  $r->capacity = $room['capacity'];
  $r->status = $room['status'];
  $result[] = $r;
}

header('Content-Type: application/json');
echo json_encode($result);
?>
