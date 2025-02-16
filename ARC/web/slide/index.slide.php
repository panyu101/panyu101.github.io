<?php
/* PHP image slideshow - auto version - PHP > 5.0 */
// set the absolute path to the directory containing the images

// URL parameters like:
// http://192.168.0.220/photo/?fld=%272016-2017/2016/%27&img=2416

//echo "<h6>fld " . $_GET["fld"] . "</h6>";
//echo"<h6>img " . $_GET["img"] . "</h6>";

//2005/180, 2010/466, 2016/2840, 2019/298

$fld = isset($_GET["fld"]) ? $_GET["fld"] : "2019";
define('DEFAULTIMG', "298");

//define('IMGDIR', '/var/www/html/mysite.com/html/images/slideshow/');
//define('IMGDIR', '/var/nginx/html/photo/1945-1989/1987/');
$folder11 = '/var/nginx/html/photo/';
//$folder11 = '/var/nginx/html/.ent/';
//$folder12 = '1990-1994/1994/';
//$folder12 = '96_Hegre-Art/303/';
//$folder12 = str_replace("'", "", $fld);
$folder12 = $fld;
$folder1 = $folder11.$folder12.'/';
$folder21 = '/ap/photo/';
//$folder21 = '/ap/.ent/';
$folder22 = $folder12;
$folder2 = $folder21.$folder22.'/';
define('IMGDIR', $folder1);
//print_r(IMGDIR);

$sessname = 'slideshow_arsess_'.substr($folder12, 0, 4);
//$sessname = 'slideshow_sess_'.substr($folder12, -4, 3);

// same but for www
//define('WEBIMGDIR', '/images/slideshow/');
//define('WEBIMGDIR', '/ap/photo/1945-1989/1987/');
define('WEBIMGDIR', $folder2);
//print_r(WEBIMGDIR);

// set session name for slideshow "cookie"
//define('SS_SESSNAME', 'slideshow_sess_1987c');
define('SS_SESSNAME', $sessname);
//print_r(SS_SESSNAME);

