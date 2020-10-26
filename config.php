<?php
/**
###################################
#                                ____                                           #
#     |||           |||     ///       \\\    |||   //    ||||||||||||||     #
#     |||    /\    |||    |||          |||    ||| //      |||                 #
#     |||  /    \  |||    |||          |||    ||| \\      |||```````        #
#     |||/        \|||    \\\____///     |||   \\    ||||||||||||||    #
#                                                                                   #
###################################
**/
// This File will be used for the global configuration of Link Stats
// the .htaccess will be generated from here to match changes

//***************
//*       Files
// ********************
// * target list file name
// ********************
$targetsListFileName = "targs.list";

// ********************
// *  target log file name
// ********************
$targetsFileName = "targs.log";

// *********************
// * default log file name
// *********************
$defaultsFileName = "defs.log";

// **************
// *     Folders
// ******************
// *  log folder name
// ******************
$logsFolderName = "pit";

// ********************
// *      Configuration
// *****************************
// *   allow target URL to be used  
// *****************************
$allowTargetURL = true;
// *****************************
// *   Do Not Log Repeated Visitors 
// *****************************
$useUniqueLogs = false;

// *****************
// *  stats URL part 
// *****************
$statsUrlPart = "info";



// ******************************
// *  userKey for api.userstack
// ******************************
$userStackApiKey = "f72b58b8f09ada350ced485b2444bdb8";


// *********************************
// *    Htaccess Auto Update Section    
// *********************************
// This will cause extended load times & security implications.
// Only added for first installation of custom htaccess file parameters

// *******************
// *  update htaccess
// *******************
$actualPage = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$end = strripos($actualPage,'/');
$rootPath = substr($actualPage,0,$end);
$htaccessFile = '.htaccess';
$htaccess = file_get_contents($htaccessFile);
if (needsUpdate())
{
   $rules = '#
# set home to index.php
DirectoryIndex index.php
#
# stop directory viewing
Options -Indexes
# stop log and target views
RewriteRule ^('.str_replace(".","\\.",$targetsListFileName).'|'.str_replace(".","\\.",$targetsFileName).'|'.str_replace(".","\\.",$defaultsFileName).') - [R=404,L]
ErrorDocument 404 '.$rootPath.'/home.php
#
# remove .php
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule !.*\.php$ %{REQUEST_FILENAME}.php [QSA,L]
Options +FollowSymlinks
RewriteEngine on
RewriteRule ^(.*)\$ $1.php [NC]
';
 if (!file_exists($htaccessFile)) 
         {
            $fp = fopen($htaccessFile, "w");
            fclose($fp);
          }
    file_put_contents($htaccessFile, $rules);
}

// **************************
// *  Check Htaccess Params   
// **************************
function needsUpdate()
{
global $targetsFileName;
global $defaultsFileName;
global $targetsListFileName;
global $rootPath;
global $htaccess;

$needsNewConfig = false;
  if (!hasConfig($targetsListFileName) |! hasConfig($targetsFileName) |! hasConfig($defaultsFileName) |! (strpos($htaccess, $rootPath) !== false))
{
   $needsNewConfig = true;
}
return $needsNewConfig;
}

function hasConfig($configPart)
{
global $htaccess;
$partToCheck = str_replace(".","\\.",$configPart);
return strpos($htaccess,$partToCheck)!==false;
}

?>
