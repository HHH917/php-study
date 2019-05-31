<?php
//print_r(get_extension_funcs('mongodb'));
//print_r(get_declared_classes());
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

if(!is_dir('./uploads/img') && !is_dir('./uploads/mp3')){  //如果目录不存在 创建目录.
    mkdir('./uploads/');
    mkdir('./uploads/img/');
    mkdir('./uploads/mp3/');
}
$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');//等同于mongoClient  连接mongodb
//$bulk = new MongoDB\Driver\BulkWrite;    //
//$bulk->insert(['ID' => uniqid(), 'title' => '爱情故事上集','artist'=>'孙耀威',"images"=>"\/uploads\/img\/1.jpg","source"=>"\/uploads\/mp3\/1.mp3"]);  //添加
//$bulk->insert(['ID' => uniqid(), 'title' => '爱如潮水','artist'=>'张信哲',"images"=>"\/uploads\/img\/2.jpg","source"=>"\/uploads\/mp3\/2.mp3"]);

//$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);//可选，修改确认
//$res = $manager->executeBulkWrite('musics.musicList', $bulk);  //写入到xxx的数据库下的  friend集合里面；
echo '<pre>';
//print_r($res);c
//$filter = ['title' => '爱如潮水']; //查询条件
//$options =['sort' => ['age' => 1]]; //查询显示结果限制例如这里 以age 升序排列 ，0为降序。
$query = new MongoDB\Driver\Query([]); //查询请求
//var_dump($query);
$result = $manager->executeQuery('musics.musicList',$query);  //给xxx.xx执行查询请求
//var_dump($result);
$data = new stdClass();
$i=0;
foreach ($result as $document) {

   $data->$i = $document;
   $i++;
}
//var_dump( get_object_vars($data[0])); //get_object_vars 把stdClass对象转换为数组;
//var_dump( get_object_vars($data));
$a=json_encode($data,true);
var_dump(json_decode($a,true));
?>