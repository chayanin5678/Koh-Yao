<?php
//เช็คอุปกรณ์
function isMobileCheck(){
    $isMobile = false;
    $op = strtolower($_SERVER['HTTP_X_OPERAMINI_PHONE']);
    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
    $ac = strtolower($_SERVER['HTTP_ACCEPT']);
    $ip = $_SERVER['REMOTE_ADDR'];
     
    $isMobile = strpos($ac, 'application/vnd.wap.xhtml+xml') !== false
            || $op != ''
            || strpos($ua, 'sony') !== false 
            || strpos($ua, 'symbian') !== false 
            || strpos($ua, 'nokia') !== false 
            || strpos($ua, 'samsung') !== false 
            || strpos($ua, 'mobile') !== false
            || strpos($ua, 'windows ce') !== false
            || strpos($ua, 'epoc') !== false
            || strpos($ua, 'opera mini') !== false
            || strpos($ua, 'nitro') !== false
            || strpos($ua, 'j2me') !== false
            || strpos($ua, 'midp-') !== false
            || strpos($ua, 'cldc-') !== false
            || strpos($ua, 'netfront') !== false
            || strpos($ua, 'mot') !== false
            || strpos($ua, 'up.browser') !== false
            || strpos($ua, 'up.link') !== false
            || strpos($ua, 'audiovox') !== false
            || strpos($ua, 'blackberry') !== false
            || strpos($ua, 'ericsson,') !== false
            || strpos($ua, 'panasonic') !== false
            || strpos($ua, 'philips') !== false
            || strpos($ua, 'sanyo') !== false
            || strpos($ua, 'sharp') !== false
            || strpos($ua, 'sie-') !== false
            || strpos($ua, 'portalmmm') !== false
            || strpos($ua, 'blazer') !== false
            || strpos($ua, 'avantgo') !== false
            || strpos($ua, 'danger') !== false
            || strpos($ua, 'palm') !== false
            || strpos($ua, 'series60') !== false
            || strpos($ua, 'palmsource') !== false
            || strpos($ua, 'pocketpc') !== false
            || strpos($ua, 'smartphone') !== false
            || strpos($ua, 'rover') !== false
            || strpos($ua, 'ipaq') !== false
            || strpos($ua, 'au-mic,') !== false
            || strpos($ua, 'alcatel') !== false
            || strpos($ua, 'ericy') !== false
            || strpos($ua, 'up.link') !== false
            || strpos($ua, 'vodafone/') !== false
            || strpos($ua, 'wap1.') !== false
            || strpos($ua, 'wap2.') !== false;
        return $isMobile;   
}
//#################################################
function DateFormat($DateTime) {
//#################################################
	global $System_Session_Language;

	$DateTimeArr = explode(" ",$DateTime);
	$Date = $DateTimeArr[0];
	$Time = $DateTimeArr[1];

	$DateArr = explode("-",$Date);

	if ($System_Session_Language=="Thai") $DateArr[0] = ($DateArr[0] + 543)- 2500;
	
	return $DateArr[2]."/".$DateArr[1]."/".$DateArr[0];
}

function DateFormatThai($DateEn) {
//#################################################
		$DateTh="";
		if($DateEn=="Monday"){
			return $DateTh="จันทร์";
		}else if($DateEn=="Tuesday"){
			return $DateTh="อังคาร";
		}else if($DateEn=="Wednesday"){
			return $DateTh="พุธ";
		}else if($DateEn=="Thursday"){
			return $DateTh="พฤหัสบดี";
		}else if($DateEn=="Friday"){
			return $DateTh="ศุกร์";
		}else if($DateEn=="Saturday"){
			return $DateTh="เสาร์";
		}else{
			return $DateTh="อาทิตย์";
		}
	
}

//#################################################
function DateFormatInsert($DateTime) {
//#################################################
	global $core_session_chkup_language;
	
	$Time = "00:00:00";

	$DateArr = explode("-",$DateTime);
	if($core_session_chkup_language=="Thai"){
	$dataYear=$DateArr[2]-543;
	
	}else{
	$dataYear=$DateArr[2];
	}
	
	return $dataYear."-".$DateArr[1]."-".$DateArr[0];
}

//#################################################
function DateFormatInsertRe($DateTime) {
//#################################################
	global $core_session_chkup_language;
	
	$Time = "00:00:00";

	$DateArr = explode("-",$DateTime);
	if($core_session_chkup_language=="Thai"){
	$dataYear=$DateArr[2]-543;
	
	}else{
	$dataYear=$DateArr[0];
	}
	
	return $DateArr[2]."-".$DateArr[1]."-".$dataYear;
}

//#################################################
function DateFormatInsertRe_1($DateTime) {
//#################################################
	global $core_session_chkup_language;
	
	$Time = "00:00:00";

	$DateArr = explode("/",$DateTime);
	if($core_session_chkup_language=="Thai"){
	$dataYear=$DateArr[2]-543;
	
	}else{
	$dataYear=$DateArr[0];
	}
	
	return trim($DateArr[2])."-".trim($DateArr[1])."-".trim($dataYear);
}


