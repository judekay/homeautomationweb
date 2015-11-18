<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/19/15
 * Time: 12:08 AM
 */
$this->title = "MAP";
use yii\helpers\Url;

$this->registerJsFile('http://maps.googleapis.com/maps/api/js?signed_in=true&AIzaSyBDo5cGMAUnBAgEk2gknxZncnxBoJeRdEw');
$this->registerJsFile(Url::home().'js/map.js');

?>

<div>
    <form>
        <div>
            <label for="filter1">Filter Data Visualized By: </label>
            <select id="filter1" name="filter1">
                <option value="1">Network Provider</option>
                <option value="2">Network Strength</option>
            </select>

    </form>
</div>
<div class="row center-block col-md-12">
    <div class="center-block" id="map-canvas"></div>
</div>

<script type="application/javascript">
    window.onload = function(){initialize(MAP_CALLERS.map)};
</script>
