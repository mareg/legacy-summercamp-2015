<?php

require '../_inc/db.php';
require '../_inc/container.php';

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

$basketViewData = array_merge(
    $container->get('acme.basket.view')->toView($_SESSION['basket']),
    ['editable' => true]
);

$basketView = $container->get('twig.renderer')->render(
    'basket.twig.html',
    $basketViewData
);

echo $basketView;

?>
<p><a href="../index.php">Return to store</a><?php if ($basketViewData['items_count']>0) { ?> or <a href="./checkout.php">continue to checkout</a><?php } ?>.</p>
<?php require '../_inc/footer.php' ?>
</body>

</html>