// global error variable
$err = '';
// start img session
session_name(SS_SESSNAME); session_start();
// init slideshow class
$ss = new slideshow($err); if (($err = $ss->init()) != '') { header('HTTP/1.1 500 Internal Server Error'); echo $err; exit();
}
// get image files from directory
$ss->get_images();
// set variables, done.
list($curr, $caption, $first, $prev, $next, $last) = $ss->run(); /* slideshow class, can be used stand-alone */ class slideshow { private $files_arr = NULL; private $err = 
    NULL; public function __construct(&$err) {
        $this->files_arr = array(); $this->err = $err;
    }
    public function init() {
        // run actions only if img array session var is empty check if image directory exists
        if (!$this->dir_exists()) { return 'Error retrieving images, missing directory';
        }
        return '';
    }
    public function get_images() {
        // run actions only if img array session var is empty
        if (isset($_SESSION['imgarr'])) { $this->files_arr = $_SESSION['imgarr'];
        }
        else { if ($dh = opendir(IMGDIR)) { while (false !== ($file = readdir($dh))) { if (preg_match('/^.*\.(jpg|gif|png)$/i', $file)) { $this->files_arr[] = $file;
                    }
                }
                closedir($dh);
            }
            sort($this->files_arr);
            //print_r($this->files_arr);
            $_SESSION['imgarr'] = $this->files_arr;
        }
    }
    public function run() { $curr = 1; $last = count($this->files_arr); if (isset($_GET['img'])) { if (preg_match('/^[0-9]+$/', $_GET['img'])) $curr = (int) $_GET['img']; 
            if ($curr <= 0 || $curr > $last) $curr = 1;
        }
        else { $img = isset($_GET["img"]) ? $_GET["img"] : DEFAULTIMG; $curr = (int) $img; }
        if ($curr <= 1) { $prev = $curr; $next = $curr + 1;
        }
        else if ($curr >= $last) { $prev = $last - 1; $next = $last;
        }
        else { $prev = $curr - 1; $next = $curr + 1;
        }
        // line below sets the caption name...
        $caption = str_replace('-', '-', $this->files_arr[$curr - 1]); $caption = str_replace('_', '_', $caption); $caption = preg_replace('/\.(jpe?g|gif|png)$/i', '', 
        $caption); $caption = ucfirst($caption); return array($this->files_arr[$curr - 1], $caption, 1, $prev, $next, $last);
    }
    private function dir_exists() { return file_exists(IMGDIR);
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <title>Slideshow</title> 
    <style type="text/css">
        body { margin: 0; padding: 0; font: 100% Verdana, Arial, Helvetica, sans-serif; font-size: 14px; background-color: #333;
        }
	.gallery { border: 1px #333 solid; max-width: 100%; margin: 0 auto; padding: 3px; text-align: center;
        }
        .gallery .gallery-nav { margin-bottom: 10px;
        }
        .gallery .gallery-nav a:first-child { margin-right: 10px;
        }
        .gallery .gallery-nav a:last-child { margin-left: 10px;
        }
        .gallery .gallery-image img { max-width: 100%; height: auto;
        }
        .gallery .gallery-image-label { color: #777;
        }
	a { color: #999;
        }
	a:hover { color: #ff0;
        }
	.sp { padding-right: 40px;
        }
	.imap { position: relative;
	}
	.imap a{ display: block; position: absolute;
	}
    </style>

<script type="text/javascript">
    document.onkeydown = function(event) {
        switch (event.keyCode) {
           case 65:
                //alert('37 Left key pressed');
                //alert('65 a key pressed');
                window.location.href = "?fld=<?=$folder12;?>&img=<?=$prev;?>";
              break;
           case 87:
                //alert('38 Up key pressed');
                //alert('87 w key pressed');
                window.location.href = "?fld=<?=$folder12;?>&img=<?=$first;?>"
              break;
           case 68:
                //alert('39 Right key pressed');
                //alert('68 d key pressed');
                window.location.href = "?fld=<?=$folder12;?>&img=<?=$next;?>";
              break;
           case 88:
                //alert('40 Down key pressed');
                //alert('88 x key pressed');
                window.location.href = "?fld=<?=$folder12;?>&img=<?=$last;?>";
              break;
           case 81:
                //alert('q key pressed');
                //document.write('<?=$caption;?>\n<?=$picinfo;?>');
		document.getElementById("qmessage").innerHTML = "<?=$folder2.$caption.'.jpg';?>";
                //window.location.href = "?fld=<?=$folder12;?>&img=<?=$last;?>";
              break;

           case 71:
                //alert('g key pressed');
                //window.location.href = "?fld=<?=$folder12;?>&img=<?=$last;?>";
              break;
        }
    };
</script>


</head>
<body>

<div id="qmessage" style="color:#090;"> &nbsp </div>

<div class="gallery"> <div class="gallery-nav">
<a href="?fld=<?=$folder12;?>&img=<?=$first;?>">First</a>
<a href="?fld=<?=$folder12;?>&img=<?=$prev;?>">Previous</a> 
<span class="sp"></span>
<a href="?fld=<?=$folder12;?>&img=<?=$next;?>">Next</a>
<a href="?fld=<?=$folder12;?>&img=<?=$last;?>">Last</a>
</div> <div class="gallery-image">

<div class="imap">
<img src="<?=WEBIMGDIR;?><?=$curr;?>" alt="" />
<a href="?fld=<?=$folder12;?>&img=<?=$first;?>" title="First"    style="top: 0%;  left: 0%;  width: 45%; height: 15%;"></a>
<a href="?fld=<?=$folder12;?>&img=<?=$last;?>"  title="Last"     style="top: 0%;  left: 55%; width: 45%; height: 15%;"></a>
<a href="?fld=<?=$folder12;?>&img=<?=$prev;?>"  title="Previous" style="top: 20%; left: 0%;  width: 45%; height: 80%;"></a>
<a href="?fld=<?=$folder12;?>&img=<?=$next;?>"  title="Next"     style="top: 20%; left: 55%; width: 45%; height: 80%;"></a>
</div>

</div> 
<a href="<?=$folder2.$caption.'.jpg';?>" target=_blank><p class="gallery-image-label"><?=$caption;?></a></p>
</div>
</body>
</html>
