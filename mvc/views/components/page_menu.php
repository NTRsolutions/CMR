        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?=base_url("uploads/images/".$this->session->userdata('photo')); 
                                ?>" class="img-circle" alt="User Image" />
                        </div>

                        <div class="pull-left info">
                            <?php
                                $name = $this->session->userdata("name");
                                if(strlen($name) > 11) {
                                   $name = substr($name, 0,11). ".."; 
                                }
                                echo "<p>".$name."</p>";
                            ?>
                            <a href="<?=base_url("profile/index")?>">
                                <i class="fa fa-hand-o-right color-green"></i>
                                <?=$this->lang->line($this->session->userdata("usertype"))?>
                            </a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php $usertype = $this->session->userdata("usertype"); ?>
                    <ul class="sidebar-menu">
                        <li>
                            <?php
                                echo anchor('dashboard/index', '<i class="fa fa-laptop"></i><span>'.$this->lang->line('menu_dashboard').'</span>'); 
                            ?>
                        </li>

                        <?php 
                            if($usertype == "Admin" || $usertype == "Teacher") {
                                echo '<li>';
                                    echo anchor('student/index', '<i class="fa icon-student"></i><span>'.$this->lang->line('menu_student').'</span>');
                                echo '</li>';
                            } 
                        ?>

                     

                        

                        <?php 
                            if($usertype == "Admin") {
                                echo '<li>';
                                    echo anchor('user/index', '<i class="fa fa-users"></i><span>'.$this->lang->line('menu_user').'</span>');
                                echo '</li>';
                            }
                        ?>
                        

												
												<?php 
                            if($usertype == "Admin" || $usertype == "Cleader" || $usertype == "Cmoderator" || $usertype == "pvc" || $usertype == "dlt") {
                                echo '<li>';
                                    echo anchor('faculty/index', '<i class="fa fa-sitemap"></i><span>'.$this->lang->line('menu_faculty').'</span>');
                                echo '</li>';
                            }
                        ?>


<?php 
                            if($usertype == "Admin" || $usertype == "Cleader" || $usertype == "Cmoderator" || $usertype == "pvc" || $usertype == "dlt") {
                                echo '<li>';
                                echo anchor('acayear/index', '<i class="fa fa-signal"></i><span>'.$this->lang->line('menu_acayear').'</span>');
                                echo '</li>';
                            } 
                        ?>
                      
											
											 <?php if($usertype == "Admin" || $usertype == "Cleader" || $usertype == "Cmoderator" || $usertype == "pvc" || $usertype == "dlt") { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-exam"></i> 
                                    <span><?=$this->lang->line('menu_course');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo anchor('course/index', '<i class="fa fa-pencil"></i><span>'.$this->lang->line('menu_course').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('coursesubmit/index', '<i class="fa fa-puzzle-piece"></i><span>'.$this->lang->line('menu_coursesubmit').'</span>'); ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>


                       
                       

                       


                        <?php if($usertype == "Admin") { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-mailandsmstop"></i> 
                                    <span><?=$this->lang->line('menu_mailandsms');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo anchor('mailandsmstemplate/index', '<i class="fa icon-template"></i><span>'.$this->lang->line('menu_mailandsmstemplate').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('mailandsms/index', '<i class="fa icon-mailandsms"></i><span>'.$this->lang->line('menu_mailandsms').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('smssettings/index', '<i class="fa fa-wrench"></i><span>'.$this->lang->line('menu_smssettings').'</span>'); ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                       

                        <?php 
                            if($this->session->userdata("usertype") == "Admin") {
                                echo '<li>';
                                    echo anchor('report/index', '<i class="fa fa-clipboard"></i><span>'.$this->lang->line('menu_report').'</span>');
                                echo '</li>';
                            }
                        ?>


  
                    </ul>
                    
                </section>
                <!-- /.sidebar -->
            </aside>