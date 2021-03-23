<?php

$height_video = 250; #height of the video preview
$start_at = 7; #the 7th second

echo <<< OPEN
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="xj.css">
  <title>XJ</title>
</head>
<body>
OPEN;

$path = '../../XJ/supercucos/';
$folders = array_diff(scandir($path), array('.', '..'));
#print_r($folders);
foreach ($folders as $folder) {
  echo '<h2>' . $folder . '</h2>';
  $path1 = "../../XJ/supercucos/$folder";
  $files = array_diff(scandir($path1), array('.', '..'));
  #print_r($files);
  foreach ($files as $video) {
    #echo $video;
    if (strstr($video, '.jpg')) {
      continue;
    };
    #echo $video;
    echo <<< EOT
<a href="../../ap/XJ/supercucos/$folder/$video#t=$start_at" target=_blank>
<img src="thumb/supercucos/$folder/$video.jpg" style="height:250px;">
</a>
EOT;
  }
}

?>