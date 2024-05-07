<?php
require_once '../config/database.php';
require_once '../app/reservations.php';

$database = new Database();
$db = $database->dbConnection();

$reservations = new reservations($db);

// Cek jika parameter id ada pada URL
if(isset($_GET['id'])){
    $reservations->id = $_GET['id'];

    if($reservations->delete()){
        header("Location: index.php");
    }else{
        echo "Gagal menghapus reservations.";
    }
}

// Tampilkan data dari method index
$data = $reservations->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>reservations</title>
</head>
<body>
    <h1>reservations</h1>
    <a href="create.php">Tambah</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Guest Id</th>
                <th>Room Id</th>
                <th>Check In Date</th>
                <th>Check Out Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach($data as $row) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['guest_id']; ?></td>
                    <td><?php echo $row['room_id']; ?></td>
                    <td><?php echo $row['check_in_date']; ?></td>
                    <td><?php echo $row['check_out_date']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        |
                        <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus reservations ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>