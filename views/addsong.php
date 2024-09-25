<?php 
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    if (!isset($_SESSION['username'])){
        header("Location: index.php");
    }
echo $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<body>

<form action="/upload/proces" method="post" enctype="multipart/form-data">
  Select file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload File" name="submit">
</form>

</body>
</html>
