


<?php 
    $usertype = $this->session->userdata("usertype");
    if($usertype == "Admin") {
?>
  <div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box ">
            <a class="small-box-footer" href="<?=base_url('student')?>">
                <div class="icon bg-aqua" style="padding: 9.5px 18px 8px 18px;">
                    <i class="fa icon-student"></i>
                </div>
                <div class="inner ">
                    <h3>
                        <?=count($student)?>
                    </h3>
                    <p>
                        <?=$this->lang->line("menu_student")?>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box ">
            <a class="small-box-footer" href="<?=base_url('teacher')?>">
                <div class="icon bg-red" style="padding: 9.5px 18px 8px 18px;">
                    <i class="fa fa-user"></i>
                </div>
                <div class="inner ">
                    <h3>
                        <?=count($teacher)?>
                    </h3>
                    <p>
                        <?=$this->lang->line("menu_teacher")?>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box ">
            <a class="small-box-footer" href="<?=base_url('parentes')?>">
                <div class="icon bg-yellow">
                    <i class="fa fa-user"></i>
                </div>
                <div class="inner ">
                    <h3>
                        <?=count($parents)?>
                    </h3>
                    <p>
                        <?=$this->lang->line("menu_cmoderator")?>
                    </p>
                </div>
            </a>
        </div>
    </div>
		
		 <div class="col-lg-3 col-xs-6">
        <div class="small-box ">
            <a class="small-box-footer" href="<?=base_url('parentes')?>">
                <div class="icon bg-yellow">
                    <i class="fa fa-book"></i>
                </div>
                <div class="inner ">
                    <h3>
                        <?=count($parents)?>
                    </h3>
                    <p>
                        <?=$this->lang->line("menu_course")?>
                    </p>
                </div>
            </a>
        </div>
    </div>


  </div>



 
  <div class="row"> 
    <div class="col-sm-4">
      <?php if(count($user)) { ?>
        <section class="panel">
          <div class="profile-db-head">
            <a href="<?=base_url('profile/index')?>">
              <?=img(base_url('uploads/images/'.$user->photo));?>
            </a>

            <h1><?=$user->name?></h1>
            <p><?=$this->lang->line($user->usertype)?></p>

          </div>
          <table class="table table-hover">
              <tbody>
                  <tr>
                    <td>
                      <i class="glyphicon glyphicon-user" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_username')?></td>
                    <td><?=$user->username?></td>
                  </tr>
                  <tr>
                      <td>
                        <i class="fa fa-envelope" style="color:#FDB45C;"></i>
                      </td>
                      <td><?=$this->lang->line('dashboard_email')?></td>
                    <td><?=$user->email?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class="fa fa-phone" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_phone')?></td>
                    <td><?=$user->phone?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class=" fa fa-globe" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_address')?></td>
                    <td><?=$user->address?></td>
                  </tr>
              </tbody>
          </table>
        </section>
      <?php } ?>
    </div>

    <div class="col-sm-8">
      <div class="box">
        <div class="box-header" style="background-color:#FDB45C;">
          <h3 class="box-title">
              <?=$this->lang->line('dashboard_notice')?>
            </h3>
        </div>

        <div class="box-body" style="padding: 0px;">
          <table class="table table-hover">
              <tbody>
                <?php 

                  if(count($notices)) {
                    $i =1;
                    foreach ($notices as $key => $notice) {
                      if($i != 8) {
                        echo "<tr>";
                          echo "<td>";
                            echo $i;
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->title) > 20) {
                               $title = substr($notice->title, 0,20). ".."; 
                            } else {
                                $title = $notice->title;
                            }
                            echo strip_tags($title);
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->notice) > 80) {
                              $discription = substr($notice->notice, 0,80). ".."; 
                            } else {
                                $discription = $notice->notice;
                            }
                            echo strip_tags($discription);
                          echo "</td>";

                          echo "<td>";
                            echo btn_dash_view('notice/view/'.$notice->noticeID, $this->lang->line('view'));
                          echo "</td>";
                        echo "</tr>";
                        $i++;
                      } else {
                        break;
                      }
                      
                    }
                  }


                ?>
              </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>
