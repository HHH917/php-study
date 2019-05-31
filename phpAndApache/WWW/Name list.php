<?php
$contents = file_get_contents('names.txt'); //获取读取文件
$lines = explode("\n",$contents);//拆分文本数据
//var_dump($lines);//打印数组
foreach($lines as $item){
    if(!$item) continue; //如果输入的数据是空的或无效大跳过这一次
    $cols = explode('|',$item);
    $data[] = $cols;
}
//var_dump($data);//打印数组
?>
<!doctype html>
<html lang="en">
<head>
    <meta charest="utf-8">
    <title>名单数据表</title>
</head>
<body>
    <h1>名单数据表</h1>
    <table>
        <thead>
            <tr>
                <th>编号</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>网址</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $line): ?>
            <tr>
                <?php foreach($line as $col): ?>
                <?php $col = trim($col); ?>
<!--                --><?php //echo gettype($col)?>
                <?php if(strpos($col,'http://')=== 0): ?>
                <td>
                    <a href="<?php echo strtolower($col); ?>"><?php echo  strtolower(substr($col,7));?></a>
                </td>
                <?php else:?>
                <td><?php echo $col;?></td>
                <?php endif; ?>
                <?php endforeach;?>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>

</body>
</html>
