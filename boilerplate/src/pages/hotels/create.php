<?php
require_once '../config/database.php';
require_once '../app/guests.php';

$database = new Database();
$db = $database->dbConnection();

$guests = new guests($db);

if(isset($_POST['tambah'])){
    $guests->first_name = $_POST['first_name'];
    $guests->last_name = $_POST['last_name'];
    $guests->email = $_POST['email'];
    $guests->phone = $_POST['phone'];

    $guests->store(); 
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
        <label for="first_name">first_name:</label>
        <input type="text" name="first_name" required>
        <br>
        <label for="last_name">last_name:</label>
        <input type="text" name="last_name" required>
        <br>
        <label for="email">email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="phone">phone:</label>
        <input type="number" name="phone" required>
        <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
</body>
</html>