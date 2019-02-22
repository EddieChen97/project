<div class="row">
    <div class="col-md-3">

    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
              <!-- 登录表单 -->
              <form action="/index.php?act=check_login" method="post">
                  <div class="page-header" align="center">
                      <h1><small>用户登录</small></h1>
                  </div>

                  <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">用户名</span>
                      <input type="text" name="username" class="form-control" placeholder="用户名" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group" style="margin:20px 0;">
                      <span class="input-group-addon" id="basic-addon1">密&nbsp;&nbsp;&nbsp;&nbsp;码</span>
                      <input type="password" name="password" class="form-control" placeholder="密码" aria-describedby="basic-addon1">
                  </div>

                      <div class="btn-group" role="group" aria-label="..." style="margin-left: 200px;">
                          <button type="submit" class="btn btn-default">登录</button>
                          <button type="button" onclick="location.href='/index.php?act=register'" class="btn btn-default">注册</button>
                      </div>



              </form>

          </div>
        </div>
    </div>

    <div class="col-md-3">

    </div>

</div>
