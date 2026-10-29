<?php
## Database Connect #################################################
$db_config=array(
    "host"=>"localhost",  // กำหนด host
    "user"=>"", // กำหนดชื่อ user
    "pass"=>"",   // กำหนดรหัสผ่าน
    "dbname"=>"",  // กำหนดชื่อฐานข้อมูล
    "charset"=>"utf8"  // กำหนด charset
);
// Environment overrides let local testing use its own database.
foreach (array('host' => 'DB_HOST', 'user' => 'DB_USER', 'pass' => 'DB_PASSWORD', 'dbname' => 'DB_NAME', 'charset' => 'DB_CHARSET') as $key => $variable) {
    $value = getenv($variable);
    if ($value !== false) $db_config[$key] = $value;
}
$db_port = getenv('DB_PORT') !== false ? (int) getenv('DB_PORT') : 3306;
try {
    $mysqli = new mysqli($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['dbname'], $db_port);
    if ($mysqli->connect_errno || !$mysqli->set_charset($db_config['charset'])) {
        throw new RuntimeException('Database connection or charset initialization failed.');
    }
} catch (Exception $exception) {
    error_log('Database connection failed (code ' . $exception->getCode() . ').');
    http_response_code(503);
    header('Content-Type: text/plain; charset=utf-8');
    exit('Database temporarily unavailable. Please try again later.');
}
############################################
function mysqli_result($res,$row=0,$col=0)
############################################
{ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
//echo $mysqli->character_set_name();  // แสดง charset เอา comment ออก
//echo 'Success... ' . $mysqli->host_info . "n";
//$mysqli->close();
?>