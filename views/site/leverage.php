<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/19/15
 * Time: 12:08 AM
 */
use yii\helpers\Url;

$this->registerJsFile('http://maps.googleapis.com/maps/api/js?signed_in=true&AIzaSyBDo5cGMAUnBAgEk2gknxZncnxBoJeRdEw');
$this->registerJsFile(Url::home().'js/map.js');

?>

<div class="row center-block col-md-12">
    <div class="center-block" id="map-canvas"></div>
</div>

<script type="application/javascript">
    window.onload = function(){initialize(MAP_CALLERS.leverage_power)};
</script>
