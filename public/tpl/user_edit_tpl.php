<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="/index.php?act=user_edit_update&id=<?php echo $_GET['id'];?>" method="post">
            <h3 class="h3 text-center">用户编辑</h3>
          <div class="form-group">
            <label for="exampleInputEmail2">用户名：</label>
            <input type="username" name="username" class="form-control" placeholder="用户名" value="<?php echo $userCurrent['username'];?>">
            <label for="exampleInputEmail2">电子邮箱：</label>
            <input type="username" name="email" class="form-control" placeholder="电子邮箱" value="<?php echo $userCurrent['email'];?>">
          </div>
          <button type="submit" class="btn btn-default" style="margin-bottom:10px;">保存</button>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
