<?php

header("Content-Type:text/html; charset=utf-8");

require_once(dirname(__FILE__) . "/config.php");
$timenamefolder = $_GET['timenamefolder'];
$x1 = $_GET['x1'];
$y1 = $_GET['y1'];
$w = $_GET['w'];
$h = $_GET['h'];
$cmd = 'python ./Cut_by_length.py '.$timenamefolder.' '.$x1.' '.$y1.' '.$w.' '.$h;
echo shell_exec($cmd);
echo "<br/><br/><button class =\"btn btn-primary\"type=\"button\" onclick=\"location.href='download_zip.php?timenamefolder=".$timenamefolder."'\"> 下載結果</button>".'<br />';
?>