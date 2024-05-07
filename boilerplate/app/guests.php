<?php
    class Guests {
        private $conn;
        private $table_name = "guests";

        public $id;
        public $first_name;
        public $last_name;
        public $email;
        public $phone;

        public function __construct($db){
            $this->conn = $db;
        }

        // Tampilkan data semua produk
        public function index(){
            $query = "SELECT * FROM {$this->table_name}";
            $data = $this->conn->prepare($query);
            $data->execute();
            return $data;
        }

        // Tampilkan halaman create
        public function create(){
            header("Location: create.php");
            exit();
        }

        // Tambah produk ke database
        public function store(){
            $query = "INSERT INTO {$this->table_name} 
                    (nama) 
                    VALUES (?)
                    ";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->nama,
            ]);
        
            return $data->rowCount() > 0;
        }

        // Tampilkan halaman edit
        public function edit(){
            $query = "SELECT * FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
            return $data;
        }

        // Update guests ke database
        public function update(){
            $query = "UPDATE {$this->table_name} 
                    SET nama=? 
                    WHERE id=?";
            $data = $this->conn->prepare($query);
        
            $data->execute([ 
                $this->nama,
                $this->id
            ]);
        
            return $data->rowCount() > 0;
        }

        // Hapus guests dari database
        public function delete(){
            $query = "DELETE FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
        
            return $data->rowCount() > 0;
        }
    }
?>