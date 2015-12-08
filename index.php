<?php
require 'vendor/autoload.php';
require 'database/ConnectionFactory.php';
require 'carts/CartService.php';

$app = new \Slim\Slim();

$app->post('/carts/', function() use ( $app ) {
    $cartJson = $app->request()->getBody();
    $newCart = json_decode($cartJson, true);
    
    if($newCart) {
        $cart = CartService::add($newCart);
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->setStatus(200);
        echo json_encode($cart);
    }
    else {
        $app->response->setStatus(400);
        echo "Malformat JSON";
    }
});

$app->get('/carts/', function() use ( $app ) {
    $carts = CartService::listCarts();
    
    if($carts) {
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->setStatus(200);
        echo json_encode($carts);
    }
    else {
        $app->response()->setStatus(204);
    }
});

$app->delete('/carts/:id', function($id) use ( $app ) {
    if(CartService::delete($id)) {
      echo "Cart with id = $id was deleted";
    }
    else {
      $app->response->setStatus('404');
      echo "Cart with id = $id not found";
    }
});
$app->run();
?>