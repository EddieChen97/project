<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
            if($catList)
            {
                echo '<table class="table table-bordered table-hover">';
                echo '<caption class="h3 text-center">分类管理</caption>';
                echo '<thead>';
                echo '<tr bgcolor="#1E9FFF" align="center">';
                        echo '<th class="text-center">分类id</th>';
                        echo '<th class="text-center">分类名称</th>';
                        echo '<th class="text-center">排序</th>';
                        echo '<th class="text-center">创建时间</th>';
                        echo '<th class="text-center">更新时间</th>';
                        echo '<th class="text-center">操作</th>';
                echo '</tr>';
                echo '</thead>';
                foreach($catList as $cat)
                {
                    echo '<tr>';
                        echo '<td class="text-center">'.$cat['id'].'</td>';
                        echo '<td class="text-center">'.$cat['cat_name'].'</td>';
                        echo '<td class="text-center">'.$cat['order'].'</td>';
                        echo '<td class="text-center">'.date('Y-m-d H:i:s',$cat['create_time']).'</td>';
                        echo '<td class="text-center">'.date('Y-m-d H:i:s',$cat['update_time']).'</td>';
                        echo '<td class="text-center">
                                <a href="?act=cat_edit&id='.$cat['id'].'" class="btn btn-info btn-xs">编辑</a>
                                <a href="#" onclick=isDel('.$cat['id'].') class="btn btn-danger btn-xs">删除</a>
                              </td>';
                    echo '</tr>';
                }
                echo '</table>';
            }else{
                echo '没有数据！';
            }

        ?>
    </div>
    <div class="col-md-2"></div>
    <script type="text/javascript">
        function isDel(id)
        {
            if(confirm('删除此条分类?'))
            {
                location.href="/index.php?act=cat_delete&id="+id;
            }else{
                location.href="/index.php?act=cat_mange";
            }
        }
    </script>
</div>
<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-1" style="margin-bottom:10px;">
        <a href="/index.php?act=cat_insert" class="btn btn-success btn-sm">添加分类</a>
    </div>
    <div class="col-md-2"></div>
</div>
