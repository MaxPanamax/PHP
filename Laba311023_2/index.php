<?php
require_once("./function/funcs.php");
$errmassage="";


if (isset($_GET))
    $pageContent = array_key_first($_GET);
if (!isset($pageContent))
    $pageContent="MyFirstPost";



    if (CurrentUser()==FALSE)  {
        if($pageContent!="Authorization" && $pageContent != "Registration"){
            header("Location:./index.php?Authorization");
        }
    }
if (count($_POST) && $pageContent == "Registration" ) {
    $login = $_POST["login"];
    $pass = $_POST["password"];
    $errmassage=RegisterUser($login,$pass);
    if ($errmassage===true) {
        header("Location:./index.php?MyFirstPost");
    }
}

if (count($_POST) && $pageContent == "Authorization" ) {
    $login = $_POST["login"];
    $pass = $_POST["password"];
    $errmassage=VerifyUser($login,$pass);
    if ($errmassage===true) {
        header("Location:./index.php?MyFirstPost");
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <link rel="stylesheet" href="./css/layout.css" type="text/css">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <div id="main">
            <?php require_once("./include/navigation.php"); ?>
            <div class="content">
                <?php
                include("./content/" . $pageContent . ".php");
                ?>
            </div>
        </div>
        <?php require_once("./include/footer.php"); ?>
    </div>
</body>

</html>