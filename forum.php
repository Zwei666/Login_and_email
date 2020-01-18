<?
$connection = new PDO('mysql:host = localhost , dbname=comments;charset=utf8', 'rafael', 'vfvtljd');
$data = $connection->query("SELECT * FROM comments.comments WHERE moderation='ok' ORDER by data DESC ");


if ($_POST['username']) {
    $username = htmlspecialchars($_POST['username']);
    $text = htmlspecialchars($_POST ['text']);
            $data = date("Y-m-d H:i:s");
    $connection->query("INSERT INTO comments.comments (username,comment,data) VALUE ('$username','$text','$data') ");
    header('Location:forum.php');
}





?>






<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,user-scalable=no , initial-scale=1.0 ,maximum-scale=1.0,minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Форум любителей форумов</title>
</head>
<body>
<style>

    * {
        -webkit-box-sizing:border-box ;
        -moz-box-sizing:border-box ;
        box-sizing: border-box;
    }

    body{
        font-family: 'Arial' ,sans-serif;
    }

    input {
        width: 300px;
        display: block;
        margin: 5px;
    }

</style>
<h1>Форум для любителй Форумов</h1>
<form action="" method="post">
    <input type="text" name="username"required placeholder="Ваше Имя">
    <textarea type="text" name="text"required placeholder="Ваше Сообщение" cols="30" rows="5"></textarea>
    <button>Отправить</button>

</form>
<hr>
<h2>Сообщение пользователей</h2>
<h3>Все соообщения проходят модерацию</h3>
<? if ($data){
    foreach ($data as $comments) {
        ?>
<div>
    <? echo $comments['date'].' '.$comments['$username'].' '.$comments['comment'].'<br>'?>
</div>
<?}}?>
</body>