<?php } elseif($usertype == "Teacher") { ?>
  <div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box ">
            <a class="small-box-footer" href="<?=base_url('student')?>">
                <div class="icon bg-aqua" style="padding: 9.5px 18px 8px 18px;">
                    <i class="fa icon-student"></i>
                </div>
                <div class="inner ">
                    <h3>
                        <?=count($student)?>
                    </h3>
                    <p>
                        <?=$this->lang->line("menu_student")?>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('teacher')?>">
              <div class="icon bg-red" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-teacher"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=count($teacher)?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_teacher")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('subject')?>">
              <div class="icon bg-yellow" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-subject"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=count($subject)?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_subject")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('sattendance')?>">
              <div class="icon bg-blue" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-attendance"></i>
              </div>
              <div class="inner ">
                <h3>
                    <?=count($attendance)?>
                </h3>
                <p>
                  <?=$this->lang->line("menu_attendance")?>
                </p>
              </div>
          </a>
      </div>
    </div>
  </div>

  <div class="row"> 
    <div class="col-sm-4">
      <?php if(count($user)) { ?>

        <section class="panel">
          <div class="profile-db-head">
            <a href="<?=base_url('profile/index')?>">
              <?=img(base_url('uploads/images/'.$user->photo));?>
            </a>

            <h1><?=$user->name?></h1>
            <p><?=$this->lang->line($user->usertype)?></p>

          </div>
          <table class="table table-hover">
              <tbody>
                  <tr>
                    <td>
                      <i class="glyphicon glyphicon-user" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_username')?></td>
                    <td><?=$user->username?></td>
                  </tr>
                  <tr>
                      <td>
                        <i class="fa fa-envelope" style="color:#FDB45C;"></i>
                      </td>
                      <td><?=$this->lang->line('dashboard_email')?></td>
                    <td><?=$user->email?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class="fa fa-phone" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_phone')?></td>
                    <td><?=$user->phone?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class=" fa fa-globe" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_address')?></td>
                    <td><?=$user->address?></td>
                  </tr>
              </tbody>
          </table>
        </section>
      <?php } ?>
    </div>


    <div class="col-sm-8">
      <div class="box">
        <div class="box-header" style="background-color:#FDB45C;">
          <h3 class="box-title">
              <?=$this->lang->line('dashboard_notice')?>
            </h3>
        </div>

        <div class="box-body" style="padding: 0px;">
          <table class="table table-hover">
              <tbody>
                <?php 

                  if(count($notices)) {
                    $i =1;
                    foreach ($notices as $key => $notice) {
                      if($i != 8) {
                        echo "<tr>";
                          echo "<td>";
                            echo $i;
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->title) > 20) {
                               $title = substr($notice->title, 0,20). ".."; 
                            } else {
                                $title = $notice->title;
                            }
                            echo strip_tags($title);
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->notice) > 80) {
                              $discription = substr($notice->notice, 0,80). ".."; 
                            } else {
                                $discription = $notice->notice;
                            }
                            echo strip_tags($discription);
                          echo "</td>";

                          echo "<td>";
                            echo btn_dash_view('notice/view/'.$notice->noticeID, $this->lang->line('view'));
                          echo "</td>";
                        echo "</tr>";
                        $i++;
                      } else {
                        break;
                      }
                      
                    }
                  }


                ?>
              </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  <script type="text/javascript" src="<?php echo base_url('assets/fullcalendar/fullcalendar.min.js'); ?>"></script>

  <script type="text/javascript">
    $(function() {
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'prev,next'
            },
            buttonText: {//This is to add icons to the visible buttons
                prev: "<span class='fa fa-caret-left'></span>",
                next: "<span class='fa fa-caret-right'></span>",
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            }
        });
    });
  </script>

