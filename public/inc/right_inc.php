<div class="col-md-4">
    <div class="list-group">
        <?php
        $counter = 1; //计数器
        foreach($artListAll as $art)
        {
            if($counter<=10)
            {
                $active = ($counter==1) ? 'active' : '';
                echo '<a href="'.$art['title_url'].'" class="list-group-item '.$active.'">'.mb_substr($art['title'],0,20,'utf-8').'<span class="badge">'.$counter.'</span></a>';

            }else{
                break;
            }
            $counter++;
        }


    ?>
   </div>
</div>
