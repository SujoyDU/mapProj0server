<?php

echo '<p>Hello World</p>';


//http://localhost/cgi-bin/mapserv?
//map=/home/sujoy/Desktop/webgis/world/maps/static.map&
//LAYERS=world30%2Ccities&FORMAT=image%2Fpng&
//SERVICE=WMS&VERSION=1.1.1&REQUEST=GetMap&
//STYLES=&EXCEPTIONS=application%2Fvnd.ogc.se_inimage&
//SRS=EPSG%3A4326&BBOX=-90,-90,0,0&WIDTH=256&HEIGHT=256

//http://localhost:4020/dynamicwms.php?
//LAYERS=cities%2Cworld30&FORMAT=image%2Fpng&
//SERVICE=WMS&VERSION=1.1.1&REQUEST=GetMap&STYLES=&
//EXCEPTIONS=application%2Fvnd.ogc.se_inimage&
//SRS=EPSG%3A4326&BBOX=-180,0,-90,90&WIDTH=256&HEIGHT=256

//http://localhost:4020/staticwms.php?
//LAYERS=world30%2Ccities&FORMAT=image%2Fpng&
//SERVICE=WMS&VERSION=1.1.1&REQUEST=GetMap&
//STYLES=&EXCEPTIONS=application%2Fvnd.ogc.se_inimage&
//SRS=EPSG%3A4326&BBOX=-180,0,-90,90&WIDTH=256&HEIGHT=256

$request = new OWSRequestObj();

foreach ($_GET as $k=>$v) {
     $request->setParameter($k, $v);
}

$request->setParameter("VeRsIoN","1.0.0");
ms_ioinstallstdouttobuffer();
$oMap = new mapObj("/home/sujoy/Desktop/webgis/mapscripts/maps/sphp.map");
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
