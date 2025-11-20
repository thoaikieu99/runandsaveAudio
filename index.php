<html>
    <head>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <a href="./add.php">add audio</a><br>
        <?php 
        
        $dir = './audio/'; // Replace with the actual path to your folder
        try {
            $iterator = new DirectoryIterator($dir);

            foreach ($iterator as $fileinfo) {
                if ($fileinfo->isFile()) {
                    $filePath = $fileinfo->getPathname();
                    $st = strpos($filePath, "\\", 5);
                    $str = substr($filePath, $st + 1);                    
                    echo '<a href="./playaudio.php?name='.$str.'">'.$str.'</a> ' ."<br>";

                }
            }
        } catch (UnexpectedValueException $e) {
            echo "Error: " . $e->getMessage();
        }
?>
    </body>
</html>