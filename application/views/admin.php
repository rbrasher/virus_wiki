<div id="content">
    <div id="projects_tabbed_box" class="tabbed_box">
        <div class="tabbed_area">
            <ul class="tabs">
                <!--<li><a href="#content_1" id="tab_1" class="active">Sources</a></li>
                <li><a href="#content_2" id="tab_2">Categories</a></li>-->
                <li><a href="#content_1" id="tab_1" class="active">Users</a></li>
                <li><a href="#content_2" id="tab_2">Error Log</a></li>
                <!--<li><a href="#content_4" id="tab_4">Re-Map Viruses</a></li>-->
            </ul>
            
            <div class="tabbed_container">
                <?php //Sources ?>
                <!--
                <div id="content_1" class="tabbed_content active">
                    <div class="white_box">
                        <div class="virus_title">Sources</div>
                    </div>
                    <div class="gray_box">
                        <ul id="sources_list">
                            <?php 
                                //if(count($sources) > 0) { $a=1; 
                                    //foreach($sources as $source) { 
                                    
                                        //if($a %2) { 
                                            //$source_class='odd';
                                        //} else {
                                            //$source_class='even';
                                        //}
                            ?>
                                    <li class="row <?php //echo $source_class;?>">
                                        <div class="five_cols" style="text-indent: 10px;"><?php //echo $source['id'];?></div>
                                        <div class="five_cols"><?php //echo $source['name'];?></div>
                                        <div class="five_cols"><?php //echo $source['website'];?></div>
                                        <div class="five_cols centered"><img src="../images/sources/<?php //echo $source['logo'];?>" title="<?php //echo $source['logo'];?>" /></div>
                                        <div class="five_cols controls">
                                            <a class="delete" title="Delete" href="admin/delete_source/<?php //echo $source['id'];?>"></a>
                                            <a class="edit" title="Edit" href="admin/edit_source/<?php //echo $source['id'];?>"></a>
                                        </div>
                                    </li>
                                    
                                <?php
                                    //$a++;
                                        //} 
                                    //} else { 
                                ?>
                                <li>No sources found.</li>
                            <?php //} ?> 
                        </ul>
                    </div>
                    <div class="white_box centered" style="margin: 10px 1%;">
                        <a class="black_btn" href="admin/add_source">Add New Source</a>
                    </div>
                </div>
                -->
                
                <?php //Categories ?>
                <!--
                <div id="content_2" class="tabbed_content">
                    <div class="white_box">
                        <div class="virus_title">Categories</div>
                    </div>
                    <div class="gray_box">
                        <ul id="categories_list">
                            <?php //if(count($categories) > 0) { 
                                    //$b=1;
                                    //foreach($categories as $category) { 
                                    
                                        //if($b %2) {
                                            //$cat_source = 'odd';
                                        //} else {
                                            //$cat_source = 'even';
                                        //}
                            ?>
                                    <li class="row <?php //echo $cat_source;?>">
                                        <div class="three_cols" style="text-indent: 10px;"><?php //echo $category['id'];?></div>
                                        <div class="three_cols"><?php //echo $category['name'];?></div>
                                        <div class="three_cols controls">
                                            <a class="delete" title="Delete Category" href="admin/delete_category/<?php //echo $category['id'];?>"></a>
                                            <a class="edit" title="Edit Category" href="admin/edit_category/<?php //echo $category['id'];?>"></a>
                                        </div>
                                    </li>
                                <?php
                                    //$b++;
                                    //} 
                                //} else { ?>
                                    <li class="row">No categories found.</li>
                            <?php //} ?>
                        </ul>
                    </div>
                    <div class="white_box centered" style="margin: 10px 1%;">
                        <a class="black_btn" href="admin/add_category">Add New Category</a>
                    </div>
                </div>
                -->
                
                <?php // Users ?>
                <div id="content_1" class="tabbed_content active">
                    <div class="white_box">
                        <div class="virus_title">Users</div>
                    </div>
                    <div class="gray_box">
                        <table id="users_table">
                            <tr class="even">
                                <th>ID</th>
                                <th>Last Name / First Name</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Actions</th>
                            </tr>
                            <?php $u = 1;?>
                            <?php foreach($users as $user) { ?>
                            <?php 
                                if($u %2) {
                                    $user_class = 'odd';
                                } else {
                                    $user_class = 'even';
                                }
                            ?>
                            <tr class="<?php echo $user_class;?>">
                                <td style="text-align: center;"><?php echo $user['id'];?></td>
                                <td style="text-indent: 5px;"><?php echo $user['last_name'] . ',' . $user['first_name'];?></td>
                                <td style="text-indent: 5px;"><?php echo $user['email_address'];?></td>
                                <td style="text-align: center;">
                                    <?php 
                                        if($user['admin'] == 1) {
                                            echo 'TRUE';
                                        } else {
                                            echo 'FALSE';
                                        }    
                                    ?>
                                </td>
                                <td style="width: 120px;">
                                    <a class="delete" title="Delete User" href="admin/delete_user/<?php echo $user['id'];?>"></a>
                                    <a class="edit" title="Edit User" href="admin/edit_user/<?php echo $user['id'];?>"></a>
                                </td>
                            </tr>
                            <?php $u++; } ?>
  
                        </table>
                        
                        <!--
                        <ul id="users_list">
                            <?php //if(count($users) > 0) { $u=1; ?>
                                <?php //foreach($users as $user) { ?>
                                <?php //if($u %2) {
                                    //$user_class = 'odd';
                                //} else {
                                    //$user_class = 'even';
                                //}
                                ?>
                                <li class="row <?php //echo $user_class;?>">
                                    <div class="five_cols" style="text-indent: 10px;"><?php //echo $user['id'];?></div>
                                    <div class="five_cols"><?php //echo $user['last_name'] . ', ' . $user['first_name'];?></div>
                                    <div class="five_cols"><?php //echo $user['email_address'];?></div>
                                    <div class="five_cols">
                                        <?php 
                                            //if($user['admin'] == 1) {
                                                //echo 'TRUE';
                                            //} else {
                                                //echo 'FALSE';
                                            //}    
                                        ?>
                                    </div>
                                    <div class="six_cols controls">
                                        <a class="delete" title="Delete User" href="admin/delete_user/<?php //echo $user['id'];?>"></a>
                                        <a class="edit" title="Edit User" href="admin/edit_user/<?php //echo $user['id'];?>"></a>
                                    </div>
                                </li>
                                <?php //$u++; } ?>
                            <?php //} else { ?>
                                <li class="row">No users found.</li>
                            <?php //} ?>
                        </ul>
                        -->
                        
                    </div>
                </div>
                
                
                <?php //Error Log ?>
                <div id="content_2" class="tabbed_content">
                    <div class="white_box">
                        <div class="virus_title">Error Log</div>
                    </div>
                    <div class="gray_box">
                        <?php
                            $errors = file_get_contents('applog.htm');
                            
                            if(strlen($errors) > 0) {
                                echo $errors;
                            } else {
                                echo '<p>There are no errors at the moment</p>';
                            }
                        ?>
                    </div>
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