<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$dirPath = "./tmp";
function scanDirectoryRecursively($dirPath)
{
    $files = scandir($dirPath);
    $mp3Files = [];

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $filePath = $dirPath . '/' . $file;

        if (is_dir($filePath)) {
            $mp3Files = array_merge($mp3Files, scanDirectoryRecursively($filePath));
        } else if (pathinfo($filePath, PATHINFO_EXTENSION) === 'mp3' || pathinfo($filePath, PATHINFO_EXTENSION) === 'wav') {
            $mp3Files[] = $filePath;
        }
    }

    return $mp3Files;
}

$dirPath = "./tmp";
$mp3Files = scanDirectoryRecursively($dirPath);

// Get the total number of MP3 files
$totalMp3Files = count($mp3Files);
echo '<style>
body {
    background-color: #000000; /* Initial background color */
    transition: background-color 2s ease-in-out; /* Transition duration and easing */
}
</style>';
echo '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CodeHim">
    <title>Tendy Playlist</title>

    <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/demo.css">

  </head>
  <body>
 <header class="intro">
 <h1>Music Everywhere</h1>
 <p>Can live without music</p>
 ' ?>
 <?php
    echo "<p>Total MP3: " . $totalMp3Files . " Songs</p>";
    ?>
 <?php
echo '
 </header>

      
 <main>
    <div class="simple-audio-player" id="simp" data-config={"shide_top":false,"shide_btm":false,"auto_load":false}>
    <div class="simp-playlist">
   
    <div>
        
        <input type="text" id="search-input" placeholder="Type to search...">
     
    <div>   
   
    <div id="search-results"></div>
    <ul>
    
       
      ' ?>
      <?php
      if (isset($_GET['query'])) {
       
        $searchQuery = htmlspecialchars($_GET['query']); 
        function readDirectoryRecursively($dirPath)
        {
            $results = [];
            $files = scandir($dirPath);
            

            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue; // Skip current and parent directories
                }
                $filePath = $dirPath . '/' . $file;
                if (is_dir($filePath)) {
                    readDirectoryRecursively($filePath); // Recursively process subdirectories
                } else {
                    // Check if the file has a .mp3 extension
                    if (pathinfo($filePath, PATHINFO_EXTENSION) === 'mp3' || pathinfo($filePath, PATHINFO_EXTENSION) === 'wav') {
                        // Process MP3 files
                       
                            // echo '<li><span class="simp-source" data-src="' . $filePath . '">' . rtrim($file, ".mp3") . '</span></li>';
                            $results[] = "<li><span class='simp-source' data-src='$filePath'>" . rtrim($file, '.mp3') . "</span></li>";
                            
                    }
                }
            }
            return $results;
            
        }
        
        $results = readDirectoryRecursively($dirPath);
        
      
    
        
        // print_r($results);
        $extractedTexts = [];

        // Loop through the array to extract the text
        foreach ($results as $item) {
            // Use preg_match to capture the text between > and </span>
            if (preg_match('/>(.*?)<\/span>/', $item, $matches)) {
                // $extractedTexts[] = trim($matches[1]); // Trim to remove whitespace
                if (stripos($item, $searchQuery) !== false) {
                    echo $item;
                }
            };
        };
        // print_r($extractedTexts);
        // foreach ($results as $key => $description) {
        //     preg_match_all('/<span class="simp-source"[^>]*>(.*?)<\/span>/', $description, $matches);
        //     // $extractedTexts = $matches[1];
        //     // print_r( $matches[1]);  
        //     // if (str_contains($description, $searchQuery) !== false) {
        //     //     echo $description;
        //     // }
        // }
    
        // if (!empty($results)) {

        //     echo $results;
        // } else {
        //     echo 'No results found for "' . $searchQuery . '"';
        // }
    }else{
        function readDirectoryRecursively($dirPath)
        {
            $files = scandir($dirPath);
            

            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue; // Skip current and parent directories
                }
                $filePath = $dirPath . '/' . $file;
                if (is_dir($filePath)) {
                    readDirectoryRecursively($filePath); // Recursively process subdirectories
                } else {
                    // Check if the file has a .mp3 extension
                    if (pathinfo($filePath, PATHINFO_EXTENSION) === 'mp3' || pathinfo($filePath, PATHINFO_EXTENSION) === 'wav') {
                        // Process MP3 files
                        echo '<li><span class="simp-source" data-src="' . $filePath . '">' . rtrim($file, ".mp3") . '</span></li>';
                    }
                }
            }
        }

        readDirectoryRecursively($dirPath);
    }
    ?>
      
      
  
      <?php
     
        

        
        echo '
    </ul>
  </div>
  <div class="simp-footer">Made with 💖 &amp; 🙌 by <a href="h#" target="_blank" title="">Broo Anjaayyy lahh</a></div>
</div>    
     </main>
     <footer class="credit">Distributed By: <a title="Awesome web design code & scripts" href="#" target="_blank">Umpu Kakah</a></footer>
<script  src="./js/script.js"></script>
  </body>
</html>';
        ?>