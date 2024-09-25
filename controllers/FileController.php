<?php
class FileController
{
    private $dirPath = './tmp';

    public function scanDirectoryRecursively($dirPath = null)
    {
        if ($dirPath === null) {
            $dirPath = $this->dirPath;  // Use default directory if not passed
        }

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

    public function getMp3Files()
    {
        // Get the MP3 and WAV files
        $mp3Files = $this->scanDirectoryRecursively();

        // echo json_encode($json);
        // Pass the data to the view
        // Include the view and pass the $mp3Files data

        //   Return the JSON encoded data
        return $mp3Files;
    }

    public function search()
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];

            $mp3Files = $this->scanDirectoryRecursively();
            echo '<ul>';
            foreach ($mp3Files as $file) {
                $pathInfo = pathinfo($file);
                if (stripos($pathInfo['filename'], $search) !== false) {
                    echo '<li><span class="simp-source" data-src="' . $file . '">' . $pathInfo['filename'] . '</span></li>';
                }
            }
            echo '</ul>';

            // echo "You entered: " . htmlspecialchars($mp3Files);

            // return $mp3Files;
        }
        // else{
        //     return $this->getMp3Files();
        // }
    }

    public function upload()
    {
        $target_dir = 'tmp/';
        $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
        $uploadOk = 1;

        // Check if file already exists
        if (file_exists($target_file)) {
            echo 'Sorry, file already exists.';
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['fileToUpload']['size'] > 20971520) {
            echo 'Sorry, your file is too large.';
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo 'Sorry, your file was not uploaded.';
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                echo 'The file ' . htmlspecialchars(basename($_FILES['fileToUpload']['name'])) . ' has been uploaded.';
            } else {
                echo 'Sorry, there was an error uploading your file.';
            }
        }
    }
};
?>
