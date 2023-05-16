<?php
class Item {
    private $conn;
    private $table_name = "item";
    private $category_table = "category";

    public $item_id;
    public $item_name;
    public $cate_id;
    public $img_url;
    public $price;
    public $item_description;
    public $is_active;
    public $created_at;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT i.item_id, i.item_name, i.cate_id, c.cate_name, i.img_url, i.price, i.item_description, i.is_active, i.created_at
                  FROM " . $this->table_name . " i 
                  JOIN " . $this->category_table . " c 
                  ON i.cate_id = c.cate_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readActive(){
        $query = "SELECT i.item_id, i.item_name, i.cate_id, c.cate_name, i.img_url, i.price, i.item_description, i.is_active, i.created_at
                  FROM " . $this->table_name . " i 
                  JOIN " . $this->category_table . " c 
                  ON i.cate_id = c.cate_id
                  WHERE i.is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readInActive(){
        $query = "SELECT i.item_id, i.item_name, i.cate_id, c.cate_name, i.img_url, i.price, i.item_description, i.is_active, i.created_at
                  FROM " . $this->table_name . " i 
                  JOIN " . $this->category_table . " c 
                  ON i.cate_id = c.cate_id
                  WHERE i.is_active = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // You can add more methods to handle create, update, and delete operations
}
?>
