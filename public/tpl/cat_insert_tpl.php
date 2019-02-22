<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="/index.php?act=cat_insert_go" method="post">
            <h3 class="h3 text-center">添加分类</h3>
          <div class="form-group">
              <label for="exampleInputEmail1">分类名称：</label>
              <input type="username" name="insert_cat_name" class="form-control" placeholder="分类名称">
            <label for="exampleInputEmail2">分类排序：</label>
            <input type="username" name="insert_cat_sort" class="form-control" placeholder="分类排序">
          </div>
          <button type="submit" class="btn btn-default" style="margin-bottom:10px;">确认添加</button>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
