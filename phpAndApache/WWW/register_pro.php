<?php
//接收用户提交的数据，保存到文件
// 表当提交三部曲
//1.接收并校验
//2.持久化（将数据持久保存到磁盘中）
//3.响应（服务端的反馈）

// empty 检查一个变量是否为空 == isset || 值等于false empty 不会产生警告！本质!isset($var) || $var == false
function postback(){
    global $message; //定义为全局变量

    if (empty($_POST['username'])) {
        // 没有提交用户名 或 用户名为空字符串
        $message = '会不会玩';
        return;
    }

    if (empty($_POST['password'])) {
        $message = '请输入密码';
        return;
    }

    if (empty($_POST['confirm'])) {
        $message = '请输入确认密码';
        return;
    }
    // 用户名 密码 确认密码都输入了

    if ($_POST['password'] !== $_POST['confirm']) {
         $message = '两次输入的密码不一致';
         return;
    }

    if (!(isset($_POST['agree']) && $_POST['agree'] === 'on')) {
        $message = '必须同意注册协议';
        return;
    }
    // 所有的校验都OK

    $username = $_POST['username'];
    $password = $_POST['password'];

    // 将数据保存到文本文件中
    file_put_contents('users.txt', $username . '|' . $password . "\n", FILE_APPEND);
    $message = '注册成功';
}

if ($_SERVER['REQUEST_METHOD']==='POST'){
   postback();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登记表</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table border="1">
        <tr>
            <td><label for="username">用户名</label></td>
            <td><input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"></td>
        </tr>
        <tr>
            <td><label for="password">密码</label></td>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
            <td><label for="confirm">确认密码</label></td>
            <td><input for="password" name="confirm" id="confirm"/></td>
        </tr>
        <tr>
            <td></td>
            <td><label><input type="checkbox" name="agree" value="on">同意注册协议</label></td>
        </tr>
        <?php if (isset($message)): ?>
            <tr>
                <td></td>
                <td><?php echo $message; ?></td>
            </tr>
        <?php endif ?>
        <tr>
            <td></td>
            <td><button>注册</button></td>
        </tr>
    </table>
</form>
</body>
</html>
