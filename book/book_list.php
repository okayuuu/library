<?php
try {
  $errmsg ="";
  require_once('../../common/pass.php');
  $dbpass = dbpass();

  $errmsg = "";
  $link1 = "";
  $link2 = "";

  //データベースへ接続
  $dsn = 'mysql:dbname=library;host=localhost;charset=utf8';
  $user = $dbpass['user'];
  $password = $dbpass['pass'];
  $dbh = new PDO($dsn,$user,$password);
  $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //レコードを全て取得
  $sql = 'SELECT code,name,stock FROM book_list WHERE 1';
  $stmt = $dbh -> prepare($sql);
  $stmt -> execute();
  $dbh = null;

  //ログイン実装後に出し分け
  $link1 = '<a href="book_kanri.php">書籍管理へ</a>'."<br>\n";
  $link2 = '<a href="../top.php">トップメニューへ</a>'."<br>\n";
} catch (\Exception $e) {
  $errmsg = "エラー";
  //echo $e;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>書籍貸出管理</title>
</head>
<body>
貸出可能書籍一覧<br><br>
<?php
//レコードを１行ずつ取り出して画面出力
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
  echo $row['code']."  ";
  echo $row['name']."  ";
  if ($row['stock'] != 0) {
    $msg = "在庫あり";
  } else {
    $msg = "貸出中";
  }
  echo '<a href="book_data.php?code='.$row['code'].'">'.$msg.'</a>'."<br>\n";
}
 ?>
<br>
<?=$link1?>
<?=$link2?>
<?=$errmsg?>

</body>
</html>
