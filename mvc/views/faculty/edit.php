
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-pencil"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("faculty/index")?>"><?=$this->lang->line('menu_faculty')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_faculty')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post">
                    <?php 
                        if(form_error('faculty')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="faculty" class="col-sm-2 control-label">
                            <?=$this->lang->line("faculty_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="faculty" name="faculty" value="<?=set_value('faculty', $faculty->faculty)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('faculty'); ?>
                        </span>
                    </div>

                   <?php 
                        if(form_error('code')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="faculty" class="col-sm-2 control-label">
                            <?=$this->lang->line("faculty_code")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="faculty" name="code" value="<?=set_value('code', $faculty->code)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('code'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('note')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="note" class="col-sm-2 control-label">
                            <?=$this->lang->line("faculty_note")?>
                        </label>
                        <div class="col-sm-6">
                            <textarea style="resize:none;" class="form-control" id="note" name="note"><?=set_value('note', $faculty->note)?></textarea>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('note'); ?>
                        </span>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_faculty")?>" >
                        </div>
                    </div>

                </form>
            </div>    
        </div>
    </div>
</div>

<script type="text/javascript">
$('#date').datepicker();
</script>
