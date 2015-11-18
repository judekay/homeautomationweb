<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/19/15
 * Time: 12:08 AM
 */
use yii\helpers\Url;
$this->title = "Statistics";

$directoryAsset = Url::home() . '../vendor/almasaeed2010/adminlte/plugins';
$this->registerJsFile($directoryAsset.'/chartjs/Chart.js');
$this->registerJsFile(Url::home().'js/statistics.js');
?>

<div class="row">
    <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area Coverage</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="polar-chart" style="height: 250px; width: 448px;" width="448" height="250"></canvas>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <!-- DONUT CHART -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">User Base</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <canvas id="pie-chart" style="height: 234px; width: 468px;" width="468" height="234"></canvas>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </div><!-- /.col (LEFT) -->
    <div class="col-md-6">
        <!-- LINE CHART -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Network Speed</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="line-chart" style="height: 250px; width: 448px;" width="448" height="250"></canvas>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <!-- BAR CHART -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Network Strength</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>

            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="bar-chart" style="height: 230px; width: 448px;" width="448" height="230"></canvas>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </div><!-- /.col (RIGHT) -->
</div>


<script type="application/javascript">
    window.onload = function(){initialize(STATISTICS_CALLER.main)};
</script>