<?php } elseif($usertype == "Accountant") { ?>
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('teacher')?>">
              <div class="icon bg-aqua" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-teacher"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=count($teacher)?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_teacher")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('feetype')?>">
              <div class="icon bg-yellow" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-feetype"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=count($feetype)?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_feetype")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box ">
            <a class="small-box-footer" href="<?=base_url('invoice')?>">
                <div class="icon bg-red" style="padding: 9.5px 18px 8px 18px;">
                    <i class="fa icon-invoice"></i>
                </div>
                <div class="inner ">
                    <h3>
                        <?=count($invoice)?>
                    </h3>
                    <p>
                        <?=$this->lang->line("menu_invoice")?>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('expense')?>">
              <div class="icon bg-blue" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-expense"></i>
              </div>
              <div class="inner ">
                <h3>
                    <?=count($expense)?>
                </h3>
                <p>
                  <?=$this->lang->line("menu_expense")?>
                </p>
              </div>
          </a>
      </div>
    </div>
  </div>

  <div class="row"> 
    <div class="col-sm-4">
      <?php if(count($user)) { ?>
        <section class="panel">
          <div class="profile-db-head">
            <a href="<?=base_url('profile/index')?>">
              <?=img(base_url('uploads/images/'.$user->photo));?>
            </a>

            <h1><?=$user->name?></h1>
            <p><?=$this->lang->line($user->usertype)?></p>

          </div>
          <table class="table table-hover">
              <tbody>
                  <tr>
                    <td>
                      <i class="glyphicon glyphicon-user" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_username')?></td>
                    <td><?=$user->username?></td>
                  </tr>
                  <tr>
                      <td>
                        <i class="fa fa-envelope" style="color:#FDB45C;"></i>
                      </td>
                      <td><?=$this->lang->line('dashboard_email')?></td>
                    <td><?=$user->email?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class="fa fa-phone" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_phone')?></td>
                    <td><?=$user->phone?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class=" fa fa-globe" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_address')?></td>
                    <td><?=$user->address?></td>
                  </tr>
              </tbody>
          </table>
        </section>
      <?php } ?>
    </div>

    <div class="col-sm-8">
      <div class="box">
        <div class="box-header" style="background-color:#FDB45C;">
          <h3 class="box-title">
              <?=$this->lang->line('dashboard_notice')?>
            </h3>
        </div>

        <div class="box-body" style="padding: 0px;">
          <table class="table table-hover">
              <tbody>
                <?php 

                  if(count($notices)) {
                    $i =1;
                    foreach ($notices as $key => $notice) {
                      if($i != 8) {
                        echo "<tr>";
                          echo "<td>";
                            echo $i;
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->title) > 20) {
                               $title = substr($notice->title, 0,20). ".."; 
                            } else {
                                $title = $notice->title;
                            }
                            echo strip_tags($title);
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->notice) > 80) {
                              $discription = substr($notice->notice, 0,80). ".."; 
                            } else {
                                $discription = $notice->notice;
                            }
                            echo strip_tags($discription);
                          echo "</td>";

                          echo "<td>";
                            echo btn_dash_view('notice/view/'.$notice->noticeID, $this->lang->line('view'));
                          echo "</td>";
                        echo "</tr>";
                        $i++;
                      } else {
                        break;
                      }
                      
                    }
                  }


                ?>
              </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  <script type="text/javascript" src="<?php echo base_url('assets/fullcalendar/fullcalendar.min.js'); ?>"></script>

  <script type="text/javascript">
    $(function() {
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'prev,next'
            },
            buttonText: {//This is to add icons to the visible buttons
                prev: "<span class='fa fa-caret-left'></span>",
                next: "<span class='fa fa-caret-right'></span>",
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            }
        });
    });
  </script>
