<?php

require '../_inc/db.php';

session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Basket</title>
<?php require '../style/style.css' ?>
</head>
<body>
<?php require '../_inc/header.php' ?>

<h2>Basket</h2>
<?php

$db = db_connect();
$res = $db->query("SELECT * FROM postcards");
?>
<table border="1">
    <thead>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Gross</th>
    </thead>
    <tbody>
<?php

$total_value = 0;
$total_qt = 0;

while($row = $res->fetchArray()) {
    foreach ($_SESSION['basket'] as $key => $qt) {
        if ($key === $row['id']) {
            $total_qt += $qt;
            $total_value += ($qt * $row['price']);
?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td style="text-align: right;">£<?php echo $row['price']; ?></td>
            <td style="text-align: right;"><?php echo $qt; ?></td>
            <td style="text-align: right;">£<?php echo $qt * $row['price']; ?></td>
            <td><a href="./remove.php?id=<?php echo $row['id']; ?>">remove product</a></td>
        </tr>
<?php
        }
    }
}

?>
        <tr>
            <th colspan="2">Total:</th>
            <td style="text-align: right"><?php echo $total_qt; ?></td>
            <td style="text-align: right">£<?php echo $total_value; ?></td>
        </tr>
    </tbody>
</table>
<?php if ($total_qt<=0) { ?>
<p>Your basket is empty.</p>
<?php } ?>
<p><a href="../index.php">Return to store</a><?php if ($total_qt>0) { ?> or <a href="./checkout.php">continue to checkout</a><?php } ?>.</p>
<?php require '../_inc/footer.php' ?>
</body>

</html>
