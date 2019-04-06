<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>書籍貸出管理</title>
</head>
<body>
<?php
try {
  //エスケープ処理
  require_once('../../common/common.php');
  $post = sanitize($_POST);

  $book_title = $post['title'];  //本のタイトル
  $book_description = $post['description'];  //本の説明

  //データベース接続
  $dsn = 'mysql:dbname=library;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';
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

  echo "登録しました。<br>\n<br>\n";
  echo '<a href="book_add.php">書籍登録</a>';
  echo "<br>\n";
  echo '<a href="book_kanri.php">書籍管理</a>';

} catch (\Exception $e) {
  echo "エラーが発生しました";
  echo $e;
  exit();
}


 ?>
</body>
</html>