<?php } elseif($usertype == "Librarian") { ?>
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('teacher')?>">
              <div class="icon bg-aqua" style="padding: 9.5px 22px 8px 22px;">
                  <i class="fa icon-teacher"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=count($teacher)?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_teacher")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box ">
            <a class="small-box-footer" href="<?=base_url('lmember')?>">
                <div class="icon bg-red" style="padding: 9.5px 22px 8px 22px;">
                    <i class="fa icon-member"></i>
                </div>
                <div class="inner ">
                    <h3>
                        <?=count($lmember)?>
                    </h3>
                    <p>
                        <?=$this->lang->line("menu_member")?>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('book')?>">
              <div class="icon bg-yellow" style="padding: 9.5px 22px 8px 22px;">
                  <i class="fa icon-lbooks"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=count($book)?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_books")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('issue')?>">
              <div class="icon bg-blue" style="padding: 9.5px 22px 8px 22px;">
                  <i class="fa icon-issue"></i>
              </div>
              <div class="inner ">
                <h3>
                    <?=count($issue)?>
                </h3>
                <p>
                  <?=$this->lang->line("menu_issue")?>
                </p>
              </div>
          </a>
      </div>
    </div>
  </div>

  <div class="row"> 
    <div class="col-sm-4">
      <?php if(count($user)) { ?>
        <section class="panel">
          <div class="profile-db-head">
            <a href="<?=base_url('profile/index')?>">
              <?=img(base_url('uploads/images/'.$user->photo));?>
            </a>

            <h1><?=$user->name?></h1>
            <p><?=$this->lang->line($user->usertype)?></p>

          </div>
          <table class="table table-hover">
              <tbody>
                  <tr>
                    <td>
                      <i class="glyphicon glyphicon-user" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_username')?></td>
                    <td><?=$user->username?></td>
                  </tr>
                  <tr>
                      <td>
                        <i class="fa fa-envelope" style="color:#FDB45C;"></i>
                      </td>
                      <td><?=$this->lang->line('dashboard_email')?></td>
                    <td><?=$user->email?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class="fa fa-phone" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_phone')?></td>
                    <td><?=$user->phone?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class=" fa fa-globe" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_address')?></td>
                    <td><?=$user->address?></td>
                  </tr>
              </tbody>
          </table>
        </section>
      <?php } ?>
    </div>

    <div class="col-sm-8">
      <div class="box">
        <div class="box-header" style="background-color:#FDB45C;">
          <h3 class="box-title">
              <?=$this->lang->line('dashboard_notice')?>
            </h3>
        </div>

        <div class="box-body" style="padding: 0px;">
          <table class="table table-hover">
              <tbody>
                <?php 

                  if(count($notices)) {
                    $i =1;
                    foreach ($notices as $key => $notice) {
                      if($i != 8) {
                        echo "<tr>";
                          echo "<td>";
                            echo $i;
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->title) > 20) {
                               $title = substr($notice->title, 0,20). ".."; 
                            } else {
                                $title = $notice->title;
                            }
                            echo strip_tags($title);
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->notice) > 80) {
                              $discription = substr($notice->notice, 0,80). ".."; 
                            } else {
                                $discription = $notice->notice;
                            }
                            echo strip_tags($discription);
                          echo "</td>";

                          echo "<td>";
                            echo btn_dash_view('notice/view/'.$notice->noticeID, $this->lang->line('view'));
                          echo "</td>";
                        echo "</tr>";
                        $i++;
                      } else {
                        break;
                      }
                      
                    }
                  }


                ?>
              </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  <script type="text/javascript" src="<?php echo base_url('assets/fullcalendar/fullcalendar.min.js'); ?>"></script>

  <script type="text/javascript">
    $(function() {
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'prev,next'
            },
            buttonText: {//This is to add icons to the visible buttons
                prev: "<span class='fa fa-caret-left'></span>",
                next: "<span class='fa fa-caret-right'></span>",
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            }
        });
    });
  </script>

