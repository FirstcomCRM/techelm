<?php

/* @var $this yii\web\View */
use common\models\ProjectjobPiss;
use common\models\Servicejob;
use common\components\Helper;
use common\models\ProjectJob;
use common\models\User;
use common\models\Customer;

$dataProject = ProjectjobPiss::find()->where(['active' => 1])->all();
// unsigned servicejob
$dataService = Servicejob::find()->limit(10)->all();
$CountUser = User::find()->count();
$CountServiceJob = Servicejob::find()->where(['status'=> 1])->count();
$CountCustomers = Customer::find()->count();
$CountProjectjob = ProjectJob::find()->count();

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-index">

<div class=" row">

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?php echo $CountUser; ?> members." class="well top-block" href="?r=user">
            <i class="glyphicon glyphicon-user blue"></i>
            <div>User List</div>
            <!-- <div>507</div> -->
            <span class="notification"><?php echo $CountUser; ?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?php echo $CountCustomers; ?> customers" class="well top-block" href="?r=customer">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Customer List</div>
            <!-- <div>228</div> -->
            <span class="notification green"><?php echo $CountCustomers; ?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?php echo $CountProjectjob; ?> Project Jobs" class="well top-block" href="?r=project-job">
            <i class="glyphicon glyphicon-envelope red"></i>
            <div>Project Job</div>
            <!-- <div>25</div> -->
            <span class="notification red"><?php echo $CountProjectjob; ?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?php echo $CountServiceJob . " Unsigned Services"; ?>" class="well top-block" href="?r=servicejob%2Findex&SearchServicejob%5Bstatus%5D=1";>
            <i class="glyphicon glyphicon-star green"></i>
            <div>Unsigned Service</div>
            <span class="notification red"><?php echo $CountServiceJob; ?></span>
        </a>
    </div>

</div>

<div class="row">

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="fa fa-map"></i> Project List (Pre-Installation)</h2>

            </div>

            <div class="box-content row">
                <div class="col-lg-12 col-md-12">
                <br/>

                <table style="font-size: 11px;" class="table table-boardered table-striped">
                    <thead>
                        <th><b>PROJECT REFERENCE</b></th>
                        <th><b>CP CODE</b></th>
                        <th><b>DATE OF SITE-WALK</b></th>
                        <th><b>STATUS</b></th>
                        <th><b>Status Flag</b></th>
                    </thead>
                    <tbody>
                        <?php foreach($dataProject as $pRow): ?>
                            <tr>
                                <td><?= $pRow['projectjob_id'] ?></td>
                                <td><?= $pRow['car_park_code'] ?></td>
                                <td><?= date('d-M-Y', strtotime($pRow['date_site_walk'])) ?></td>
                                <td><?= $pRow['remarks'] ?></td>
                                <td><?= Helper::createActiveLabel($pRow['active']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                </div>

            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="fa fa-battery"></i> Service List</h2>

            </div>

            <div class="box-content row">
                <div class="col-lg-12 col-md-12">
                <br/>

                <table style="font-size: 11px;" class="table table-boardered table-striped">
                    <thead>
                        <th><b>SERVICE CODE</b></th>
                        <th><b>DATE CREATED</b></th>
                        <th><b>SERVICE NO</b></th>
                        <th><b>STATUS</b></th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($dataService as $sRow):
                        ?>
                            <tr>
                                <td><?= $sRow['id'] ?></td>
                                <td><?= date('d-M-Y', strtotime($sRow['start_date'])) ?></td>
                                <td><?= $sRow['service_no'] ?></td>
                                <td><?= Helper::createStatusFlag($sRow['status']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                </div>

            </div>
        </div>
    </div>

</div>

</div>
