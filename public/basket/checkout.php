<?php

require '../_inc/db.php';
require '../_inc/container.php';

session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Checkout</title>
<?php require '../style/style.css' ?>
</head>
<body>
<?php require '../_inc/header.php' ?>
<form action="" method="get">
<h2>Place an order</h2>
<h3>Products</h3>
<p>You are about to order the following products:</p>
<?php

$basketViewData = $container->get('acme.basket.view')->toView($_SESSION['basket']);
$basketView = $container->get('twig.renderer')->render(
    'basket.twig.html',
    $basketViewData
    );

echo $basketView;

?>
<h3>Shipping address</h3>
<p><label>Name:<br /><input type="text" name="addr_name" value="<?php echo $_GET['addr_name']; ?>" /></label></p>
<p><label>Address:<br /><input type="text" name="addr_line_1" value="<?php echo $_GET['addr_line_1']; ?>" /></label><br />
    <input type="text" name="addr_line_2" value="<?php echo $_GET['addr_line_2']; ?>" /></p>
<p><label>City:<br /><input type="text" name="addr_city" value="<?php echo $_GET['addr_city']; ?>" /></label></p>
<p><label>Postcode:<br /><input type="text" name="addr_postcode" value="<?php echo $_GET['addr_postcode']; ?>" /></label></p>

<h3>Payment details</h3>
<p><label>Name on the card:<br /><input type="text" name="pay_name" value="<?php echo $_GET['pay_name']; ?>" /></label></p>
<p><label>Card number:<br /><input type="text" name="pay_card" value="<?php echo $_GET['pay_card']; ?>" /></label></p>
<p><label>Expiry date [MM/YY]:<br /><input type="text" name="pay_expiry" size="5" value="<?php echo $_GET['pay_expiry']; ?>" /></label></p>
<p><label>Security code:<br /><input type="text" name="pay_ccv2" size="5" value="" /></label></p>

<p><label><input type="checkbox" name="t_and_c_accepted"/> Agree to the terms and conditions of sale</label></p>
<p><input type="submit" value="Place an order" /> or <a href="/">return to store</a></p>

</form>
<?php require '../_inc/footer.php' ?>
</body>

</html>
