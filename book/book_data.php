<?php
try {
  require_once('../../common/pass.php');
  $dbpass = dbpass();

  $errmsg = "";

  //データベースへ接続
  $dsn = 'mysql:dbname=library;host=localhost;charset=utf8';
  $user = $dbpass['user'];
  $password = $dbpass['pass'];
  $dbh = new PDO($dsn,$user,$password);
  $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //IDを元に書籍データを取得
  $sql = 'SELECT name,description,image,stock FROM book_list WHERE code=?';
  $stmt = $dbh -> prepare($sql);
  $data[] = $_GET['code'];
  $stmt -> execute($data);
  $dbh = null;

  $row = $stmt -> fetch(PDO::FETCH_ASSOC);

  if ($row['stock'] == 1) {
    $msg = "借りる";
  }else {
    $msg = "返す";
  }

  //ログイン実装後に出し分け
  $link1 = '<a href="book_kanri.php">書籍管理へ</a>'."<br>\n";
  $link2 = '<a href="../top.php">トップメニューへ</a>'."<br>\n";
} catch (\Exception $e) {
  $errmsg = "エラー";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>書籍貸出管理</title>
</head>
<body>
書籍詳細<br><br>
<?=$row['name']?><br>
<?=$row['description']?><br>
<form method="post" action="book_stockedit_check.php">
<input type="hidden" name="code" value="<?=$_GET['code']?>">
<input type="hidden" name="name" value="<?=$row['name']?>">
<input type="submit" name="status" value="<?=$msg?>">
</form>
<br>
<?=$link1?>
<?=$link2?>
<?=$errmsg?>
</body>
</html>