//#################################################
function DateFormatTime($DateTime) {
//#################################################
	global $System_Session_Language;

	$DateTimeArr = explode(" ",$DateTime);
	$Date = $DateTimeArr[0];
	$Time = $DateTimeArr[1];

	$DateArr = explode("-",$Date);

	if ($System_Session_Language=="Thai") $DateArr[0] = ($DateArr[0] + 543)- 2500;
	
	return $DateArr[2]."/".$DateArr[1]."/".$DateArr[0]." ".$Time;
}

####################################################
// Edit By A 2012-02-08 for print pdf
####################################################
function ShowDateFormPDF($myDate) {
                $myDateArray=explode("-",$myDate);
                $myDay = sprintf("%d",$myDateArray[2]);
                switch($myDateArray[1]) {
                        case "01" : $myMonth = "มกราคม";  break;
                        case "02" : $myMonth = "กุมภาพันธ์";  break;
                        case "03" : $myMonth = "มีนาคม"; break;
                        case "04" : $myMonth = "เมษายน"; break;
                        case "05" : $myMonth = "พฤษภาคม";   break;
                        case "06" : $myMonth = "มิถุนายน";  break;
                        case "07" : $myMonth = "กรกฎาคม";   break;
                        case "08" : $myMonth = "สิงหาคม";  break;
                        case "09" : $myMonth = "กันยายน";  break;
                        case "10" : $myMonth = "ตุลาคม";  break;
                        case "11" : $myMonth = "พฤศจิกายน";   break;
                        case "12" : $myMonth = "ธันวาคม";  break;
                }
                $myYear = sprintf("%d",$myDateArray[0])+543;
                if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
                $myDate= "วันที่ ".$myDay . "  เดือน " . $myMonth . "  พ.ศ. " . $myYear;
                }else{
                $myDate="       /        /       ";
                }
        return $myDate;
}
function ShowDateFormThai($myDate) {
                $myDateArray=explode("-",$myDate);
                $myDay = sprintf("%d",$myDateArray[2]);
                switch($myDateArray[1]) {
                        case "01" : $myMonth = "มกราคม";  break;
                        case "02" : $myMonth = "กุมภาพันธ์";  break;
                        case "03" : $myMonth = "มีนาคม"; break;
                        case "04" : $myMonth = "เมษายน"; break;
                        case "05" : $myMonth = "พฤษภาคม";   break;
                        case "06" : $myMonth = "มิถุนายน";  break;
                        case "07" : $myMonth = "กรกฎาคม";   break;
                        case "08" : $myMonth = "สิงหาคม";  break;
                        case "09" : $myMonth = "กันยายน";  break;
                        case "10" : $myMonth = "ตุลาคม";  break;
                        case "11" : $myMonth = "พฤศจิกายน";   break;
                        case "12" : $myMonth = "ธันวาคม";  break;
                }
                $myYear = sprintf("%d",$myDateArray[0])+543;
                if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
                $myDate= $myDay ." ". $myMonth ." ".$myYear;
                }else{
                $myDate="       /        /       ";
                }
        return $myDate;
}
function ShowDateFormEng($myDate) {
                $myDateArray=explode("-",$myDate);
                $myDay = sprintf("%d",$myDateArray[2]);
                switch($myDateArray[1]) {
                        case "01" : $myMonth = "January";  break;
                        case "02" : $myMonth = "February";  break;
                        case "03" : $myMonth = "March"; break;
                        case "04" : $myMonth = "April"; break;
                        case "05" : $myMonth = "May";   break;
                        case "06" : $myMonth = "June";  break;
                        case "07" : $myMonth = "July";   break;
                        case "08" : $myMonth = "August";  break;
                        case "09" : $myMonth = "September";  break;
                        case "10" : $myMonth = "October";  break;
                        case "11" : $myMonth = "November";   break;
                        case "12" : $myMonth = "December";  break;
                }
                $myYear = sprintf("%d",$myDateArray[0]);
                if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
                $myDate= $myDay ." ". $myMonth ." ".$myYear;
                }else{
                $myDate="       /        /       ";
                }
        return $myDate;
}
function ShowDateFrontEng($myDate) {
                $myDateArray=explode("-",$myDate);
                $myDay = sprintf("%d",$myDateArray[0]);
                switch($myDateArray[1]) {
                        case "01" : $myMonth = "January";  break;
                        case "02" : $myMonth = "February";  break;
                        case "03" : $myMonth = "March"; break;
                        case "04" : $myMonth = "April"; break;
                        case "05" : $myMonth = "May";   break;
                        case "06" : $myMonth = "June";  break;
                        case "07" : $myMonth = "July";   break;
                        case "08" : $myMonth = "August";  break;
                        case "09" : $myMonth = "September";  break;
                        case "10" : $myMonth = "October";  break;
                        case "11" : $myMonth = "November";   break;
                        case "12" : $myMonth = "December";  break;
                }
                $myYear = sprintf("%d",$myDateArray[2]);
                if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
                $myDate= $myDay ." ". $myMonth ." ".$myYear;
                }else{
                $myDate="       /        /       ";
                }
        return $myDate;
}
function ShowDateTimeThai($myDate) {
                $myDateArray=explode("-",$myDate);
				$DateTimeArr = explode(" ",$myDate);
                $myDay = sprintf("%d",$myDateArray[2]);
                switch($myDateArray[1]) {
                        case "01" : $myMonth = "มกราคม";  break;
                        case "02" : $myMonth = "กุมภาพันธ์";  break;
                        case "03" : $myMonth = "มีนาคม"; break;
                        case "04" : $myMonth = "เมษายน"; break;
                        case "05" : $myMonth = "พฤษภาคม";   break;
                        case "06" : $myMonth = "มิถุนายน";  break;
                        case "07" : $myMonth = "กรกฎาคม";   break;
                        case "08" : $myMonth = "สิงหาคม";  break;
                        case "09" : $myMonth = "กันยายน";  break;
                        case "10" : $myMonth = "ตุลาคม";  break;
                        case "11" : $myMonth = "พฤศจิกายน";   break;
                        case "12" : $myMonth = "ธันวาคม";  break;
                }
                $myYear = sprintf("%d",$myDateArray[0])+543;
                if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
                $myDate= $myDay ." ". $myMonth ." ".$myYear." ".$DateTimeArr[1];
                }else{
                $myDate="       /        /       ";
                }
        return $myDate;
}
function dateThai($date_en){
		
		$myArray1= array(7);
		$myArray1[0] = "วันอาทิตย์";
		$myArray1[1] = "วันจันทร์";
		$myArray1[2] = "วันอังคาร";
		$myArray1[3] = "วันพุธ";
		$myArray1[4] = "วันพฤหัส";
		$myArray1[5] = "วันศุกร์";
		$myArray1[6] = "วันเสาร์";
		
		$myArray2= array(12);
		$myArray2[0] = "มกราคม";
		$myArray2[1] = "กุมภาพันธ์";
		$myArray2[2] = "มีนาคม";
		$myArray2[3] = "เมษายน";
		$myArray2[4] = "พฤษภาคม";
		$myArray2[5] = "มิถุนายน";
		$myArray2[6] = "กรกฎาคม";
		$myArray2[7] = "สิงหาคม";
		$myArray2[8] = "กันยายน";
		$myArray2[9] = "ตุลาคม";
		$myArray2[10] = "พฤศจิกายน";
		$myArray2[11] = "ธันวาคม";
		
		$date_thai=(int)substr($date_en,8,2)." ".$myArray2[(int)substr($date_en,5,2)-1]." ".((int)substr($date_en,0,4)+543)." ".substr($date_en,11);
		 
		return $date_thai;
	}


