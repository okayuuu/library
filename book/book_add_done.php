<?php
try {
  //エスケープ処理
  require_once('../../common/common.php');
  $post = sanitize($_POST);

  require_once('../../common/pass.php');
  $dbpass = dbpass();

  $book_title = $post['title'];  //本のタイトル
  $book_description = $post['description'];  //本の説明
  $msg = "";
  $link1 ="";
  $link2 = "";

  //データベース接続
  $dsn = 'mysql:dbname=library;host=localhost;charset=utf8';
  $user = $dbpass['user'];
  $password = $dbpass['pass'];
  $dbh = new PDO($dsn,$user,$password);
  $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //本テーブルにレコードを追加
  $sql = 'INSERT INTO book_list(stock,name,description) VALUES(?,?,?)';
  $stmt = $dbh -> prepare($sql);
  $data[] = 1;                    //登録時の在庫は必ず１
  $data[] = $book_title;
  $data[] = $book_description;
  $stmt -> execute($data);

  $dbh = null;

  $msg = "登録しました。";
  $link1 = '<a href="book_add.php">書籍登録</a>'."<br>\n";
  $link2 = '<a href="book_kanri.php">書籍管理</a>'."<br>\n";

} catch (\Exception $e) {
  $msg = "エラーが発生しました";
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
<?=$msg?>
<br>
<?=$link1?>
<?=$link2?>
</body>
</html>
