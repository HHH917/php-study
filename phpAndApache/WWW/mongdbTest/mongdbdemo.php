<?php
//print_r(get_extension_funcs('mongodb'));
//print_r(get_declared_classes());
$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');//等同于mongoClient  连接mongodb
//$bulk = new MongoDB\Driver\BulkWrite;    //
//$bulk->insert(['name' => 'hhh', 'age' => 26]);  //添加
//$bulk->insert(['name' => 'JetWu6', 'age' => 26]);

//$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);//可选，修改确认
//$res = $manager->executeBulkWrite('wjt.friend', $bulk);  //写入到xxx的数据库下的  friend集合里面；
echo '<pre>';
//print_r($res);c
$filter = ['name'=>'hhh']; //查询条件
$options =['sort' => ['age' => 1]]; //查询显示结果限制例如这里 以age 升序排列 ，0为降序。
$query = new MongoDB\Driver\Query($filter,$options); //查询请求
var_dump($query);
$result = $manager->executeQuery('wjt.friend',$query);  //给xxx.xx执行查询请求
//var_dump($result);
$data=[];
foreach ($result as $document) {
    $data[0]=$document;
}
//var_dump( get_object_vars($data[0])); //get_object_vars 把stdClass对象转换为数组;
echo get_object_vars($data[0])['name'];
?>

