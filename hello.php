<?php

$request = new OWSRequestObj();

foreach ($_GET as $k=>$v) {
     $request->setParameter($k, $v);
}

$request->setParameter("VeRsIoN","1.0.0");

$map_path="maps/";
$map = new mapObj($map_path."sphp.map");
$image=$map->draw();
$image_url=$image->saveWebImage();
echo $image_url


?>