function monthThai($month){
		
		$myArray2= array(12);
		$myArray2[0] = "มกราคม";
		$myArray2[1] = "กุมภาพันธ์";
		$myArray2[2] = "มีนาคม";
		$myArray2[3] = "เมษายน";
		$myArray2[4] = "พฤษภาคม";
		$myArray2[5] = "มิถุนายน";
		$myArray2[6] = "กรกฎาคม";
		$myArray2[7] = "สิงหาคม";
		$myArray2[8] = "กันยายน";
		$myArray2[9] = "ตุลาคม";
		$myArray2[10] = "พฤศจิกายน";
		$myArray2[11] = "ธันวาคม";
		
		$date_thai=$myArray2[(int)$month-1];
		 
		return $date_thai;
		
}
function monthEng($month){
		
		$myArray2= array(12);
		$myArray2[0] = "January";
		$myArray2[1] = "February";
		$myArray2[2] = "March";
		$myArray2[3] = "April";
		$myArray2[4] = "May";
		$myArray2[5] = "June";
		$myArray2[6] = "July";
		$myArray2[7] = "August";
		$myArray2[8] = "September";
		$myArray2[9] = "October";
		$myArray2[10] = "November";
		$myArray2[11] = "December";
		  
		$date_eng=$myArray2[(int)$month-1];
		 
		return $date_eng;
}

function monthshortEng($month){
		
		$myArray2= array(12);
		$myArray2[0] = "Jan";
		$myArray2[1] = "Feb";
		$myArray2[2] = "Mar";
		$myArray2[3] = "Apr";
		$myArray2[4] = "May";
		$myArray2[5] = "Jun";
		$myArray2[6] = "Jul";
		$myArray2[7] = "Aug";
		$myArray2[8] = "Sep";
		$myArray2[9] = "Oct";
		$myArray2[10] = "Nov";
		$myArray2[11] = "Dec";
		  
		$date_eng=$myArray2[(int)$month-1];
		 
		return $date_eng;
}

function ConvThaiForPDF($myText) { 

	$myThaiText = iconv('UTF-8','cp874',$myText);

	return $myThaiText; 
}

