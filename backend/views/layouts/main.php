<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
$this->title = 'Techelm | Dashboard';
?>

<?php $this->beginPage() ?>
<a href="#"></a>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php  $this->head() ?>
    <!-- CSS -->
    <!-- id="bs-css"  -->
    <link href="assets/bootstrap/dashboard/css/bootstrap-cerulean.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/css/charisma-app.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/bower_components/fullcalendar/dist/fullcalendar.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/bower_components/fullcalendar/dist/fullcalendar.print.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/bower_components/chosen/chosen.min.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/bower_components/colorbox/example3/colorbox.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/bower_components/responsive-tables/responsive-tables.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css" />
    <link rel="stylesheet" href="css/site.css">
    <link rel="stylesheet" href="assets/bootstrap/dashboard/css/jquery.noty.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/css/noty_theme_default.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/css/elfinder.min.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/css/elfinder.theme.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/css/jquery.iphone.toggle.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/css/uploadify.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/css/animate.min.css" />
    <link rel="stylesheet" href="assets/bootstrap/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/bootstrap/dashboard/css/styles.css" />
    <link rel="stylesheet" href="plugins/datepicker/css/datepicker.css" />
    <link rel="stylesheet" href="plugins/timepicker/stylesheets/wickedpicker.css" />
    <link rel="stylesheet" type="text/css" href="fullcalendar/fullcalendar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
</head>

<body>
<?php $this->beginBody() ?>

    <div class="navbar navbar-default" role="navigation"><!-- topbar starts -->
        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!---
            <a class="navbar-brand" href="<?php echo Url::base(); ?>"> <img alt="Charisma Logo" src="assets/bootstrap/dashboard/img/logo20.png" class="hidden-xs"/>
                <span>Techelm</span></a>  --->
                <a class="navbar-brand" href="<?php echo Url::base(); ?>"> <img alt="Techelm Logo" src="logo/techelm_logo1.png" class="hidden-xs"/>
                  </a>
            <div class="btn-group pull-right">  <!-- user dropdown starts -->
                <button style="border:0;background: transparent;color: #fff" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><br>
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo Yii::$app->user->identity->username;  ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo Url::base(). '?r=site/logout'; ?>">Logout</a></li>
                </ul>
            </div><!-- user dropdown ends -->
        </div>
    </div><!-- topbar ends -->

