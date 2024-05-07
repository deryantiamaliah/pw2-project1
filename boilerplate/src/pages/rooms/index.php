<?php
require_once '../config/database.php';
require_once '../app/rooms.php';

$database = new Database();
$db = $database->dbConnection();

$rooms = new rooms($db);

// Cek jika parameter id ada pada URL
if(isset($_GET['id'])){
    $rooms->id = $_GET['id'];

    if($rooms->delete()){
        header("Location: index.php");
    }else{
        echo "Gagal menghapus rooms.";
    }
}

// Tampilkan data dari method index
$data = $rooms->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rooms</title>
</head>
<body>
    <h1>rooms</h1>
    <a href="create.php">Tambah</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hotel Id</th>
                <th>Room Number</th>
                <th>Room type</th>
                <th>Price</th>
                <th>availability</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach($data as $row) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['hotel_id']; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['availability']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        |
                        <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus rooms ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>