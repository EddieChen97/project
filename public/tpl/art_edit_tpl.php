<!--编辑博文模板-->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h3 class="text-center">编辑博文</h3>
        <form action="/index.php?act=art_edit_update&id=<?php echo $artCurrent[0]['id'];?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="博文标题" name="title" value="<?php echo $artCurrent[0]['title'];?>" autofocus>
            </div>

            <div class="form-group" >
            <textarea class="form-control" rows="12"  name="content" id="editor">
                <?php echo $artCurrent[0]['content']; ?>
            </textarea>
            </div>

            <div class="form-group">
                <input type="number" class="form-control" placeholder="排序" name="order" value="<?php echo $artCurrent[0]['order'];?>">
            </div>

            <div class="form-group">
                <select class="form-control" name="cat_id">

                    <?php foreach($catList as $cat):?>
                        <?php if ($cat_id == $cat['id']) :?>
                    <option value="<?php echo $cat['id'];?>"  selected>

                        <!--找到对应的分类并设置为默认,然后结束本次循环-->

                        <?php echo $cat['cat_name']; continue;?>
                    </option>
                        <?php endif; ?>
                    <option value="<?php echo $cat['id'];?>" ><?php echo $cat['cat_name']; ?> </option>

                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-group">
                <select class="form-control" name="recommend">
                    <option  value="1" selected>推荐</option>
                    <option  value="0">暂不推荐</option>

                </select>
            </div>

            <button type="submit" class="btn btn-info btn-block">保存</button>
        </form>


    </div>
    <div class="col-md-2"></div>
</div>
<div class="row" style="height: 30px;"></div>
