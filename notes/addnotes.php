<?php
include "../connect.php";

try {
    $noteTitle = fillterRequest('noteTitle');
    $noteContent = fillterRequest('noteContent');
    $noteUser = fillterRequest('noteUser');
    $noteImage = imageUpload("file");
    if ($noteImage != "Error uploading file") {
        $stmt = $con->prepare("INSERT INTO `notestb` (`noteTitle`, `noteContent`,`noteUser`,`noteImage`) VALUES (?,?,?,?)");
        $stmt->execute(array($noteTitle, $noteContent, $noteUser,$noteImage));
        $count = $stmt->rowCount();
        //for get the data from table

        if ($count > 0)
            echo json_encode(array("status" => true));
        else
            echo json_encode(array("status" => false));
    } else   echo json_encode(array("status" => false));
} catch (PDOException $e) {
    echo json_encode(array("status" => false, "message" => "Error: " . $e->getMessage()));
}
