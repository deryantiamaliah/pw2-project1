<?php
require_once '../config/database.php';
require_once '../app/rooms.php';

$database = new Database();
$db = $database->dbConnection();

$rooms = new rooms($db);

if(isset($_POST['update'])) {
    $rooms->id = $_POST['id'];
    $rooms->hotel_id = $_POST['hotel_id'];
    $rooms->room_number = $_POST['room_number'];
    $rooms->room_type = $_POST['room_type'];
    $rooms->price = $_POST['price'];
    $rooms->availability = $_POST['availability'];

    $rooms->update();
    header("Location: index.php");
    exit;
} elseif(isset($_GET['id'])) {
    $rooms->id = $_GET['id'];
    $stmt = $rooms->edit();
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
        <label for="hotel_id">hotel_id:</label>
        <input type="text" name="hotel_id" value="<?php echo $guest_id; ?>" required>
        <br>
        <label for="room_number">room_number:</label>
        <input type="text" name="room_number" value="<?php echo $room_id; ?>" required>
        <br>
        <label for="room_type">room_type:</label>
        <input type="text" name="room_type" value="<?php echo $check_in_date; ?>" required>
        <br>
        <label for="price">price:</label>
        <input type="text" name="price" value="<?php echo $check_out_date; ?>" required>
        <br>
        <label for="availability">availability:</label>
        <input type="text" name="availability" value="<?php echo $check_out_date; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>