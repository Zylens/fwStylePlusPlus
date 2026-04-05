<?
error_reporting(0);
function savepic($bild) {
    $pic = file_get_contents("http://fwshop.ath.cx/imgd/$bild.jpg");
    $fp = fopen("./tmp/$bild.jpg", "w");
    fwrite($fp, $pic);
    fclose($fp);
}
$seite = file_get_contents("http://fwshop.ath.cx/freewar_shoppreise.html");
preg_match_all("/\<img alt=\"fwshop: shoppreise .*\" width=\"320\" height=\"240\" src=\"imgd\/(.*?).jpg\"\>/", $seite, $treffer);
savepic($treffer[1][0]);
savepic($treffer[1][1]);
$image = imagecreatetruecolor(437, 55);
$tile1 = imagecreatefromjpeg("tmp/{$treffer[1][0]}.jpg");
$tile2 = imagecreatefromjpeg("tmp/{$treffer[1][1]}.jpg");
imagecopy($image, $tile1, 0,   0, 7, 92, 313, 55);
imagecopy($image, $tile2, 313, 0, 0, 92, 124, 55);
header("Content-Type: image/jpeg");
imagejpeg($image);
imagedestroy($image);
unlink("tmp/{$treffer[1][0]}.jpg");
unlink("tmp/{$treffer[1][1]}.jpg");
?>