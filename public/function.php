<?php

// 公共函数库




/**
 * db_connect 连接数据库
 * @param  array $db 数据库连接参数
 * @return resource  $conn   数据库连接资源
 */
function db_connect($db)
{
    //创建连接
    $conn = mysqli_connect($db['db_host'],$db['db_user'],$db['db_pass'],$db['db_name']);

    //设置时区
    date_default_timezone_set("Asia/Shanghai");

    //设置字符集
    mysqli_query($conn,"SET NAMES UTF8");

    //检测连接
    if(!$conn)
    {
        die('数据库连接失败！'.mysqli_connect_error());
    }

    return $conn;
}

/****************************登录注册函数********************************/

/**
 * [check_register 注册验证]
 * @param  [resource] $conn    [数据库连接资源]
 * @param  [array] $regInfo [存有用户注册数据的数组]
 * @return [void]
 */
function check_register($conn,$table)
{
    //获取注册数据
    $userName = $_POST['username'];
    $passWord = $_POST['password'];
    $checkPassword = $_POST['check_password'];
    $email = $_POST['email'];
    $updateTime = time();
    //获取数据库中所有的用户数据，用来查重用户名的
    $dbUsername = do_user_select($conn,$table,'','');

    //储存正则验证的结果（bool型）
    //用户名为1-6位中文英文数字下划线和小数点组合
    $username_bool = preg_match('/^[\w\x{4e00}-\x{9fa5}]{2,12}$/u',$userName);
    //密码为8-12位字母数字下划线和小数点组成
    $password_bool = preg_match('/[\w]{8,12}/',$passWord);
    //邮箱验证
    $email_bool = preg_match('/(\w+\.)*(\w+)+@(\w+\.)([a-z]{2,3})/',$email);

    // 验证并返回详细信息
    if(!$username_bool){
        echo '<script>alert("用户名格式错误！");location.href="/index.php?act=register";</script>';
        return false;
    }
    if(!$password_bool)
    {
        echo '<script>alert("密码格式错误！");location.href="/index.php?act=register";</script>';
        return false;
    }
    if($passWord!==$checkPassword)
    {
        echo '<script>alert("两次密码输入不一致！");location.href="/index.php?act=register";</script>';
        return false;
    }
    if(!$email_bool)
    {
        echo '<script>alert("邮箱格式错误！");location.href="/index.php?act=register";</script>';
        return false;
    }

    //用户名查重
    foreach ($dbUsername as $value) {
        if($userName==$value['username'])
        {
            echo '<script>alert("用户名重复！");location.href="/index.php?act=register";</script>';
            return false;
        }
    }

    //处理密码
    $passWord = md5($passWord);

    //写入数据库
    $sql = "INSERT INTO {$table}(`username`,`password`,`email`,`update_time`) VALUES('{$userName}','{$passWord}','{$email}','{$updateTime}')";
    if(mysqli_query($conn,$sql))
    {
        echo '<script>alert("注册成功！");location.href="/index.php?act=login";</script>';
    }else{
        echo '<script>alert("注册失败！");location.href="/index.php?act=register";</script>';
    }

}

//登录验证
function check_login($username,$password,$userList)
{
    //用户名或密码为空不能登录
    if(empty($username)||empty($password))
    {
        echo '<script>alert("用户名或密码不能为空！");location.href="/index.php?act=login";</script>';
    }else{
            foreach ($userList as $user)
            {
                if($user['username']==$username)
                {
                    $userPassword = $user['password'];
                }
            }
            if(!empty($userPassword))
            {
                if(md5($password)==$userPassword)
                {
                    //登录成功  将用户名写入SESSION
                    $_SESSION['username'] = $username;
                    echo '<script>alert("登录成功！");location.href="/index.php";</script>';
                }else{
                    echo '<script>alert("密码错误！");location.href="/index.php?act=login";</script>';
                }
            }else{
                echo '<script>alert("用户名错误！");location.href="/index.php?act=login";</script>';
            }

    }
}

//注销登录
function logout()
{
    if(session_destroy())
    {
        echo '<script>location.href="/index.php";</script>';
    }
}

/***********************分类管理相关操作*****************************/

/**
 * do_cat_select 查询分类表中记录
 * @param  [resource] $conn  [数据库连接资源]
 * @param  [string] $table [要查询的表名]
 * @param  [string] $where [查询条件]
 * @param  [string] $order [排序规则]
 * @return [array]   $rows [存放查询到的所有记录，是一个二维数组]
 */
