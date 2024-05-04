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


$setClauses = [];
foreach ($data as $key => $value) {
    $setClauses[] = "$key = '$value'";
}
$setClause = implode(", ", $setClauses);

$sql = "delete from $tableName where $setClause ";
echo $sql;
mysqli_query($conDB, $sql);

?>