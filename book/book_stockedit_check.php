<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>書籍貸出管理</title>
</head>
<body>
<?php

require_once('../../common/common.php');
$post = sanitize($_POST);

if ($post['status'] == "借りる") {
  $msg = "貸出";
}elseif ($post['status'] == "返す") {
  $msg = "返却";
}

echo $msg."書籍は下記でよろしいでしょうか？";
echo "<br>\n";
echo $post['name'];
echo '<form method="post" action="book_stockedit_done.php">';
echo '<input type="hidden" name="code" value="'.$post['code'].'">';
echo '<input type="hidden" name="status" value="'.$msg.'">';
echo '<input type="button" onclick="history.back()" value="戻る">';
echo '<input type="submit" value="'.$post['status'].'">';
echo '</form>';


 ?>
</body>
</html>
