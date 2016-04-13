
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-puzzle-piece"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_coursesubmit')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin" || $usertype == "Cleader" || $usertype == "Cmoderator" || $usertype == "Dlt") {
                        if($usertype == "Admin") {
                ?>
                <h5 class="page-header">
                    <a href="<?php echo base_url('coursesubmit/add') ?>">
                        <i class="fa fa-plus"></i> 
                        <?=$this->lang->line('add_title')?>
                    </a>
                </h5>
                <?php }  ?>

                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post">  
                            <div class="form-group">              
                                <label for="facultyID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("coursesubmit_faculty")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("coursesubmit_select_faculty"));
                                        foreach ($faculty as $classa) {
                                            $array[$classa->facultyID] = $classa->faculty;
                                        }
                                        echo form_dropdown("facultyID", $array, set_value("facultyID", $set), "id='facultyID' class='form-control'");
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <?php if(count($coursesubmits) > 0 ) { ?>

                    <div class="col-sm-12">

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("coursesubmit_all_coursesubmit")?></a></li>
                                <?php foreach ($sections as $key => $section) {
                                    echo '<li class=""><a data-toggle="tab" href="#'. $section->sectionID .'" aria-expanded="false">'. $this->lang->line("student_section")." ".$section->section. " ( ". $section->category." )".'</a></li>';
                                } ?>
                            </ul>



                            <div class="tab-content">
                                <div id="all" class="tab-pane active">

                                    <div id="hide-table">
                                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th><?=$this->lang->line('slno')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_name')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_faculty')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_acayear')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_course')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_date')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_time')?></th>
                                                    <?php if($usertype == "Admin") { ?>
                                                    <th><?=$this->lang->line('action')?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($coursesubmits)) {$i = 1; foreach($coursesubmits as $coursesubmit) { ?>
                                                    <tr>
                                                        <td data-title="<?=$this->lang->line('slno')?>">
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('coursesubmit_name')?>">
                                                            <?php echo $coursesubmit->exam; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('coursesubmit_faculty')?>">
                                                            <?php echo $coursesubmit->faculty; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('coursesubmit_section')?>">
                                                            <?php echo $coursesubmit->section; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('coursesubmit_subject')?>">
                                                            <?php echo $coursesubmit->subject; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('coursesubmit_time')?>">
                                                            <?php echo date("d M Y", strtotime($coursesubmit->edate)); ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('coursesubmit_time')?>">
                                                            <?php echo $coursesubmit->examfrom, " - ", $coursesubmit->examto ; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('coursesubmit_room')?>">
                                                            <?php echo $coursesubmit->room; ?>
                                                        </td>

                                                        <?php if($usertype == "Admin") { ?>
                                                        <td data-title="<?=$this->lang->line('action')?>">
                                                            <?php echo btn_edit('coursesubmit/edit/'.$coursesubmit->coursesubmitID."/".$set, $this->lang->line('edit')) ?>
                                                            <?php echo btn_delete('coursesubmit/delete/'.$coursesubmit->coursesubmitID."/".$set, $this->lang->line('delete')) ?>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php $i++; }} ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <?php foreach ($sections as $key => $section) { ?>
                                        <div id="<?=$section->sectionID?>" class="tab-pane">
                                            
                                            <div id="hide-table">
                                                <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th><?=$this->lang->line('slno')?></th>
                                                            <th><?=$this->lang->line('coursesubmit_name')?></th>
                                                            <th><?=$this->lang->line('coursesubmit_faculty')?></th>
                                                            <th><?=$this->lang->line('coursesubmit_subject')?></th>
                                                            <th><?=$this->lang->line('coursesubmit_date')?></th>
                                                            <th><?=$this->lang->line('coursesubmit_time')?></th>
                                                            <th><?=$this->lang->line('coursesubmit_room')?></th>
                                                            <?php if($usertype == "Admin") { ?>
                                                            <th><?=$this->lang->line('action')?></th>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(count($allsection[$section->section])) {$i = 1; foreach($allsection[$section->section] as $coursesubmit) { ?>
                                                            <tr>
                                                                <td data-title="<?=$this->lang->line('slno')?>">
                                                                    <?php echo $i; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('coursesubmit_name')?>">
                                                                    <?php echo $coursesubmit->exam; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('coursesubmit_faculty')?>">
                                                                    <?php echo $coursesubmit->faculty; ?>
                                                                </td>
            
                                                                <td data-title="<?=$this->lang->line('coursesubmit_subject')?>">
                                                                    <?php echo $coursesubmit->subject; ?>
                                                                </td>

                                                                <td data-title="<?=$this->lang->line('coursesubmit_time')?>">
                                                                    <?php echo date("d M Y", strtotime($coursesubmit->edate)); ?>
                                                                </td>

                                                                <td data-title="<?=$this->lang->line('coursesubmit_time')?>">
                                                                    <?php echo $coursesubmit->examfrom, " - ", $coursesubmit->examto ; ?>
                                                                </td>

                                                                <td data-title="<?=$this->lang->line('coursesubmit_room')?>">
                                                                    <?php echo $coursesubmit->room; ?>
                                                                </td>

                                                                <?php if($usertype == "Admin") { ?>
                                                                <td data-title="<?=$this->lang->line('action')?>">
                                                                    <?php echo btn_edit('coursesubmit/edit/'.$coursesubmit->coursesubmitID."/".$set, $this->lang->line('edit')) ?>
                                                                    <?php echo btn_delete('coursesubmit/delete/'.$coursesubmit->coursesubmitID."/".$set, $this->lang->line('delete')) ?>
                                                                </td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php $i++; }} ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                <?php } ?>
                            </div>

                        </div> <!-- nav-tabs-custom -->
                    </div> <!-- col-sm-12 for tab -->

                <?php } else { ?>
                    <div class="col-sm-12">

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("coursesubmit_all_coursesubmit")?></a></li>
                            </ul>


                            <div class="tab-content">
                                <div id="all" class="tab-pane active">
                                    <div id="hide-table">
                                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th><?=$this->lang->line('slno')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_name')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_faculty')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_section')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_subject')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_date')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_time')?></th>
                                                    <th><?=$this->lang->line('coursesubmit_room')?></th>
                                                    <?php if($usertype == "Admin") { ?>
                                                    <th><?=$this->lang->line('action')?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($coursesubmits)) {$i = 1; foreach($coursesubmits as $coursesubmit) { ?>
                                                    <tr>
                                                        <td data-title="<?=$this->lang->line('slno')?>">
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('coursesubmit_name')?>">
                                                            <?php echo $coursesubmit->exam; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('coursesubmit_faculty')?>">
                                                            <?php echo $coursesubmit->faculty; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('coursesubmit_section')?>">
                                                            <?php echo $coursesubmit->section; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('coursesubmit_subject')?>">
                                                            <?php echo $coursesubmit->subject; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('coursesubmit_time')?>">
                                                            <?php echo date("d M Y", strtotime($coursesubmit->edate)); ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('coursesubmit_time')?>">
                                                            <?php echo $coursesubmit->examfrom, " - ", $coursesubmit->examto ; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('coursesubmit_room')?>">
                                                            <?php echo $coursesubmit->room; ?>
                                                        </td>

                                                        <?php if($usertype == "Admin") { ?>
                                                        <td data-title="<?=$this->lang->line('action')?>">
                                                            <?php echo btn_edit('coursesubmit/edit/'.$coursesubmit->coursesubmitID."/".$set, $this->lang->line('edit')) ?>
                                                            <?php echo btn_delete('coursesubmit/delete/'.$coursesubmit->coursesubmitID."/".$set, $this->lang->line('delete')) ?>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php $i++; }} ?>
                                            </tbody>
                                        </table>
                                    </div>    

                                </div>
                            </div>
                        </div> <!-- nav-tabs-custom -->
                    </div>
                <?php } ?>


                <?php } elseif($usertype == "Student" || $usertype == "Parent") { ?>
                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th><?=$this->lang->line('slno')?></th>
                                <th><?=$this->lang->line('coursesubmit_name')?></th>
                                <th><?=$this->lang->line('coursesubmit_faculty')?></th>
                                <th><?=$this->lang->line('coursesubmit_subject')?></th>
                                <th><?=$this->lang->line('coursesubmit_date')?></th>
                                <th><?=$this->lang->line('coursesubmit_time')?></th>
                                <th><?=$this->lang->line('coursesubmit_room')?></th>
                                <?php if($usertype == "Admin") { ?>
                                <th><?=$this->lang->line('action')?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($coursesubmits)) {$i = 1; foreach($coursesubmits as $coursesubmit) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('coursesubmit_name')?>">
                                        <?php echo $coursesubmit->exam; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('coursesubmit_faculty')?>">
                                        <?php echo $coursesubmit->faculty; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('coursesubmit_subject')?>">
                                        <?php echo $coursesubmit->subject; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('coursesubmit_time')?>">
                                        <?php echo date("d M Y", strtotime($coursesubmit->edate)); ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('coursesubmit_time')?>">
                                        <?php echo $coursesubmit->examfrom, " - ", $coursesubmit->examto ; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('coursesubmit_room')?>">
                                        <?php echo $coursesubmit->room; ?>
                                    </td>

                                    <?php if($usertype == "Admin") { ?>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_edit('coursesubmit/edit/'.$coursesubmit->coursesubmitID."/".$set, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('coursesubmit/delete/'.$coursesubmit->coursesubmitID."/".$set, $this->lang->line('delete')) ?>
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>

            </div> <!-- col-sm-12 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
    

<script type="text/javascript">
    $('#facultyID').change(function() {
        var facultyID = $(this).val();
        if(facultyID == 0) {
            $('#hide-table').hide();
            $('.nav-tabs-custom').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('coursesubmit/coursesubmit_list')?>",
                data: "id=" + facultyID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>
