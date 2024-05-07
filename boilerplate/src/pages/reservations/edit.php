<?php
require_once '../config/database.php';
require_once '../app/reservations.php';

$database = new Database();
$db = $database->dbConnection();

$reservations = new reservations($db);

if(isset($_POST['update'])) {
    $reservations->id = $_POST['id'];
    $reservations->guest_id = $_POST['guest_id'];
    $reservations->room_id = $_POST['room_id'];
    $reservations->check_in_date = $_POST['check_in_date'];
    $reservations->check_out_date = $_POST['check_out_date'];

    $reservations->update();
    header("Location: index.php");
    exit;
} elseif(isset($_GET['id'])) {
    $reservations->id = $_GET['id'];
    $stmt = $reservations->edit();
    $num = $stmt->rowCount();

    if($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="guest_id">guest_id:</label>
        <input type="text" name="guest_id" value="<?php echo $guest_id; ?>" required>
        <br>
        <label for="room_id">room_id:</label>
        <input type="text" name="room_id" value="<?php echo $room_id; ?>" required>
        <br>
        <label for="check_in_date">check_in_date:</label>
        <input type="text" name="check_in_date" value="<?php echo $check_in_date; ?>" required>
        <br>
        <label for="check_out_date">check_out_date:</label>
        <input type="text" name="check_out_date" value="<?php echo $check_out_date; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>