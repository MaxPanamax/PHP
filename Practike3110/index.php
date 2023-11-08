<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("./header.php")
        ?>
    <title>Document</title>
</head>

<body>
    <?php
    define("BR", "<br/>");
    $a = 5;

    function MyFunc()
    {
        global $a;
        $b = 2;
        $a = 6;
        echo "Привет!!" . $a . BR;
        foreach ($GLOBALS as $k => $v) {
            echo $k . " " . $v . BR;
        }
    }

    $NameFunc = "MyFunc";
    $NameFunc();


    function MyFunc01()
    {
        echo "11111" . BR;
        function MyFunc02()
        {
            echo "22222" . BR;
        }
    }

    MyFunc01();
    /*========================================================*/
    function MyFunc011(&$b)
    {
        echo ++$b . BR;
    }

    MyFunc011($a);
    /*========================================================*/
    function MyFunc0111(...$b)
    {
        echo count($b) . BR;
        echo var_dump($b);
    }
    MyFunc0111($a, 2, 5, 2, 5);
    /*========================================================*/

    echo BR;
    function MyFunc01111($text, $visible = true)
    {
        if ($visible) {
            echo $text . BR;
        } else {
            echo "Фиг тебе!!" . BR;
        }
        return "Aга";
    }

    echo "Пока!!" . MyFunc01111("Тест", false) . $a . BR;

    ?>
</body>

</html>