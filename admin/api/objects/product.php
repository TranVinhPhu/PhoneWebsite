<?php
class Product {
    private $con;
    private $table_name = "product";

    public $item_id;
    public $item_brand;
    public $item_name;
    public $item_price;
    public $item_image;
    public $item_register;
    public $item_description;

    public function __construct($db) {
        $this->con = $db;
    }

    function upload_image($path, $file) {
        $baseDir = dirname(__DIR__, 3);
        $targetDir = $baseDir . '/' . trim($path, './');
        $default = "1.png";
    
        $filename = basename($file['name']);
        $targetFilePath = $targetDir . '/' . $filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
        if (!empty($filename)) {
            $allowType = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowType)) {
                if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                    if (file_exists($targetFilePath)) {
                        return $path . $filename;
                    }
                }
            }
        }
        return $path . $default;
    }
    

    function read(){
        $query = "SELECT
                    `item_id`, `item_brand`, `item_name`, `item_price`, `item_image`, `item_register`, `item_description`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    item_id DESC";
    
        $stmt = $this->con->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }

    function read_single(){
        $query = "SELECT
                    `item_id`, `item_brand`, `item_name`, `item_price`, `item_image`, `item_register`, `item_description`
                FROM
                    " . $this->table_name . " 
                WHERE
                    item_id = :item_id";
    
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(":item_id", $this->item_id);
        $stmt->execute();
        return $stmt;
    }

    function create() {
        if ($this->isAlreadyExist()) {
            return false;
        }
    
        $query = "INSERT INTO " . $this->table_name . " 
                    (item_brand, item_name, item_price, item_image, item_register, item_description) 
                    VALUES (?, ?, ?, ?, NOW(), ?)";
    
        $stmt = $this->con->prepare($query);
    
        $stmt->bind_param('ssdss', $this->item_brand, $this->item_name, $this->item_price, $this->item_image, $this->item_description);
    
        if ($stmt->execute()) {
            $this->item_id = $this->con->insert_id;
            return true;
        }
    
        return false;
    }
    
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE item_id= ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i', $this->item_id);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
    function update() {
        $query = "UPDATE " . $this->table_name . "
            SET item_brand = ?,
                item_name = ?,
                item_price = ?,
                item_image = ?,
                item_description = ?
            WHERE item_id = ?";
    
        $stmt = $this->con->prepare($query);
    
        $stmt->bind_param('ssdssi', $this->item_brand, $this->item_name, $this->item_price, $this->item_image, $this->item_description, $this->item_id);
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    function isAlreadyExist() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE item_name = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('s', $this->item_name);
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function readPaginated($start, $pageSize) {
        $query = "SELECT * FROM product LIMIT ?, ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ii", $start, $pageSize);
        $stmt->execute();
        return $stmt;
    }

    public function countAll() {
        $query = "SELECT COUNT(*) as total FROM product";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}