<?php

$mysql = mysqli_connect('db', 'root', 'root');
if (!$mysql) {
  echo "接続に失敗しました".mysql_error();
  exit;
}
echo '<p>接続に成功しました。</p>';

$db_selected = mysqli_select_db($mysql, 'terada_thread');
if (!$db_selected){
  echo "データベースの選択に失敗しました".mysqli_error();
  exit;
}
$comment_id = $_POST["comment_id"];
$preview = $_POST["preview"];
$name = $_POST["name"];
$subject = $_POST["subject"];
$message = $_POST["comment"];
$email = $_POST["email"];
$url = $_POST["url"];
$image = $_POST["image"];
date_default_timezone_set("Asia/Tokyo");
$time= date("Y-m-d H:i:s");
$edit = $_POST["edit"];
$font_color = $_POST["color"];
$comment_id = $_POST["comment_id"];
$datas = mysqli_query($mysql, "SELECT * FROM comments WHERE comment_id = {$comment_id};");
while($data = mysqli_fetch_assoc($datas)){
  ?>
    <form action="teradanokeijiban_hensin0.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="comment_id" value="<?php echo $data["comment_id"];?>">
        <!-- <input type="hidden" name="iamge" value="<?php echo $data["image"];?>"> -->
        <!-- ↑これ違う。コメントテーブルにあるイメージの情報持ってきてもしょうがないので（返信の画像入れたいぜって話だから無関係 -->
      <hr/>

      <head>
        <title>寺田の掲示板</title>
      </head>
      <body>

      <form action="teradanokeijiban_hensin0.php" method="POST" enctype="multipart/form-data">

        <hr/>

        <center>
          <h2>寺田掲示板</h2>
        </center>
        <table>
          <tr>
            <th>名前</th>
            <td>
              <input type="text" name="name"/>
            </td>
          </tr>
          <tr>
            <th>件名</th>
            <td>
              <input type="text" name="subject"/>
            </td>
          </tr>
          <tr>
            <th>メッセージ</th>
            <td>
              <textarea name="comment" rows="5" cols="40"></textarea>
            </td>
          </tr>
          <tr>
            <th>画像</th>
            <td>
              <input type="file" name="image" accept="image/*">
            </td>
          </tr>
          <tr>
            <th>メールアドレス</th>
            <td>
              <input type="email" name="email">
            </td>
          </tr>
          <tr>
            <th>URL</th>
            <td>
              <input type="text" name="url">
            </td>
          </tr>
          <tr>
            <th>文字色</th>
            <td>
              <!-- 黒 -->
              <label>
                <input type="radio" name="color" value="black">
                <font color="black">■</font>
              </label>

              <!-- 青 -->
              <label>
                <input type="radio" name="color" value="blue">
                <font color="blue">■</font>
              </label>

              <!-- 緑 -->
              <label>
                <input type="radio" name="color" value="green">
                <font color="green">■</font>
              </label>

              <!-- ラベンダー -->
              <label>
                <input type="radio" name="color" value="lavender">
                <font color="lavender">■</font>
              </label>

            </td>
          </tr>
          <tr>
            <th>編集/削除キー</th>
            <td>
              <input type="number" name="edit" size="8" maxlength="8" value="pass">
              <small>(英数字で8文字以内)</small>
            </td>
          </tr>
          <tr>
            <th colspan="2" align="right">
              <input type="submit" value="送信"　/>
            </th>
          </tr>
        </table>
      </form>
    <?php
    // var_dump($data);
    // exit;

  }


?>
