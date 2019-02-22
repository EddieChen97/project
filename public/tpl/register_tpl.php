<div class="row">
    <div class="col-md-3">

    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
              <!-- 登录表单 -->
              <form action="/index.php?act=check_register" method="post">
                  <div class="page-header" align="center">
                      <h1><small>用户注册</small></h1>
                  </div>

                  <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">用&nbsp;户&nbsp;名</span>
                      <input type="text" name="username" class="form-control" placeholder="2-12位中英文数字下划线和小数点组合" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group" style="margin:20px 0;">
                      <span class="input-group-addon" id="basic-addon1">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</span>
                      <input type="password" name="password" class="form-control" placeholder="8-12位字母数字下划线和小数点组合" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group" style="margin:20px 0;">
                      <span class="input-group-addon" id="basic-addon1">确认密码</span>
                      <input type="password" name="check_password" class="form-control" placeholder="确认密码" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group" style="margin:20px 0;">
                      <span class="input-group-addon" id="basic-addon1">电子邮箱</span>
                      <input type="text" name="email" class="form-control" placeholder="email" aria-describedby="basic-addon1">
                  </div>


                      <div class="btn-group" role="group" aria-label="..." style="margin-left: 200px;">
                          <button type="submit" class="btn btn-default">注册</button>
                      </div>

              </form>

          </div>
        </div>
    </div>

    <div class="col-md-3">

    </div>

</div>
