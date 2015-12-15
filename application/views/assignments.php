<div class="breadcrumb blue" onclick="history.back();return false;">&laquo; Back</div>

<div id="content">
    <div class="white_box">
        <div class="virus_title">Armor Threats Assigned to: <?php echo $threat;?></div>
    </div>
    <div class="gray_box">
        <table id="threat_assignments_table">
            <tr class="even">
                <th>ID</th>
                <th>Engine</th>
                <th>Threat</th>
                <th>Category</th>
                <th>Name</th>
                <th>Group</th>
                <th>Armor Alias</th>
            </tr>
            <?php 
                $aa = 1;
                foreach($assignments as $assignment) {
                    if($aa %2) {
                        $class = 'odd';
                    } else {
                        $class = 'even';
                    }
            ?>
            <tr class="<?php echo $class;?>">
                <td style="text-align: center;"><?php echo $assignment['id'];?></td>
                <td style="text-align: center;"><?php echo $assignment['engine'];?></td>
                <td style="text-align: center;"><?php echo $assignment['threat'];?></td>
                <td style="text-align: center;"><?php echo $assignment['category'];?></td>
                <td style="text-align: center;"><?php echo $assignment['name'];?></td>
                <td style="text-align: center;"><?php echo $assignment['group'];?></td>
                <td style="text-align: center;"><?php echo $assignment['alias'];?></td>
            </tr>
            <?php $aa++;} ?>
        </table>
    </div>
</div>