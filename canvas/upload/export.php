<?php

	/**
	 * More info about this script on: 
	 * http://stackoverflow.com/questions/11511511/how-to-save-a-png-image-server-side-from-a-base64-data-string
	 */
        /*
$name = $_REQUEST['name'];
*/
	$data = $_REQUEST['base64data']; 
	echo $data;
       
        $date = new DateTime();
        $curr = $date->getTimestamp();
   
        $rnd = rand();

	$image = explode('base64,',$data); 
        $name = $curr.$rnd.'.png';
	file_put_contents($name, base64_decode($image[1])); 

?>	