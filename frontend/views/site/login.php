<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Techelm';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>

      <!-- CSS -->
      <!-- Font Awesome -->
      <link rel="stylesheet" href="assets/bootstrap/font-awesome-4.7.0/css/font-awesome.min.css" />
      <!-- Theme style -->
      <link rel="stylesheet" href="assets/bootstrap/login/css/style.css">
      <!-- other -->
      <!-- <link rel="stylesheet" href="css/login.style.css"> -->

</head>

<body>

    <section class="container">
    
        <div class="login">
          <h1><span class="fa fa-user-circle"></span> Log your account.</h1>

          <?php $form = ActiveForm::begin(); ?>
            <p>
                <?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'id' => 'username', 'placeholder' => 'Username here' ])->label(false) ?>
            </p>
            <p>
                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password here' ])->label(false) ?>
            </p>
            <p class="submit"><input type="submit" name="commit" value="Login"></p>
          <?php ActiveForm::end(); ?>
        </div>

    </section>

    <!-- Javascript -->
    <!-- jQuery 2.2.3 -->
    <script src="assets/plugins/jquery-3.2.1.min.js"></script>

    </body>

</html>

<?php $this->endPage() ?>