function do_cat_select($conn,$table,$where,$order)
{
    //设置查询语句
    $sql = "SELECT * FROM $table"." $where"." $order";
    $rows = [];

    //判断资源是否存在
    if($result = mysqli_query($conn,$sql))
    {
        //返回表中记录
        while($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row; //将表中每一条记录都存入$rows
        }
        mysqli_free_result($result); //释放资源
    }

    mysqli_close($conn);  //关闭数据库连接
    return $rows;  //返回表中所有记录

}

/**
 * 更新分类信息
 */
function do_cat_edit($conn,$table,$where,$updateInfo)
{
    $updateTime = time();
    $sql = "UPDATE $table SET `cat_name`='{$updateInfo['update_cat_name']}',`order`='{$updateInfo['update_cat_sort']}',`update_time`='{$updateTime}'  $where";
    if($result = mysqli_query($conn,$sql))
    {
        echo '<script>alert("更新成功！");location.href="/index.php?act=cat_mange";</script>';
    }else{
        echo '<script>alert("更新失败！");location.href="/index.php?act=cat_mange";</script>';
    }
    if($result)mysqli_free_result($result);
    mysqli_close($conn);
}

/**
 * 删除分类表记录
 */
function do_cat_delete($conn,$table,$where)
{
    $sql = "DELETE FROM `{$table}` {$where}";
    if($result = mysqli_query($conn,$sql))
    {
        echo '<script>alert("删除成功！");location.href="/index.php?act=cat_mange";</script>';
    }else{
        echo '<script>alert("删除失败！");location.href="/index.php?act=cat_mange";</script>';
    }
    mysqli_free_result($result);
    mysqli_close($conn);
}

/**
 * 插入分类记录
 */
function do_cat_insert($conn,$table)
{
    $catName = $_POST['insert_cat_name'];
    $order = $_POST['insert_cat_sort'];
    $catUrl = '?cat=';
    $createTime = time();
    $updateTime = time();
    $sql = "INSERT INTO `{$table}`(`id`,`cat_name`,`order`,`cat_url`,`create_time`,`update_time`) VALUES(null,'$catName',$order,'$catUrl',$createTime,$updateTime)";

    if(mysqli_query($conn,$sql))
    {
        $insert_id = mysqli_insert_id($conn);
        $updateUrl = "UPDATE `{$table}` SET `cat_url`='{$catUrl}{$insert_id}' WHERE `id`={$insert_id}";echo $updateUrl;
        mysqli_query($conn,$updateUrl);
        echo '<script>alert("添加成功！");location.href="/index.php?act=cat_mange";</script>';
    }else{
        echo '<script>alert("添加失败！");history.back();</script>';
    }

}

/********************************博文相关函数*****************************/
/**
 * [do_art_select 查询博文表内容]
 * @param  [resource] $conn  [数据库连接资源]
 * @param  [string] $table [数据表名]
 * @param  [string] $where [查询条件]
 * @param  [string] $limit [limit条件]
 * @return [array]  $rows      [博文表中所有记录$rows,是一个二维数组]
 */
function do_art_select($conn,$table,$where,$limit)
{
    $sql = "SELECT * FROM `{$table}` {$where} {$limit}";

    $rows = [];
    if($result = mysqli_query($conn,$sql))
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row;
        }

        mysqli_free_result($result);
    }
    mysqli_close($conn);

    return $rows;
}

/**
 * 更新博文表内容
 */
function do_art_update($conn,$table)
{
    //接收数据
    $idCurrent = $_GET['id'];// 博文ID
    $title = addslashes($_POST['title']);// 博文标题
    $content = addslashes($_POST['content']);// 博文内容
    $order = $_POST['order']; // 博文排序
    $catId = $_POST['cat_id']; // 博文分类ID
    $titleUrl = "?cat={$catId}&id=".$idCurrent;
    $recommend = $_POST['recommend']; // 博文是否推荐
    $updateTime = time();

    $sql = "UPDATE `{$table}` SET `title`='{$title}',`content`='{$content}',`order`='{$order}',`cat_id`='{$catId}',`recommend`='{$recommend}',`title_url`='{$titleUrl}',`update_time`='{$updateTime}' WHERE `id`='{$idCurrent}'";

    if(mysqli_query($conn,$sql))
    {
        echo '<script>alert("保存成功！");location.href="/index.php?act=art_mange";</script>';
    }else{
        echo '<script>alert("保存失败！");history.back();</script>';
    }

}

