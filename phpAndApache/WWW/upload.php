<?php
 function upload(){
   if (!isset($_FILES['avatar'])){
       $GLOBALS['message'] = '兄弟！文件都没有上传什么！';
       return;
   }
   $avatar = $_FILES['avatar'];
   echo $avatar['error'].'<br>';
   if ($avatar['error']!== UPLOAD_ERR_OK){
       $GLOBALS['message'] = '上传失败';
       return;
   }
   $source = $avatar['tmp_name']; //源文件地址
     //echo $source;
     if(!is_dir('./uploads/')){  //如果目录不存在 创建目录.
         mkdir('./uploads/');
     }
     $target = './uploads/'.$avatar['name'];//目标放在那里
     $moved = move_uploaded_file($source,$target);// 原文件所在路径 | 目标路径
     if(!$moved){
         $GLOBALS['message'] = '上传失败';
         return;
     }
 }

 if ($_SERVER['REQUEST_METHOD']==='POST'){
    // var_dump($_FILES);
     upload();
 }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>文件上传</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post" enctype="multipart/form-data">
    <input type="file" name="avatar">
    <button>上传</button>
    <?php if (isset($message)):?>
    <p style="color:cyan"><?php echo $message;?></p>
    <?php endif ?>
</form>
</body>
</html>
