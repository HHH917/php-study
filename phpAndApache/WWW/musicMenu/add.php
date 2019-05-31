<?php
function add_music()
{

    // 文本框校验
    if (empty($_POST['title'])) {
        $GLOBALS['error_message'] = '请输入标题';
        return;
    }
    if (empty($_POST['artist'])) {
        $GLOBALS['error_message'] = '请输入歌手';
        return;
    }

    // 文件上传校验
    if (empty($_FILE['source'])) {
        $GLOBALS['error_message'] = '请正确提交文件';
        return;
    }

    $source = $_FILES['source'];

    // 判断用户是否选择了文件
    if ($source['error'] !== UPLOAD_ERR_OK) {
        $GLOBALS['error_message'] = '请选择音乐文件';
        return;
    }

    //校验文件的大小
    if ($source['size'] > 10 * 1024 * 1024) {
        $GLOBALS['error_message'] = '音乐文件过大';
        return;
    }
    if ($source['size'] < 1 * 1024 * 1024) {
        $GLOBALS['error_message'] = '音乐文件过小';
        return;
    }

    //校验文件类型
    $allowed_types = array('audio/mp3', 'audio/wma');
    if (!in_array($source['type'], $allowed_types)) {
        $GLOBALS['error_message'] = '这是不支持的音乐格式';
        return;
    }

    //对音乐文件进行重命名
    $target = './uploads/' . uniqid() . '-' . $source['name'];
    if (!move_uploaded_file($source['tmp_name'], $target)) {
        $GLOBALS['error_message'] = '上传图片失败';
        return;
    }

    //图片上传成功后
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $images = '图片';
    $source = '音乐';

    $origin = josn_decode(file_get_contents('storage.json', true));

    $origin[] = array(
        'id' => uniqid(),
        'title' => $_POST['title'],
        'artist' => $_POST['artist'],
        'images' => 'potato',
        'source' => 'music',
    );

    $json = json_encode($origin);

    file_put_contents('storage.json',$json);

    //跳转回列表页
    header('Location:list.php');
  }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    add_music();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加音乐</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<div class="containner py-5">
    <h1 class="display-4">添加新音乐</h1>
    <hr>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="form-group">
            <label for="title" style="margin-left:10px;">标题</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="artist" style="margin-left:10px;">歌手</label>
            <input type="text" class="form-control" id="artist" name="artist">
        </div>
        <div class="form-group">
            <label for="images" style="margin-left:10px;">海报</label>
            <input type="text" class="form-control" id="images" name="images">
        </div>
        <div class="form-group">
            <label for="source" style="margin-left:10px;">音乐</label>
            <input type="file" class="form-control" id="source" name="source" accept="audio/*">
        </div>
        <button class="btn btn-primary btn-block">保存</button>
    </form>
</div>
</body>
</html>
