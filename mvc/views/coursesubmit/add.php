
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-puzzle-piece"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("coursesubmit/index")?>"><?=$this->lang->line('menu_coursesubmit')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_coursesubmit')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8"> 
                <form class="form-horizontal" role="form" method="post">
                    <?php 
                        if(form_error('courseID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="courseID" class="col-sm-2 control-label">
                            <?=$this->lang->line("coursesubmit_name")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array();
                                $array[0] = $this->lang->line("coursesubmit_select_course");
                                foreach ($course as $course) {
                                    $array[$course->courseID] = $course->course;
                                }
                                echo form_dropdown("courseID", $array, set_value("courseID"), "id='courseID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('courseID'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('facultyID'))
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="facultyID" class="col-sm-2 control-label">
                            <?=$this->lang->line("coursesubmit_faculty")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array('0' => $this->lang->line("coursesubmit_select_faculty"));
                                foreach ($faculty as $classa) {
                                    $array[$classa->facultyID] = $classa->faculty;
                                }
                                echo form_dropdown("facultyID", $array, set_value("facultyID"), "id='facultyID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('facultyID'); ?>
                        </span>
                    </div>
										
										
										<?php 
                        if(form_error('acayearID'))
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="acayearID" class="col-sm-2 control-label">
                            <?=$this->lang->line("coursesubmit_acayear")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array('0' => $this->lang->line("coursesubmit_select_acayear"));
                                foreach ($acayear as $acayear) {
                                    $array[$acayear->acayearID] = $acayear->acayear;
                                }
                                echo form_dropdown("acayearID", $array, set_value("acayearID"), "id='acayearID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('acayearID'); ?>
                        </span>
                    </div>

                    

                   
                    <?php 
                        if(form_error('date')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="date" class="col-sm-2 control-label">
                            <?=$this->lang->line("coursesubmit_date")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="date" name="date" value="<?=set_value('date')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('date'); ?>
                        </span>
                    </div>

                 

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_coursesubmit")?>" >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#facultyID').change(function(event) {
    var facultyID = $(this).val();
    if(facultyID === '0') {
        $('#subjectID').val(0);
        $('#sectionID').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('coursesubmit/subjectcall')?>",
            data: "id=" + facultyID,
            dataType: "html",
            success: function(data) {
               $('#subjectID').html(data);
            }
        });

        $.ajax({
            type: 'POST',
            url: "<?=base_url('coursesubmit/sectioncall')?>",
            data: "id=" + facultyID,
            dataType: "html",
            success: function(data) {
               $('#sectionID').html(data);
            }
        });
    }
});

$('#date').datepicker();
$('#coursefrom').timepicker();
$('#courseto').timepicker();

</script>