<?php
include_once("../wp-config.php");

$mysql_host     = DB_HOST;
$mysql_username = DB_USER;
$mysql_password = DB_PASSWORD;
$mysql_database = DB_NAME;

/* REPETIR pero en lugar de SITEURL, poner Las urls de los otros posibles environments */
$is_localhost_env       = (strpos($_SERVER['HTTP_HOST'], "localhost") !== false);
$is_localhost8080_env   = (strpos($_SERVER['HTTP_HOST'], "localhost:8080") !== false);
$is_mitreum_env         = (strpos($_SERVER['HTTP_HOST'], "mitreum") !== false);

$siteurl      = 'http://localhost:8080/hacia-el-este';  // <<  ---- CHANGE THIS. To replace

$replacements = array(
        'http://localhost:8080/hacia-el-este' => $siteurl,  // don't put the '/' at the end - REPLACE THIS IN YOUR STAGE SERVER - then in the browser your wp will be at http://localhost:8080/myprojectfolder/www
        'http://localhost/hacia-el-este' => $siteurl,  // don't put the '/' at the end - REPLACE THIS IN YOUR STAGE SERVER - then in the browser your wp will be at http://localhost:8080/myprojectfolder/www
        'http://www.mitreum.net' => $siteurl,  // don't put the '/' at the end - REPLACE THIS IN YOUR STAGE SERVER - then in the browser your wp will be at http://localhost:8080/myprojectfolder/www
        'utf8mb4' => 'utf8',  // if your mysql server doesnt accept utf8mb4
    );

//    IN LOCALHOST REF TO PATH ARE  /Applications/XAMPP/xamppfiles/htdocs/myprojectfolder/www
//    IN LOCALHOST REF TO SERVER ARE  /Applications/XAMPP/xamppfiles/   {en caso de db manager:  bin/mysqldump y bin/mysql }


$filename = listdirfile_by_date('../wp-content/backup-db');  // dont add the '/' at the end


/* Toma el último .sql del path pasado */
function listdirfile_by_date($path)
{
    $dir = opendir($path);
    $list = array();
    while($file = readdir($dir))
    {
        if($file != '..' && $file != '.' && strpos($file, ".sql"))
        {
            $list[] = $file;
        }
    }
    closedir($dir);

    krsort($list);

    foreach($list as $key => $value)
    {
        return $path.'/'.$list[$key];
    }
    return '';
}




echo "opening: <b>".$filename."</b>";



// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
//

/*

    drop all tables of the current db.
    TO_DO: make a backup first?

*/

 mysql_query("DROP DATABASE $mysql_database");
 mysql_query("CREATE DATABASE $mysql_database");



 mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

 mysql_query("USE DATABASE $mysql_database");

/*
    NOW IMPORT THE FILE

*/






// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;



foreach ($replacements as $search => $replace){
 if (strpos($line, $search)) $line = str_replace($search, $replace, $line);
}
// if (strpos($line, "SITEURL")) $line = str_replace("SITEURL", $localhost_url, $line);
// if (strpos($line, "INVOICPREFIX")) $line = str_replace("INVOICPREFIX", $invoice_prefix , $line);

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "<br><br>Tables imported successfully<br>";


/*echo "Manual fixes <br>";
$single_query = "UPDATE wp_options SET option_value = 455 WHERE option_name = 'woocommerce_terms_page_id';";
echo $single_query."<br>";
mysql_query($single_query) or print('Error performing query \'<strong>' . $single_query . '\': ' . mysql_error() . '<br /><br />');
*/
