<pre>
    <?php
    require './connect-db.php';

    $sql = "SELECT * FROM shops";

    $stmt = $pdo->query($sql)->fetchAll();

    print_r($stmt);
    ?>
</pre>