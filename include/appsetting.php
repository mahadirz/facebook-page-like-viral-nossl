<?php
 ///////////////////////////////////////////////
//                                            //
//  Facebook Page Like Viral NoSSL            //
//                                            //
//  Copyright Mahadir Ahmad 2012              //
//  www.mahadirlab.com                        //
//                                            //
 //////////////////////////////////////////////

//------------ technical settings ---------------------------------//
require_once("class.php");
$func = new functionAdd() ;  //initialize class

$ini_array = parse_ini_file("setting");
$appId          = $ini_array["APPID"];    //you APP ID
$secret         = $ini_array["APPSECRET"];        //Your App Secret
$url_of_tab     = $ini_array["URLTAB"];  //will be used for redirect
$image_caption  = $ini_array["IMGCAPTION"] ;
$not_fan_image  = $ini_array["NONFANIMG"]; //this is relative path, you can use image from URL
$script_preview = $ini_array["PREVIEW"] ; // change to 1 for preview mode

$url_script_host = $func->curDirURL() ;


//-------------------------------------------------------------//

//--------------- Output template settings --------------//
//supported variable to be parsed
//%gender%
//%name%
//%id%
//%random_friend%

$no_of_text = 2 ; //set how much text to be used
$random_template = $func->random_template(1,17) ; //initialize  random template
//$templateimg = $random_template ;
$templateimg = 'template.jpg' ;

$text1 = '%name%' ;  // text to be printed in the template image
$position_x1 = 100  ; // x coordinate of the text
$position_y1 = 90 ;    // y coordinate of the text
$size_text1 = 24;    //text size
$angle_text1 = 0;    // text degree
$color1 = 0x0000FF ;     // Text colour in RGB format (hexadecimal)
$font1 = 'arial.ttf';

$text2 = '%random_friend%' ;  // this is the second text
$position_x2 = 100  ;
$position_y2 = 150 ;
$size_text2 = 24;
$angle_text2 = 0;
$color2 = 0xFF0000 ;
$font2 = 'arial.ttf';

// setting for user profile picture
$enable_dp = 1;
$dp_x_coordinate = 12 ;
$dp_y_coordinate = 189 ;
$dp_width = 193;
$dp_height = 197;


// random user's friend profile picture
$enable_friend_randomdp = 1;
$friend_dp_x_coordinate = 310 ;
$friend_dp_y_coordinate = 185 ;
$friend_dp_width = 193 ;
$friend_dp_height = 197;


// if you would like to prevent random result!
$disable_random_result = 0;

