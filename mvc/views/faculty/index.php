
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-pencil"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_faculty')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin") {
                ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('faculty/add') ?>">
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
                                <th class="col-lg-3"><?=$this->lang->line('faculty_name')?></th>
																<th class="col-lg-3"><?=$this->lang->line('faculty_code')?></th>
                                <th class="col-lg-3"><?=$this->lang->line('faculty_note')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($faculty)) {$i = 1; foreach($faculty as $faculty) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('faculty_name')?>">
                                        <?php echo $faculty->faculty; ?>
                                    </td>
																		<td data-title="<?=$this->lang->line('faculty_code')?>">
                                        <?php echo $faculty->code; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('faculty_note')?>">
                                        <?php echo $faculty->note; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_edit('faculty/edit/'.$faculty->facultyID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('faculty/delete/'.$faculty->facultyID, $this->lang->line('delete')) ?>
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

