<?php
ob_start();
class Cart
{
    public $db = null;
    public $product = null;

    public function __construct(DBController $db, Product $product)
    {
        if (!isset($db->con) || !isset($product)) return null;
        $this->db = $db;
        $this->product = $product;
    }

    public  function insertIntoCart($params = null, $table = "cart"){
        if ($this->db->con != null){
            if ($params != null){
                // "Insert into cart(user_id) values (0)"
                $columns = implode(',', array_keys($params));

                $values = implode(',' , array_values($params));

                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    public  function addToCart($userid, $itemid){
        if (isset($userid) && isset($itemid)){
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
            );

            $result = $this->insertIntoCart($params);
            if ($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
        }
    }

    public function deleteCart($item_id = null, $table = 'cart'){
        if($item_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    public function deleteWishlist($item_id = null, $table = 'wishlist'){
        if($item_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $item){
                $sum += floatval(str_replace(',', '', $item[0]));
            }
            return number_format($sum, 0, '.', '.');
        }
    }

    public function getCartId($cartArray = null, $key = "item_id"){
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    public function saveForLater($item_id = null, $saveTable = "wishlist", $fromTable = "cart"){
        if ($item_id != null){
            $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id={$item_id};";
            $query .= "DELETE FROM {$fromTable} WHERE item_id={$item_id};";

            $result = $this->db->con->multi_query($query);

            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }
    public  function addToCartID($userid, $itemid){
        if (isset($userid) && isset($itemid)){
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
            );

            $result = $this->insertIntoCart($params);
            if ($result){
                header("Location: product.php?item_id=$itemid");
            }
        }
    }
    public  function addToCartIDBuyNow($userid, $itemid){
        if (isset($userid) && isset($itemid)){
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
            );

            $result = $this->insertIntoCart($params);
            if ($result){
                header("Location: cart.php");
            }
        }
    }

    public function insertIntoBill($params = null, $table = "bill") {
        if ($this->db->con != null && $params != null) {
            $columns = implode(',', array_keys($params));
            $values = implode(',', array_fill(0, count($params), '?'));
    
            $query_string = "INSERT INTO $table ($columns) VALUES ($values)";
            $stmt = $this->db->con->prepare($query_string);
    
            $types = '';
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } else {
                    $types .= 's';
                }
            }
    
            $bindParams = array_merge([$types], array_values($params));
            
            $stmt->bind_param(...$bindParams);
    
            $result = $stmt->execute();
    
            $stmt->close();
    
            return $result;
        }
    }
    
    public function insertIntoBillDes($params = null, $table = "billdes") {
        if ($this->db->con != null && $params != null) {
            $columns = implode(',', array_keys($params));
            $values = implode(',', array_fill(0, count($params), '?'));
    
            $query_string = "INSERT INTO $table ($columns) VALUES ($values)";
            $stmt = $this->db->con->prepare($query_string);
    
            $types = '';
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } else {
                    $types .= 's';
                }
            }
            $bindParams = array_merge([$types], array_values($params));
            
            $stmt->bind_param(...$bindParams);
    
            $result = $stmt->execute();
    
            $stmt->close();
    
            return $result;
        }
    }

    public function insertIntoPay($params = null, $table = "pay") {
        if ($this->db->con != null && $params != null) {
            $columns = implode(',', array_keys($params));
            $values = implode(',', array_fill(0, count($params), '?'));
    
            $query_string = "INSERT INTO $table ($columns) VALUES ($values)";
            $stmt = $this->db->con->prepare($query_string);
    
            $types = '';
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } else {
                    $types .= 's';
                }
            }
            $bindParams = array_merge([$types], array_values($params));
            
            $stmt->bind_param(...$bindParams);
    
            $result = $stmt->execute();
    
            $stmt->close();
    
            return $result;
        }
    }
    
    public function clearCart($user_id, $table = 'cart') {
        if ($user_id != null) {
            $result = $this->db->con->query("DELETE FROM {$table} WHERE user_id={$user_id}");
            return $result;
        }
        return false;
    }    

    public function createBill($userid, $total) {
        $bill_register = date('Y-m-d H:i:s');

        $billParams = array(
            "user_id" => $userid,
            "bill_register" => $bill_register,
            "bill_total" => $total
        );

        $billResult = $this->insertIntoBill($billParams);

        if ($billResult) {
            $billId = $this->db->con->insert_id;

            foreach ($_POST['quantity'] as $item_id => $quantity) {
                $product_info = $this->product->getProduct($item_id);

                if ($product_info && $quantity > 0) {
                    $billdesParams = array(
                        "bill_id" => $billId,
                        "item_id" => $item_id,
                        "quantity" => $quantity,
                        "price" => $product_info[0]['item_price']
                    );
                    $this->insertIntoBillDes($billdesParams);
                }
            }
            $pay_date = date('Y-m-d H:i:s');

            $payParams = array(
                "bill_id" => $billId,
                "pay_date" => $pay_date,
                "total" => $total,
                "paystatus" => "Not Paid"
            );
    
            $this->insertIntoPay($payParams);

            $this->clearCart($userid);

            return true;
        }

        return false;
    }
}