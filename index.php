<?php

require_once 'include/appsetting.php';
require_once 'include/facebook.php';
$facebook = new Facebook(array(
    'appId' => $appId,
    'secret' => $secret,
    'cookie' => true
));

//Facebook Authentication part
$user     = $facebook->getUser();
$loginUrl = $facebook->getLoginUrl(array(
    'scope' => 'user_status,publish_stream,user_photos,user_about_me',
    'redirect_uri' => $url_script_host . 'index.php?red=1'
));


if (!$user) {
    echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
    exit;
}

if ($_GET["red"] == 1) {
    if ($user) {
        header("location: $url_of_tab");
        exit;
    }
}



if ($user) {
    // get user informations
    $user_profile = $facebook->api('/me');
    $gender       = $user_profile['gender'];
    $name         = $user_profile['name'];
    $id           = $user_profile['id'];

    //random friend generator
    $friends = $facebook->api('/me/friends');
    foreach ($friends["data"] as $value) {
        $index             = $index + 1;
        ${"name" . $index} = $value["name"];
        ${"uid" . $index}  = $value["id"];
    }
    $random        = rand(0, $index);
    $random_friend = ${"name" . $random};
    $friend1_uid   = ${"uid" . $random};
    $im            = $func->createimg($templateimg);


    for ($counter = 1; $counter <= $no_of_text; $counter += 1) {
        $def_var       = array(
            "%name%",
            "%gender%",
            "%id%",
            "%random_friend%"
        );
        $replace       = array(
            $name,
            $gender,
            $id,
            $random_friend
        );
        $replaced_text = str_replace($def_var, $replace, ${'text' . $counter});

        $def_var                = array(
            "%name%",
            "%gender%",
            "%id%",
            "%random_friend%"
        );
        $replace                = array(
            $name,
            $gender,
            $id,
            $random_friend
        );
        $replaced_image_caption = str_replace($def_var, $replace, $image_caption);


        // Font (make sure file permission 775 )
        //putenv('GDFONTPATH=' . realpath('.'));
        ${'font' . $counter} = dirname(__FILE__) . '/' . ${'font' . $counter};
        $return              = imagettftext($im, ${'size_text' . $counter}, ${'angle_text' . $counter}, ${'position_x' . $counter}, ${'position_y' . $counter}, ${'color' . $counter}, ${'font' . $counter}, $replaced_text);
    }


    if ($enable_dp == 1) {
        //------- get redirect -------
        $redirect_url = $func->getredirect('https://graph.facebook.com/' . $id . '/picture?type=large');
        // Create image instances
        $src          = $func->createimg($redirect_url);
        list($width, $height) = getimagesize($redirect_url);
        imagecopyresampled($im, $src, $dp_x_coordinate, $dp_y_coordinate, 0, 0, $dp_width, $dp_height, $width, $height);
        imagedestroy($src);
    }
    // End of integration DP Picture ///

    if ($enable_friend_randomdp == 1) {
        //------- get redirect -------
        $redirect_url_2 = $func->getredirect('https://graph.facebook.com/' . $friend1_uid . '/picture?type=large');
        $src_2          = $func->createimg($redirect_url_2);
        list($width, $height) = getimagesize($redirect_url_2);
        imagecopyresampled($im, $src_2, $friend_dp_x_coordinate, $friend_dp_y_coordinate, 0, 0, $friend_dp_width, $friend_dp_height, $width, $height);
        imagedestroy($src_2);
    }

    // end of random friend DP /////


    // prevent random result //
    if ($disable_random_result == 1) {
        if (!file_exists(dirname(__FILE__) . '/images/' . $id . '.jpg')) {
            imagejpeg($im, dirname(__FILE__) . '/images/' . $id . '.jpg');
        }
    } else {
        imagejpeg($im, dirname(__FILE__) . '/images/' . $id . '.jpg');
    }


    if ($script_preview != 1) {
        $img = dirname(__FILE__) . "/images/$id.jpg";
        // allow uploads
        $facebook->setFileUploadSupport("http://" . $_SERVER['SERVER_NAME']);
        // add a status message
        $photo = $facebook->api('/me/photos', 'POST', array(
            'source' => '@' . $img,
            'message' => $replaced_image_caption
        ));
    }

    imagedestroy($im);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet"  href="include/menu.css"></link>
<title>Facebook Page Viral Like NoSSL</title>
</head><body><center>
<script>
var _gaq=[["_setAccount","UA-36253005-1"],["_trackPageview"]]; (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1; g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js"; s.parentNode.insertBefore(g,s)}(document,"script"));
</script>
<?php if ($script_preview == 1) {  ?>
Preview Mode<br>-----------------------------------<br>Photo Description text :<br>
<?php echo $replaced_image_caption; ?>
<br>-----------------------------------<br>
<?php } ?>
<img src="<?php
echo $url_script_host;
?>images/<?php
echo $id;
?>.jpg" </img>
<br><br>
<div class="container">
<iframe src="https://www.facebook.com/plugins/facepile.php?href=<?php
echo $url_of_tab;
?>&amp;size=small&amp;width=500&amp;max_rows=4&amp;colorscheme=light&amp;appId=285852271465234" style="border:none; overflow:hidden; width:500px; height:100px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe><br>
  <ul id="nav">
    <li><a href="http://www.mahadirlab.com" target="_blank" class="icon-home"></a></li>
    <li><a href="#contactus" target="_blank" class="icon-mail"></a></li>
    <li><a href="#privacypolicy" target="_blank" class="icon-user"></a></li>
    <li><a href="#termofservice" target="_blank" class="icon-cog"></a></li>
  </ul>
</div>
</center>
</body></html>
