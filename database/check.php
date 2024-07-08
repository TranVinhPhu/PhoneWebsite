<?php
    if(isset($_GET["action"])){
        $action = $_GET["action"];
        define('BASE_URL', '../');
        switch($action){
            case 'search-product':
                $keyword = $_GET['keyword'];
                liveSearch($keyword);
                break;
        }
    }
    function liveSearch($keyword)
    {
        include_once '../database/dbhelper.php';
        $paramSearch = "%" . $keyword . "%";
        $sqlSearch =  "SELECT * FROM product
                        WHERE product.item_name LIKE ?";
        $data = executeGetDataBindParam($sqlSearch,"s",[$paramSearch]);
        echo json_encode($data);
    }
?>