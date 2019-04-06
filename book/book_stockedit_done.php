<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>書籍貸出管理</title>
</head>
<body>
<?php

try {

  require_once('../../common/common.php');
  $post = sanitize($_POST);

  require_once('../../common/pass.php');
  $dbpass = dbpass();

  if ($post['status'] == "貸出") {
    $status = 0;
  }elseif ($post['status'] == "返却") {
    $status = 1;
  }

  //データベースへ接続
  $dsn = 'mysql:dbname=library;host=localhost;charset=utf8';
  $user = $dbpass['user'];
  $password = $dbpass['pass'];
  $dbh = new PDO($dsn,$user,$password);
  $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //在庫数を変更する
  $sql = 'UPDATE book_list SET stock=? WHERE code=?';
  $stmt = $dbh -> prepare($sql);
  $data[] = $status;
  $data[] = $post['code'];
  $stmt -> execute($data);
  $dbh = null;


  echo $post['status']."完了です。";

  //ログイン実装後に出し分け
  echo "<br>\n";
  echo '<a href="book_kanri.php">書籍管理へ</a>';
  echo "<br>\n";
  echo '<a href="../top.php">トップメニューへ</a>';
} catch (\Exception $e) {
  echo "エラー";
  //echo $e;
}

 ?>

</body>
</html>
