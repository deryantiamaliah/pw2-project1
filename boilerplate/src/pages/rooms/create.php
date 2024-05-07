<?php
require_once '../config/database.php';
require_once '../app/rooms.php';

$database = new Database();
$db = $database->dbConnection();

$rooms = new rooms($db);

if(isset($_POST['tambah'])){
    $rooms->hotel_id = $_POST['hotel_id'];
    $rooms->room_number = $_POST['room_number'];
    $rooms->room_type = $_POST['room_type'];
    $rooms->price = $_POST['price'];
    $rooms->availability = $_POST['availability'];

    $rooms->store(); 
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data</h1>
    <form method="POST" action="">
        <label for="hotel_id">hotel_id:</label>
        <input type="text" name="hotel_id" required>
        <br>
        <label for="room_number">room_number:</label>
        <input type="text" name="room_number" required>
        <br>
        <label for="room_type">room_type:</label>
        <input type="text" name="room_type" required>
        <br>
        <label for="price">price:</label>
        <input type="text" name="price" required>
        <br>
        <label for="availability">availability:</label>
        <input type="text" name="availability" required>
        <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
</body>
</html>