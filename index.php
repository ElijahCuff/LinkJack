<?php
// get configuration
include('config.php');

if (hasParam('id'))
{
$useragent= $_SERVER['HTTP_USER_AGENT'];
$ip = getIp();
$id = $_GET['id'];
$key = $_GET[$statsUrlPart];
$device = $ip.'|'.$useragent;
$logDevice = $ip.'|'.$useragent.'|'.time();
buildFile($targetsListFileName);
$target = getTarget($id);
$loadedID = $target[0];
$loadedQuery = $target[1];
$loadedTargetURL = $target[2];
$loadedDefaultURL = $target[3];
$loadedKey = $target[4];
$doUnique = $useUniqueLogs;

if (strlen($loadedTargetURL) > 0)
{
 if (!isTarget($device, $loadedQuery)){
     logView($logDevice,$logsFolderName.'/'.$loadedID,$defaultsFileName,$loadedQuery,$doUnique);
     redirect($loadedDefaultURL);
    } 
else
{
     logView($logDevice,$logsFolderName.'/'.$loadedID,$targetsFileName,$loadedQuery,$doUnique);
     redirect($loadedTargetURL);
 }

}
else
{
 four04();
}

}
else
{
  four04();
}

function four04()
{
  $data = file_get_contents('home.php');
  echo $data;
  exit;
}


function isTarget($device, $query)
{
       $results = false;
       $parts = explode(",",$query);
        foreach($parts as $part)
        {
        if (stripos($device, trim($part)) !== false) 
        {
           $results = true;
        }
        }
        return $results;
}
function getTarget($linkID)
{
global $targetsListFileName;
     $targets = file($targetsListFileName);
     $results;
     foreach($targets as $num => $value) {
$in = explode('|', trim($value));
$id = $in[0];
        if (strpos($linkID,$id)!==false) 
        {
           $results = $in;
        }
      }
     return $results;
}

function logView($device, $path, $fileName, $title, $uniqueLog = true) 
{
$dir = dirname(__FILE__) . '/'.$path.'/'; 
$file = $dir.$fileName;

if( !file_exists($dir) ) 
{ 
    mkdir($dir, 0755, true);
 } 
if (!file_exists($file)) 
         {
            $fp = fopen($file, "w");
            fclose($fp);
          }


  // only log unique visits
$valid = true; 
 if ($uniqueLog)
  {
     $logLines = file($file);
     foreach($logLines as $logLine)
     {
       $lineParts = explode("|",$logLine);
       $ipInLog = $lineParts[0];
       $userInLog = $lineParts[1];
       $combined = $ipInLog.'|'.$userInLog;
       $devParts = explode("|", $device);
       $devIp = $devParts[0];
       $devUser = $devParts[1];
       $devComb = $devIp."|". $devUser;
       if (strpos($devComb,$combined) !== false)
          {
                $valid = false;
           }
     }
   }

 // continue
  if ($valid)
{
 file_put_contents($file, $device."\n", FILE_APPEND);
}
}


function buildFile($path)
{
      $log_file = dirname(__FILE__) . '/'.$path;
      if (!file_exists($log_file)) 
         {
            $fp = fopen($log_file, "w");
            fclose($fp);
          }
}

function redirect($url)
{
   ob_start();
   header("Location: $url");
   exit();
   ob_end_flush();
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

function getStats($id, $key)
{
global $statsUrlPart;
echo '<form id="myForm" action="stats" method="post">
<input type="hidden" name="id" value="'.$id.'">
<input type="hidden" name="'.$statsUrlPart.'" value="'.$key.'">
</form>
<script type="text/javascript">
    document.getElementById("myForm").submit();
</script>
';
}

function hasParam($param) 
{
      return (isset($_REQUEST[$param])? true : false);
}

?>
