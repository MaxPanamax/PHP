<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    define("BR","<br/>");
    $filename = "./data/data.dat";
    if (file_exists($filename)) {
        $filecontent=file_get_contents($filename);
        $arrayStringsByFile=explode("\n", $filecontent);
        foreach ($arrayStringsByFile as $v) {
            echo $v.BR;
        }
    }

    file_put_contents($filename,$filecontent." 7777");

    
    ?>
</body>
</html>