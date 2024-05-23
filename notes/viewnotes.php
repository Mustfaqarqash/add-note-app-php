<?php
include "../connect.php";
// Sanitize input parameters
$noteUser = fillterRequest('noteUser');
try {
    // Prepare the SQL query
    $stmt = $con->prepare("SELECT `noteId`, `noteTitle`, `noteContent`, `noteImage`,`noteUser` FROM `notestb` 
                           WHERE `noteUser` = ? ");
    
    // Bind parameters
    $stmt->bindParam(1, $noteUser);
  

    // Execute the query
    $stmt->execute();

     //for get the data from table
    $data= $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get row count
    $count = $stmt->rowCount();


    // Prepare response
    $response = array("status" => ($count > 0 ? true : false) ,"data"=> $data);

   
    
    // Return JSON response
    echo json_encode($response);
} catch(PDOException $e) {
    // Handle database errors
    echo json_encode(array("error" => $e->getMessage()));
}
?>
