<?php
/* Read the image */
//$im = new imagick( "img/cat.jpg" );
/* create the thumbnail */
//$im->cropThumbnailImage( 240, 180 );
/* Write to a file */
//$im->writeImage( "cat_thumbnail.jpg" );

//exec("/usr/bin/convert img/cat.jpg -resize '240x180^' -gravity center -extent '100x200' output.jpg");
//convert input.jpg -thumbnail x200 -resize '200x<' -resize 50% -gravity center -crop 100x100+0+0 +repage -format jpg -quality 91 square.jpg
exec("/usr/bin/convert img/ca-01-00.jpg -thumbnail 240x180^ -gravity center -extent 240x180  img/ca-01-00_thumbnail.jpg", $return, $value);

/*print_r($return);
print_r($value);*/
?>