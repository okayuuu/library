<?php
require_once('../../common/common.php');
$post = sanitize($_POST);

if ($post['status'] == "借りる") {
  $msg = "貸出";
}elseif ($post['status'] == "返す") {
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
<?=$msg?>書籍は下記でよろしいでしょうか？
<br>
<?=$post['name']?>
<form method="post" action="book_stockedit_done.php">
<input type="hidden" name="code" value="<?=$post['code']?>">
<input type="hidden" name="status" value="<?=$msg?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="<?=$post['status']?>">
</form>
</body>
</html>
