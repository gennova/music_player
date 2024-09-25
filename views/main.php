<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'controllers/FileController.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: /login");
}

require("views/header.php");



$fileController = new FileController();
$files=$fileController->getMp3Files();
$search=$fileController->search();



$totalMp3Files = count($files);

echo "<p>Total MP3: " . $totalMp3Files . " Songs</p>";

?>
</header>


<main>
  <div class="simple-audio-player" id="simp" data-config={"shide_top":false,"shide_btm":false,"auto_load":false}>
    <div class="simp-playlist">

      <div>
      
        <input type="text" name="search" id="search-input" placeholder="Type to search..." >
      
      

        <div>
         
        <div id="search-results">
         <ul>
           
            <?php 
            foreach ($files as $file){
              $pathInfo = pathinfo($file);
              echo '<li><span class="simp-source" data-src="' . $file . '">' . $pathInfo['filename'] . '</span></li>';
            }
            
            ?>
         </ul>
         </div>
          
        </div>
        <div class="simp-footer">Made with 💖 &amp; 🙌 by <a href="h#" target="_blank" title="">Broo Anjaayyy lahh</a>
        </div>
      </div>
</main>

<?php

  // require("view/footer.php")

  ?>
  <footer class="credit">Distributed By: <a title="Awesome web design code & scripts" href="#" target="_blank">Umpu
    Kakah</a></footer>
<script src="./js/script.js"></script>
</body>

</html>