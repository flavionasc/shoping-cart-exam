<?php
class CartService {
    
    public static function listCarts() {
        $db = ConnectionFactory::getDB();
        $carts = array();
        
        foreach($db->carts() as $cart) {
           $carts[] = array (
               'id' => $cart['id'],
               'description' => $cart['description'],
               'qty' => $cart['qty'],
               'price' => $cart['price']
           ); 
        }
        return $carts;
    }
    
    public static function getById($id) {
        $db = ConnectionFactory::getDB();
        return $db->carts[$id];
    }
    
    public static function add($newCart) {
        $db = ConnectionFactory::getDB();
        $cart = $db->carts->insert($newCart);
        return $cart;
    }
  
    
    public static function delete($id) {
        $db = ConnectionFactory::getDB();
        $cart = $db->carts[$id];
        if($cart) {
            $cart->delete();
            return true;
        }
        return false;
    }
}
?>