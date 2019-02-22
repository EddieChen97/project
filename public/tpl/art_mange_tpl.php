<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <?php
            if($artList)
            {
                echo '<table class="table table-bordered table-hover">';
                echo '<caption class="h3 text-center">博文管理</caption>';
                echo '<thead>';
                echo '<tr bgcolor="#1E9FFF" align="center">';
                        echo '<th class="text-center">博文id</th>';
                        echo '<th class="text-center">博文标题</th>';
                        echo '<th class="text-center">排序</th>';
                        echo '<th class="text-center">所属分类</th>';
                        echo '<th class="text-center">是否推荐</th>';
                        echo '<th class="text-center">创建时间</th>';
                        echo '<th class="text-center">最后更新时间</th>';
                        echo '<th class="text-center">操作</th>';
                echo '</tr>';
                echo '</thead>';
                foreach($artList as $art)
                {
                    //获取当前分类名称
                    foreach ($catList as $cat)
                    {
                        if($cat['id']==$art['cat_id'])$catName = $cat['cat_name'];
                    }
                    echo '<tr>';
                        echo '<td class="text-center">'.$art['id'].'</td>';
                        echo '<td class="text-center">'.$art['title'].'</td>';
                        echo '<td class="text-center">'.$art['order'].'</td>';
                        echo '<td class="text-center">'.$catName.'</td>';
                        echo '<td class="text-center">'.$art['recommend'].'</td>';
                        echo '<td class="text-center">'.date('Y-m-d H:i:s',$art['create_time']).'</td>';
                        echo '<td class="text-center">'.date('Y-m-d H:i:s',$art['update_time']).'</td>';
                        echo '<td class="text-center">
                                <a href="?act=art_edit&id='.$art['id'].'" class="btn btn-info btn-xs">编辑</a>
                                <a href="#" onclick=isDel('.$art['id'].') class="btn btn-danger btn-xs">删除</a>
                              </td>';
                    echo '</tr>';
                }
                echo '</table>';
            }else{
                echo '没有数据！';
            }

        ?>
    </div>
    <div class="col-md-1"></div>
    <script type="text/javascript">
        function isDel(id)
        {
            if(confirm('删除此条博文?'))
            {
                location.href="/index.php?act=art_delete&id="+id;
            }else{
                location.href="/index.php?act=art_mange";
            }
        }
    </script>
</div>
<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-1" style="margin-bottom:10px;">
        <a href="/index.php?act=art_insert" class="btn btn-success btn-sm">添加博文</a>
    </div>
    <div class="col-md-2"></div>
</div>
<!-- 分页 -->
<?php
//获取当前页数  供分页模板使用
$pageCurrent = isset($_GET['page']) ? $_GET['page'] : 1;
// 加载分页模板
include 'public/tpl/page_tpl.php';

?>
