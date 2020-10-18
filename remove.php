<?php
include('config.php');
$target = $_POST['target'];
$key = $_POST['key'];

if (strlen($target) > 0)
{
  parse_str(parse_url($target,PHP_URL_QUERY),$targetArr);
  if(removedTarget($targetArr['id'], trim($key)))
   {
   echo "REMOVED ". $targetArr['id'];
   }
   else
   {
    echo "NOTHING MATCHED THAT LINK & KEY PAIR";
   }
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
  <meta name="description" content="Remove your Link Stats ID from the system with all load stats.">
  <title>Link Stats - Remove</title>
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
                <h3 class="mbr-section-subtitle align-center mbr-light mbr-white pb-3 mbr-fonts-style display-5">Please Provide Your Link & Key</h3>
                
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
                            <div class="col-md-4 multi-horizontal" data-for="email">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="email-form1-1">Target Link</label>
                                    <input type="url" class="form-control" name="target" required="" placeholder="Your target link to remove" id="email-form1-1">
                                </div>
                            </div>
                        </div>
                        
                        
<div class="row row-sm-offset">
                            <div class="col-md-4 multi-horizontal" data-for="phone">
 <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-1">Private Link Key</label>
                                    <input type="text" class="form-control" name="key" required="" placeholder="Enter Private Link Key..." id="phone-form1-1">
                                </div>
           
</div>
            </div>
                        <span class="input-group-btn"><button type="submit" class="btn btn-primary display-4" id="linkBack">REMOVE THIS LINK</button></span>
                    </form>
            </div>
        </div>
    </div>
</section>
<script>
function getID(){
event.preventDefault();
document.getElementById("linkBack").innerHTML="REMOVING...";
$.ajax({
   type: "post",
   data: $("form").serialize(),
   success: function(response) {
   var button = document.getElementById("linkBack");
   button.innerHTML = response;
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


function removedTarget($linkID, $key)
{
global $targetsFileName;
global $statsUrlPart;
global $defaultsFileName;
global $targetsListFileName;
global $logsFolderName;

$deletedBit = false;
     $targets = file($targetsListFileName);
     $results = "";
     foreach($targets as $num => $items) {
         $in = explode('|', $items);
         $id = $in[0];
         $keyOfTarget = trim($in[4]);
        if ((strpos($linkID,$id) !== false) && $keyOfTarget == $key)
        {
          $deletedBit = true;
        } else
        {
          $results .= $items;
        }
     }
$log_file = dirname(__FILE__) . '/'.$targetsListFileName;
      if (!file_exists($log_file)) 
         {
            $fp = fopen($log_file, "w");
            fclose($fp);
          }
file_put_contents($log_file, $results);

$targets = ($logsFolderName."/".$linkID."/".$targetsFileName);
$defaults = ($logsFolderName."/".$linkID."/".$defaultsFileName);

if (file_exists($targets))
{
   unlink($targets);
}

if (file_exists($defaults))
{
   unlink($defaults);
}

if (file_exists($logsFolderName."/".$linkID))
{
   rmdir($logsFolderName."/".$linkID);
}
return $deletedBit;
}

?>