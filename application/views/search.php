<div id="content">
    <div class="white_box">
        <div class="virus_title"><?php echo count($results);?> Results Found</div>
    </div>
    <div class="gray_box">
        <ul id="results_list">
            <?php
                if(count($results) > 0) {
                    $x=1;
                    foreach($results as $result) { 
                        if($x %2) {
                            $class='odd';
                        } else {
                            $class='even';
                        }
            ?>
            <li id="<?php echo $result['id'];?>" class="<?php echo $class;?>">

                <div class="row">
                    <a href="<?php base_url();?>view/<?php echo $result['alias'];?>" title="<?php echo urldecode($result['alias']);?>"><?php echo urldecode($result['alias']);?></a>
                </div>

                <?php $x++;}} ?>

            </li>

        </ul>
    </div>
</div>