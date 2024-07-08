<?php
require_once './header.php';

if(isset($_GET["action"])){
    $action = $_GET["action"];
    if (!defined('BASE_URL')) {
        define('BASE_URL', '../');
    }
    
    switch($action){
        case 'search-product':
            if(isset($_GET['keyword'])){
                liveSearch($_GET['keyword']);
            }
            break;
        default:
            break;
    }
}

function liveSearch($keyword)
{
    require_once '../database/dbhelper.php';
    
    $paramSearch = "%" . $keyword . "%";
    $sqlSearch =  "SELECT * FROM product WHERE item_name LIKE ?";
    
    $data = executeGetDataBindParam($sqlSearch, "s", [$paramSearch]);
    
    echo json_encode($data);
}
?>
