<?php
// get configuration
include('config.php');

$target = $_POST['target'];
$default = $_POST['default'];
$disabled = '';
$hidden = false;
if ($allowTargetURL)
{
$redirect = $_POST['redirect'];
}
else
{
$disabled = 'disabled';
$hidden = true;
$redirect = $_POST['default'];
}

if (strlen($target) > 0)
{
   $nowRand;
   $nowRand = rand(1000,99999);
   $key = rand(1000,9999);
   $uniqueID = uniqid($nowRand);
   $targNew = $uniqueID .'|'.$target.'|'.$redirect.'|'.$default.'|'.$key;
   addTarget($targNew);
  $response = array($uniqueID,$key);
  $myJSON = json_encode($response);
  echo $myJSON;
}
else
{
echo '<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="Setup Link Stats - Add a new link and get your ID">
  <title>Link Stats</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>

  <section class="mbr-section content5 cid-rTfq9csQbO" id="content5-a">

    

    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(35, 35, 35);">
    </div>

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-1">Link Stats</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light mbr-white pb-3 mbr-fonts-style display-5">Get Detailed Information On Your Loads</h3>
                
                <div class="mbr-section-btn align-center"><a class="btn btn-white-outline display-4" href="add"><span class="mbri-edit mbr-iconfont mbr-iconfont-btn" style="color: rgb(255, 129, 0);"></span>ADD</a><a class="btn btn-white-outline display-4" href="getstats"><span class="mbri-edit mbr-iconfont mbr-iconfont-btn" style="color: rgb(255, 129, 0);"></span>GET STATS</a> <a class="btn btn-white-outline display-4" href="remove"><span class="mbri-trash mbr-iconfont mbr-iconfont-btn" style="color: rgb(255, 129, 0);"></span>REMOVE</a></div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section form1 cid-rSNFIE3pgC" id="form1-1">

    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8" data-form-type="formoid">
                    
            
                    <form class="mbr-form" action="" onsubmit="getID();">
                        <div class="row row-sm-offset">
                            <div class="col-md-4 multi-horizontal" data-for="name">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="name-form1-1">Target</label>
                                    <input type="text" class="form-control" name="target" required="" placeholder="IP, Device, Browser or OS separated by ( , )" id="name-form1-1">
                                </div>
                            </div>
';

if (!$hidden)
{
echo '
                            <div class="col-md-4 multi-horizontal" data-for="email">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="email-form1-1">Targets URL</label>
                                    <input type="url" class="form-control" name="redirect" required="" placeholder="http://google.com" id="email-form1-1" '.$disabled.'>
                                </div>
                            </div>
';
}
echo '
                            <div class="col-md-4 multi-horizontal" data-for="phone">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-1">Default URL</label>
                                    <input type="url" class="form-control" name="default" required="" placeholder="http://google.com" id="phone-form1-1">

                                </div>
                            </div>
<div class="col-md-4 multi-horizontal" id="keySection" style="display: none;">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-1">Your Private Key</label>
                                    <input type="text" class="form-control" placeholder="" id="results" value="">
                                </div>
                            </div>

                        </div>

                <h4 class="align-center pb-0 mbr-fonts-style display-4" >Before adding a link, you must read and agree to our <a href="privacy">Privacy Policy</a> & <a href="terms">Terms of Service</a></h4>
            <span class="input-group-btn"><button type="submit" class="btn btn-primary display-4" id="linkBack">GET LINK</button></span>

                    </form>
            </div>
        </div>
    </div>
</section>
<script>
function getID(){
event.preventDefault();
document.getElementById("linkBack").innerHTML = "GETTING LINK...";
document.getElementById("keySection").style.display = "none";
$.ajax({
   type: "post",
   data: $("form").serialize(),
   success: function(response) {
   var back = JSON.parse(response);
   var id = back[0];
   var key = back[1];
   var keyFrame = document.getElementById("keySection");
   var keyBox = document.getElementById("results");
   var button = document.getElementById("linkBack");
   var loc = window.location.href;
   var dir = loc.substring(0, loc.lastIndexOf(\'/\'));
   keyBox.type = "text";
   keyFrame.style.display = "inline";
   keyBox.value = dir+"?id="+id;
   keyBox.select();
   keyBox.setSelectionRange(0, 99999); 
   document.execCommand("copy");
   button.innerHTML = "LINK COPIED TO CLIPBOARD";
   keyBox.value = key;
   button.select();
   }
});
}
</script>

  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/viewportchecker/jquery.viewportchecker.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
  
</body>
</html>';
}


function addTarget($targetString) 
{
global $targetsListFileName;
     $log_file = dirname(__FILE__) . '/'.$targetsListFileName;
      if (!file_exists($log_file)) 
         {
            $fp = fopen($log_file, "w");
            fclose($fp);
          }
       file_put_contents($log_file, $targetString."\n", FILE_APPEND);
}

?>