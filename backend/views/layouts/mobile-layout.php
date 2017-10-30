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

  
      <div>
          <?= $content ?>
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
