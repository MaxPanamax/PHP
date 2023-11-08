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
    $a="cat";
    $cat="dog";
    $dog="rat";
    $rat="pig";
    $pig="a";

    /*echo $a."<br/>";
    echo $$a."<br/>";
    echo $$$a."<br/>";
    echo $$$$a."<br/>";
    echo $$$$$a."<br/>";*/
    echo $$$$$$a."<br/>";

    $a="CAT";?>
    <?php
    if ($a<=5){
        ?>
        "dddd"
        <?php } else{ ?>
            "aaaa"
        <?php };

    define("BR", "<br/>");
    // include_once "header.php"
    // define("helper","1")

    // // if (defined(helper)){

    // // }
    // // echo "111".BR."222";



    echo BR;
    
    if (isset($a)) echo "isset-true".BR; else echo "isset-false".BR;
    if (empty($a)) echo "Empty-true".BR; else echo "Empty-false".BR;
    if (is_null($a)) echo "IsNull-true".BR; else echo "IsNull-false".BR;
    if (is_bool($a)) echo "Isbool-true".BR; else echo "Isbool-false".BR;
    if (is_string($a)) echo "is_string-true".BR; else echo "is_string-false".BR;
    if (is_array($a)) echo "is_array-true".BR; else echo "is_array-false".BR;

    echo BR;
    echo BR;


    foreach ($GLOBALS as $k => $v)
    {
        echo $k." ".$v.BR;
    }

    $ptr_a = & $a;
    unset($a);
    echo $ptr_a.BR;
    
    





    ?>
</body>
</html>