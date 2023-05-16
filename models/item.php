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

    // You can add more methods to handle create, update, and delete operations
}
?>
