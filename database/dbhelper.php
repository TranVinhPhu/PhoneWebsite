<?php
function executeGetDataBindParam($sql, $dataType, $param){

    include_once "../database/connect.php";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param($dataType, ...$param);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];

    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }

    $stmt->close();
    $con->close();
    return $data;
}
