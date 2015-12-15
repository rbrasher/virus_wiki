<div class="breadcrumb blue" onclick="history.back();return false;">&laquo; Back</div>

<div id="content">
    <div class="white_box">
        <div class="virus_title">Threats related to <?php echo $engine . ' : ' . $threat;?></div>
    </div>
    <div class="gray_box">
        <table id="related_threats_table">
            <tr class="even">
                <th style="width: 40%;">Engine</th>
                <th style="width: 40%;">Threat</th>
                <th style="width: 20%;">Times Appears With</th>
            </tr>
            
            <?php 
                $c = 1;
                foreach($related_threats as $related_threat) { 
                    if($c %2) {
                        $class = 'odd';
                    } else {
                        $class = 'even';
                    }
            ?>
            <tr class="<?php echo $class;?>">
                <td style="width: 40%; text-align: center;"><?php echo $related_threat['engine'];?></td>
                <td style="width: 40%; text-align: center;"><?php echo $related_threat['threat'];?></td>
                <td style="width: 20%; text-align: center;"><?php echo $related_threat['times_appears_with'];?></td>
            </tr>
            <?php $c++;} ?>
        </table>
    </div>
</div>