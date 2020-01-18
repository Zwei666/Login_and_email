<?
session_start();
$connection = new PDO('mysql:host = localhost , dbname=comments;charset=utf8', 'rafael', 'vfvtljd');
$data = $connection->query('SELECT * FROM comments.admin');
if ($_POST['login']) {
    foreach ($data as $info) {
        if ($_POST['login'] == $info ['login'] && $_POST['password'] == $info['password']) {
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
