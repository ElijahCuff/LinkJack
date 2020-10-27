<?php
include('config.php');
$id = $_POST['id'];
$key = $_POST[$statsUrlPart];
$targetsList = $targetsListFileName;
$targetsFile = $logsFolderName.'/'.$id.'/'.$targetsFileName;
$targets = 0;
$defaultsFile = $logsFolderName.'/'.$id.'/'.$defaultsFileName;
$defaults = 0;
$targetsOut = "";
$defaultsOut = "";
$foundID = false;
$targetMatch = "";
$redirectURL = "";
$defaultURL = "";
$failURL = "getstats?error";
$apiKey = $userStackApiKey;
$viewersIP = getIp();

if(hasParam('ipID') && strlen($_POST['ipID']) > 6)
{
   echo ipInfo($_POST['ipID'], $_POST['userID']);
   exit;
}

if (file_exists($targetsList)) 
         {
              foreach(file($targetsList) as $targ)
              {
                   $parts = explode("|", $targ);
                   $idOf = $parts[0];
                   $matchOf = $parts[1];
                   $targUrlOf = $parts[2];
                   $defURL = $parts[3];
                   $keyOf = trim($parts[4]);
                  if ($idOf == $id)
                      {
                          if ($keyOf !== trim($key))
                              { 
                                    redirect($failURL);
                              }
                         $targetMatch = htmlspecialchars($matchOf);
                         $redirectURL = htmlspecialchars($targUrlOf);
                         $defaultURL = htmlspecialchars($defURL);
                         $foundID = true;
                      }
                     
              }
         }
if (!$foundID)
{
   redirect($failURL);
}
if (file_exists($targetsFile)) 
         {
              
              $targets = count(file($targetsFile));
              foreach(file($targetsFile) as $line)
              {
                   $loop++;
                  $parts = explode("|", $line);
                  $isIpv6 = false;
                  $ipv4 = "";
if (strpos($parts[0],'::')!==false)
{
  $isIpv6 = true;
 $ipv6 = $parts[0]; 
 $ipv4 = hexdec(substr($ipv6, 0, 2)). "." . hexdec(substr($ipv6, 2, 2)). "." . hexdec(substr($ipv6, 5, 2)). "." . hexdec(substr($ipv6,7,2));
}

$device = json_decode(getDeviceInfo($parts[1]),true);
$os = $device['os']['name'];

// GET THIS SERVERS DATE
$date = $parts[2];
$nowTime = time();
$userLocalTime = timeFormat($date, $nowTime, false);
if(strlen($os) < 1)
{
  $os = "BOT";
}

                  $targetsOut .= '
<tr> 
                
                
                
       
              <td class="body-item mbr-fonts-style display-7">'.$userLocalTime.'</td><td class="body-item mbr-fonts-style display-7">TARGET</td><td class="body-item mbr-fonts-style display-7"><button type="button" class="btn btn-primary btn-sm" style="white-space: nowrap ;margin:0 0 0 0;padding: 0 4px 0 4px;display:inline;" onclick="getIpInfo(this, \''.$parts[0].'\', \''.trim($parts[1]).'\');">'.($isIpv6? $ipv4 :$parts[0]).'</button></td><td class="body-item mbr-fonts-style display-7" style="white-space: nowrap ;">'.$os.'</td></tr>';
     }
          }

if (file_exists($defaultsFile)) 
         {
              $defaults = count(file($defaultsFile));
              $loop = 0;
              foreach(file($defaultsFile) as $line)
              {
                  $loop++;
                  $parts = explode("|", $line);
              $isIpv6 = false;
                  $ipv4 = "";
if (strpos($parts[0],'::')!==false)
{
  $isIpv6 = true;
 $ipv6 = $parts[0]; 
 $ipv4 = hexdec(substr($ipv6, 0, 2)). "." . hexdec(substr($ipv6, 2, 2)). "." . hexdec(substr($ipv6, 5, 2)). "." . hexdec(substr($ipv6,7,2));
}

$device = json_decode(getDeviceInfo($parts[1]),true);
$os = $device['os']['family'];

// GET THIS SERVERS DATE
$date = $parts[2];
$userLocalTime = $date;
$nowTime = time();
$userLocalTime = timeFormat($date, $nowTime, false);
if(strlen($os) < 1)
{
  $os = "BOT";
}
                  $targetsOut .= '
<tr> 
                
                
                
                
              <td class="body-item mbr-fonts-style display-7">'.$userLocalTime.'</td><td class="body-item mbr-fonts-style display-7">DEFAULT</td><td class="body-item mbr-fonts-style display-7"><button type="button" class="btn btn-primary btn-sm" style="white-space: nowrap ;margin:0 0 0 0;padding: 0 4px 0 4px;display:inline;" onclick="getIpInfo(this, \''.$parts[0].'\', \''.trim($parts[1]).'\');">'.($isIpv6? $ipv4 :$parts[0]).'</button></td><td class="body-item mbr-fonts-style display-7" style="white-space: nowrap ;">'.$os.'</td></tr>';
               }
          }
