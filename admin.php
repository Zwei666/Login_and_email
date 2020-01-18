<?
session_start();
if ($_POST['login'] || $_POST['password']) {
    header("Location:login.php");
    die();
}
$connection = new PDO('mysql:host = localhost , dbname=comments;charset=utf8', 'rafael', 'vfvtljd');
$data = $connection->query('SELECT * FROM comments.comments WHERE moderation="new" ORDER by data DESC');


?>



<h1>Админка</h1>
<form method="post">
    <?foreach ($data as $comment) {?>
        <select name="<?=$comment['id']?>" id="<?=$comment['id']?>">
            <option value="ok">OK</option>
            <option value="rejected">Отклонить</option>
        </select>
        <label for="lorem"><?=$comment ['username'].'Оставил коментарий'.' '. $comment['comment'].'<br>'?></label>
    <?}?>
    <button>Модерировать </button>
</form>

<form method="post">
    <input type="submit" name="unlogin" required value="Выйти из админки">
</form>


<?
echo "<pre>";
var_dump($_POST);
echo "<pre>";
foreach ($_POST as $num=>$checked ) {
    if ($checked = "ok") {
        $connection->query("UPDATE comments.comments SET moderation='ok' WHERE id=$num");
    } else {
        $connection->query("UPDATE comments.comments SET moderation='rejected' WHERE id=$num");

    }
}


?>