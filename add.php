<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <a href="./">Home</a><br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST["user_name"]);
        $st = strpos($name, '/', 25);
        $en = strpos($name, '/', 32);
        $str = substr($name, $st + 1, $en - ($st + 1));
        $a = ucwords($str, '-');
        $str =  str_replace('-', '', $a) . "TH";

        $linkMeta = "https://archive.org/metadata/" .   $str;
        $content = @file_get_contents("https://archive.org/metadata/" . $str);
        $result  = json_decode($content);
        $dem = 1;
        if (isset($result->files)) {
            $file = 'text1.txt';
            // Open the file to get existing content
            $current = file_get_contents($file);
            if (strpos($current, $name) == false) {
                file_put_contents($file, $current . $name . "\n");
            }


    ?>
            <?= $str ?><br>
            <?php
            $resultt = $result->files;
            foreach ($resultt as $resource) {
                if ($resource->format == "VBR MP3") {

                    $link = "https://archive.org/download/" . $str . "/" . $resource->name;
            ?>
                    <a href="<?= $link ?>"><?= $dem ?></a>

    <?php
                    $dem++;
                }
            }
        }
    }
    $myfile = fopen("text1.txt", "r") or die("Unable to open file!");
    echo "<br>history<br>";
    while (!feof($myfile)) {
        echo fgets($myfile) . "<br>";
    }
    fclose($myfile);
    ?>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="user_name"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>