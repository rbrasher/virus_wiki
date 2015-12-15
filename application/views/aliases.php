<div class="breadcrumb blue" onclick="history.back();return false;">&laquo; Back</div>

<div id="content">
    <div class="white_box">
        <div class="virus_title">Armor Threats Assigned to: <?php echo $armor_alias;?></div>
    </div>
    <div class="gray_box">
        <table id="threat_alias_table">
            <tr class="even">
                <th>Armor Alias</th>
                <th>ID</th>
                <th>Engine</th>
                <th>Threat</th>
                <th>Category</th>
                <th>Name</th>
                <th>Group</th>
                
            </tr>
            <?php 
                $a = 1;
                foreach($aliases as $alias) { 
                    if($a %2) {
                        $class = 'odd';
                    } else {
                        $class = 'even';
                    }
            ?>
            <tr class="<?php echo $class;?>">
                <td style="text-indent: 10px;"><?php echo $alias['alias'];?></td>
                <td style="text-align: center;"><?php echo $alias['id'];?></td>
                <td style="text-align: center;"><?php echo $alias['engine'];?></td>
                <td style="text-align: center;"><?php echo $alias['threat'];?></td>
                <td style="text-align: center;"><?php echo $alias['category'];?></td>
                <td style="text-align: center;"><?php echo $alias['name'];?></td>
                <td style="text-align: center;"><?php echo $alias['group'];?></td>
            </tr>
            <?php $a++; } ?>
        </table>

    </div>
</div>