####################################################
// Edit By A 2013-03-20 for convert to thai number
####################################################
function thnumber($val)
{
    return str_replace(
      Array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),
      Array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),
      $val );
};

//###################BY BEE 22/8/2013##############################
function FormatTimeByMantech($DateTime) {
//#################################################
	global $System_Session_Language;

	$Time = $DateTime;

	$TimeArr = explode(":",$Time);

	
	return $TimeArr[0].":".$TimeArr[1].":".$TimeArr[2];
}

//#################################################
function DateFormatTimeByMantech($DateTime) {
//#################################################
	global $System_Session_Language;

	$DateTimeArr = explode(" ",$DateTime);
	$Date = $DateTimeArr[0];
	//$Time = $DateTimeArr[1];
	$DateArr = explode("-",$Date);

	if ($System_Session_Language=="Thai") $DateArr[0] = ($DateArr[0] + 543)- 2500;

	
	return $DateArr[1]."/".$DateArr[2]."/".$DateArr[0];
}

############################################ START BY TOR 28 11/2013 13:29 For Mantech

function getAge($birthday) {
$then = strtotime($birthday);
return(floor((time()-$then)/31556926));
}




//############################# BY A 13/01/2014 04:37 For Mantech
function ShowDateText($myDate) { // Format 31012014 //////
		$myDateArray=explode("-",$myDate);
		
		$myDay = $myDateArray[2];
		$myMonth = $myDateArray[1];
		$myYear = $myDateArray[0];
		
		if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
			$myDate = $myDay."".$myMonth."".$myYear;
		}else{
			$myDate = "";
		}
        return $myDate;
}
//#################################################
function DateFormatInsert_Eng($DateTime) {
//#################################################
	global $core_session_chkup_language;
	
	$Time = "00:00:00";

	$DateArr = explode("-",$DateTime);
	if($core_session_chkup_language=="Thai"){
	$dataYear=$DateArr[0];
	
	}else{
	$dataYear=$DateArr[0];
	}
	
	return $DateArr[1]."/".$DateArr[2]."/".$dataYear."".$Time;
}


//###################################### by Yoseigi (21 July 2014) #### 
function DateFormat_dmY_to_Ymd($Date) {
//#####################################################################
	global $System_Session_Language;

	$dateBdayArr = explode("-",$Date);
	$Date = $dateBdayArr[0];
	$Mount = $dateBdayArr[1];
	$Year = $dateBdayArr[2];
	
	return $Year."-".$Mount."-".$Date;
}

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

############################################
function changeQuot($Data) {
############################################
	return str_replace("'","&rsquo;",str_replace('"','&quot;',$Data));
}


############################################
function rechangeQuot($Data) {
############################################
	return str_replace("&rsquo;","'",str_replace('&quot;','"',$Data));
}

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

function encodeStr($variable) { # by Pu  2007-05-23 
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                        $key = "xitgmLwmp";
                        $index = 0;
                        $temp="";
                        $variable = str_replace("=","?O",$variable);
                        for($i=0; $i < strlen($variable); $i++)
                        {
                                                $temp .= $variable[$i].$key[$index];      
                                                $index++;
                                                if($index >= strlen($key)) $index = 0;
                        }
                        $variable = strrev($temp);
                        $variable = base64_encode($variable);
                        $variable = utf8_encode($variable);
                        $variable = urlencode($variable);
                        $variable = str_rot13($variable);
                        return $variable;
}
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function decodeStr($enVariable) { # by Pu  2007-05-23 
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//decodeURL($_SERVER["QUERY_STRING"]);
                        $enVariable = str_rot13($enVariable);
                        $enVariable = urldecode($enVariable);
                        $enVariable = utf8_decode($enVariable);
                        $enVariable = base64_decode($enVariable);
                        $enVariable = strrev($enVariable);
                        $current = 0;
                        $temp="";
                        for($i=0; $i < strlen($enVariable); $i++)
                        {
                                                if($current%2==0)
                                                {
                                                            $temp .= $enVariable[$i];          
                                                }
                                                $current++;
                        }
                        $temp = str_replace("?O","=",$temp);
                        parse_str($temp, $variable); 
                         return $temp;

}



############################################
function DiffDate($date1,$date2) {
############################################

$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$datediff[]=$years;
$datediff[]=$months;
$datediff[]=$days;
return($datediff);
}




####################################################
function txtReplace($data){
####################################################
	$BlogName = str_replace("\\","",$data);
	return $BlogName;
}

