<?php
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
function FormatTime($DateTime) {
//#################################################
	$DateTimeArr = explode(":",$DateTime);

	return $DateTimeArr[0].":".$DateTimeArr[1];
}
function FormatTimeHour($DateTime) {
//#################################################
	$DateTimeArr = explode(":",$DateTime);

	return $DateTimeArr[0]."h ".$DateTimeArr[1]."m";
}
function ShowDateTimeFormThai($myDate) {
                $myDateArray=explode("-",$myDate);
                $myDay = sprintf("%d",$myDateArray[2]);
				$Time = explode(" ",$myDate);
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
                $myDate= $myDay ." ". $myMonth ." ".$myYear." เวลา ".substr($Time[1],0,5)." น.";
                }else{
                $myDate="       /        /       ";
                }
        return $myDate;
}
//#################################################
function DateFormatInsert($DateTime) {
//#################################################
	global $core_session_chkup_language;
	
	$Time = "00:00:00";

	$DateArr = explode("/",$DateTime);
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
	
	return $DateArr[2]."/".$DateArr[1]."/".$dataYear;
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
function ShowDateTimeThai($myDate) {
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
				$myTime=explode(" ",$myDateArray[2]);
                $myYear = sprintf("%d",$myDateArray[0])+543;
                if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
                $myDate= $myDay ." ". $myMonth ." ".$myYear;
                }else{
                $myDate="       /        /       ";
                }
        return $myDate." ".FormatTime($myTime[1]);
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
	$dataYear=$DateArr[2];
	
	}else{
	$dataYear=$DateArr[2];
	}
	
	return $dataYear."-".$DateArr[1]."-".$DateArr[0]."".$Time;
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
		$myTime=explode(" ",$myDateArray[2]);
		$myYear = sprintf("%d",$myDateArray[0])+543;
		if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
		$myDate=$myDay . " " . $myMonth . " " . $myYear;
		}else{
		$myDate="-";
		}
        return $myDate." ".FormatTime($myTime[1]);
}
function ShowDate($myDate) {
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

function GetTextMoney($Number){
$a=array("","หนึ่งล้าน","สองล้าน","สามล้าน","สี่ล้าน","ห้าล้าน","หกล้าน","เจ็ดล้าน","แปดล้าน","เก้าล้าน");
$b=array("","หนึ่งแสน","สองแสน","สามแสน","สี่แสน","ห้าแสน","หกแสน","เจ็ดแสน","แปดแสน","เก้าแสน");
$c=array("","หนึ่งหมื่น","สองหมื่น","สามหมื่น","สี่หมื่น","ห้าหมื่น","หกหมื่น","เจ็ดหมื่น","แปดหมื่น","เก้าหมื่น");
$d=array("","หนึ่งพัน","สองพัน","สามพัน","สี่พัน","ห้าพัน","หกพัน","เจ็ดพัน","แปดพัน","เก้าพัน");
$e=array("","หนึ่งร้อย","สองร้อย","สามร้อย","สี่ร้อย","ห้าร้อย","หกร้อย","เจ็ดร้อย","แปดร้อย","เก้าร้อย");
$f=array("","สิบ","ยี่สิบ","สามสิบ","สี่สิบ","ห้าสิบ","หกสิบ","เจ็ดสิบ","แปดสิบ","เก้าสิบ");
$g=array("","เอ็ด","สอง","สาม","สี่","ห้า","หก","เจ็ด","แปด","เก้า");
$m=array("","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ด","แปด","เก้า");
$h=บาท;
$l=ถ้วน;
$Number=str_replace(",","",$Number);
$Number=explode(".",$Number);
$Price=$Number[0];
$Pricestang=$Number[1];

$k=strlen($Price);
switch($k)
{
	case"7";
	{
		$z7=substr($Price,-7,1);
		$z6=substr($Price,-6,1);
		$z5=substr($Price,-5,1);
		$z4=substr($Price,-4,1);
		$z3=substr($Price,-3,1);
		$z2=substr($Price,-2,1);
		$z1=substr($Price,-1,1);
		if($z2<='0'){
		$TextMoney= $a[$z7].$b[$z6].$c[$z5].$d[$z4].$e[$z3].$f[$z2].$m[$z1].$h;
		}else{
		$TextMoney= $a[$z7].$b[$z6].$c[$z5].$d[$z4].$e[$z3].$f[$z2].$g[$z1].$h;	
		}
		break;
	}
	case"6";
	{
		$z6=substr($Price,-6,1);
		$z5=substr($Price,-5,1);
		$z4=substr($Price,-4,1);
		$z3=substr($Price,-3,1);
		$z2=substr($Price,-2,1);
		$z1=substr($Price,-1,1);
		if($z2<='0'){
		$TextMoney=  $b[$z6].$c[$z5].$d[$z4].$e[$z3].$f[$z2].$m[$z1].$h;
		}else{
		$TextMoney=  $b[$z6].$c[$z5].$d[$z4].$e[$z3].$f[$z2].$g[$z1].$h;
		}
		break;
	}
	case"5";
	{
		$z5=substr($Price,-5,1);
		$z4=substr($Price,-4,1);
		$z3=substr($Price,-3,1);
		$z2=substr($Price,-2,1);
		$z1=substr($Price,-1,1);
		if($z2<='0'){
		$TextMoney=  $c[$z5].$d[$z4].$e[$z3].$f[$z2].$m[$z1].$h;
		}else{
		$TextMoney=  $c[$z5].$d[$z4].$e[$z3].$f[$z2].$g[$z1].$h;	
		}
			break;
	}
	case"4";
	{
		$z4=substr($Price,-4,1);
		$z3=substr($Price,-3,1);
		$z2=substr($Price,-2,1);
		$z1=substr($Price,-1,1);
		if($z2<='0'){
		$TextMoney=  $d[$z4].$e[$z3].$f[$z2].$m[$z1].$h;
		}else{
		$TextMoney=  $d[$z4].$e[$z3].$f[$z2].$g[$z1].$h;	
		}
			break;
	}
	case"3";
	{
		$z3=substr($Price,-3,1);
		$z2=substr($Price,-2,1);
		$z1=substr($Price,-1,1);
		if($z2<='0'){
		$TextMoney=  $e[$z3].$f[$z2].$m[$z1].$h;
		}else{
		$TextMoney=  $e[$z3].$f[$z2].$g[$z1].$h;	
		}
			break;
	}
	case"2";
	{
		$z2=substr($Price,-2,1);
		if($z2<='0'){
		$z1=substr($Price,-1,1);
		$TextMoney=  $f[$z2].$m[$z1].$h;
		}else{
			$z1=substr($Price,-1,1);
		$TextMoney=  $f[$z2].$g[$z1].$h;
			break;
		}
	}
	case"1";
	{
		if($z2<='0'){
			$z1=substr($Price,-1,1);
		$TextMoney=  $m[$z1].$h;
		}else{
		$z1=substr($Price,-1,1);
		$TextMoney=  $g[$z1].$h;
			break;
		}
	}
}
if($Pricestang=='0'){
return $TextMoney.$l;
}else{
	
$stangunit ="สตางค์";
$i=strlen($Pricestang);
switch($i)
{
	case"2";
	{
		$z2=substr($Pricestang,-2,1);
		$z1=substr($Pricestang,-1,1);
		 $TextMoneyStang=  $f[$z2].$g[$z1];
			break;
	}
	
	case"1";
	{
		$z1=substr($Pricestang,-1,1);
		$TextMoneyStang=  $g[$z1];
			break;
	}

	
}

return $TextMoney.$TextMoneyStang.$stangunit;
}
	

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
function dateLang($date_en,$lang){
		$date=date('w', strtotime($date_en));
		if($lang=="eng"){
			$thai_day_arr = array ("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		}else{
			$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
		}
		$thai_date_return=$thai_day_arr[$date]; 
		return $thai_date_return;
}
function ShowDateLang($myDate,$lang) {
                $myDateArray=explode("-",$myDate);
                $myDay = sprintf("%d",$myDateArray[2]);
				if($lang=="eng"){
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
				}else{
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
				}
                $myYear = sprintf("%d",$myDateArray[0]);
                if($myDate!="" && $myDate!="0000-00-00 00:00:00" && $myDate!="0000-00-00" && $myDate!="--"){
                $myDate= $myDay ." ". $myMonth ." ".$myYear;
                }else{
                $myDate="       /        /       ";
                }
        return $myDate;
}
############################################
function getUserPermissionOnMenu($myUserID,$myMenuID) {
############################################
	global 	$mysqli,$mod_sys_permission;
	
	  $sql = "SELECT ".$mod_sys_permission."_permission FROM ".$mod_sys_permission." WHERE ".$mod_sys_permission."_menuid ='".$myMenuID."' AND ".$mod_sys_permission."_perid ='".$myUserID."'";
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
	global $mysqli,$mod_sys_grp;
	
	$sql = "SELECT ".$mod_sys_grp."_name FROM ".$mod_sys_grp." WHERE ".$mod_sys_grp."_id='".$myID."'";
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

	global $mysqli,$mod_sys_menu,$core_session_sys_language;
//echo "aa ".
	$sql = "SELECT ".$mod_sys_menu."_name".$_SESSION["core_session_sys_language"]." FROM ".$mod_sys_menu." WHERE ".$mod_sys_menu."_id='".$myID."'";
	
	
	//AND ".$mod_set_menu_language."='".$_SESSION["core_session_chkup_language"]."'";
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
	global $mysqli,$mod_sys_staff;
	
	$sql = "SELECT ".$mod_sys_staff."_fname,".$mod_sys_staff."_lname  FROM ".$mod_sys_staff." WHERE ".$mod_sys_staff."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= $Row[0]." ".$Row[1];
		return($name_return); 
}

############################################
function getGeoName($myID) {
############################################
	global $mysqli,$mod_sys_geo;
	
	$sql = "SELECT ".$mod_sys_geo."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_sys_geo." WHERE ".$mod_sys_geo."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getProvinceName($myID) {
############################################
	global $mysqli,$mod_sys_province;
	
	$sql = "SELECT ".$mod_sys_province."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_sys_province." WHERE ".$mod_sys_province."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getAmperName($myID) {
############################################
	global $mysqli,$mod_sys_amphures;
	
	$sql = "SELECT ".$mod_sys_amphures."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_sys_amphures." WHERE ".$mod_sys_amphures."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getTambonName($myID) {
############################################
	global $mysqli,$mod_sys_tambon;
	
	$sql = "SELECT ".$mod_sys_tambon."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_sys_tambon." WHERE ".$mod_sys_tambon."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getPrefixName($myID) {
############################################
	global $mysqli,$mod_sys_prefix;
	
	$sql = "SELECT ".$mod_sys_prefix."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_sys_prefix." WHERE ".$mod_sys_prefix."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getProvince($myID) {
############################################
	global $mysqli,$mod_md_province;
	
	$sql = "SELECT ".$mod_md_province."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_province." WHERE ".$mod_md_province."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getLocationName($myID) {
############################################
	global $mysqli,$mod_md_location;
	
	$sql = "SELECT ".$mod_md_location."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_location." WHERE ".$mod_md_location."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getLocationNameEng($myID) {
############################################
	global $mysqli,$mod_md_location;
	
	$sql = "SELECT ".$mod_md_location."_nameeng  FROM ".$mod_md_location." WHERE ".$mod_md_location."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getBoatTypeName($myID) {
############################################
	global $mysqli,$mod_md_boattype;
	
	$sql = "SELECT ".$mod_md_boattype."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_boattype." WHERE ".$mod_md_boattype."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getSeatName($myID) {
############################################
	global $mysqli,$mod_md_seat;
	
	$sql = "SELECT ".$mod_md_seat."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_seat." WHERE ".$mod_md_seat."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getCompanyName($myID) {
############################################
	global $mysqli,$mod_md_company;
	
	$sql = "SELECT ".$mod_md_company."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_company." WHERE ".$mod_md_company."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}

############################################
function getPierName($myID) {
############################################
	global $mysqli,$mod_md_pier;
	
	$sql = "SELECT ".$mod_md_pier."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_pier." WHERE ".$mod_md_pier."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getFaqTypeName($myID) {
############################################
	global $mysqli,$mod_md_faqtype;
	
	$sql = "SELECT ".$mod_md_faqtype."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_faqtype." WHERE ".$mod_md_faqtype."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getCarType($myID) {
############################################
	global $mysqli,$mod_md_cartype;
	
	$sql = "SELECT ".$mod_md_cartype."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_cartype." WHERE ".$mod_md_cartype."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getTransferName($myID) {
############################################
	global $mysqli,$mod_md_transfer;
	
	$sql = "SELECT ".$mod_md_transfer."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_transfer." WHERE ".$mod_md_transfer."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getPackageName($myID) {
############################################
	global $mysqli,$mod_md_package;
	
	$sql = "SELECT ".$mod_md_package."_name".$_SESSION["core_session_sys_language"]."  FROM ".$mod_md_package." WHERE ".$mod_md_package."_id='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getCountriesName($myID) {
############################################
	global $mysqli,$mod_sys_countries;
	
	$sql = "SELECT ".$mod_sys_countries."_name  FROM ".$mod_sys_countries." WHERE ".$mod_sys_countries."_code='".$myID."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= ($Row[0]!="")?$Row[0]:"-";
		return($name_return); 
}
############################################
function getExchange($money) {
############################################
	global $mysqli,$mod_md_exchange;
	
	$sql = "SELECT ".$mod_md_exchange."_money  FROM ".$mod_md_exchange." WHERE 1=1";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		$name_return= $money/$Row[0];
		return($name_return); 
}
############################################
function getPaypalTax($money,$timetable) {
############################################
	global $mysqli,$mod_md_timetable;
	$sql = "SELECT ".$mod_md_timetable."_vat  FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_id='".$timetable."'";
	$Query=$mysqli->query($sql);
	$Row=$Query->fetch_array();
		
	$name_return=($money*$Row[0])/100;
	return($name_return); 
}
############################################
function getAgentName($myNo) {
############################################
	global $mysqli,$mod_md_agent;
	
	$sql = "SELECT * FROM ".$mod_md_agent." WHERE ".$mod_md_agent."_no='".$myNo."'";
	$Query=$mysqli->query($sql);
	$RecordCount=$Query->num_rows;
		$Row=$Query->fetch_array();
		if($Row[$mod_md_agent."_company"]!=""){
			$name_return= $Row[$mod_md_agent."_company"];
		}else{
			$name_return= $Row[$mod_md_agent."_fname"]." ".$Row[$mod_md_agent."_lname"];
		}
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
function duration($begin,$end){
	####################################################
	$remain=intval(strtotime($end)-strtotime($begin));
	$wan=floor($remain/86400);
	$l_wan=$remain%86400;
	$hour=floor($l_wan/3600);
	$l_hour=$l_wan%3600;
	$minute=floor($l_hour/60);
	$second=$l_hour%60;
	return sprintf("%02d",$hour).":".sprintf("%02d",$minute);
}
?>