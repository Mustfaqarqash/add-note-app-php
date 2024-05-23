<?php
function fillterRequest($requestName)
{
   return htmlspecialchars(strip_tags($_POST[$requestName]));
}

define('MB', 1048576); // 1 MB = 1048576 bytes

function imageUpload($imageRequest)
{
   $msgError = array(); // Initialize the error array

   if (!isset($_FILES[$imageRequest])) {
      $msgError[] = "No file uploaded";
   } else {
      $imageName = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
      $imageTmp = $_FILES[$imageRequest]['tmp_name'];
      $imageSize = $_FILES[$imageRequest]['size'];
      $allowExt = array("jpg", "png", "gif", "mp3", "pdf");

      $stringToArr = explode(".", $imageName);
      $ext = end($stringToArr);
      $ext = strtolower($ext);

      // Check if file extension is allowed
      if (!empty($imageName) && !in_array($ext, $allowExt)) {
         $msgError[] = "Invalid file extension";
      }

      // Check file size
      if ($imageSize > 2 * MB) {
         $msgError[] = "The file should be less than 2 MB";
      }

      // If there are no errors, move the file
      if (empty($msgError)) {
         $uploadDir = "../upload/";
         if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
         }
         $destination = $uploadDir . $imageName;
         if (move_uploaded_file($imageTmp, $destination)) {
            echo "File uploaded successfully";
            return $imageName;
         } else {
            return "Error uploading file";
         }
      }
   }

   // Display errors if any
   if (!empty($msgError)) {
      echo "<pre>";
      print_r($msgError);
      echo "</pre>";
   }
}
function deleteFile($path, $fileName)
{
   if (file_exists($path . "/" . $fileName)) {
      unlink($path . "/" . $fileName);
   }
}

function checkAuthenticate()
{
   if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {

      if ($_SERVER['PHP_AUTH_USER'] != "mustafa" ||  $_SERVER['PHP_AUTH_PW'] != "Mostfa7**") {
         header('WWW-Authenticate: Basic realm="My Realm"');
         header('HTTP/1.0 401 Unauthorized');
         echo 'Page Not Found';
         exit;
      }
   } else {
      exit;
   }
}