####################################################
function cropImage($imagesource,$nw, $nh) {
####################################################
 
		$ImageData = getimagesize($imagesource);
		if($ImageData[2]==1) { 
			$simg = imagecreatefromgif($imagesource);
		} elseif($ImageData[2]==2) {
			$simg = imagecreatefromjpeg($imagesource);
		}else{
			$simg = imagecreatefromjpeg($imagesource);
		}
		
		$w = imagesx($simg);
		$h = imagesy($simg);
	 
		$dimg = imagecreatetruecolor($nw, $nh);
	 
		$wm = $w/$nw;
		$hm = $h/$nh;
	 
		$h_height = $nh/2;
		$w_height = $nw/2;
	 
		if($w> $h) {
	 
			$adjusted_width = $w / $hm;
			$half_width = $adjusted_width / 2;
			$int_width = $half_width - $w_height;
	 
			imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
	 
		} elseif(($w <$h) || ($w == $h)) {
	 
			$adjusted_height = $h / $wm;
			$half_height = $adjusted_height / 2;
			$int_height = $half_height - $h_height;
	 
			imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
	 
		} else {
			imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
		}
	 
		return $dimg;
	} 
####################################################
function get_Icon($DownloadFile){
####################################################
	$ImageType = strstr($DownloadFile,'.');														
	if($ImageType==".pdf"){
		$TypeImgFile="<i class='ace-icon fa fa-file-pdf-o bigger-140 red'></i>";
	}elseif($ImageType==".txt"){
		$TypeImgFile="<i class='ace-icon fa fa-file-text-o bigger-140 light'></i>";
	}elseif($ImageType==".xls" || $ImageType==".xlsx"){
		$TypeImgFile="<i class='ace-icon fa fa-file-excel-o bigger-140 green'></i>";
	}elseif($ImageType==".ppt"){
		$TypeImgFile="<i class='ace-icon fa fa-file-powerpoint-o bigger-140 red'></i>";
	}elseif($ImageType==".rtf" || $ImageType==".doc"|| $ImageType==".docx"){
		$TypeImgFile="<i class='ace-icon fa fa-file-word-o bigger-140 blue'></i>";
	}elseif($ImageType==".rar"){
		$TypeImgFile="<i class='ace-icon fa fa-file-zip-o bigger-140 orange'></i>";
	}elseif($ImageType==".zip"){
		$TypeImgFile="<i class='ace-icon fa fa-file-zip-o bigger-140 orange'></i>";
	}elseif($ImageType==".jpg" || $ImageType==".jpeg" || $ImageType==".gif" ){
		$TypeImgFile="<i class='ace-icon fa fa-file-photo-o bigger-140 purple'></i>";
	}else{
		$TypeImgFile="<i class='ace-icon fa fa-file-photo-o bigger-140 purple'></i>";
	}
	return($TypeImgFile);
}

####################################################
function get_IconSize($LinkRelativePath){
####################################################
		$filesize = @filesize($LinkRelativePath);		 
		if ($filesize<10485) {
			$sizeFile= number_format($filesize/1024,2)." Kb";
		}else{
			$sizeFile=  number_format($filesize/(1024*1024),2)." Mb";
		}
	return($sizeFile);
}


############################################
function txtLimit($s,$n){
############################################
	if(strlen($s)>$n)
		return iconv_substr($s, 0, $n, "UTF-8")."..";
	else
		return $s;
}
############################################
function remove_dir($dir)
############################################
{
  if(is_dir($dir))
  {
    $dir = (substr($dir, -1) != "/")? $dir."/":$dir;
    $openDir = opendir($dir);
    while($file = readdir($openDir))
    {
      if(!in_array($file, array(".", "..")))
      {
        if(!is_dir($dir.$file))
        {
          @unlink($dir.$file);
        }
        else
        {
          remove_dir($dir.$file);
        }
      }
    }
    closedir($openDir);
    @rmdir($dir);
  }
} 