<div class="ch-container">
    <div class="row">
    <div class="col-sm-2 col-lg-2">  <!-- left menu starts -->
        <div class="sidebar-nav"> <!--class sidebar-nav starts here--->
            <div class="nav-canvas"> <!--class nav-canvas starts here-->
                <div class="nav-sm nav nav-stacked">
                  <!--Insert something here-->
                </div>

                <ul class="nav nav-pills nav-stacked main-menu"> <!---Navigation Menu starts here-->
                    <li class="nav-header">Navigation Menu</li>
                    <li>
                      <a class="ajax-link" href="?">
                        <i class="fa fa-home"></i><span class="menuStyle" > Dashboard</span>
                      </a>
                    </li>
                    <li class="accordion"><!--User Management sub-menu starts here-->
                        <a href="#">
                            <i class="fa fa-user-circle"></i><span class="menuStyle" > User Mgmt. </span>
                        </a>
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <?php echo Html::a('<i class="fa fa-chevron-right"></i> User-Group',['user-group/index'],['class'=>'menuStyle']) ?>
                            </li>
                            <li>
                                <?php echo Html::a('<i class="fa fa-chevron-right"></i> User-Permission',['user-permission/permission-setting'],['class'=>'menuStyle']) ?>
                            </li>
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> User-Account',['user/index'],['class'=>'menuStyle']) ?>
                            </li>
                        </ul>
                    </li><!--User Management sub-menu ends here-->

                    <li><!--Customer Menu starts here-->
                        <?php echo Html::a('<i class="fa fa-users"></i> Customer List',['customer/index'],['class'=>'menuStyle']) ?>
                    </li><!--Customer Menu ends here-->

                    <!--EDR--->

                    <li class="nav-header hidden-md">Service-job Section</li>
                    <li class="accordion"><!---Start of ServiceJob sub-menu--->
                        <a href="#">
                            <i class="fa fa-cogs"></i><span class="menuStyle" >Service</span>
                        </a>

                        <ul class="nav nav-pills nav-stacked">
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> Services Categories',['service/index'],['class'=>'menuStyle']) ?>
                            </li>
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> Complaint Categories',['servicejob-categories/index'],['class'=>'menuStyle']) ?>
                            </li>
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> Complaints',['servicejob-complaint-fault/index'],['class'=>'menuStyle']) ?>
                            </li>
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i>  Complaint Actions',['servicejob-action-service/index'],['class'=>'menuStyle']) ?>
                            </li>
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> Service Job',['servicejob/index'],['class'=>'menuStyle']) ?>
                            </li>
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> Set Equipment',['equipment/index'],['class'=>'menuStyle ajax-link']) ?>
                            </li>
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> Replacement Rates',['servicejob-part-replacement-rates/index'],['class'=>'menuStyle ajax-link']) ?>
                            </li>
                            <li>
                                <?php echo Html::a('<i class="fa fa-chevron-right"></i> Replacement Category',['servicejob-replacement-category/index'],['class'=>'menuStyle ajax-link']) ?>
                            </li>
                        </ul>
                    </li><!---End of ServiceJob sub-menu--->

                    <li class="nav-header hidden-md">Project Section</li>
                    <li class="accordion"><!---Start of ProjectJob sub-menu--->
                      <a href="#">  <i class="fa fa-cogs"></i><span class="menuStyle" > Project Jobs</span></a>
                      <ul class="nav navpills nav-stacked">
                        <li>
                          <?php echo Html::a('<i class="fa fa-chevron-right"></i> Pre-Installation',['project-job/index'],['class'=>'menuStyle']) ?>
                        </li>
                        <li>
                          <?php echo Html::a('<i class="fa fa-chevron-right"></i> Site In-process Inspection',['projectjob-site-inspection/index'],['class'=>'menuStyle']) ?>
                        </li>
                        <li>
                          <?php echo Html::a('<i class="fa fa-chevron-right"></i> Task Actions',['projectjob-ipi-tasks-action/index'],['class'=>'menuStyle']) ?>
                        </li>
                        <li>
                          <?php echo Html::a('<i class="fa fa-chevron-right"></i> Site Walk Actions',['projectjob-site-walk-actions/index'],['class'=>'menuStyle']) ?>
                        </li>
                      </ul>
                    </li><!---End of ProjectJob sub-menu--->


                    <li class="nav-header hidden-md">Reports Section</li>
                    <li class="accordion"><!---Start of Service Job Reports sub-menu--->
                        <a href="#">
                            <i class="fa fa-cogs"></i><span class="menuStyle" > Service Job </span>
                        </a>
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> Service Report Summary',['reports/report-a'],['class'=>'menuStyle']) ?>
                            </li>
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> Service Report Complain Summary',['reports/report-b'],['class'=>'menuStyle']) ?>
                            </li>
                            <li>
                              <?php echo Html::a('<i class="fa fa-chevron-right"></i> Service Report Part Summary',['reports/report-d'],['class'=>'menuStyle']) ?>
                            </li>

                        </ul>
                      </li><!---End of Service Job Reports sub-menu--->

                    <!---Start of Toolbox meeting--->
                    <li class="nav-header hidden-md">Toolbox Meeting Section</li>
                    <li>
                      <?php echo Html::a('<i class="fa fa-angle-double-right"></i> Toolbox Meetings',['toolboxmeeting/index'],['class'=>'menuStyle']) ?>
                    </li>
                    <li>
                      <?php echo Html::a('<i class="fa fa-angle-double-right"></i> Meetings Attendees',['toolboxmeeting-attendees/index'],['class'=>'menuStyle']) ?>
                    </li>
                    <!---Start of Toolbox meeting--->

                    <!---Start of Utilities--->
                    <li class="nav-header hidden-md">Utilities</li>
                    <li>
                      <?php echo Html::a('<i class="fa fa-cube"></i> View Calendars',['calendar/index'],['class'=>'menuStyle']) ?>
                    </li>
                    <li>
                      <?php echo Html::a('<i class="fa fa-cube"></i> Company Profile',['company/index'],['class'=>'menuStyle']) ?>
                    </li>
                    <li>
                      <?php echo Html::a('<i class="fa fa-cube"></i> Sub-Contractor',['subcontractor/index'],['class'=>'menuStyle']) ?>
                    </li>
                    <li>
                      <?php echo Html::a('<i class="fa fa-cube"></i> Gii Application php',['gii/default'],['class'=>'menuStyle']) ?>
                    </li>
                    <!---End of Utilities--->

                </ul><!---Navigation Menu ends here-->

            </div><!--class nav-canvas ends here-->
        </div><!--class sidebar-nav ends here--->
    </div>  <!-- left menu ends -->

    <!--/span-->

    <div id="content" class="col-lg-10 col-sm-10"><!-- content starts -->
      <div class="breadcrumbStyle" >
          <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
           ]) ?>
          <?= Alert::widget() ?>
      </div>
      <div>
          <?= $content ?>
      </div>
    </div>  <!-- content ends -->

    <!--/#content.col-md-0-->
