
<!-- 标题 -->
<div class="row">
    <div class="col-md-8">
        <div class="page-header">
            <h2><?php echo isset($catName) ? $catName : ''?>最新博文</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="page-header">
          <h2><small>阅读排行</small></h2>
        </div>
    </div>
</div>


<!-- 左边列表 -->
<div class="row">
<div class="col-md-8">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php foreach ($artList as $art) :?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?php echo $art['title']?>
            </a>
        </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
            <p><?php
            //将内容实体转标签
            $content = htmlspecialchars_decode($art['content']); //博文内容

            //截取内容前的120个中文做为简介
            $content = mb_substr($content,0,120,'utf-8');

            echo  $content;
            ?></p>
            <a  class="btn btn-info btn-xs" href="/index.php<?php echo $art['title_url']; //详情 ?>" role="button">点击阅读 >></a>
        </div>
    </div>
</div>
<?php endforeach;?>
</div>
</div>





<!-- 右边排行 -->
<?php include 'public/inc/right_inc.php'?>
</div>

<!-- 分页 -->
<?php
    // 获取当前页数
    // 判断地址栏是否有page参数 如果有就返回page的值  没有则返回1  即首页
    $pageCurrent = isset($_GET['page']) ? $_GET['page'] : 1;

    // 加载分页模板
    include 'public/tpl/page_tpl.php'
?>
