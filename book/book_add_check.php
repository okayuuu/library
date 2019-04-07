<?php
//自作関数でエスケープ処理
require_once('../../common/common.php');
$post = sanitize($_POST);

$book_title = $post['title'];             //本のタイトル
$book_description = $post['description']; //本の説明
$okflg = true;                            //入力内容チェックをフラグ制御
$errmsg = "";
$msg = "";
$msg2 = "";

//タイトルの未入力確認。入力があれば画面に表示
if ($book_description == "") {
  $errmsg = "本のタイトルを入力してください<br>\n";
  $okflg = false;
}else {
  $msg = "本のタイトル<br>\n".$book_title."<br>\n";
}

//説明の入力があれば画面に表示
if ($book_description != "") {
   $msg .= "本の説明<br>\n".$book_description."<br>\n";
}

//画像追加したら画像サイズチェック追加する
// if (condition) {
//   echo "画像サイズが大きすぎます";
//   $okflg = false;
// }

if ($okflg == false) {
  $msg2 = '<a href="book_add.php">戻る</a>';
} else {
  $msg2 = "<br>以上の内容で登録します<br>\n";
  $msg2 .= '<form method="post" action="book_add_done.php">';
  $msg2 .= '<input type="hidden" name="title" value="'.$book_title.'">';
  $msg2 .= '<input type="hidden" name="description" value="'.$book_description.'">';
  $msg2 .= '<input type="button" onclick="history.back()" value="戻る">';
  $msg2 .= '<input type="submit" value="登録">';
  $msg2 .= '</form>';
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
<?=$msg2?>
<br>
</body>
</html>