function utf8_to_tis620($string) {
  $str = $string;
  $res = "";
  for ($i = 0; $i < strlen($str); $i++) {
    if (ord($str[$i]) == 224) {
      $unicode = ord($str[$i+2]) & 0x3F;
      $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
      $unicode |= (ord($str[$i]) & 0x0F) << 12;
      $res .= chr($unicode-0x0E00+0xA0);
      $i += 2;
    } else {
      $res .= $str[$i];
    }
  } 
  return $res;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function UTF8toTIS620($string) { 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	$UTF8 = array('เธ'=>'ก','เธ'=>'ข','เธ'=>'ฃ','เธ'=>'ค','เธ…'=>'ฅ','เธ'=>'ฆ','เธ'=>'ง','เธ'=>'จ','เธ'=>'ฉ','เธ'=>'ช','เธ'=>'ซ','เธ'=>'ฌ','เธ'=>'ญ','เธ'=>'ฎ','เธ'=>'ฏ','เธ'=>'ฐ','เธ‘'=>'ฑ','เธ’'=>'ฒ','เธ“'=>'ณ','เธ”'=>'ด','เธ•'=>'ต','เธ–'=>'ถ','เธ—'=>'ท','เธ'=>'ธ','เธ'=>'น','เธ'=>'บ','เธ'=>'ป','เธ'=>'ผ','เธ'=>'ฝ','เธ'=>'พ','เธ'=>'ฟ','เธ '=>'ภ','เธก'=>'ม','เธข'=>'ย','เธฃ'=>'ร','เธค'=>'ฤ','เธฅ'=>'ล','เธฆ'=>'ฦ','เธง'=>'ว','เธจ'=>'ศ','เธฉ'=>'ษ','เธช'=>'ส','เธซ'=>'ห','เธฌ'=>'ฬ','เธญ'=>'อ','เธฎ'=>'ฮ','เธฏ'=>'ฯ','เธฐ'=>'ะ','เธฑ'=>'ั','เธฒ'=>'า','เธณ'=>'ำ','เธด'=>'ิ','เธต'=>'ี','เธถ'=>'ี','เธท'=>'ื','เธธ'=>'ุ','เธน'=>'ู','เธบ'=>'ฺ','เธฟ'=>'฿','เน€'=>'เ','เน'=>'แ','เน'=>'โ','เน'=>'ใ','เน'=>'ไ','เน…'=>'ๅ','เน'=>'ๆ','เน'=>'็','เน'=>'่','เน'=>'้','เน'=>'๊','เน'=>'๋','เน'=>'์','เน'=>'ํ','เน'=>'๎','เน'=>'๏','เน'=>'๐','เน‘'=>'๑','เน’'=>'๒','เน“'=>'๓','เน”'=>'๔','เน•'=>'๕','เน–'=>'๖','เน—'=>'๗','เน'=>'๘','เน'=>'๙','เน'=>'๚','เน'=>'๛');
	return strtr($string, $UTF8); 
}
function ShowDateTime($myDate) {
		$datetime=explode(" ",$myDate);
		$myDateArray=explode("-",$datetime[0]);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
		if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
		$myDate=$myDay . " " . $myMonth . " " . $myYear." ".$datetime[1];
		}else{
		$myDate="-";
		}
        return $myDate;
}
function ShowDate($myDate) {
		$myDateArray=explode("-",$myDate);
		$myDay = $myDateArray[2];
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
		if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
		$myDate=$myDay . " " . $myMonth . " " . $myYear;
		}else{
		$myDate="-";
		}
        return $myDate;
}

function ShowDateMonth($myDate) {
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
		if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
		$myDate=$myMonth;
		}else{
		$myDate="-";
		}
        return $myDate;
}

function ShowMonthYear($myDate) {
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
		$myDate= $myMonth . " " . $myYear;
        return $myDate;
}

function ShowDatePDF($myDate) {
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
		if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
		$myDate=$myDay . " / " . $myMonth . " / " . $myYear;
		}else{
		$myDate="       /        /       ";
		}
        return $myDate;
}

function bathformat($number) {
		$numberstr = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
		$digitstr = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
	  
		$number = str_replace(",","",$number); // ลบ comma
		$number = explode(".",$number); // แยกจุดทศนิยมออก
	  
		// เลขจำนวนเต็ม
		$strlen = strlen($number[0]);
		$result = '';
		for($i=0;$i<$strlen;$i++) {
		  $n = substr($number[0], $i,1);
		  if($n!=0) {
			if($i==($strlen-1) AND $n==1){ $result .= 'เอ็ด'; }
			elseif($i==($strlen-2) AND $n==2){ $result .= 'ยี่'; }
			elseif($i==($strlen-2) AND $n==1){ $result .= ''; }
			else{ $result .= $numberstr[$n]; }
			$result .= $digitstr[$strlen-$i-1];
		  }
		}
		
		// จุดทศนิยม
		$strlen = strlen($number[1]);
		if ($strlen>2) { // ทศนิยมมากกว่า 2 ตำแหน่ง คืนค่าเป็นตัวเลข
		  $result .= 'จุด';
		  for($i=0;$i<$strlen;$i++) {
			$result .= $numberstr[(int)$number[1][$i]];
		  }
		} else { // คืนค่าเป็นจำนวนเงิน (บาท)
		  $result .= 'บาท';
		  if ($number[1]=='0' OR $number[1]=='00' OR $number[1]=='') {
			$result .= 'ถ้วน';
		  } else {
			// จุดทศนิยม (สตางค์)
			for($i=0;$i<$strlen;$i++) {
			  $n = substr($number[1], $i,1);
			  if($n!=0){
				if($i==($strlen-1) AND $n==1){$result .= 'เอ็ด';}
				elseif($i==($strlen-2) AND $n==2){$result .= 'ยี่';}
				elseif($i==($strlen-2) AND $n==1){$result .= '';}
				else{ $result .= $numberstr[$n];}
				$result .= $digitstr[$strlen-$i-1];
			  }
			}
			$result .= 'สตางค์';
		  }
		}
		return $result;
	  }

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

#################################################
function format($num,$length) {
#################################################

	$formated_num = strval($num);
	while (strlen($formated_num) < $length) {
		$formated_num = "0".$formated_num;
	}
	return $formated_num;
}



