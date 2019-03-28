#!/usr/bin/php
<?php
function downloadImages($srcs, $folder, $url) {
    $imgUrls = array();
    foreach ($srcs as $link){
        if (strpos($link, '/') == 0) {
            $link = $url . $link;
        }
        $imgUrls[] = $link;
    }

    foreach ($imgUrls as $img) {
        $imageName = basename($img);
        if (file_exists("./$folder" . $imageName)) {
            continue ;
        }
        $image = file_get_contents($img);
        file_put_contents($folder . '/' . $imageName, $image);
    }
}

if ($argc != 2)
    exit();

$page = file_get_contents($argv[1]);
$img = '/(<img\s+)(.*?)(>)/';
$src = '/(src=\")(.*?)(\")/';
$output = array();

preg_match_all($img, $page, $output);
$srcs = array();
foreach ($output[0] as $match) {
    preg_match($src, $match, $m);
    $srcs[] = $m[2];
}

$folder = preg_replace('/https?:\/\//', '', $argv[1]);
if (file_exists($folder) == FALSE) {
    mkdir($folder, 0777, true);
}

downloadImages($srcs, $folder, $argv[1]);
?>
