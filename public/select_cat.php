<?php
/**
 * 分类模板
 * index.php?cat=?
 * 共分七步
 * 1. 加载分共函数库: function.php
 * 2. 获取全部分类数据: $catList,用在部导航用
 * 3. 获取当前分类的名称: $catName,用在标题与说明
 * 4. 获取博文分页数据: $artList,用在左侧列表
 * 5. 获取右边推荐数据: $artListAll: 用在右侧列表
 * 6.获取当前表当前分类的总记录数量
 * 7. 加载分类模板文件:其实与首页共用: index
 */

//1.加载公共函数库
include 'function.php';


//2.获取分类数据
//连接数据库
$conn = db_connect($db);
//设置排序规则
$order = 'ORDER BY `order`';
//获取满足条件的分类信息,注意返回的是只有一个数组的二维数组,[0]=>Array()
$catList = do_cat_select($conn,$catTable,' ',$order);



//3.获取当前分类的名称
foreach ($catList as $cat)
{
    if($cat['id'] == $_GET['cat'])
    {
        $catName = $cat['cat_name'];
    }
}



//4.获取博文分页数据
//连接数据库
$conn = db_connect($db);
//获取当前页数
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//获取limit
$limit = pagination($conn,$artTable,$page,$num);
//设置where条件
$where = " WHERE cat_id={$_GET['cat']} ";
//获取全部博文
$artList = do_art_select($conn,$artTable,$where,$limit);



//5.获取当前分类推荐的博文
//连接数据库
$conn = db_connect($db);
//获取分类id
$cat_id = $_GET['cat'];
//设置查询条件
$where1 = ' WHERE cat_id='.$cat_id;
$where2 = ' AND recommend=1';
$where = $where1.$where2;
//查询满足条件的博文
$artListAll = do_art_select($conn,$artTable,$where,'');

//6.获取博文表中总记录数
//连接数据库
$conn = db_connect($db);
$where = isset($_GET) ? 'WHERE cat_id='.$_GET['cat'] : '';
$result = mysqli_query($conn,"SELECT * FROM {$artTable} {$where}");
$count = mysqli_num_rows($result);


//7.设置分类页模板文件名
$tplName = 'index';

//获取用户等级  登录之后才能获取
if(isset($_SESSION))
{
    if(isset($_SESSION['username']))
    {
        //连接数据库
        $conn = db_connect($db);
        //获取数据库所有用户信息 是一个二维数组
        $userList = do_user_select($conn,$userTable,'','');
        //获取当前用户的等级grade
        foreach($userList as $user)
        {
            if($user['username']==$_SESSION['username'])
            {
                $grade = $user['grade'];
            }
        }

    }
}
