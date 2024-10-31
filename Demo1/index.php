<?php
require_once 'Class/Flower.php';
require_once 'Class/Rose.php';
require_once 'Class/Lily.php';
require_once 'Class/Cart.php';
require_once 'Traits/DiscountTrait.php';

$rose = new Rose('Rose', 15000, 10);
$lily = new Lily('Lily', 20000, 5);

$cart = new Cart();
$cart->addFlower($rose);
$cart->addFlower($lily);

// Output JSON
header('Content-Type: application/json');
echo json_encode($cart->getCartDetails());
