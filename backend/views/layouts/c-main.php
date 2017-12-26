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


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="icon" href="favicon.ico" type="image/ico">
</head>



<body>
<?php $this->beginBody() ?>



 <!-- topbar starts -->

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"> <img alt="Techelm Logo" src="logo/techelm_logo1.png" class="hidden-xs"/>
              </a>
            <!-- user dropdown starts -->

            <div class="btn-group pull-right">
                <button style="border:0;background: transparent;color: #fff" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><br>
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo Yii::$app->user->identity->username;  ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo Url::base(). '?r=site/logout'; ?>">Logout</a></li>
                </ul>
            </div>

            <!-- user dropdown ends -->
        </div>

    </div>

    <!-- topbar ends -->



<div class="ch-container">
    <div class="row">
    <!-- left menu starts -->
    <!---<div class="col-sm-2 col-lg-2"> //edr remove sidebar  in frontend
       <div class="sidebar-nav">
            <div class="nav-canvas">
                <div class="nav-sm nav nav-stacked">

                </div>

                <ul class="nav nav-pills nav-stacked main-menu">
                    <li class="nav-header">Navigation Menu</li>


                    <li>//edr
                        <a class="ajax-link" href="?r=customer">
                            <i class="fa fa-users"></i><span class="menuStyle" > Customer List</span>
                        </a>
                    </li>


            </div>

        </div>

    </div>--->

    <!--/span-->

    <!-- left menu ends -->



    <div id="content" class="col-lg-12 col-sm-12">

    <!-- content starts -->



    <div class="breadcrumbStyle" >

        <?= Breadcrumbs::widget([

            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

         ]) ?>

        <?= Alert::widget() ?>

    </div>



    <div>

        <?= $content ?>

    </div>



    <!-- content ends -->

    </div>

    <!--/#content.col-md-0-->



</div>

<!--/fluid-row-->



    <footer class="row">

    <br/>

        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; Techelm Technologies - <?= date('Y') ?></p>



        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a

                href="https://www.firstcom.com.sg/">FirstCom Solutions</a></p>

    </footer>



</div>

<!--/.fluid-container-->



<?php $this->endBody() ?>



    <!-- Javascript -->

    <!--- <script src="assets/bootstrap/dashboard/bower_components/jquery/jquery.min.js"></script> --->

    <script src="assets/bootstrap/dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="assets/bootstrap/dashboard/js/jquery.cookie.js"></script>

    <script src="assets/bootstrap/dashboard/bower_components/moment/min/moment.min.js"></script>


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

    <!---<script src="assets/bootstrap/dashboard/js/charisma.js"></script>--->

    <script src="plugins/confirmation.js"></script>


    <script type="text/javascript" src="plugins/datepicker/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript" src="plugins/datepicker.js"></script>

    <script type="text/javascript" src="plugins/timepicker/src/wickedpicker.js"></script>

    <script type="text/javascript" src="plugins/timepicker.js"></script>

    <script type="text/javascript" src="plugins/service.js"></script>


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