/**
 * 删除博文表内容
 */
function do_art_delete($conn,$table)
{
    // 获取要删除的博文id
    $artId = $_GET['id'];
    $sql = "DELETE FROM `{$table}` WHERE `id`='{$artId}'";
    if(mysqli_query($conn,$sql))
    {
        echo '<script>alert("删除成功！");location.href="/index.php?act=art_mange";</script>';
    }else{
        echo '<script>alert("删除失败！");location.href="/index.php?act=art_mange";</script>';
    }
}

/**
 * 新增博文
 */
function do_art_insert($conn,$table)
{
    //接收数据
    $title = addslashes($_POST['title']);//博文标题
    $content = addslashes($_POST['content']);//博文内容
    $order = $_POST['order']; //博文排序
    $cat_id = $_POST['cat_id'];//博文分类id
    $recommend = $_POST['recommend'];//是否推荐
    $titleUrl = '?cat='.$cat_id.'&id=';//url
    $createTime = time();//创建时间
    $updateTime = time();//更新时间

    $sql = "INSERT INTO `{$table}`(`title`,`order`,`content`,`cat_id`,`recommend`,`title_url`,`create_time`,`update_time`) VALUES('{$title}','{$order}','{$content}','{$cat_id}','{$recommend}','{$titleUrl}','{$createTime}','{$updateTime}')";

    if(mysqli_query($conn,$sql))
    {
        $insert_id = mysqli_insert_id($conn);
        $updateUrl = "UPDATE `{$table}` SET `title_url`='{$titleUrl}{$insert_id}' WHERE `id`='{$insert_id}'";
        mysqli_query($conn,$updateUrl);
        echo '<script>alert("添加成功!");location.href="/index.php?act=art_mange";</script>';
    }else{
        echo '<script>alert("添加失败!");history.back();</script>';
    }

}

/****************************分页相关函数********************************/

/**
 * @param $conn :数据库连接资源
 * @param $table: 当前数据表名称
 * @param $page :当前页数$_GET['page']
 * @param $num :每页显示记录数量
 * @return SQL查询字符串: limit $offset, $num
 */
function pagination($conn, $table, $page, $num)
{
    /*
     * 对传入的当前页数$page进行特殊处理,第一页再向前默认设置为首页,已到尾页,再翻页必须是只能是最后一页
     * 所以必须先求出当前总页数,求总页数,必须要知道表中共有多少条记录,以及每页允许显示几条
     * 每页显示记录数是已知的,我们只要求出记录总数就可以
     */

     // 1.获取表中总记录数
     $sql = "SELECT count(*) AS count FROM $table";

     if($result = mysqli_query($conn,$sql))
     {
         $row = mysqli_fetch_assoc($result);
         $count = $row['count'];
     }else{
         echo "没有更多数据了~";
         $count = 0;
     }

     // 2.计算总页数
     $total = ceil($count/$num);

     //3.处理第一页和最后一页
     //当前页数是首页，返回1  即首页，否则返回当前页数
     $page = ($page<=1) ? 1 : $page;
     // 如果当前页数是尾页，则返回尾页  否则返回当前页数
     $page = ($page>=$total) ? $total : $page;

     $offset = ($page-1)*$num;

     $limit = 'limit '.$offset.','.$num;

     return $limit;



}




/******************************用户管理相关函数******************************/
/**
 * do_select_user  获取用户信息
 */
function do_user_select($conn,$table,$where,$order)
{
    $sql = "SELECT * FROM $table $where $order";
    $rows = [];

    if($result = mysqli_query($conn,$sql))
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row;
        }
        mysqli_free_result($result);
    }

    return $rows;

}

/**
 * 更新用户数据
 */
function do_user_update($conn,$table)
{
    //获取数据
    $userId = $_GET['id'];
    $userName = $_POST['username'];
    $userEmail = $_POST['email'];
    $updateTime = time();

    $sql = "UPDATE `{$table}` SET `username`='{$userName}',`email`='{$userEmail}',`update_time`='{$updateTime}' WHERE `id`='{$userId}'";

    if(mysqli_query($conn,$sql))
    {
        echo '<script>alert("保存成功！");location.href="/index.php?act=user_mange";</script>';
    }else{
        echo '<script>alert("保存失败！");location.href="/index.php?act=user_mange";</script>';
    }
    mysqli_close($conn);
}
