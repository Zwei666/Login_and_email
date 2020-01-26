<?
session_start();


    $connection = new PDO('mysql:host = localhost , dbname=comments;charset=utf8', 'rafael', 'vfvtljd');
    if ($_POST['login']) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $data = $connection->query("SELECT * FROM comments.admin WHERE  login = '$login' AND password ='$password' ");
        $user = $data->fetch(PDO::FETCH_ASSOC);
        if (count($user) == 0) {
            echo "Такой пользователь не найден";
            exit();
        } else {
            if ($_POST['login'] == $user ['login'] && $_POST['password'] == $user['password']) {
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];
                header("Location:admin.php");
            }
        }
    }
?>

<h2>Вход в админку</h2>

<form method="POST">
    <input type="text" name="login" placeholder="Логин" required>
    <input type="text" name="password" placeholder="Пароль" required>
    <button>Отправить</button>

</form>
