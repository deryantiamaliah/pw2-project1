<?php
require_once '../config/database.php';
require_once '../app/guests.php';

$database = new Database();
$db = $database->dbConnection();

$guests = new guests($db);

if(isset($_POST['update'])) {
    $guests->id = $_POST['id'];
    $guests->first_name = $_POST['first_name'];
    $guests->last_name = $_POST['last_name'];
    $guests->email = $_POST['email'];
    $guests->phone = $_POST['phone'];

    $guests->update();
    header("Location: index.php");
    exit;
} elseif(isset($_GET['id'])) {
    $guests->id = $_GET['id'];
    $stmt = $guests->edit();
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
        <label for="first_name">first_name:</label>
        <input type="text" name="first_name" value="<?php echo $first_name; ?>" required>
        <br>
        <label for="last_name">last_name:</label>
        <input type="text" name="last_name" value="<?php echo $last_name; ?>" required>
        <br>
        <label for="email">email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>
        <br>
        <label for="phone">phone:</label>
        <input type="number" name="phone" value="<?php echo $phone; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>