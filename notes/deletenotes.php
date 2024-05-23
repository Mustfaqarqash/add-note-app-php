<?php
include "../connect.php";

try {

    $noteId = fillterRequest('noteId');
    $imageName = fillterRequest("imageName");


    $stmt = $con->prepare("DELETE FROM `notestb`  WHERE `noteId` = ? ");
    $stmt->execute(array($noteId)); // Changed $notId to $noteId
    $count = $stmt->rowCount();

    if ($count > 0) {
        deleteFile("../upload", $imageName);
        echo json_encode(array("status" => true));
    } else
        echo json_encode(array("status" => false));
} catch (PDOException $e) {
    echo json_encode(array("status" => false, "message" => "Error: " . $e->getMessage()));
}
