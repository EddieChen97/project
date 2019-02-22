<!--
/**
 * 分页模板
 * 调用此模板需要的参数:
 * 1.$count  //表中总记录数 定义在select文件里
 * 2.$pageCurrent //当前页数    注：一定要在引入分页模板文件之前定义
 */
-->

<?php
//设置前缀 当地址栏没有get参数或第一个get参数为page时 一定是首页
if((count($_GET)==0) || (array_keys($_GET)[0]=='page'))
{
    $prefix = '?';
}else {
    $prefix = '?'.key($_GET).'='.current($_GET).'&';
}

//计算总页数

?>

<div class="row">
<div class="col-md-10">
    <nav aria-label="..." style="text-align:center;">
        <ul class="pagination">
          <li class="">
              <a href="<?php
              $page = ($pageCurrent<=1) ? 1 : $pageCurrent-1;
              echo $prefix.'page='.$page;

              ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
              <?php
                  //总页数
                  $total = ceil($count/$num);

                  //设置分页取值范围保存在$pageRange数组里
                  $pageRange = range(1,$total);

                  if($total!=0)
                  {
                      foreach ($pageRange as $value)
                      {
                          $active = ($pageCurrent==$value) ? 'active' : '';
                          echo '<li class="'.$active.'"><a href="'.$prefix.'page='.$value.'">'.$value.' <span class="sr-only">(current)</span></a></li>
                          <li>';
                      }
                  }else{
                      echo '<li class="active"><a href="?page=1">1 <span class="sr-only">(current)</span></a></li>
                      <li>';
                  }

              ?>

              <a href="<?php
                $page = ($pageCurrent>=$total) ? $total : $pageCurrent+1;
                echo $prefix.'page='.$page;

                ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
         </li>
        </ul>
   </nav>
</div>
</div>
