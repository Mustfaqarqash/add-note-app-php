<?php
include "../connect.php";

try {
    $noteTitle = fillterRequest('noteTitle');
    $noteContent = fillterRequest('noteContent');
    $noteImage = fillterRequest('noteImage');
    $noteId = fillterRequest('noteId');

    // Check if a file is uploaded
    if (isset($_FILES['file'])) {
        // Upload the file
        $imageName = imageUpload("file");
        
        // If upload successful, delete the old image
        if ($imageName !== "Error uploading file") {
            deleteFile("../upload", $noteImage);
            $noteImage = $imageName;
        }
    }
    
    $stmt = $con->prepare("UPDATE `notestb` SET `noteContent` = ?, `noteTitle` = ?, `noteImage` = ?  WHERE `noteId` = ?");
    $stmt->execute(array($noteContent, $noteTitle, $noteImage, $noteId));
    $count = $stmt->rowCount();

    if ($count > 0) {
        echo json_encode(array("status" => true));
    } else {
        echo json_encode(array("status" => false, "message" => "No rows updated"));
    }
} catch (PDOException $e) {
    echo json_encode(array("status" => false, "message" => "Error updating note: " . $e->getMessage()));
}
?>
