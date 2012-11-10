<?php
include("../include/class.php");

class notinstalldir extends functionAdd {
public function rootDirURL(){
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return dirname(dirname($pageURL)).'/';
}
}

if (isset($_POST['submit_form'])) {
$appid = $_POST['q2_appId'];
$appssecret = $_POST['q3_appSecret'];
$taburl = $_POST['q4_tabUrl'];
$imgcaption = $_POST['q5_imageCaption'];
$nonfanimg = $_POST['q6_nonFan'];
$preview = $_POST['q7_preview'];
if ($preview == "YES")
$preview = 1;
else
$preview = 0;


$func = new functionAdd() ;
$func_add = new notinstalldir() ;
$ini_write_block = Array (
"APPID"       => $appid,
"APPSECRET"   => $appssecret,
"URLTAB"      => $taburl,
"IMGCAPTION"  => $imgcaption,
"NONFANIMG"   => $nonfanimg,
"PREVIEW"     => $preview
) ;
$func->write_php_ini($ini_write_block, '../include/setting') ;

$rootdir = urlencode($func_add->rootDirURL()) ;
$returnurl = urlencode($func->curDirURL().'?success=1') ;
$data = array('appidflv'     => $appid,
              'appsecretflv' => $appssecret,
              'connectflv'   => $rootdir,
              'redirectflv'  => $returnurl);
$redir = "http://mahadirnetwork.com/tools/remotesdk/index.php?".http_build_query($data) ;

echo '<script type="text/javascript">';
echo 'location.replace("'.$redir.'");';
echo '</script>';
exit;
}

$ini_array = parse_ini_file("../include/setting");


if ($ini_array["PREVIEW"] == 1)
$option_form ='<option value="NO"> NO </option>
<option selected="selected" value="YES"> YES </option>';
else
$option_form ='<option value="YES"> YES </option>
<option selected="selected" value="NO"> NO </option>';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="HandheldFriendly" content="true">
<title>Facebook Page Like Viral NoSSL setup</title>
<link href="index_files/gformCss.css" rel="stylesheet" type="text/css">
<link type="text/css" rel="stylesheet" href="index_files/nova.css">
<style type="text/css">
    .form-label{
        width:150px !important;
    }
    .form-label-left{
        width:150px !important;
    }
    .form-line{
        padding-top:12px;
        padding-bottom:12px;
    }
    .form-label-right{
        width:150px !important;
    }
    body, html{
        margin:0;
        padding:0;
        background:false;
    }

    .form-all{
        margin:0px auto;
        padding-top:0px;
        width:650px;
        color:#555 !important;
        font-family:'Lucida Grande';
        font-size:14px;
    }
</style>

<link type="text/css" rel="stylesheet" href="index_files/form-submit-button-simple_red.css">
<script src="index_files/gjotform.js" type="text/javascript"></script>
<script type="text/javascript">
   JotForm.init();
