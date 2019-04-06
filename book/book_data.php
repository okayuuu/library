<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>書籍貸出管理</title>
</head>
<body>
<?php

echo "書籍詳細<br>\n<br>\n";

try {

  require_once('../../common/pass.php');
  $dbpass = dbpass();

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
  echo $row['name']."<br>\n";
  echo $row['description']."<br>\n";

  if ($row['stock'] == 1) {
    $msg = "借りる";
  }else {
    $msg = "返す";
  }
  echo '<form method="post" action="book_stockedit_check.php">';
  echo '<input type="hidden" name="code" value="'.$_GET['code'].'">';
  echo '<input type="hidden" name="name" value="'.$row['name'].'">';
  echo '<input type="submit" name="status" value="'.$msg.'">';
  echo '</form>';


  //ログイン実装後に出し分け
  echo "<br>\n";
  echo '<a href="book_kanri.php">書籍管理へ</a>';
  echo "<br>\n";
  echo '<a href="../top.php">トップメニューへ</a>';
} catch (\Exception $e) {
  echo "エラー";
  echo $e;
}

 ?>

</body>
</html>
