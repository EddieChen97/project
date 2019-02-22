<?php
/**
 * 内容页
 * index.php?cat=1&id=24
 * 分六步
 * 1.加载公共函数库
 * 2.获取分类数据 用在头部导航栏
 * 3.获取分类对应博文内容 用在内容区
 * 4.获取推荐数据 用在右侧排行
 * 5.获取分类表信息  内容上面的标题导航
 * 6.设置模板名称 content
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


//3.获取对应的一条博文内容
//连接数据库
$conn = db_connect($db);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$where = 'WHERE `cat_id`='.$_GET['cat'].' AND `id`='.$_GET['id'];
$limit = pagination($conn,$artTable,$page,$num);
$artList = do_art_select($conn,$artTable,$where,$limit);

// 4.获取推荐数据
//连接数据库
$conn = db_connect($db);
$where = 'WHERE cat_id='.$_GET['cat'].' AND recommend=1';
$artListAll =do_art_select($conn,$artTable,$where,'');



//5.获取分类表信息
$conn = db_connect($db);
$where = "WHERE id=".$_GET['cat'];
$cat = do_cat_select($conn,$catTable,$where,'');
// 获取当前分类名称
$catName = $cat[0]['cat_name'];



//6.设置内容页模板文件名
$tplName = 'content';

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
