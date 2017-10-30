<?php	use yii\bootstrap\Modal; ?>
<center><h1>Calendar</h1></center><div class="row">	<div class="col-md-4">		<label class="label label-primary">Project Job</label> &nbsp;		<label class="label label-default">Service Job</label>	</div></div>
<br>
<div class="row">	<div class="col-md-12">		<div id="calendar"></div>	</div></div>
<?php	Modal::begin([	    'header' => '<label class="label label-primary">Hello world</label>',	    'id' => 'calendarModal',	    'class' => 'modal-dialog modal-sm'	]);
	echo 'Say hello...';
	Modal::end(); ?>
<?php    $this->registerJsFile(        '@web/js/calendar/custom.js',        ['depends' => [\yii\web\JqueryAsset::className()]]    ); ?>