<?php
require_once '../config/database.php';
require_once '../app/reservations.php';

$database = new Database();
$db = $database->dbConnection();

$reservations = new reservations($db);

if(isset($_POST['tambah'])){
    $reservations->guest_id = $_POST['guest_id'];
    $reservations->room_id = $_POST['room_id'];
    $reservations->check_in_date = $_POST['check_in_date'];
    $reservations->check_out_date = $_POST['check_out_date'];

    $reservations->store(); 
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
        <label for="guest_id">guest_id:</label>
        <input type="text" name="guest_id" required>
        <br>
        <label for="room_id">room_id:</label>
        <input type="text" name="room_id" required>
        <br>
        <label for="check_in_date">check_in_date:</label>
        <input type="text" name="check_in_date" required>
        <br>
        <label for="check_out_date">check_out_date:</label>
        <input type="text" name="check_out_date" required>
        <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
</body>
</html>