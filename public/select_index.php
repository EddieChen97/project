<?php
/**
 * 首页模板
 * index.php
 * index.php?page=?
 * 共分四步
 * 1. 加载公共函数库
 * 2. 获取分类数据 用在导航
 * 3. 获取博文分页数据
 * 4. 获取右边推荐数据
 * 5.获取当前表的总记录数量 用在分页
 * 6. 加载首页模板文件index_tpl.php
 * 7.获取用户等级 用在导航
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

//3.获取当前页面要显示的$num条博文数据
//连接数据库
$conn = db_connect($db);
//获取当前页数
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//获取limit
$limit = pagination($conn,$artTable,$page,$num);
//获取全部博文
$artList = do_art_select($conn,$artTable,' ',$limit);

//4.获取右边排行数据
//连接数据库
$conn = db_connect($db);
//获取全部博文数据（忽略limit）
$artListAll = do_art_select($conn,$artTable,'','');

//5.获取当前表的总记录数量
//连接数据库
$conn = db_connect($db);
$result = mysqli_query($conn,"SELECT * FROM {$artTable}");
$count = mysqli_num_rows($result);

//6.设置首页模板文件名
$tplName = 'index';

//7.获取用户等级  登录之后才能获取
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
