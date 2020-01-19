<?

$connection = new PDO('mysql:host = localhost , dbname=email; charset=utf8', 'rafael', 'vfvtljd');

function generateRandomString () {
    $char = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    $random = '';
    for ($i=0 ;$i<20;$i++){
        $random .= $char[rand(0, (strlen($char) - 1))];
    }
    return $random;
}
if ($_POST['username']) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $authKey = generateRandomString();
    $query = $connection->query("INSERT INTO email.email (username,email,auth_key) VALUES('$username','$email','$authKey')");

    if ($query) {
        mail($email, 'Подтвердите почту', "Перейдите по ссылке http://email/?auth=$authKey");
        echo "Отправлено письмо";
    } else {
        $findUser = $connection->query("SELECT * FROM email.email WHERE email='$email'");
        $findUser = $findUser->fetch();
        if (!$findUser['validate']) {
            echo "Ваша почта так и не подтвреждена ";
        }else {
            echo "Вы уже подписаны на нашу рассылку";
        }
    }

}

if ($_GET['auth']) {
    $auth = $_GET ['auth'];
    $searh = $connection->query("SELECT * FROM email.email WHERE auth_key='$authKey'");

    if ($searh) {
        $connection->query("UPDATE email.email SET validate=true ,updated_at=current_timestamp WHERE auth_key='$auth'");
        echo "Ваша почта подтверждена";
    }
}
?>


<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,user-scalable=no , initial-scale=1.0 ,maximum-scale=1.0,minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Document</title>
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
<form action="" method="post">
    <input type="text" name="username" required >
    <input type="email" name="email" required>
    <input type="submit">
</form>
</body>
</html>