function encodeURL($variable) { 
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//-- ฟังก์ชั่นการเข้ารหัส ตัวแปรแบบ GET ผ่าน URL

		$key = "xitgmLwmp";
		$index = 0;
		$temp="";
		$variable = str_replace("=","๐O",$variable);
		for($i=0; $i < strlen($variable); $i++)
		{
				$temp .= $variable[$i].$key[$index];	
				$index++;
				if($index >= strlen($key)) $index = 0;
		}
		$variable = strrev($temp);
		$variable = base64_encode($variable);
		$variable = utf8_encode($variable);
		$variable = urlencode($variable);
		$variable = str_rot13($variable);

		$variable = str_replace("%","o7o",$variable);
		return "WP=".$variable;

}

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function decodeURL($enVariable) { 
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//-- ฟังก์ชั่นการถอดรหัส ตัวแปรแบบ GET ผ่าน URL
// การใช้งาน decodeURL($_SERVER["QUERY_STRING"]);
		$key = "xitgmLwmp";

		$ex = explode("WP=",$enVariable);
		$enVariable = $ex[1];
		$enVariable = str_replace("o7o","%",$enVariable);

		$enVariable = str_rot13($enVariable);
		$enVariable = urldecode($enVariable);
		$enVariable = utf8_decode($enVariable);
		$enVariable = base64_decode($enVariable);
		$enVariable = strrev($enVariable);

		$current = 0;
		$temp="";
		for($i=0; $i < strlen($enVariable); $i++)
		{
				if($current%2==0)
				{
					$temp .= $enVariable[$i];	
				}
				$current++;
		}
		$temp = str_replace("๐O","=",$temp);

		parse_str($temp, $variable); 
		//echo "temp=".$temp;

		foreach($variable as $key=>$value)
		{
				$_REQUEST[$key]=$value;
				global $$key; 
				$$key=$value;
		}
}

##########################################
function curPageName() {
##########################################
 return $_SERVER["SCRIPT_NAME"];
}

####################################################
function txtReplaceHTML($data){
####################################################
	$dataHTML = str_replace("\\","",$data);
	return $dataHTML;
}

####################################################
function resize($img, $w, $h, $newfilename) {
####################################################
 
 //Check if GD extension is loaded
 if (!extension_loaded('gd') && !extension_loaded('gd2')) {
  trigger_error("GD is not loaded", E_USER_WARNING);
  return false;
 }
 
 //Get Image size info
 $imgInfo = getimagesize($img);
 switch ($imgInfo[2]) {
  case 1: $im = imagecreatefromgif($img); break;
  case 2: $im = imagecreatefromjpeg($img);  break;
  case 3: $im = imagecreatefrompng($img); break;
  default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
 }
 
 //If image dimension is smaller, do not resize
 if ($imgInfo[0] <= $w && $imgInfo[1] <= $h) {
  $nHeight = $imgInfo[1];
  $nWidth = $imgInfo[0];
 }else{
                //yeah, resize it, but keep it proportional
  if ($w/$imgInfo[0] > $h/$imgInfo[1]) {
   $nWidth = $w;
   $nHeight = $imgInfo[1]*($w/$imgInfo[0]);
  }else{
   $nWidth = $imgInfo[0]*($h/$imgInfo[1]);
   $nHeight = $h;
  }
 }
 $nWidth = round($nWidth);
 $nHeight = round($nHeight);
 
 $newImg = imagecreatetruecolor($nWidth, $nHeight);
 
 /* Check if this image is PNG or GIF, then set if Transparent*/  
 if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
  imagealphablending($newImg, false);
  imagesavealpha($newImg,true);
  $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
  imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
 }
 imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);
 
 //Generate the file, and rename it to $newfilename
 switch ($imgInfo[2]) {
  case 1: imagegif($newImg,$newfilename); break;
  case 2: imagejpeg($newImg,$newfilename);  break;
  case 3: imagepng($newImg,$newfilename); break;
  default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
 }
   
   return $newfilename;
}
####################################################
function ShowDateThai($myDate) {
####################################################
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = sprintf("%2d",$myDateArray[0])+543-2500;
		if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
		$myDate=$myDay . " " . $myMonth . " " . $myYear;
		}else{
		$myDate="-";
		}
        return $myDate;
}
####################################################
function ShowDateEng($myDate) {
####################################################
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "Jan";  break;
			case "02" : $myMonth = "Feb";  break;
			case "03" : $myMonth = "Mar"; break;
			case "04" : $myMonth = "Apr"; break;
			case "05" : $myMonth = "May";   break;
			case "06" : $myMonth = "Jun";  break;
			case "07" : $myMonth = "Jul";   break;
			case "08" : $myMonth = "Aug";  break;
			case "09" : $myMonth = "Sep";  break;
			case "10" : $myMonth = "Oct";  break;
			case "11" : $myMonth = "Nov";   break;
			case "12" : $myMonth = "Dec";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])-2000;
		if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
		$myDate=$myDay . " " . $myMonth . " " . $myYear;
		}else{
		$myDate="-";
		}
        return $myDate;
}
############################################
function getUserPermissionOnMenu($myUserID,$myMenuID) {
############################################
	global 	$mysqli;
	
	  $sql = "SELECT sys_mis_permission FROM sys_mis WHERE sys_mis_menuid ='".$myMenuID."' AND sys_mis_perid ='".$myUserID."'";
	$Query=$mysqli->query($sql) OR DIE("Error: <br />$sql<br />\n");
	$RecordCount=$Query->num_rows;
	if($RecordCount>=1) { 
		$Row=$Query->fetch_array();
		return($Row[0]); 
	} else { 
		return("NA"); 
	}
}
############################################
function getGroupName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT sys_group_name FROM sys_group WHERE sys_group_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
	if($RecordCount>=1) { 
		$Row=$Query->fetch_array();
		$name_return= $Row[0];
		return($name_return); 
	}
}
############################################
function getNameMenu($myID) {
############################################

	global $mysqli;
//echo "aa ".
	$sql = "SELECT sys_menu_name".$_SESSION["core_session_sys_language"]." FROM sys_menu WHERE sys_menu_id='".$myID."'";
	
	
	//AND set_menu_language."='".$_SESSION["core_session_chkup_language"]."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
	if($RecordCount>=1) { 
		$Row=$Query->fetch_array();
	  	$name_return=$Row[0];
		
		//return iconv("tis-620", "utf-8",$name_return); 
		return $name_return; 
	}
}
############################################
function getStaffName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT sys_staff_fname,sys_staff_lname  FROM sys_staff WHERE sys_staff_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= $Row[0]." ".$Row[1];
		return($name_return); 
}

