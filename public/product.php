<?php

require '_inc/db.php';

$db = db_connect();
$row = $db->querySingle("SELECT * FROM postcards WHERE id = " . $_GET['id'], true);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Airline postcards - <?php echo $row['title']; ?></title>
<?php require 'style/style.css' ?>
</head>
<body>
<?php require '_inc/header.php' ?>

<h2><?php echo $row['title']; ?></h2>
<img src="images/<?php echo $row['filename']; ?>" />

<ul>
    <li>Airline: <?php echo $row['airline']; ?></li>
    <li>Make: <?php echo $row['make']; ?></li>
    <li>Price: £<?php echo $row['price']; ?> each</li>
</ul>
<p><a href="./basket/add.php?id=<?php echo $row['id']; ?>">Add to basket</a></p>

<p><a href="#" onclick="history.back(); return false;">Back</a></p>

<?php require '_inc/footer.php' ?>
</body>

</html>
