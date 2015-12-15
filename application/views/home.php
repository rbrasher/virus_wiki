<div id="content">
    <div id="projects_tabbed_box" class="tabbed_box">
        <div class="tabbed_area">
            <ul class="tabs">
                <li><a href="#content_1" id="tab_1" class="active">Welcome</a></li>
                <!--<li><a href="#content_2" id="tab_2">Newest Threats</a></li>-->
                <?php if($is_admin) { ;?>
                <li><a href="#content_2" id="tab_2">Threat List</a></li>
                
                <li><a href="#content_3" id="tab_3">Threat Queue</a></li>
                <li><a href="#content_4" id="tab_4">Comment Queue</a></li>
                <?php } ?>
            </ul>
            
            <div class="tabbed_container">
                <div id="content_1" class="tabbed_content active">
                    <div class="white_box">
                        <div class="virus_title">Android Threat Wiki</div>
                    </div>
                    <div class="gray_box centered">
                        <img src="images/logo2.png" />
                    </div>
                    <div class="gray_box centered">
                        <p style="font-weight: bold;">This wiki is currently in Beta Testing Mode. Not all options and definitions are not available at this time.</p>
                    </div>
                </div>
                
                
                <?php //Complete Virus List ?>
                <?php if($is_admin) { ?>
                <div id="content_2" class="tabbed_content">
                    <div class="white_box">
                        <div class="virus_title">Threat List</div>
                    </div>
                    <div class="gray_box">
                        <ul id="virus_list">
                            <?php if(count($items) > 0) { $c=1;?>
                                <?php foreach($items as $item) { ?>
                                    <?php if($c %2) {
                                        $item_class='odd';
                                    } else {
                                        $item_class='even';
                                    } 
                                ?>
                                    <?php if($is_admin) { ?>
                                    <li class="<?php echo $item_class;?>">
                                        <div class="list_link">
                                            <a href="view_by_id/<?php echo $item['id'];?>" title="<?php echo urldecode($item['alias']);?>"><?php echo urldecode($item['alias']);?></a>
                                        </div>
                                        <div class="list_link_controls">
                                            <a class="delete" title="Delete" href="delete_threat/<?php echo $item['id'];?>"></a>
                                            <a class="edit" title="Edit" href="edit_threat_definition/<?php echo $item['id'];?>"></a>
                                        </div>
                                    </li>
                                    <?php } else { ?>
                                        <li class="<?php echo $item_class;?>"><a href="view_by_id/<?php echo $item['id'];?>" title="<?php echo urldecode($item['alias']);?>"><?php echo urldecode($item['alias']);?></a></li>
                                    <?php } ?>
                                <?php $c++;} ?>
                            <?php } else { ?>
                                    <li>There are currently no threats to view</li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
                
                
                
                <?php //Virus Queue ?>
                <?php if($is_admin) {?>
                <div id="content_3" class="tabbed_content">
                    <div class="white_box">
                        <div class="virus_title">Threat Queue</div>
                    </div>
                    <div class="gray_box">
                        <table id="virus_queue_table">
                            <tr class="even">
                                <th>ID</th>
                                <th>Engine</th>
                                <th>Threat</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Alias</th>
                                <th>Actions</th>
                            </tr>
                            <?php $i = 1;?>
                            <?php foreach($qvs as $qv) { ?>
                            <?php 
                                if($i %2) {
                                    $class = 'odd';
                                } else {
                                    $class = 'even';
                                }
                            ?>
                            <tr class="<?php echo $class;?>">
                                <td style="text-align: center;"><?php echo $qv['id'];?></td>
                                <td style="text-align: center;"><?php echo $qv['engine'];?></td>
                                <td style="text-indent: 5px;"><a href="../getAssignmentsByThreat/<?php echo urlencode($qv['threat']);?>"><?php echo $qv['threat'];?></a></td>
                                <td style="text-indent: 5px;"><?php echo $qv['name'];?></td>
                                <td style="text-indent: 5px;"><?php echo $qv['category'];?></td>
                                <td style="text-indent: 5px;"><a href="../getThreatsByAlias/<?php echo urlencode($qv['alias']);?>"><?php echo $qv['alias'];?></a></td>
                                <td>
                                    <a class="delete" title="Delete" href="delete_threat/<?php echo $qv['id'];?>"></a>
                                    <a class="edit" title="Edit" href="../edit_threat_definition/<?php echo $qv['id'];?>"></a>
                                    <a class="approve" title="Approve" href="home/approve_threat/<?php echo $qv['id'];?>"></a>
                                    <a class="remap" title="Remap Threat" href="../remap_threat/<?php echo $qv['id'];?>"></a>
                                    <a class="related_threats" title="Get Related Threats" href="../viewrelated/<?php echo $qv['id'];?>"></a>
                                </td>
                            </tr>
                            
                            <?php $i++;} ?>
                        </table>
                        
                    </div>
                </div>
                
                
                
                
                
                <?php //Comments Queue ?>
                <div id="content_4" class="tabbed_content">
                    <div class="white_box">
                        <div class="virus_title">Comments Queue</div>
                    </div>
                    <div class="gray_box">
                        <table id="comment_queue_table">
                            <tr class="even">
                                <th>User:</th>
                                <th>Comment:</th>
                                <th>Post Date:</th>
                                <th>Actions:</th>
                            </tr>
                            <?php if(count($qcs) > 0) { $i=1;?>
                            <?php foreach($qcs as $qc) { ?>
                                <?php if($i %2) {
                                    $class='odd';
                                } else {
                                    $class='even';
                                } ?>
                            
                            <tr class="<?php echo $class;?>">
                                <td style="text-indent: 5px;"><?php echo ucwords($qc['created_by']);?></td>
                                <td style="padding: 0 5px;"><?php echo $qc['comment'];?></td>
                                <td style="text-indent: 5px;"><?php echo $qc['created_date'];?></td>
                                <td style="width: 100px;">
                                    <a class="delete" title="Delete Comment" href="home/delete_comment/<?php echo $qc['id'];?>"></a>
                                    <a class="approve" title="Approve Comment" href="home/approve_comment/<?php echo $qc['id'];?>"></a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                            <?php } else { ?>
                                <tr><td colspan="4">There are currently no comments to approve.</td></tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    var tabs = $('ul.tabs');

    tabs.each(function(i) {
        //Get all tabs
        var tab = $(this).find('> li > a');
        tab.click(function(e) {
            //Get Location of tab's content
            var contentLocation = $(this).attr('href');

            //Let go if not a hashed one
            if(contentLocation.charAt(0)=="#") {
                e.preventDefault();

                //Make Tab Active
                tab.removeClass('active');
                $(this).addClass('active');

                //Show Tab Content & add active class
                $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
            }
        });
    });

});
</script>