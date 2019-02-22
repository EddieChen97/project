<div class="row">
    <div class="col-md-8">
        <div class="page-header">
            <h2><?php echo $artList[0]['title']?></h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="page-header">
          <h2><small>阅读排行</small></h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">
              <a href="/">首页</a> /
              <a href="?cat=<?php echo $_GET['cat']?>"><?php echo $catName?></a> /
              <span style="color:#bbb;"><?php echo $artList[0]['title']?></span>
          </div>
          <div class="panel-body">
              <?php
                $content = htmlspecialchars_decode($artList[0]['content'],ENT_QUOTES);
                echo $content;
              ?>
          </div>
        </div>
    </div>

    <!-- 右边排行 -->
    <?php include 'public/inc/right_inc.php'?>

</div>
