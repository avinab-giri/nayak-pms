<?php 

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include (SERVER_INCLUDE_PATH.'add_to_room.php');

$postData = file_get_contents('php://input');

$jsonData = json_decode($postData, true);

$tableName = $jsonData['table'];
$data = $jsonData['data'];
$elementId = $jsonData['elementId'];

if($elementId != ''){
    $setClauses = [];
    foreach ($data as $key => $value) {
        $setClauses[] = "$key = '$value'";
    }
    $setClause = implode(", ", $setClauses);
    $sql = "update $tableName set $setClause where id = '$elementId'";

}else{
    $columns = implode(", ", array_keys($data));
    $values = implode(", ", array_map(function($value) { return "'$value'"; }, $data));
    
    $sql = "insert into $tableName";
    $sql .= "($columns) VALUES ($values)";
}
echo $sql;
mysqli_query($conDB, $sql);

?>