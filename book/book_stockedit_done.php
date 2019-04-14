<?php
try {
  require_once('../../common/common.php');
  $post = sanitize($_POST);

  var_dump($post['code']);

  require_once('../../common/pass.php');
  $dbpass = dbpass();

  $msg = "";
  $link1 = "";
  $link2 = "";

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
  foreach ($post['code'] as $key => $value) {
    $sql = 'UPDATE book_list SET stock=? WHERE code=?';
    $stmt = $dbh -> prepare($sql);
    $data[0] = $status;
    $data[1] = $value;
    $stmt -> execute($data);
  }
  $dbh = null;

  $msg = $post['status']."完了です。";

  //ログイン実装後に出し分け
  $link1 = '<a href="book_kanri.php">書籍管理へ</a>'."<br>\n";
  $link2 = '<a href="../top.php">トップメニューへ</a>'."<br>\n";
} catch (\Exception $e) {
  $msg = "エラー";
  echo $e;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>書籍貸出管理</title>
</head>
<body>
<br>
<?=$msg?>
<br>
<?=$link1?>
<?=$link2?>
</body>
</html>
