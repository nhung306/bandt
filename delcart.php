<?php
session_start();
$cart=$_SESSION['cart_items'];
$id=$_GET['ProductID'];
if($id == 0)
{
 unset($_SESSION['cart_items']);
}
else
{
unset($_SESSION['cart_items'][$id]);
}
header("location: shopping_cart.php");
exit();
?>