############################################
function getGeoName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT sys_geo_name".$_SESSION["core_session_sys_language"]."  FROM sys_geo WHERE sys_geo_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getProvinceName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT sys_prov_name".$_SESSION["core_session_sys_language"]."  FROM sys_prov WHERE sys_prov_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getAmperName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT sys_amp_name".$_SESSION["core_session_sys_language"]."  FROM sys_amp WHERE sys_amp_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getTambonName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT sys_tam_name".$_SESSION["core_session_sys_language"]."  FROM sys_tam WHERE sys_tam_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getPrefixName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT sys_prefix_name".$_SESSION["core_session_sys_language"]."  FROM sys_prefix WHERE sys_prefix_id='".$myID."'";
	$Query=$mysqli->query($sql)OR DIE("Error sql: <br>$sql<br>\n");
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getBranchName($myID) {
############################################
	global $mysqli;
	
	// $sql = "SELECT md_branch_name  FROM md_branch WHERE md_branch_id='".$myID."'";
	$sql = "SELECT md_trader_name  FROM md_trader WHERE md_trader_id='".$myID."'";
	$Query=$mysqli->query($sql)OR DIE("Error sql: <br>$sql<br>\n");
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getAPIName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT md_api_name  FROM md_api WHERE md_api_id='".$myID."'";
	$Query=$mysqli->query($sql)OR DIE("Error sql: <br>$sql<br>\n");
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getBalanceWallet($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT md_wallet_balance FROM md_wallet WHERE md_wallet_traderid='".$myID."' ORDER BY md_wallet_id DESC LIMIT 1";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"0";
		return($name_return); 
}

############################################
function getBankName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT md_bankname_name  FROM md_bankname WHERE md_bankname_id='".$myID."'";
	$Query=$mysqli->query($sql)OR DIE("Error sql: <br>$sql<br>\n");
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getEmployeeTypeName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT md_employeetype_name  FROM md_employeetype WHERE md_employeetype_id='".$myID."'";
	$Query=$mysqli->query($sql)OR DIE("Error sql: <br>$sql<br>\n");
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getSaleTypeName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT md_saletype_name  FROM md_saletype WHERE md_saletype_id='".$myID."'";
	$Query=$mysqli->query($sql)OR DIE("Error sql: <br>$sql<br>\n");
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getSaleName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT md_sale_code  FROM md_sale WHERE md_sale_id='".$myID."'";
	$Query=$mysqli->query($sql)OR DIE("Error sql: <br>$sql<br>\n");
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getBranchTypeName($myID) {
############################################
	global $mysqli;
	
	$sql = "SELECT md_branchtype_name  FROM md_branchtype WHERE md_branchtype_id='".$myID."'";
	$Query=$mysqli->query($sql)OR DIE("Error sql: <br>$sql<br>\n");
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function fulldelete($location) {    
############################################ 
    if (is_dir($location)) {     
        $currdir = opendir($location);     
        while ($file = readdir($currdir)) {     
            if ($file  <> ".." && $file  <> ".") {     
                $fullfile = $location."/".$file;     
                if (is_dir($fullfile)) {     
                    if (!fulldelete($fullfile)) {     
                        return false;     
                    }     
                } else {     
                    if (!unlink($fullfile)) {     
                        return false;     
                    }     
                }     
            }     
        }     
        closedir($currdir);     
        if (! rmdir($location)) {     
            return false;     
        }     
    } else {     
        if (!unlink($location)) {     
            return false;     
        }     
    }     
    return true;     
} 
####################################################
function DateDiff($strDate1,$strDate2)
####################################################
{
	return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
}
####################################################
function timeAgo($time_ago)
####################################################
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}

?>