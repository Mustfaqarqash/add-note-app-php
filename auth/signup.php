<?php
include "../connect.php";
$userName = fillterRequest('userName');
$userEmail = fillterRequest('userEmail');
$userPass = fillterRequest('userPass');

$stmt = $con->prepare("INSERT INTO `userstb` (`userName`, `userEmail`, `userPass`) VALUES (?,?,?)");
$stmt->execute(array($userName,$userEmail,$userPass));
$count = $stmt->rowCount();
if ($count > 0)
    echo json_encode(array("status"=>true));
else
echo json_encode(array("status"=>false));
