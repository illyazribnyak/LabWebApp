<?php
require_once '_db.php';

$stmt = $db->prepare("DELETE FROM reservations WHERE id = :id");
$stmt->bindParam(':id', $_POST['id']);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Deleted successfully';

header('Content-Type: application/json');
echo json_encode($response);
?>