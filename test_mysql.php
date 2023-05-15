
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <div id="item-data">
        <!-- Item data will be inserted here -->
    </div>

    <script>
        fetch('./controller/itemController.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.error(error));
    </script>
</body>
</html>
