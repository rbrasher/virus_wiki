<div class="white_box">
    <div class="virus_title">Edit Virus Definition: <?php echo $virus['id'] . ' - ' . urldecode($virus['alias']);?></div>
</div>
<div class="white_box">
    <?php echo validation_errors('<p class="error">');?>
</div>
<div class="gray_box">
    <?php echo form_open('../edit_threat_definition/' . $virus['id'], array('id' => 'edit_threat_form')); ?>
        <input type="hidden" readonly="true" id="threat_id" name="threat_id" value="<?php echo $virus['id'];?>" />

        <?php echo form_fieldset('Mapping Data');?>
        <div class="half_row">
            <label>Engine:</label>
            <input class="rounded no_bg" type="text" readonly="true" id="threat_engine" name="threat_engine" value="<?php echo $virus['engine'];?>" />
        </div>
        
        <div class="half_row">
            <label>Threat:</label>
            <input class="rounded no_bg" type="text" readonly="true" id="threat_threat" name="threat_threat" value="<?php echo $virus['threat'];?>" />
        </div>
    
        <div class="half_row">
            <label>Category:</label>
            <input class="rounded no_bg" type="text" readonly="true" id="threat_category" name="threat_category" value="<?php echo $virus['category'];?>" />
        </div>
        
        <!--
        <div class="half_row">
            <label>New Category:</label>
            <input class="rounded" type="text" readonly="true" id="threat_new_category" name="threat_new_category" value="<?php echo $virus['new_category'];?>" />
        </div>
        -->
        
        <div class="half_row">
            <label>Name:</label>
            <input class="rounded no_bg" type="text" readonly="true" id="threat_name" name="threat_name" value="<?php echo $virus['name'];?>" />
        </div>
        
        <!--
        <div class="half_row">
            <label>New Name:</label>
            <input class="rounded" type="text" readonly="true" id="threat_new_name" name="threat_new_name" value="<?php echo $virus['new_name'];?>" />
        </div>
        -->
        
        <div class="half_row">
            <label>Group:</label>
            <input class="rounded no_bg" type="text" readonly="true" id="threat_group" name="threat_group" value="<?php echo $virus['group'];?>" />
        </div>
        
        <!--
        <div class="half_row">
            <label>New Group:</label>
            <input class="rounded" type="text" readonly="true" id="threat_new_group" name="threat_new_group" value="<?php echo $virus['new_group'];?>" />
        </div>
        -->
        <?php echo form_fieldset_close();?>
        <?php //end mapping fields ?>
        
        <?php echo form_fieldset('Threat Info');?>
        <div class="row">
            <label>Summary:</label>
            <input class="rounded" type="text" id="threat_summary" name="threat_summary" value="<?php echo $virus['summary'];?>" />
        </div>
        
        <div class="row">
            <label>Threat Definition:</label>
            <textarea id="threat_description" name="threat_description"><?php echo $virus['description'];?></textarea>
        </div>
        
        <div class="row">
            <label>Additional Threat Details:</label>
            <textarea id="threat_additional_details" name="threat_additional_details"><?php echo $virus['additional_details'];?></textarea>
        </div>
    
        <div class="row">
            <label>Threat Repair:</label>
            <textarea id="threat_repair" name="threat_repair"><?php echo $virus['repair'];?></textarea>
        </div>
    
        <div class="row">
            <label>Related Links:</label>
            <textarea id="threat_related_links" name="threat_related_links"><?php echo $virus['related_links'];?></textarea>
        </div>
        
        <div class="half_row">
            <label>Occurrences:</label>
            <input class="rounded" type="text" id="threat_occurrences" name="threat_occurrences" value="<?php echo $virus['occurences'];?>" />
        </div>
    
        <div class="half_row">
            <label>Total Devices:</label>
            <input class="rounded" type="text" readonly="true" id="threat_total_devices" name="threat_total_devices" value="<?php echo $virus['total_devices'];?>" />
        </div>

        <div class="row">
            <label>Trend Direction:</label>
            <?php if(isset($virus['trend_direction'])) { ?>
            
            <?php } else { ?>
            <img src="<?php echo base_url();?>images/trend_up.png" title="Trending Up" alt="Treding Up" />
            <?php } ?>
        </div>
        
        <div class="row">
            <label>Alias:</label>
            <input class="rounded" type="text" readonly="true" id="threat_alias" name="threat_alias" value="<?php echo $virus['alias'];?>" />
        </div>
        <?php echo form_fieldset_close();?>
        
        
        
        <?php echo form_fieldset('Admin Info');?>
        <div class="half_row">
            <label>Approved:</label>
            <input class="rounded" type="text" readonly="true" id="threat_approved" name="threat_approved" value="<?php echo $virus['approved'];?>" />
        </div>
        
        <div class="half_row">
            <label>Approved By:</label>
            <input class="rounded" type="text" readonly="true" id="threat_created_by" name="threat_approved_by" value="<?php echo $virus['approved_by'];?>" />
        </div>
        
        <div class="half_row">
            <label>Created/Modified Date:</label>
            <input class="rounded" type="text" readonly="true" id="threat_created_date" name="threat_created_date" value="<?php echo $virus['created_date'];?>" />
        </div>
        
        <div class="half_row">
            <label>Created/Modified By:</label>
            <input class="rounded" type="text" readonly="true" id="threat_created_by" name="threat_created_by" value="<?php echo $virus['created_by'];?>" />
        </div>
        <?php echo form_fieldset_close();?>
        
        

        <div class="row" style="text-align: center;">
            <input type="submit" name="submit" id="submit" value="Submit" />
        </div>

    <?php echo form_close();?>
   
</div>