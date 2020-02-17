<?php
    $map_path="maps/";
    $map = new mapObj("europe", $map_path."sphp.map");
    $image=$map->draw();
    $image_url=$image->saveWebImage();
    echo $image_url

?>

<HTML>
    <HEAD>
        <TITLE>Example 1: Displaying a map</TITLE>
    </HEAD>
    <BODY>
        <IMG SRC=<?php echo $image_url; ?> >
    </BODY>
</HTML>