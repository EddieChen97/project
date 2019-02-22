<!-- 开启SESSION -->
<?php session_start();?>
<!-- 加载全局配置文件 -->
<?php include 'public/config.php';?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo $siteName.'-'.SITE_SUFFIX;?></title>
    <link rel="short icon" type="image/x-icon" href="static/images/LOGO.png">
    <!-- Bootstrap -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--引入wangeditor的css文件-->
    <link rel="stylesheet" type="text/css" href="/lib/wangeditor/dist/css/wangEditor.min.css">
  </head>
  <body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">CQ博客</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">首页</a></li>
              <?php foreach($catList as $cat) :?>
              <li><a href="<?php echo $cat['cat_url'];?>"><?php echo $cat['cat_name'];?></a></li>
              <?php endforeach;?>
            </ul>
            <?php if(isset($_SESSION['username'])):

                        if($grade == 1):
            ?>
            <!-- 管理员显示页面 -->
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><?php echo $_SESSION['username'];?></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">后台管理 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="?act=cat_mange">分类管理</a></li>
                  <li><a href="?act=art_mange">博文管理</a></li>
                  <li><a href="?act=user_mange">用户管理</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="?act=logout">退出</a></li>
                </ul>
              </li>
            </ul>
                    <!-- 普通用户显示页面 -->
                    <?php else:?>
                        <ul class="nav navbar-nav navbar-right">
                          <li><a href="#"><?php echo $_SESSION['username'];?></a></li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">我的<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="#">个人中心</a></li>
                              <li><a href="#">我的博文</a></li>
                              <li><a href="#">信息管理</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="?act=logout">退出</a></li>
                            </ul>
                          </li>
                        </ul>
                    <?php endif;?>

            <?php
                else:
            ?>
                <!-- 未登录状态显示页面 -->
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="?act=login">登录</a></li>
                  <li><a href="?act=register">注册</a></li>
              </ul>

            <?php endif;?>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
        </div>
    </div>
