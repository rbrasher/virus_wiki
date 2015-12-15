<div class="breadcrumb blue" onclick="history.back();return false;">&laquo; Back</div>

<div id="content">
    <div id="projects_tabbed_box" class="tabbed_box">
        <div class="tabbed_area">
            <ul class="tabs">
                <li><a href="#content_1" id="tab_1" class="active">Definition</a></li>
                <li><a href="#content_2" id="tab_2">Comments</a></li>
            </ul>
            <div class="tabbed_container">
                <?php if(isset($item['alias'])) { ?>
                <?php //Definition Tab ?>
                <div id="content_1" class="tabbed_content active">
                    <div class="white_box">
                        <div class="virus_title">
                            <?php echo urldecode($item['alias']);?>
                        </div>
                    </div>
                    
                    <div class="gray_box">
                        <div class="small_virus_title"><?php echo $item['name'];?></div>
                    </div>
                    
                    <?php //Summary ?>
                    <?php if(isset($item['summary'])) { ?>
                    <div class="gray_box">
                        <div class="box_header blue">Summary:</div>
                        <p><?php echo $item['summary'];?></p>
                    </div>
                    <?php } ?>
                    
                    <?php //Source ?>
                    <div class="gray_box">
                        <div class="box_header blue">Reported By:</div>
                        <div class="reported_by">
                            <div class="centered">
                                <img title="Reported By: <?php echo $item['engine'];?>" src="<?php echo base_url();?>images/sources/<?php echo $item['engine'];?>.png" />
                                <br /><br />
                                <?php echo $item['engine'];?>
                            </div>
                        </div>
                    </div>

                    <?php if(isset($item['related_links'])) { ?>
                    <?php //Related Links ?>
                    <div class="gray_box">
                        <div class="box_header blue">Related:</div>
                        <div class="related_links">
                            <p><?php echo $item['related_links'];?></p>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php //Definition ?>
                    <div class="gray_box">
                        <div class="box_header blue">Definition:</div>
                        <p>
                            <?php 
                                if(isset($item['description'])) {
                                    echo $item['description'];
                                } else {
                                    echo "There is no current definition available at this time.";
                                }
                            ?>
                        </p>
                    </div>
                    
                    <?php //Additional Details ?>
                    <?php if(isset($item['additional_details'])) { ?>
                    <div class="gray_box">
                        <div class="box_header blue">Additional Details:</div>
                        <p><?php echo strip_quotes($item['additional_details']);?></p>
                    </div>
                    <?php } ?>
                    
                    
                    <?php if(isset($item['repair'])) { ?>
                    <div class="gray_box">
                        <div class="box_header blue">Repair:</div>
                        <p><?php echo $item['repair'];?></p> 
                    </div>
                    <?php } ?>
                    
                    <div class="gray_box">
                        <div class="box_header blue">Risk:</div>
                        <p>There are no Risk assessments at this time.</p>
                    </div>

                </div>
                <?php } else { ?>
                    <div class="white_box">
                        <div class="virus_title">
                            <?php echo ucwords(str_replace('/view/', '', $_SERVER['REQUEST_URI']));?>
                        </div>
                    </div>
                    <div class="gray_box">
                        <div class="small_virus_title"><?php echo ucwords(str_replace('/view/', '', $_SERVER['REQUEST_URI']));?></div>
                    </div>
                    <div class="gray_box">
                        <div class="box_header blue">Definition:</div>
                        <p><?php echo "There is no current definition available at this time.";?></p>
                    </div>
                <?php } ?>
                
                
                <?php //Comments Tab ?>
                <div id="content_2" class="tabbed_content">
                    <div class="white_box">
                        <div class="virus_title">
                            <?php
                                if(isset($item['alias'])) {
                                    echo urldecode($item['alias']);
                                } else {
                                    echo ucwords(str_replace('/view/', '', $_SERVER['REQUEST_URI']));
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="gray_box">
                        <div class="box_header blue">Comments:</div>
                        <ul id="comments_list">
                            <?php if(count($comments) > 0) { $i=1; ?>
                                <?php foreach($comments as $comment) { ?>
                                <?php if($i %2) {
                                        $class='odd';
                                    } else {
                                        $class='even';
                                    } 
                                ?>
                                <li class="row <?php echo $class;?>">
                                    <div class="two_cols">By: <?php echo ucwords($comment['created_by']);?></div>
                                    <div class="two_cols">Date: <?php echo $comment['created_date'];?></div>
                                    <div class="one_col"><?php echo $comment['comment'];?></div>
                                </li>
                                <?php $i++; } ?>
                            <?php } else { ?>
                                <li class="row">There are no comments at this time.</li>
                            <?php } ?>
                        </ul>
                    </div>
                    
                    <?php if(isset($username) && $username != '') { ;?>
                    <div class="white_box">
                        <div class="virus_title">Submit a Comment</div>
                    </div>
                    <div class="gray_box">
                        <?php echo form_open_multipart('home/add_comment/' . $item['id'], array('id' => 'add_comment_form')); ?>

                        <div class="row">
                            <label>Comment:</label>
                            <textarea id="user_comment" name="user_comment"></textarea>
                        </div>

                        <div class="row" style="text-align: center; margin-top: 20px;">
                            <input type="submit" name="submit" id="submit" value="Submit Comment" />
                        </div>

                        <?php echo form_close();?>
                    </div>
                    <?php } ?>
                </div>
                
                
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