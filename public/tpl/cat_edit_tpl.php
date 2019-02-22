<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="/index.php?act=cat_edit_update&id=<?php echo $_GET['id'];?>" method="post">
            <h3 class="h3 text-center">分类编辑</h3>
          <div class="form-group">
              <label for="exampleInputEmail1">分类名称：</label>
              <input type="username" name="update_cat_name" class="form-control" placeholder="分类名称" value="<?php echo $catCurrent?>">
            <label for="exampleInputEmail2">分类排序：</label>
            <input type="username" name="update_cat_sort" class="form-control" placeholder="分类排序" value="<?php echo $catOrder?>">
          </div>
          <button type="submit" class="btn btn-default" style="margin-bottom:10px;">保存</button>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
