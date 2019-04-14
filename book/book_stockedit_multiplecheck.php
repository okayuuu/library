<?php
$msg = "";

try {
  //DB接続用パスを記載したファイルを読み込み
  require_once('../../common/pass.php');
  $dbpass = dbpass();

  //DB接続
  $dsn = 'mysql:dbname=library;host=localhost;charset=utf8';
  $user = $dbpass['user'];
  $password = $dbpass['pass'];
  $dbh = new PDO($dsn,$user,$password);
  $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //codeから名前を取得
  foreach ($_POST['code'] as $key => $value) {
    $sql = 'SELECT name FROM book_list WHERE code=?';
    $stmt = $dbh -> prepare($sql);
    $data[0] = $value;
    $stmt -> execute($data);
    $row = $stmt -> fetch(PDO::FETCH_ASSOC);

    $book_title[] = $row['name'];
    $book_code[] = $value;
  }
  $dbh = null;

} catch (\Exception $e) {
  $msg = "エラー";
}

$max = count($_POST['code']);

if ($_POST['status'] == "まとめて借りる") {
  $msg = "貸出";
}elseif ($_POST['status'] == "まとめて返す") {
  $msg = "返却";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>書籍貸出管理</title>
</head>
<body>
<?=$msg?>書籍は下記<?=$max?>冊でよろしいでしょうか？
<br><br>
<form method="post" action="book_stockedit_done.php">
<?php for ($i=0; $i<$max ; $i++) : ?>
<?=$book_title[$i]?>
<input type="hidden" name="code[]" value="<?=$book_code[$i]?>">
<br>
<?php endfor; ?>
<input type="hidden" name="status" value="<?=$msg?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="<?=$_POST['status']?>">
</form>
</body>
</html>
