<div id="content">
    <div class="white_box">
        <div class="virus_title">Remap Virus</div>
    </div>
    
    <div class="gray_box">
        <?php echo form_open('../threat/search_by_title', array('id' => 'threat_search_form')); ?>
            <input id="remap_keyword" name="remap_keyword" value="" placeholder="Enter Threat Name" />&nbsp;&nbsp;
            <input type="submit" value="submit" />
        <?php echo form_close();?>
    </div>
    <div class="gray_box">
        <table id="remap_list">
            <tr class="even">
                <th>Engine</th>
                <th>Threat</th>
                <th>Category</th>
                <th>New Category</th>
                <th>Name</th>
                <th>New Name</th>
                <th>Group</th>
                <th>New Group</th>
                <th>Modified</th>
            </tr>
            <?php
                if(count($items) > 0) {
                    $x=1;
                    foreach($items as $item) { 
                        if($x %2) {
                            $class='odd';
                        } else {
                            $class='even';
                        }
            ?>
            <tr class="<?php echo $class;?>">
                <td style="text-indent: 5px;"><?php echo $item['engine'];?></td>
                <td style="text-indent: 5px;"><?php echo $item['threat'];?></td>
                <td style="text-align: center;"><?php echo $item['category'];?></td>
                <td style="text-align: center;"><?php echo $item['new_category'];?></td>
                <td style="text-align: center;"><?php echo $item['name'];?></td>
                <td style="text-align: center;"><?php echo $item['new_name'];?></td>
                <td style="text-indent: 5px;"><?php echo $item['group'];?></td>
                <td style="text-indent: 5px;"><?php echo $item['new_group'];?></td>
                <td style="text-align: center;"><?php echo $item['modified'];?></td>
            </tr>
            <?php $x++;}} ?>
        </table>

    </div>
    
    <div class="gray_box">
        <?php echo form_open('threat/remap_virus', array('id' => 'remap_to_form'));?>
            <input type="text" id="new_category" name="new_category" value="" placeholder="New Category" />
            <input type="text" id="new_name" name="new_name" value="" placeholder="New Name" />
            <input type="text" id="new_group" name="new_group" value="" placeholder="New Group" />
            
            <input type="hidden" id="new_remap_keyword" name="new_remap_keyword" value="<?php if(isset($keyword)) echo $keyword;?>" />
            <input type="submit" value="Remap It" />
        <?php echo form_close();?>
    </div>
</div>