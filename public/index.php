<?php

require '_inc/db.php';

session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Airline postcards</title>
<?php require 'style/style.css' ?>
</head>
<body>
<?php require '_inc/header.php' ?>
<?php

if ($items = count($_SESSION['basket'])) {
    ?><p>You've got <?php echo $items; ?> item(s) in <a href="/basket">the basket</a>.</p><?php
}

?>
<ul id="products">
<?php

$db = db_connect();
$res = $db->query("SELECT * FROM postcards");

while($row = $res->fetchArray()) { ?>
<li>
    <a href="product.php?id=<?php echo $row['id']; ?>"><img src="images/t/<?php echo $row['filename']; ?>" /></a><br />
    <?php echo $row['title']; ?><br />
    £<?php echo $row['price']; ?><br />
    <a href="product.php?id=<?php echo $row['id']; ?>">view details</a>
</li>
<?php } ?>
</ul>

<?php require '_inc/footer.php' ?>
</body>

</html>
