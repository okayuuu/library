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
<form method="post" action="book_stockedit_multiplecheck.php">
<input type="submit" name="status" value="まとめて借りる"><input type="submit" name="status" value="まとめて返す">
<table border="1">
<tr>
  <td>タイトル</td>
  <td>在庫</td>
  <td>まとめて借りる</td>
  <td>まとめて返す</td>
</tr>
<?php
//レコードを１行ずつ取り出して画面出力
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
  ?>
<tr>
  <td><?=$row['name']?></td>
  <td>
  <?php if ($row['stock'] != 0): ?>
  <a href="book_data.php?code=<?=$row['code']?>">在庫あり</a>
  <?php else: ?>
  <a href="book_data.php?code=<?=$row['code']?>">貸出中</a>
  <?php endif; ?></td>
  <td>
  <?php if ($row['stock'] != 0): ?>
  <input type="checkbox" name="code[]" value="<?=$row['code']?>"></inpu>
  <?php else: ?>
  <?php endif; ?></td>
  <td>
  <?php if ($row['stock'] != 0): ?>
  <?php else: ?>
  <input type="checkbox" name="code[]" value="<?=$row['code']?>"></inpu>
  <?php endif; ?>
  </td>
</tr>
<?php }
?>
</table>
</form>
<br>
<?=$link1?>
<?=$link2?>
<?=$errmsg?>

</body>
</html>
