<?php
include "../connect.php";
// Sanitize input parameters
$userName = fillterRequest('userName');
$userPass = fillterRequest('userPass');

try {
    // Prepare the SQL query
    $stmt = $con->prepare("SELECT `userId`, `userName`, `userEmail`, `userPass` FROM `userstb` 
                           WHERE `userName` = ?  AND `userPass` = ?");
    
    // Bind parameters
    $stmt->bindParam(1, $userName);
    $stmt->bindParam(2, $userPass);

    // Execute the query
    $stmt->execute();

     //for get the data from table
     $data= $stmt->fetch(PDO::FETCH_ASSOC);

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