<?php } elseif($usertype == "Student") { ?>
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('teacher')?>">
              <div class="icon bg-aqua" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-teacher"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=count($teacher)?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_teacher")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box ">
            <a class="small-box-footer" href="<?=base_url('subject')?>">
                <div class="icon bg-red" style="padding: 9.5px 18px 8px 18px;">
                    <i class="fa icon-subject"></i>
                </div>
                <div class="inner ">
                    <h3>
                        <?=count($subject)?>
                    </h3>
                    <p>
                        <?=$this->lang->line("menu_subject")?>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('issue')?>">
              <div class="icon bg-yellow" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-issue"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=count($issue)?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_issue")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('invoice')?>">
              <div class="icon bg-blue" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-invoice"></i>
              </div>
              <div class="inner ">
                <h3>
                    <?=count($invoice)?>
                </h3>
                <p>
                  <?=$this->lang->line("menu_invoice")?>
                </p>
              </div>
          </a>
      </div>
    </div>
  </div>

  <div class="row"> 
    <div class="col-sm-4">
      <?php if(count($user)) { ?>
        <section class="panel">
          <div class="profile-db-head">
            <a href="<?=base_url('profile/index')?>">
              <?=img(base_url('uploads/images/'.$user->photo));?>
            </a>

            <h1><?=$user->name?></h1>
            <p><?=$this->lang->line($user->usertype)?></p>

          </div>
          <table class="table table-hover">
              <tbody>
                  <tr>
                    <td>
                      <i class="glyphicon glyphicon-user" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_username')?></td>
                    <td><?=$user->username?></td>
                  </tr>
                  <tr>
                      <td>
                        <i class="fa fa-envelope" style="color:#FDB45C;"></i>
                      </td>
                      <td><?=$this->lang->line('dashboard_email')?></td>
                    <td><?=$user->email?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class="fa fa-phone" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_phone')?></td>
                    <td><?=$user->phone?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class=" fa fa-globe" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_address')?></td>
                    <td><?=$user->address?></td>
                  </tr>
              </tbody>
          </table>
        </section>
      <?php } ?>
    </div>

    <div class="col-sm-8">
      <div class="box">
        <div class="box-header" style="background-color:#FDB45C;">
          <h3 class="box-title">
              <?=$this->lang->line('dashboard_notice')?>
            </h3>
        </div>

        <div class="box-body" style="padding: 0px;">
          <table class="table table-hover">
              <tbody>
                <?php 

                  if(count($notices)) {
                    $i =1;
                    foreach ($notices as $key => $notice) {
                      if($i != 8) {
                        echo "<tr>";
                          echo "<td>";
                            echo $i;
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->title) > 20) {
                               $title = substr($notice->title, 0,20). ".."; 
                            } else {
                                $title = $notice->title;
                            }
                            echo strip_tags($title);
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->notice) > 80) {
                              $discription = substr($notice->notice, 0,80). ".."; 
                            } else {
                                $discription = $notice->notice;
                            }
                            echo strip_tags($discription);
                          echo "</td>";

                          echo "<td>";
                            echo btn_dash_view('notice/view/'.$notice->noticeID, $this->lang->line('view'));
                          echo "</td>";
                        echo "</tr>";
                        $i++;
                      } else {
                        break;
                      }
                      
                    }
                  }


                ?>
              </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  <script type="text/javascript" src="<?php echo base_url('assets/fullcalendar/fullcalendar.min.js'); ?>"></script>

  <script type="text/javascript">
    $(function() {
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'prev,next'
            },
            buttonText: {//This is to add icons to the visible buttons
                prev: "<span class='fa fa-caret-left'></span>",
                next: "<span class='fa fa-caret-right'></span>",
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            }
        });
    });
  </script>

