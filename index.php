<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ping All Sites -  Webception IT Solutions</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
        <link rel="stylesheet" href="style.css" media="screen">
    </head>
    <body>
        <?php
        error_reporting(E_ERROR | E_PARSE);
        $file = file_get_contents("./sites.json"); //fetch sites from JSON
        $sites = json_decode($file,true);
        foreach($sites as $site):
            $site_error ="";
            if($socket = fsockopen($site['url'], 80, $errno, $errstr, 3)) { //Check if port 80 is open or site is live. Timeout: 3 seconds
                $classname="online";
                fclose($socket);
            } else {
                $classname="offline";
                $site_error=$errno.$errstr;
            }
        ?>
        <div class="site <?php echo $classname; //put classname according to site status ?>">
            <strong><?php echo $site['title'];?></strong><br />
            <small class="url"><a href="<?php echo "http://".$site['url'];?>" target="_blank"><?php echo "http://".$site['url'];?></a></small><br />
            <small class="error"><?php if(strlen($site_error)!=0) echo "Error: ".$site_error;?></small>
        </div>
    <?php endforeach;?>
    </body>
    <footer><small class="foot"> &copy; Webception IT Solutions Pvt. Ltd.</small></footer>
</html>
