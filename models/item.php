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

    function uuid()  
    {  
        $chars = md5(uniqid(mt_rand(), true));  
        $uuid = substr ( $chars, 0, 8 ) . '-'
                . substr ( $chars, 8, 4 ) . '-' 
                . substr ( $chars, 12, 4 ) . '-'
                . substr ( $chars, 16, 4 ) . '-'
                . substr ( $chars, 20, 12 );  
        return $uuid;
    }  

    function get_total_pages($active, $items_per_page){
        $query = "SELECT COUNT(*) AS total_items FROM " . $this->table_name . " WHERE is_active = :active";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':active', $active);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_pages = $row['total_items'] / $items_per_page;
        return ceil($total_pages);
    }

    function get_items_for_page($active, $page_number, $items_per_page){
        $offset = ($page_number - 1) * $items_per_page;
        $query = "SELECT i.item_id, i.item_name, i.cate_id, c.cate_name, i.img_url, i.price, i.item_description, i.is_active, i.created_at
                  FROM " . $this->table_name . " i 
                  JOIN " . $this->category_table . " c 
                  ON i.cate_id = c.cate_id
                  WHERE i.is_active = :active
                  ORDER BY i.item_id
                  LIMIT :offset,:items_per_page";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':active', $active);
        $stmt->bindValue(':items_per_page', $items_per_page, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    function updateItem($item_id, $item_name, $cate_id, $img_url, $price, $item_description){
        $query = "UPDATE " . $this->table_name . " SET item_name = :item_name, cate_id = :cate_id, img_url = :img_url, price = :price, item_description = :item_description WHERE item_id = :item_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':item_name', $item_name);
        $stmt->bindParam(':cate_id', $cate_id);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':item_description', $item_description);
        $stmt->bindParam(':item_id', $item_id);
        $stmt->execute();
    }

    function deleteItem($item_id){
        $query = "DELETE FROM " . $this->table_name . " WHERE item_id = :item_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':item_id', $item_id);
        $stmt->execute();
    }

    function insertItem($item_name, $cate_id, $img_url, $price, $item_description){
        $query = "INSERT INTO " . $this->table_name . " (item_id, item_name, cate_id, img_url, price, item_description) VALUES (:item_id, :item_name, :cate_id, :img_url, :price, :item_description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':item_id', $this->uuid(), PDO::PARAM_STR);
        $stmt->bindParam(':item_name', $item_name);
        $stmt->bindParam(':cate_id', $cate_id);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':item_description', $item_description);
        $stmt->execute();
    }
    // You can add more methods to handle create, update, and delete operations
}
?>
