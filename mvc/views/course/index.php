
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-pencil"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_course')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin" || $usertype == "Cleader") {
                ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('course/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-lg-1"><?=$this->lang->line('slno')?></th>
                                <th class="col-lg-4"><?=$this->lang->line('course_name')?></th>
																<th class="col-lg-1"><?=$this->lang->line('course_code')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('course_date')?></th>
                                <th class="col-lg-3"><?=$this->lang->line('course_note')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($courses)) {$i = 1; foreach($courses as $course) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('course_name')?>">
                                        <?php echo $course->course; ?>
                                    </td>
																		<td data-title="<?=$this->lang->line('course_code')?>">
                                        <?php echo $course->code; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('course_date')?>">
                                        <?php echo date("d M Y", strtotime($course->date)); ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('course_note')?>">
                                        <?php echo $course->note; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_edit('course/edit/'.$course->courseID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('course/delete/'.$course->courseID, $this->lang->line('delete')) ?>
                                    </td>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>


            </div> <!-- col-sm-12 -->
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

