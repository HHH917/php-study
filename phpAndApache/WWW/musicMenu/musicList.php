<?php

use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

echo '<pre>';
    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $query = new MongoDB\Driver\Query([]);//查询所有
    $result = $manager->executeQuery('musics.musicList',$query);
    $fileData = new stdClass();
    $i=0;
    foreach ($result as $document) {

        $fileData->$i = $document;
        $i++;
    }
    $a=json_encode($fileData,true);
    $data=json_decode($a,true);
    //$contents = file_get_contents('storage.json');
   // $data = json_decode($contents,true);
   // var_dump($data);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>音乐列表</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
    <div class="container py-5">
        <h1 class="display-3">音乐列表</h1>
        <hr>
        <div>
            <a href="add.php"class="btn btn-secondary btn-sm">添加</a>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <th class="text-center">标题</th>
                <th class="text-center">歌手</th>
                <th class="text-center">海报</th>
                <th class="text-center">音乐</th>
                <th class="text-center">操作</th>
            </thead>
            <tobody class="text-center">
                <?php foreach ($data as $item):?>
                <tr>
                    <td><?php echo $item['title']?></td>
                    <td><?php echo $item['artist']?></td>
                    <td><img src="<?php echo $item['images'][0]?>" alt=""></td>
                    <td>
                        <audio src="<?php echo $item['source']?>" controls></audio></td>
                    <td><button class="btn btn-danger btn-sm">删除</button></td>
                </tr>
                <?php endforeach;?>
            </tobody>
        </table>
    </div>
</body>
</html>