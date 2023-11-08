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
    define("BR", "<br/>");

    class My
    {
        public $var1 = 5;
        public $var2 = 2;


        public function varPub()
        {
            echo "ssssssss";
        }

        public function ClassPrint()
        {
            echo $this->var1 . "" . $this->var2 . "" . BR;
        }
    }

    $nameclass = "ClassPrint";

    $my01 = new My();
    $my02 = $my01;
    $my03 = &$my01;
    $my01->var1=10;





    var_dump($my01); echo BR;
    var_dump($my02); echo BR;
    var_dump($my03); echo BR;

    ?>
</body>

</html>