</div>

<!--/fluid-row-->
    <footer class="row">
    <br/>
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; Techelm Technologies - <?= date('Y') ?></p>
        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="http://usman.it/free-responsive-admin-template">FirstCom Solutions</a></p>
    </footer>

</div>

<!--/.fluid-container-->

<?php $this->endBody() ?>
    <!-- Javascript -->
    <!--- <script src="assets/bootstrap/dashboard/bower_components/jquery/jquery.min.js"></script> --->
    <script src="assets/bootstrap/dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/dashboard/js/jquery.cookie.js"></script>
    <script src="assets/bootstrap/dashboard/bower_components/moment/min/moment.min.js"></script>
    <script src="assets/bootstrap/dashboard/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="assets/bootstrap/dashboard/js/jquery.dataTables.min.js"></script>
    <script src="assets/bootstrap/dashboard/bower_components/chosen/chosen.jquery.min.js"></script>
    <script src="assets/bootstrap/dashboard/bower_components/colorbox/jquery.colorbox-min.js"></script>
    <script src="assets/bootstrap/dashboard/js/jquery.noty.js"></script>
    <script src="assets/bootstrap/dashboard/bower_components/responsive-tables/responsive-tables.js"></script>
    <script src="assets/bootstrap/dashboard/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
    <script src="assets/bootstrap/dashboard/js/jquery.raty.min.js"></script>
    <script src="assets/bootstrap/dashboard/js/jquery.iphone.toggle.js"></script>
    <script src="assets/bootstrap/dashboard/js/jquery.autogrow-textarea.js"></script>
    <script src="assets/bootstrap/dashboard/js/jquery.uploadify-3.1.min.js"></script>
    <script src="assets/bootstrap/dashboard/js/jquery.history.js"></script>
    <script src="assets/bootstrap/dashboard/js/charisma.js"></script>
    <script src="plugins/confirmation.js"></script>
    <script type="text/javascript" src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="plugins/datepicker.js"></script>
    <script type="text/javascript" src="plugins/timepicker/src/wickedpicker.js"></script>
    <script type="text/javascript" src="plugins/timepicker.js"></script>
    <script type="text/javascript" src="plugins/service.js"></script>
    <script type="text/javascript" src="fullcalendar/lib/moment.min.js"></script>
    <script type="text/javascript" src="fullcalendar/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    </body>

<script type="text/javascript">

/*********************************************************
 *
 *  USER PERMISSION
 *
 *
*********************************************************/
    $('#userGroup').change(function(){
        $('#w0').submit();
    });

    $('#controllerName').change(function(){
        $('#w0').submit();
    });

    $('#select-all').click(function(event) {
        $(':checkbox').each(function() {
            this.checked = true;
        });

    });

</script>
</html>
<?php $this->endPage() ?>
