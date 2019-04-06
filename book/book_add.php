<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>書籍貸出管理</title>
</head>
<body>

書籍登録<br>
<br>
<br>

<form method="post" action="book_add_check.php">
  タイトル<br>
  <input type="text" name="title" style="width:200px"><br>
  本の説明<br>
  <textarea name="description" rows="4" cols="25"></textarea><br>
  <input type="button" onclick="history.back()" value="戻る">
  <input type="submit" value="OK">

</form>
</body>
</html>