if(!hasParam('ipID'))
{
echo '
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="My Link Stats Stats">
  <title>Stats</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/datatables/data-tables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
  <section class="mbr-section content4 cid-rTcJNdGl3k" id="content4-3">
 <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h4 class="align-center pb-0 pt-2 mbr-fonts-style display-2">Link Statistics</h4>
                <h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-5" style="font-size:14px;">'.$targetMatch.' -> '.$redirectURL.'<br>Others -> '.$defaultURL.'<br><br>Click on a IP address for details.</h3>
            </div>
        </div>
    </div>
</section>


<div align="center">
<div style="width: 45%; float:left; margin:10px;height:150px;">
<div class="card p-3 align-right col-12 col-md-6">
                    <div class="panel-item p-3">
                        
                        <div class="card-text">
                            <h3 class="mbr-fonts-style display-2">
                                  '.$defaults.'
                            </h3>
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">NON Targets</h4>
                            
                        </div>
                    </div>
               
            </div>
</div>
<div style="width: 45%; float:left; margin:10px;height:150px;">

<div class="card p-3 align-left col-12 col-md-6">
                    <div class="panel-item p-3">
                        

                        <div class="card-text">
                            <h3 class="mbr-fonts-style display-2">
                                  '.$targets.'
                            </h3>
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">Targets Hit</h4>
                            
                        </div>
                    </div>
                </div>
</div>

           <div class="card p-0 align-right col-12 col-md-6">
                    <div class="panel-item p-3">
                
                    </div>
                </div>

               

<section>
 <div>
  <div class="container container-table" id="ipInfoBox" style="display: none;">
    <h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-5" id="ipInfoTitle">IP INFORMATION</h3>
      <div class="table-wrapper">
        <div class="container">
          <table class="table">
            <thead>
              <tr class="table-heads"><th class="mbr-fonts-style display-7">📡</th>
<th class="mbr-fonts-style display-7">💻</th>
<th class="mbr-fonts-style display-7">📶</th>
             </tr>
            </thead>
            <tbody id="ipInfoTableParts"><tr><td class="body-item mbr-fonts-style display-7">Place 0</td><td class="body-item mbr-fonts-style display-7">Place 1</td><td class="body-item mbr-fonts-style display-7">Place 2</td></tr><tr>
            </tbody>
          </table>
        </div>
  </div>
</section>

<section class="section-table cid-rTcRTBY1K1" id="table1-7">

  
  
  <div class="container container-table">
      
      
      <div class="table-wrapper">
        <div class="container">
          <div class="row search">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="dataTables_filter">
                  <label class="searchInfo mbr-fonts-style display-7">Search:</label>
                  <input class="form-control input-sm" disabled="">
                </div>
            </div>
          </div>
        </div>

        <div class="container scroll">
          <table class="table isSearch table-hover table-sm" cellspacing="0">
            <thead>
              <tr class="table-heads">
<th class=" mbr-fonts-style display-7">📆</th>
<th class=" mbr-fonts-style display-7">🔗</th>
<th class="mbr-fonts-style display-7">🌐</th>
<th class="mbr-fonts-style display-7">💻</th></tr>
            </thead>

            <tbody>'.$targetsOut.'</tbody>
         </table>
        </div>
        <div class="container table-info-container">
          <div class="row info">
            <div class="col-md-6">
              <div class="dataTables_info mbr-fonts-style display-7">
                <span class="infoBefore">Showing</span>
                <span class="inactive infoRows"></span>
                <span class="infoAfter"></span>
                <span class="infoFilteredBefore"> of </span>
                <span class="inactive infoRows"></span>
                <span class="infoFilteredAfter"></span>
              </div>
            </div>
            <div class="col-md-6"></div>
          </div>
        </div>
      </div>
    </div>
</section>

<script>
function getIpInfo(button, ip, user){
var ipInfoBox = document.getElementById("ipInfoBox");
var ipInfoTitle = document.getElementById("ipInfoTitle");
var ipTableHeads = document.getElementById("ipInfoTableHeads");
var ipTableParts = document.getElementById("ipInfoTableParts");
var oldText = button.innerHTML;
button.innerHTML = "LOADING";
var nowIP = ip;
var nowUser = user;
var urllink = window.location.href;
event.preventDefault();
$.ajax({
    type: "POST",
    url: urllink,
    data: {ipID: ip , userID: user },
    success: function(output){
    var ipInfo = $.parseJSON(output);
    ipInfoBox.style = "display:inline;";
    ipInfoTitle.innerHTML = "IP<br>"+ipInfo.ip+"<br>Agent<p style=\"font-size:14px;\">"+ipInfo.ua+"</p>";
     ipTableParts.innerHTML = \'<tr><td class="body-item mbr-fonts-style display-7">\'+ipInfo.country_name+", "+ipInfo.region+"/"+ipInfo.city+\'</td><td class="body-item mbr-fonts-style display-7">\'+ipInfo.browser.name+" "+ipInfo.browser.version+\'</td><td class="body-item mbr-fonts-style display-7">\'+ipInfo.org+\'</td></tr>\';
     button.innerHTML = oldText;
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
  <script src="assets/datatables/jquery.data-tables.min.js"></script>
  <script src="assets/datatables/data-tables.bootstrap4.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
  
</body>
</html>';
}

function ipInfo($ip, $useragent) 
{

$ch = file_get_contents('https://ipapi.co/'.$ip.'/json/');
$ipParts = json_decode($ch,true);



// append device data to IP json
$deviceParts = json_decode(getDeviceInfo($useragent), true);

$finalArray = array_merge($ipParts, $deviceParts);
$ch = json_encode($finalArray);
return $ch;

/**
Accepted Params,

 "ip": "000.00.109.08"
 "city": "Bengaluru"
 "region": "Karnataka"
 "region_code": "KA"
 "country": "IN"
 "country_code": "IN"
 "country_code_iso3": "IND"
 "country_capital": "New Delhi"
 "country_tld": ".in"
 "country_name": "India"
 "continent_code": "AS"
 "in_eu": false

 "postal": "560002"
 "latitude": 12.9721
 "longitude": 77.5933
 "timezone": "Asia/Kolkata"
 "utc_offset": "+0530"
 "country_calling_code": "+91"
 "currency": "INR"
 "currency_name": "Rupee"
 "languages": "en-IN"
 "country_area": 3287590.0
 "country_population": 1173108018.0
 "asn": "AS24309"
 "org": "Atria Convergence Technologies Pvt. Ltd. Broadband Internet Service Provider INDIA" 

**/


}

function timeFormat($start_time, $end_time, $std_format = false)
{       
$total_time = $end_time - $start_time;
$days       = floor($total_time /86400);        
$hours      = floor($total_time /3600);     
$minutes    = intval(($total_time/60) % 60);        
$seconds    = intval($total_time % 60);     
$results = "";
if($std_format == false)
{
  if($days > 0) $results .= $days . (($days > 1)?" days ":" day ");     
  if($hours > 0) $results .= $hours . (($hours > 1)?" hrs ":" hr ");        
  if($minutes > 0) $results .= $minutes . (($minutes > 1)?" mins ":" min ");
  if($seconds > 0) $results .= $seconds . (($seconds > 1)?" secs ":" sec ");
}
else
{
  if($days > 0) $results = $days . (($days > 1)?" days ":" day ");
  $results = sprintf("%s%02d:%02d:%02d",$results,$hours,$minutes,$seconds);
}
return $results;
}



function getDeviceInfo($userAgent) 
{
  global $apiKey;
  $userAgent = trim($userAgent);
  $userAgents = dirname(__FILE__) . '/useragent.list';
      if (!file_exists($userAgents)) 
         {
            $fp = fopen($userAgents, "w");
            fclose($fp);
          }

  $log = file($userAgents); 
  // check exists
  $savedUserAgent;
  $needsData = true; 
     foreach ($log as $user) 
       {
          if (strpos($user, $userAgent) !== false) 
           {
              $needsData = false;
     $in = $user;
$index = strpos($in,"|",0)+1;
$end = strpos($in,"\n",$index);
$length = $end - $index;
$cutPart = substr($in,$index,$length);
$savedUserAgent = $cutPart;
              break; 
           }
       }


 // userAgents
  if ($needsData)
     { 
    $queryparams = http_build_query([
      'access_key' => $apiKey,
      'ua' => $userAgent ]);
    $ch = curl_init('http://api.userstack.com/detect?' . $queryparams);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
          curl_close($ch);
file_put_contents($userAgents, $userAgent.'|'.$json."\n", FILE_APPEND);
    return $json;
    }
   else
   {
      return $savedUserAgent;
   }


/**
ACCEPTED Cat & Name for getDevice(cat,name);
Category  >  Name

ua	
type	
brand	
name	
url	
os > name	
os > code	
os > url	
os > family	
os > family_code	
os > family_vendor	
os > icon	
os > icon	
device > is_mobile_device	
device > type	
browser > name	
browser > version	
browser > version_major
browser > engine	
crawler > is_crawler	
crawler > category	
crawler > last_seen
**/
}

function getIp() 
{
   $ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:getUserIpAddr());
   if (strlen($ip) > 1)
   {
     return $ip;
   }
   else
   {
     return $_ENV['HTTP_X_FORWARDED_FOR'];
   }
}

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function hasParam($param) 
{
   return array_key_exists($param, $_REQUEST);
}

function redirect($url)
{
   ob_start();
   header("Location: $url");
   exit();
   ob_end_flush();
}
?>
