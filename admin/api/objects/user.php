<?php
class User {
    private $con;
    private $table_name = "user";

    public $user_id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $profileImage;
    public $register_date;

    public function __construct($db) {
        $this->con = $db;
    }

    function upload_profile($path, $file) {
        $baseDir = dirname(__DIR__, 3);
        $targetDir = $baseDir . '/register/' . trim($path, './');
        $default = "beard.png";
    
        $filename = basename($file['name']);
        $targetFilePath = $targetDir . '/' . $filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
        if (!empty($filename)) {
            $allowType = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowType)) {
                if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                    if (file_exists($targetFilePath)) {
                        return $path . $filename;}
                    }
            }
        }
        return $path . $default;
    }
    

    function read(){
        $query = "SELECT
                    `user_id`, `first_name`, `last_name`, `email`, `password`, `profileImage`, `register_date`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    user_id DESC";
    
        $stmt = $this->con->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }

    function read_single(){
        $query = "SELECT
                    `user_id`, `first_name`, `last_name`, `email`, `password`, `profileImage`, `register_date`
                FROM
                    " . $this->table_name . " 
                WHERE
                    user_id = ?";
    
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    

    function create() {
        if ($this->isAlreadyExist()) {
            return false;
        }
    
        $query = "INSERT INTO " . $this->table_name . " 
                    (first_name, last_name, email, password, register_date";
    
        if (!empty($this->profileImage)) {
            $query .= ", profileImage";
        }
    
        $query .= ") VALUES (?, ?, ?, ?, NOW()";
    
        if (!empty($this->profileImage)) {
            $query .= ", ?";
        }
    
        $query .= ")";
    
        $stmt = $this->con->prepare($query);
    
        $stmt->bind_param('sssss', $this->first_name, $this->last_name, $this->email, $this->password, $this->profileImage);
    
        if ($stmt->execute()) {
            $this->user_id = $this->con->insert_id;
    
            $query_read = "SELECT
                                user_id, first_name, last_name, email, profileImage, register_date
                           FROM
                                " . $this->table_name . "
                           WHERE
                                user_id = ?";
    
            $stmt_read = $this->con->prepare($query_read);
            $stmt_read->bind_param('i', $this->user_id);
            $stmt_read->execute();
    
            $result = $stmt_read->get_result();
    
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->user_id = $row['user_id'];
                $this->first_name = $row['first_name'];
                $this->last_name = $row['last_name'];
                $this->email = $row['email'];
                $this->profileImage = $row['profileImage'];
                $this->register_date = $row['register_date'];
    
                return true;
            }
        }
    
        return false;
    }
    
    

    function delete(){
        
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    user_id= '".$this->user_id."'";
        
        $stmt = $this->con->prepare($query);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name . "
          SET first_name = ?,
              last_name = ?,
              email = ?,
              password = ?";

        if (!empty($this->profileImage)) {
            $query .= ", profileImage = ?";
        }

        $query .= " WHERE user_id = ?";

        $stmt = $this->con->prepare($query);
        
        $stmt->bind_param('sssssi', $this->first_name, $this->last_name, $this->email, $this->password, $this->profileImage, $this->user_id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    function isAlreadyExist() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('s', $this->email);
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        $row = $result->fetch_assoc();
    
        if ($row) {
            return true;
        } else {
            return false;
        }
    }
    public function readPaginated($start, $pageSize) {
        $query = "SELECT * FROM user LIMIT ?, ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ii", $start, $pageSize);
        $stmt->execute();
        return $stmt;
    }

    public function countAll() {
        $query = "SELECT COUNT(*) as total FROM user";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
?>