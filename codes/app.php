<?php

$year = isset($_GET["year"]) ? $_GET["year"] : "2021";

$height_photo = 150; #height of the photo preview
$start_at = 0; #the 0th second

#$year='2021';
$path = "../../photo/$year";
$folders = array_diff(scandir($path), array('.', '..'));
sort($folders);
#print_r($folders);
#exit;

echo <<< OPEN
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="photo.css">
  <title>Photo $year</title>
</head>
<body>
OPEN;

foreach ($folders as $folder) {
  echo '<h2>' . $folder . '</h2>';
  $path1 = "../../photo/$year/$folder";
  #$photos = array_diff(scandir($path1), array('.', '..', 'IMG_20210101_170738.jpg.hidden'));
  $photos = array_map('basename', glob($path1.'/*.jpg'));
  #print_r($photos);
  foreach ($photos as $photo) {
    if (file_exists("thumb/$year/$folder/$photo.txt")){
        $text = file_get_contents("thumb/$year/$folder/$photo.txt");
    }else{
      #$text = "<a href=tag.py?photo=\"$year/$folder/$photo\"&tag=\"\" target=_blank>".'Tag it : '.$photo.'</a>';
      $text = "<a href=tag.py?photo=\"$year/$folder/$photo\"&tag=\"\" target=_blank>".' TAG </a>'.$photo.
      # uncomment the next two lines will provide option of HIDE photo in photo yearly index view!
      #"<br><a href=hide.py?photo=\"$year/$folder/$photo\" target=_blank>".
      #' HIDE </a>'.$photo.
      '</br>' ;
    }
    echo <<< EOT
<div class="tooltip"><span style="margin-left:3px;"></span>
  <a href='../photo/slide.py?this="$year/$folder/$photo"' target=_blank>
  <img src="thumb/$year/$folder/$photo" style="height:150px;">
  </a>
  <span class="tooltiptext">$text</span>
</div>
EOT;
  }
}

?>