</script>
</head>
<body>
<form novalidate="true" class="jotform-form" method="post" name="form_23145807712451" id="23145807712451" accept-charset="utf-8">
  <input name="formID" value="23145807712451" type="hidden">
  <div class="form-all">
    <ul class="form-section">
      <li id="cid_1" class="form-input-wide">
        <div class="form-header-group">
          <h2 id="header_1" class="form-header">
            Facebook Page Like Viral NoSSL setup
          </h2>
        </div>
      </li>
      <li class="form-line" id="id_2">
        <label class="form-label-left" id="label_2" for="input_2"> APP ID </label>
        <div id="cid_2" class="form-input">
          <input class="form-textbox" id="input_2" name="q2_appId" size="50" type="text" value="<?php echo $ini_array["APPID"]; ?>">
        </div>
      </li>
      <li class="form-line" id="id_3">
        <label class="form-label-left" id="label_3" for="input_3"> APP Secret </label>
        <div id="cid_3" class="form-input">
          <input class="form-textbox" id="input_3" name="q3_appSecret" size="50" type="text" value="<?php echo $ini_array["APPSECRET"]; ?>">
        </div>
      </li>
      <li class="form-line" id="id_4">
        <label class="form-label-left" id="label_4" for="input_4"> Tab URL </label>
        <div id="cid_4" class="form-input">
          <input class="form-textbox" id="input_4" name="q4_tabUrl" size="50" type="text" value="<?php echo $ini_array["URLTAB"]; ?>">
        </div>
      </li>
      <li class="form-line" id="id_5">
        <label class="form-label-left" id="label_5" for="input_5"> Image Caption </label>
        <div id="cid_5" class="form-input">
          <input class="form-textbox" id="input_5" name="q5_imageCaption" size="50" type="text" value="<?php echo $ini_array["IMGCAPTION"]; ?>">
        </div>
      </li>
      <li class="form-line" id="id_6">
        <label class="form-label-left" id="label_6" for="input_6"> Non Fan Image </label>
        <div id="cid_6" class="form-input">
          <input class="form-textbox" id="input_6" name="q6_nonFan" size="50" type="text" value="<?php echo $ini_array["NONFANIMG"]; ?>">
        </div>
      </li>
      <li class="form-line" id="id_7">
        <label class="form-label-left" id="label_7" for="input_7"> Preview </label>
        <div id="cid_7" class="form-input">
          <select class="form-dropdown" style="width:150px" id="input_7" name="q7_preview">
         <?php echo $option_form ; ?>
          </select>
        </div>
      </li>
      <li class="form-line form-line-active" id="id_9">
        <div id="cid_9" class="form-input-wide">
          <div style="margin-left:156px" class="form-buttons-wrapper">
            <button id="input_9" type="submit" class="form-submit-button form-submit-button-simple_red" name="submit_form">
              Submit
            </button>
          </div>
        </div>
      </li>
      <li class="form-line" id="id_8">
        <div id="cid_8" class="form-input-wide">
          <div id="text_8" class="form-html">
            <p>
              Facebook Page Like Viral NoSSL - Powered by
              <a href="http://mahadirlab.com/" target="_blank">Mahadir Lab</a>
            </p>
            <p>
              &gt;&gt; NO SSL &amp; No MySQL setup required. but for 
security, please remove the install folder after finish the setup and 
the app running with no problem. The input from this form is not 
sanitized as it assumes that the admin of the script is making the 
installation.
              &lt;&lt;</p>
                <p>
                  <strong>
                    Please consider to buy premium items from me if you 
like this free script. Free script comes with some limitation.
                  </strong>
                </p>
                <p>
                  <br><span style="text-decoration: underline;">Disclaimer</span>
                  <br>
                  <br>
                  THIS SCRIPT IS PROVIDED&nbsp; "AS IS" AND ANY EXPRESS 
OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE 
DISCLAIMED. IN NO EVENT SHALL THE&nbsp;OWNER&nbsp; BE LIABLE FOR ANY 
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS 
OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) 
HOWEVER CAUSED AND ON ANY THEORY
                  OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, 
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF 
THE USE OF THIS&nbsp;SCRIPT, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH 
DAMAGE.
                </p>
          </div>
        </div>
      </li>
      <li style="display:none">
        Should be Empty:
        <input name="website" type="text">
      </li>
    </ul>
  </div>
  <input id="simple_spc" name="simple_spc" value="23145807712451-23145807712451" type="hidden">
  <script type="text/javascript">
  document.getElementById("si" + "mple" + "_spc").value = "23145807712451-23145807712451";
  </script>
  <?php if ($_GET['success'] == 1){
    $func_add = new notinstalldir() ;
    $rootdir = $func_add->rootDirURL() ; ?>
<script type="text/javascript">
alert("Successfully Set on Facebook Developer Dashboard \n\nUse informations below to set your page tab \n\n\nPage Source: <?php echo $rootdir ;?> \n\nNon-Fan Page Source: <?php echo $rootdir.'non-fan.php';?>  ")
</script>
<?php } ?>
</form>
</body></html>
