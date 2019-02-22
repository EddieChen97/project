<?php
//加载公共函数库
include 'public/function.php';

switch ($_GET['act']) {

    //登录
    case 'login':
        //设置模板名称
        $tplName = 'login';
        //设置页面title名称
        $siteName = '用户登录';
        //连接数据库
        $conn = db_connect($db);
        //获取分类列表 用在头部标题
        $order = 'ORDER BY `order`';
        $catList = do_cat_select($conn,$catTable,' ',$order);
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

        break;

    //登录验证
    case 'check_login':
        //获取用户名和密码
        $userName = $_POST['username'];
        $passWord = $_POST['password'];
        //连接数据库
        $conn = db_connect($db);
        //获取用户数据
        $userList = do_user_select($conn,$userTable,'','');
        //登录验证
        check_login($userName,$passWord,$userList);

        break;

    //退出登录
    case 'logout':
        logout();

        break;

    // 用户注册
    case 'register':
        //设置模板名称
        $tplName = 'register';
        //设置页面title名称
        $siteName = '用户注册';
        //连接数据库
        $conn = db_connect($db);
        //获取分类数据   用在导航标题
        $order = "ORDER BY `order`";
        $catList = do_cat_select($conn,$catTable,'',$order);
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



        break;

    // 验证注册信息
    case 'check_register':

        //连接数据库
        $conn = db_connect($db);
        //验证用户注册信息
        check_register($conn,$userTable);
        break;

    //分类管理
    case 'cat_mange':
        //设置模板名称
        $tplName = 'cat_mange';
        //连接数据库
        $conn = db_connect($db);
        //获取分类列表 用在头部标题
        $order = 'ORDER BY `order`';
        $catList = do_cat_select($conn,$catTable,' ',$order);
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


        break;

    //分类编辑
    case 'cat_edit':
        //设置模板名称
        $tplName = 'cat_edit';
        //连接数据库
        $conn = db_connect($db);
        //获取分类列表 用在头部标题
        $order = 'ORDER BY `order`';
        $catList = do_cat_select($conn,$catTable,' ',$order);

        foreach ($catList as $cat) {
            if($cat['id']==$_GET['id'])
            {
                $catCurrent = $cat['cat_name'];
                $catOrder = $cat['order'];
            }
        }
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

        break;

    //分类信息更新
    case 'cat_edit_update':
        //连接数据库
        $conn = db_connect($db);
        //获取更新数据
        $updateInfo = [
            'update_cat_name' => $_POST['update_cat_name'],
            'update_cat_sort' => $_POST['update_cat_sort'],
        ];
        $update_cat_id = $_GET['id'];
        //设置更新条件
        $where = "WHERE `id`='{$update_cat_id}'";
        do_cat_edit($conn,$catTable,$where,$updateInfo);
        break;

    // 删除分类
    case 'cat_delete':
        //连接数据库
        $conn = db_connect($db);
        $where = "WHERE `id`='{$_GET['id']}'";
        do_cat_delete($conn,$catTable,$where);

    case 'cat_insert':
        //设置模板名称
        $tplName = 'cat_insert';
        //连接数据库
        $conn = db_connect($db);
        //获取分类列表 用在头部标题
        $order = "ORDER BY `order`";
        $catList = do_cat_select($conn,$catTable,'',$order);
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

        break;

    case 'cat_insert_go':
        //连接数据库
        $conn = db_connect($db);
        do_cat_insert($conn,$catTable);
        break;

    //博文管理
    case 'art_mange':
        // 设置模板名称
        $tplName = 'art_mange';
        // 连接数据库
        $conn = db_connect($db);
        //获取分类数据  用在导航标题
        $order = "ORDER BY `order`";
        $catList = do_cat_select($conn,$catTable,'',$order);
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

        //获取当前页数
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        // 重新连接数据库  上一个数据库连接已经被关闭
        $conn = db_connect($db);
        //获取limit条件
        $limit = pagination($conn,$artTable,$page,$num);
        //获取博文数据
        $artList = do_art_select($conn,$artTable,'',$limit);
        //获取总记录数  分页模板使用
        $conn = db_connect($db);
        $result = mysqli_query($conn,"SELECT * FROM $artTable");
        $count = mysqli_num_rows($result);
        mysqli_close($conn);
        break;

    //博文编辑
    case 'art_edit':
        // 设置模板名称
        $tplName = 'art_edit';
        //连接数据库
        $conn = db_connect($db);
        //获取分类数据  用在导航标题
        $order = "ORDER BY `order`";
        $catList = do_cat_select($conn,$catTable,'',$order);
        //获取当前编辑的博文数据
        $conn = db_connect($db);
        $where = "WHERE `id`=".$_GET['id'];
        $limit = "LIMIT 1";
        $artCurrent = do_art_select($conn,$artTable,$where,$limit);
        //获取当前分类id
        $cat_id = $artCurrent[0]['cat_id'];
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

        break;

    // 博文信息更新
    case 'art_edit_update':
        //连接数据库
        $conn = db_connect($db);
        do_art_update($conn,$artTable);
        break;

    //删除博文信息
    case 'art_delete':
        //连接数据库
        $conn = db_connect($db);
        //删除博文
        do_art_delete($conn,$artTable);

        break;

    //新增博文
    case 'art_insert':
        //设置模板名称
        $tplName = 'art_insert';
        //连接数据库
        $conn = db_connect($db);
        //获取分类数据 用在导航标题
        $order = "ORDER BY `order`";
        $catList = do_cat_select($conn,$catTable,'',$order);
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



        break;

    case 'art_insert_go':
        //连接数据库
        $conn = db_connect($db);
        do_art_insert($conn,$artTable);
        break;

    case 'user_mange':
        //设置模板名称
        $tplName = 'user_mange';
        //连接数据库
        $conn = db_connect($db);
        //获取分类数据  用在导航标题
        $order = "ORDER BY `order`";
        $catList = do_cat_select($conn,$catTable,'',$order);
        //重新连接数据库
        $conn = db_connect($db);
        //获取用户表数据
        $order = "ORDER BY `id`";
        $userList = do_user_select($conn,$userTable,'',$order);
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


        break;

    //编辑用户
    case 'user_edit':
        //设置模板名称
        $tplName = 'user_edit';
        //连接数据库
        $conn = db_connect($db);
        //获取分类数据  用在导航标题
        $order = "ORDER BY `order`";
        $catList = do_cat_select($conn,$catTable,'',$order);
        //获取当前编辑的用户数据
        $conn = db_connect($db);
        $where = "WHERE id=".$_GET['id'];
        $userList = do_user_select($conn,$userTable,$where,'');
        $userCurrent = $userList[0];
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


        break;

    //保存编辑过的用户数据
    case 'user_edit_update':
        // 连接数据库
        $conn = db_connect($db);
        do_user_update($conn,$userTable);

        break;



    default:
        echo '<script>alert("参数错误！");location.href="/index.php"</script>';
        break;
}
