<?php
class CartService {
    
    public static function listCarts() {
        $db = ConnectionFactory::getDB();
        $items = array();
        
        foreach($db->items() as $item) {
           $items[] = array (
               'id' => $item['id'],
               'description' => $item['description'],
               'qty' => $item['qty'],
               'price' => $item['price']
           ); 
        }
        return $items;
    }
    
    public static function getById($id) {
        $db = ConnectionFactory::getDB();
        return $db->items[$id];
    }
    
    public static function add($newItem) {
        $db = ConnectionFactory::getDB();
        $item = $db->items->insert($newItem);
        return $item;
    }
  
    
    public static function delete($id) {
        $db = ConnectionFactory::getDB();
        $item = $db->items[$id];
        if($item) {
            $item->delete();
            return true;
        }
        return false;
    }
}
?>