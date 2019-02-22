<?php
/**
 * 全局配置文件
 *
 * 命名规范:变量采用驼峰命名法,函数采用小写字母加下划线命名法
 * 全站要求:可配置,可扩展
 * 全部url采用全动态生成,约定cat代表分类,act代表操作
 * 全站为个人博客,首页与分类模板相同,仅调用数据不同,首页为全部数据,分类页为分类数据
 * 分类的入口地址统一为: index.php?act=分类id,例如:index.php?act=2
 * 博文的入口地址统一为: index.php?act=分类id&id=博文id,例如:index.php?cat=2&id=10
 */

//设置站点名称
$siteName = 'CQ博客';

//设置页面标题后缀
define('SITE_SUFFIX','www.cqblog.ooo');

//设置数据库参数
$db = [
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => '123',
    'db_name' => 'cbwwdndg'
];

//设置用到的数据表名称
$catTable = 'blog_category';
$artTable = 'blog_article';
$userTable = 'blog_user';

//设置每页显示信息数量
$num = 5;

//加载模板选择脚本
$getNo = isset($_GET) ? count($_GET) : 0;//获取GET参数的个数

switch($getNo)
{
    //地址栏没有GET参数时一定是首页
    case 0:
        include 'select_index.php';break;
    //当地址栏有1个2个或3个参数时再做一个判断
    case 1:
    case 2:
    case 3:
        $get = array_keys($_GET); //取出GET参数所有的键名
        //判断第一个GET参数
        switch($get[0])
        {
            case 'page':
                include 'select_index.php';break 2; //第一个参数为page时一定是首页
            case 'cat':
                if(in_array('id',$get)) //当有cat和id两个参数时表示是内容页
                {
                    include 'select_content.php';break 2;
                }
                include 'select_cat.php';break 2; //只有cat参数时表示是分类页
            case 'act':
                include 'select_act.php';break 2; //act表示是操作
        }break;
    default:echo "<script>alert('参数异常！');location.href='/index.php';</script>";
}
