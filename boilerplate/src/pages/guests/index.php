<?php
require_once '../config/database.php';
require_once '../app/guests.php';

$database = new Database();
$db = $database->dbConnection();

$guests = new guests($db);

// Cek jika parameter id ada pada URL
if(isset($_GET['id'])){
    $guests->id = $_GET['id'];

    if($guests->delete()){
        header("Location: index.php");
    }else{
        echo "Gagal menghapus guests.";
    }
}

// Tampilkan data dari method index
$data = $guests->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guests</title>
</head>
<body>
    <h1>Guests</h1>
    <a href="create.php">Tambah</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach($data as $row) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        |
                        <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus guest ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>