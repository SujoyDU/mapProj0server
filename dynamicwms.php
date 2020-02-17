<?php

$request = new OwsrequestObj();

foreach ($_GET as $k=>$v) {
     $request->setParameter($k, $v);
}

$request->setParameter("VeRsIoN","1.0.0");
ms_ioinstallstdouttobuffer();
$oMap = new mapObj("/home/sujoy/Desktop/webgis/mapscripts/maps/dynamic.map");


$new_layer = new layerObj($oMap);
$new_layer->set("type", MS_LAYER_POLYGON);
$new_layer->set("dump", 1);
$new_layer->set("status", 1);
$new_layer->set("name","world30");
$new_class = new classObj($new_layer);
$new_style = new styleObj($new_class);
$new_style-> outlinecolor->setRGB(255, 0, 0);
$new_layer->setConnectionType(MS_POSTGIS);
$new_layer->set("connection","user=postgres password=system dbname=world host=localhost");
$data="geom from (select * from world30 where gid in (select world30.gid from world30,cities where st_contains(world30.geom,cities.geom) group by world30.gid having count(*)>100)) as foo using unique gid using SRID=4326";
$new_layer->set("data",$data) ;


$new_layer = new layerObj($oMap);
$new_layer->set("type", MS_LAYER_POINT);
$new_layer->set("dump", 1);
$new_layer->set("status", 1);
$new_layer->set("name","cities");
$new_class = new classObj($new_layer);
$new_style = new styleObj($new_class);
$new_style-> color->setRGB(0, 0,255);
$new_style->set("symbolname", "circle");
$new_style->set("size", 5);

$new_layer->setConnectionType(MS_POSTGIS);
$new_layer->set("connection","user=postgres password=system dbname=world host=localhost");
$data="geom from (select * from cities where pop_rank<3) as foo using unique gid using SRID=4326";
$new_layer->set("data",$data) ;


$oMap->owsdispatch($request);
$contenttype = ms_iostripstdoutbuffercontenttype();
if ($contenttype == 'image/png')
{
   header('Content-type: image/png');
   ms_iogetStdoutBufferBytes();
}
else
{
	$buffer = ms_iogetstdoutbufferstring();
	echo $buffer;
}
ms_ioresethandlers();
?>