<?php } elseif($usertype == "Parent") { ?>
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('teacher')?>">
              <div class="icon bg-aqua" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-teacher"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=count($teacher)?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_teacher")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box ">
            <a class="small-box-footer" href="<?=base_url('book')?>">
                <div class="icon bg-red" style="padding: 9.5px 18px 8px 18px;">
                    <i class="fa icon-lbooks"></i>
                </div>
                <div class="inner ">
                    <h3>
                        <?=count($books)?>
                    </h3>
                    <p>
                        <?=$this->lang->line("menu_books")?>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('issue')?>">
              <div class="icon bg-yellow" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-issue"></i>
              </div>
              <div class="inner ">
                  <h3>
                      <?=$issue?>
                  </h3>
                  <p>
                      <?=$this->lang->line("menu_issue")?>
                  </p>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box ">
          <a class="small-box-footer" href="<?=base_url('invoice')?>">
              <div class="icon bg-blue" style="padding: 9.5px 18px 8px 18px;">
                  <i class="fa icon-invoice"></i>
              </div>
              <div class="inner ">
                <h3>
                    <?=$invoice?>
                </h3>
                <p>
                  <?=$this->lang->line("menu_invoice")?>
                </p>
              </div>
          </a>
      </div>
    </div>
  </div>

  <div class="row"> 
    <div class="col-sm-4">
      <?php if(count($user)) { ?>
        <section class="panel">
          <div class="profile-db-head">
            <a href="<?=base_url('profile/index')?>">
              <?=img(base_url('uploads/images/'.$user->photo));?>
            </a>

            <h1><?=$user->name?></h1>
            <p><?=$this->lang->line($user->usertype)?></p>

          </div>
          <table class="table table-hover">
              <tbody>
                  <tr>
                    <td>
                      <i class="glyphicon glyphicon-user" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_username')?></td>
                    <td><?=$user->username?></td>
                  </tr>
                  <tr>
                      <td>
                        <i class="fa fa-envelope" style="color:#FDB45C;"></i>
                      </td>
                      <td><?=$this->lang->line('dashboard_email')?></td>
                    <td><?=$user->email?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class="fa fa-phone" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_phone')?></td>
                    <td><?=$user->phone?></td>
                  </tr>
                  <tr>
                    <td>
                      <i class=" fa fa-globe" style="color:#FDB45C;"></i>
                    </td>
                    <td><?=$this->lang->line('dashboard_address')?></td>
                    <td><?=$user->address?></td>
                  </tr>
              </tbody>
          </table>
        </section>
      <?php } ?>
    </div>

    <div class="col-sm-8">
      <div class="box">
        <div class="box-header" style="background-color:#FDB45C;">
          <h3 class="box-title">
              <?=$this->lang->line('dashboard_notice')?>
            </h3>
        </div>

        <div class="box-body" style="padding: 0px;">
          <table class="table table-hover">
              <tbody>
                <?php 

                  if(count($notices)) {
                    $i =1;
                    foreach ($notices as $key => $notice) {
                      if($i != 8) {
                        echo "<tr>";
                          echo "<td>";
                            echo $i;
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->title) > 20) {
                               $title = substr($notice->title, 0,20). ".."; 
                            } else {
                                $title = $notice->title;
                            }
                            echo strip_tags($title);
                          echo "</td>";

                          echo "<td>";
                            if(strlen($notice->notice) > 80) {
                              $discription = substr($notice->notice, 0,80). ".."; 
                            } else {
                                $discription = $notice->notice;
                            }
                            echo strip_tags($discription);
                          echo "</td>";

                          echo "<td>";
                            echo btn_dash_view('notice/view/'.$notice->noticeID, $this->lang->line('view'));
                          echo "</td>";
                        echo "</tr>";
                        $i++;
                      } else {
                        break;
                      }
                      
                    }
                  }


                ?>
              </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  <script type="text/javascript" src="<?php echo base_url('assets/fullcalendar/fullcalendar.min.js'); ?>"></script>

  <script type="text/javascript">
    $(function() {
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'prev,next'
            },
            buttonText: {//This is to add icons to the visible buttons
                prev: "<span class='fa fa-caret-left'></span>",
                next: "<span class='fa fa-caret-right'></span>",
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            }
        });
    });
  </script>

<?php } ?>

