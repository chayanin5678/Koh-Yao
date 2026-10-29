        <?php  
        error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
        require_once("manageadmin/libs/config.php");
        require_once("manageadmin/libs/connect.php");
        require_once("libs/session.php");
        require_once("libs/function.php"); 
        if($_SESSION['front_session_sys_language']=="thai"){
            include("libs/language_thai.php");
        }else{
            include("libs/language_eng.php");   
        } 
        date_default_timezone_set("Asia/Bangkok");
        $sql_info = "SELECT *  FROM sys_info WHERE 1=1 ORDER BY sys_info_id DESC";
        $Query_info=$mysqli->query($sql_info);
        $Row_info=$Query_info->fetch_array();
        // print_r($_REQUEST);
        
        ?>
 
        <form name="myForm" id="myForm" method="POST" action="">
            <input type="hidden" id="myaction" name="myaction" value="">
            <input type="hidden" id="language" name="language" value="<?php echo $_SESSION["front_session_sys_language"]?>">
            <input type="hidden" id="booking_type" name="booking_type" value="<?php echo $_REQUEST['booking_type']?>">
            <input type="hidden" id="locationstart" name="locationstart" value="<?php echo $_REQUEST['locationstart']?>">
            <input type="hidden" id="locationend" name="locationend" value="<?php echo $_REQUEST['locationend']?>">
            <input type="hidden" id="input_pickupdate" name="input_pickupdate" value="<?php echo $_REQUEST['input_pickupdate']?>">
            <input type="hidden" id="input_returndate" name="input_returndate" value="<?php echo $_REQUEST['input_returndate']?>">
            <input type="hidden" id="input_adult" name="input_adult" value="<?php echo $_REQUEST['input_adult']?>">
            <input type="hidden" id="input_child" name="input_child" value="<?php echo $_REQUEST['input_child']?>">
            <input type="hidden" id="input_infant" name="input_infant" value="<?php echo $_REQUEST['input_infant']?>">
            <input type="hidden" id="myid" name="myid" value="<?php echo $_REQUEST['myid']?>">
            <input type="hidden" id="boattime" name="boattime" value="<?php echo $_REQUEST['myid']?>">
            <input type="hidden" id="boattimereturn" name="boattimereturn" value="<?php echo $_REQUEST['boattimereturn']?>"> 

            <input type="hidden" id="input_pickup1" name="input_pickup1" value="<?php echo $_REQUEST['input_pickup1']?>"> 
            <input type="hidden" id="input_pickup2" name="input_pickup2" value="<?php echo $_REQUEST['input_pickup2']?>"> 
            <input type="hidden" id="input_carpickup1" name="input_carpickup1" value="<?php echo $_REQUEST['input_carpickup1']?>"> 
            <input type="hidden" id="input_carpickup2" name="input_carpickup2" value="<?php echo $_REQUEST['input_carpickup2']?>"> 
            <input type="hidden" id="input_pickuppoint1" name="input_pickuppoint1" value="<?php echo $_REQUEST['input_pickuppoint1']?>"> 
            <input type="hidden" id="input_pickuppoint2" name="input_pickuppoint2" value="<?php echo $_REQUEST['input_pickuppoint2']?>"> 
            <input type="hidden" id="input_hotelpickup1" name="input_hotelpickup1" value="<?php echo $_REQUEST['input_hotelpickup1']?>"> 
            <input type="hidden" id="input_hotelpickup2" name="input_hotelpickup2" value="<?php echo $_REQUEST['input_hotelpickup2']?>"> 
            <input type="hidden" id="input_filghtnumberpickup" name="input_filghtnumberpickup" value="<?php echo $_REQUEST['input_filghtnumberpickup']?>">
            <input type="hidden" id="input_filghtnumberpickup1" name="input_filghtnumberpickup1" value="<?php echo $_REQUEST['input_filghtnumberpickup1']?>">  
            <input type="hidden" id="input_filghtnumberpickup2" name="input_filghtnumberpickup2" value="<?php echo $_REQUEST['input_filghtnumberpickup2']?>">    
            <input type="hidden" id="input_filghtnumberdropoff" name="input_filghtnumberdropoff" value="<?php echo $_REQUEST['input_filghtnumberdropoff']?>"> 
            <input type="hidden" id="input_arrivetimeHH" name="input_arrivetimeHH" value="<?php echo $_REQUEST['input_arrivetimeHH']?>"> 
            <input type="hidden" id="input_arrivetimeMM" name="input_arrivetimeMM" value="<?php echo $_REQUEST['input_arrivetimeMM']?>"> 
            <input type="hidden" id="input_departtimeHH" name="input_departtimeHH" value="<?php echo $_REQUEST['input_departtimeHH']?>"> 
            <input type="hidden" id="input_departtimeMM" name="input_departtimeMM" value="<?php echo $_REQUEST['input_departtimeMM']?>"> 
            <input type="hidden" id="input_arrivetimeHH1" name="input_arrivetimeHH1" value="<?php echo $_REQUEST['input_arrivetimeHH1']?>"> 
            <input type="hidden" id="input_arrivetimeMM1" name="input_arrivetimeMM1" value="<?php echo $_REQUEST['input_arrivetimeMM1']?>"> 
            <input type="hidden" id="input_arrivetimeHH2" name="input_arrivetimeHH2" value="<?php echo $_REQUEST['input_arrivetimeHH2']?>"> 
            <input type="hidden" id="input_arrivetimeMM2" name="input_arrivetimeMM2" value="<?php echo $_REQUEST['input_arrivetimeMM2']?>"> 

            <input type="hidden" id="input_cardropoff1" name="input_cardropoff1" value="<?php echo $_REQUEST['input_cardropoff1']?>"> 
            <input type="hidden" id="input_cardropoff2" name="input_cardropoff2" value="<?php echo $_REQUEST['input_cardropoff2']?>"> 
            <input type="hidden" id="input_dropoffpoint1" name="input_dropoffpoint1" value="<?php echo $_REQUEST['input_dropoffpoint1']?>"> 
            <input type="hidden" id="input_dropoffpoint2" name="input_dropoffpoint2" value="<?php echo $_REQUEST['input_dropoffpoint2']?>"> 
            <input type="hidden" id="input_hoteldropoff1" name="input_hoteldropoff1" value="<?php echo $_REQUEST['input_hoteldropoff1']?>">  
            <input type="hidden" id="input_hoteldropoff2" name="input_hoteldropoff2" value="<?php echo $_REQUEST['input_hoteldropoff2']?>">  

            <input type="hidden" name="omise_source" id="omise_source">
            <input type="hidden" id="omise_token" name="omise_token">
            <!-- customer-details-area -->
            <section class="customer-details-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="customer-details-content">
                                <div class="icon">
                                    <!-- <img src="assets/img/icon/customer_det_icon.jpg" alt=""> -->
                                </div>
                                <div class="content">
                                    <h2 class="title">Customer Details: Please fill in with valid information.</h2>
                                    <div class="customer-progress-wrap">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <div class="customer-progress-step">
                                            <ul style="display: flex;  align-items: flex-start; justify-content: space-between;">
                                                <li style="width:25%">
                                                    <span>1</span>
                                                    <p>Choose Your Boat</p>
                                                </li>
                                                <li style="width:50%">
                                                    <span>2</span>
                                                    <p>Shuttle Transfer</p>
                                                </li>
                                                <li style="width:25%">
                                                    <span>3</span>
                                                    <p>Payment</p>
                                                </li>
                                                <li style="width:25%">
                                                    <span>4</span>
                                                    <p class="text-end">Booking Completed</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- customer-details-area-end -->

            <?php  
                // print_r($_REQUEST);
                $booking_type=$_REQUEST['booking_type'];
                $locationstart=$_REQUEST['locationstart'];
                $locationend=$_REQUEST['locationend'];
                $input_pickupdate=$_REQUEST['input_pickupdate'];
                $input_returndate=$_REQUEST['input_returndate'];
                $input_adult=$_REQUEST['input_adult'];
                $input_child=$_REQUEST['input_child'];
                $input_infant=$_REQUEST['input_infant'];
                $boattime=  $_REQUEST['myid'];
                $boattimereturn=$_REQUEST['boattimereturn'];
                
                $checkpersons=$input_adult+$input_child;
                if($boattimereturn!=""){
                    $checkpersons=$checkpersons*2;
                }
                $checkminimum=0;
                // echo "<br>sql_minimum=".
                $sql_minimum = "SELECT *  FROM ".$mod_md_timetable." WHERE (".$mod_md_timetable."_id='".$boattime."' OR ".$mod_md_timetable."_id='".$boattimereturn."')";
                $Query_minimum=$mysqli->query($sql_minimum);
                while($Row_minimum=$Query_minimum->fetch_array()){
                    $checkminimum=$checkminimum+$Row_minimum[$mod_md_timetable."_minimum"];
                }
                $sql_minimum1 = "SELECT *  FROM ".$mod_md_timetable." WHERE (".$mod_md_timetable."_id='".$boattime."' OR ".$mod_md_timetable."_id='".$boattimereturn."')";
                $Query_minimum1=$mysqli->query($sql_minimum1);
                $Row_minimum1=$Query_minimum1->fetch_array();
                
                //echo "<br>checkpersons=".$checkpersons;	
                //echo "<br>checkminimum=".$checkminimum;				
                                
            if($checkminimum>$checkpersons){				
                echo "<script language='javascript'>alert('".$txt_mod["booking:minimum"]." ".$Row_minimum1[$mod_md_timetable."_minimum"]." ".$txt_mod["booking:persons"]."');</script>";
                //header("Location:booking.php?".encodeURL("booking_type=$booking_type&locationstart=$locationstart&locationend=$locationend&input_pickupdate=$input_pickupdate&input_returndate=$input_returndate&input_adult=$input_adult&input_child=$input_child"));
                echo "<meta charset='UTF-8'><meta http-equiv='refresh' content='0;url=booking.php?".encodeURL("booking_type=$booking_type&locationstart=$locationstart&locationend=$locationend&input_pickupdate=$input_pickupdate&input_returndate=$input_returndate&input_adult=$input_adult&input_child=$input_child")."'/>";
            }else{ ?>
                <!-- booking-details-area -->
                <section class="booking-details-area">
                    <div class="container">
                        <div class="text-end">
                            <a href="#" onclick="backfn2()" class="btn">Back</a>
                        </div><br>
                        <div class="row justify-content-center">
                            <div class="col-73">
                                <div class="primary-contact">
                                    <!-- <i class="fa-regular fa-user"></i> -->
                                    <h2 class="title">Shuttle Transfer</h2>
                                </div>
                                <div class="booking-details-wrap" id="step2">
                                    <div class="row col-lg-12"> 
                                        <section class="cruise-list"> 
                                            <!-- End Sort by and View by -->
                                            <!-- Cruise Content -->
                                            <div class="cruise-list-cn">
                                                <div class="cruise-item row" style="padding:0">
                                                    <div class="payment-room col-5">
                                                        <?php
                                                            $sql_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_id='".$boattime."'";
                                                            $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");
                                                            $Row_timetable=$Query_timetable->fetch_array();
                                                            $row_startname=getLocationName($Row_timetable[$mod_md_timetable."_startid"]);
                                                            $row_endname=getLocationName($Row_timetable[$mod_md_timetable."_endid"]);
                                                            $row_pier=getPierName($Row_timetable[$mod_md_timetable."_pierid"]);
                                                            $row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);
                                                            $row_arrivaltime=FormatTime($Row_timetable[$mod_md_timetable."_arrivaltime"]);
                                                            $row_departuretime=FormatTime($Row_timetable[$mod_md_timetable."_departuretime"]);
                                                            $row_time=FormatTimeHour($Row_timetable[$mod_md_timetable."_time"]);
                                                            $row_remark=$Row_timetable[$mod_md_timetable."_remark"];
                                                            $row_detailtransfer=$Row_timetable[$mod_md_timetable."_detailtransfer"];
                                                            
                                                            $priceadult=$Row_timetable[$mod_md_timetable."_priceadult"];
                                                            $pricechild=$Row_timetable[$mod_md_timetable."_pricechild"];
                                                            $priceinfant=$Row_timetable[$mod_md_timetable."_priceinfant"];
                                                            
                                                            $priceadult_date=$Row_timetable[$mod_md_timetable."_saleadult"];
                                                            $pricechild_date=$Row_timetable[$mod_md_timetable."_salechild"];
                                                            $priceinfant_date=$Row_timetable[$mod_md_timetable."_saleinfant"];
                                                            if($priceadult_date!="0"){
                                                                $showpriceadult=$priceadult_date;
                                                                $showpricechild=$pricechild_date;
                                                                $showpriceinfant=$priceinfant_date;
                                                                $showpriceadult=getExchange($showpriceadult,$_SESSION["front_session_sys_currency"]);
                                                                $showpricechild=getExchange($showpricechild,$_SESSION["front_session_sys_currency"]);
                                                                $showpriceinfant=getExchange($showpriceinfant,$_SESSION["front_session_sys_currency"]);
                                                            }else{
                                                                $showpriceadult=$priceadult;
                                                                $showpricechild=$pricechild;
                                                                $showpriceinfant=$priceinfant;
                                                                // $showpriceadult=getExchange($showpriceadult,$_SESSION["front_session_sys_currency"]);
                                                                // $showpricechild=getExchange($showpricechild,$_SESSION["front_session_sys_currency"]);
                                                                // $showpriceinfant=getExchange($showpriceinfant,$_SESSION["front_session_sys_currency"]);
                                                            }
                    
                                                            $totaladult=$showpriceadult*$_REQUEST["input_adult"];
                                                            $totalchild=$showpricechild*$_REQUEST["input_child"];
                                                            $totalinfant=$showpriceinfant*$_REQUEST["input_infant"];
                                                            
                                                            $total1=$totaladult+$totalchild+$totalinfant;
                                                            //$ratetax=getPaypalTax($total1,$Row_timetable[$mod_md_timetable."_id"]);
                                                            $total=$total1+$ratetax;
                                                            $total11=$total1+$ratetax;
                    
                                                            $pickupdate = substr(DateFormatInsert($_REQUEST['input_pickupdate']),0,10);
                                                            $date=dateLang($pickupdate);
                    
                                                            $totalpassenger=$_REQUEST["input_adult"]+$_REQUEST["input_child"];
                                                            
                                                            $sql_company = "SELECT * FROM ".$mod_md_company." WHERE ".$mod_md_company."_id='".$Row_timetable[$mod_md_timetable."_companyid"]."'";
                                                            $Query_company=$mysqli->query($sql_company) OR DIE("Error sql_company: <br>$sql_company<br>\n");
                                                            $Row_company=$Query_company->fetch_array();
                                                            
                                                            //echo "<br>closetransfer=".$Row_company[$mod_md_company."_closetransfer"];
                                                            //echo "<br>datetime=".date("H:i:s");
                                                            // echo strtotime("2023-12-07 14:32:20");
                                                            // echo "<br>daylast=".
                                                            $daylast=date('Y-m-d H:i:s',strtotime("+1 day"));
                                                            $ddate = DateFormYmd2($pickupdate);
                                                            // echo "<br>pickupdatetransfer=".
                                                            $pickupdatetransfer=$ddate." ".$Row_company[$mod_md_company.'_closetransfer'];
                                                            // echo "<br>daydiff=".
                                                            $daydiff=strtotime($daylast) <= strtotime($pickupdatetransfer);
                                                            // echo "<br>daydiff=".
                                                            // $daydiff= strtotime($pickupdatetransfer) - strtotime($daylast); 



                                                        
                                                            $sql_timetable_return = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_id='".$boattimereturn."'";
                                                            $Query_timetable_return=$mysqli->query($sql_timetable_return) OR DIE("Error sql_timetable: <br>$sql_timetable_return<br>\n");
                                                            $Row_timetable_return=$Query_timetable_return->fetch_array();
                                                            $row_startname_return=getLocationName($Row_timetable_return[$mod_md_timetable."_startid"]);
                                                            $row_endname_return=getLocationName($Row_timetable_return[$mod_md_timetable."_endid"]);
                                                            $row_pier_return=getPierName($Row_timetable_return[$mod_md_timetable."_pierid"]);
                                                            $row_seat_return=getSeatName($Row_timetable_return[$mod_md_timetable."_seatid"]);
                                                            $row_arrivaltime_return=FormatTime($Row_timetable_return[$mod_md_timetable."_arrivaltime"]);
                                                            $row_departuretime_return=FormatTime($Row_timetable_return[$mod_md_timetable."_departuretime"]);
                                                            $row_time_return=FormatTimeHour($Row_timetable_return[$mod_md_timetable."_time"]);
                                                            $row_remark_return=$Row_timetable_return[$mod_md_timetable."_remark"];
                                                            $row_detailtransfer_return=$Row_timetable_return[$mod_md_timetable."_detailtransfer"];
                                                            
                                                            $priceadult_return=$Row_timetable_return[$mod_md_timetable."_priceadult"];
                                                            $pricechild_return=$Row_timetable_return[$mod_md_timetable."_pricechild"];
                                                            $priceinfant_return=$Row_timetable_return[$mod_md_timetable."_priceinfant"];
                                                            
                                                            $priceadult_date_return=$Row_timetable_return[$mod_md_timetable."_saleadult"];
                                                            $pricechild_date_return=$Row_timetable_return[$mod_md_timetable."_salechild"];
                                                            $priceinfant_date_return=$Row_timetable_return[$mod_md_timetable."_saleinfant"];
                                                            if($priceadult_date_return!="0"){
                                                                $showpriceadult_return=$priceadult_date_return;
                                                                $showpricechild_return=$pricechild_date_return;
                                                                $showpriceinfant_return=$priceinfant_date_return;
                                                                $showpriceadult_return=getExchange($showpriceadult_return,$_SESSION["front_session_sys_currency"]);
                                                                $showpricechild_return=getExchange($showpricechild_return,$_SESSION["front_session_sys_currency"]);
                                                                $showpriceinfant_return=getExchange($showpriceinfant_return,$_SESSION["front_session_sys_currency"]);
                                                            }else{
                                                                $showpriceadult_return=$priceadult_return;
                                                                $showpricechild_return=$pricechild_return;
                                                                $showpriceinfant_return=$priceinfant_return;
                                                                // $showpriceadult=getExchange($showpriceadult,$_SESSION["front_session_sys_currency"]);
                                                                // $showpricechild=getExchange($showpricechild,$_SESSION["front_session_sys_currency"]);
                                                                // $showpriceinfant=getExchange($showpriceinfant,$_SESSION["front_session_sys_currency"]);
                                                            }
                    
                                                            $totaladult_return=$showpriceadult_return*$_REQUEST["input_adult"];
                                                            $totalchild_return=$showpricechild_return*$_REQUEST["input_child"];
                                                            $totalinfant_return=$showpriceinfant_return*$_REQUEST["input_infant"];
                                                            
                                                            $total1_return=$totaladult_return+$totalchild_return+$totalinfant_return;
                                                            //$ratetax=getPaypalTax($total1,$Row_timetable_return[$mod_md_timetable."_id"]);
                                                            $total_return=$total1+$ratetax;
                                                            $total11_return=$total1+$ratetax;
                                                                
                                                            $input_returndate = substr(DateFormatInsert($_REQUEST['input_returndate']),0,10);
                                                            $date_return=dateLang($input_returndate);
                    
                                                            $totalpassenger_return=$_REQUEST["input_adult"]+$_REQUEST["input_child"];
                                                            
                                                            $sql_company = "SELECT * FROM ".$mod_md_company." WHERE ".$mod_md_company."_id='".$Row_timetable_return[$mod_md_timetable."_companyid"]."'";
                                                            $Query_company=$mysqli->query($sql_company) OR DIE("Error sql_company: <br>$sql_company<br>\n");
                                                            $Row_company=$Query_company->fetch_array();
                                                            
                                                            //echo "<br>closetransfer=".$Row_company[$mod_md_company."_closetransfer"];
                                                            //echo "<br>datetime=".date("H:i:s");
                                                            // echo strtotime("2023-12-07 14:32:20");
                                                            // echo "<br>daylast=".
                                                            $daylast_return=date('Y-m-d H:i:s',strtotime("+1 hour"));
                                                            $ddate_return = DateFormYmd2($input_returndate);
                                                            // echo "<br>pickupdatetransfer=".
                                                            $pickupdatetransfer_return=$ddate_return." ".$Row_company[$mod_md_company.'_closetransfer'];
                                                            // echo "<br>daydiff=".
                                                            $daydiff_return=strtotime($daylast_return) <= strtotime($pickupdatetransfer_return);
                                                            // echo "<br>daydiff=".
                                                            // $daydiff= strtotime($pickupdatetransfer) - strtotime($daylast); 
                                                        
                                                        ?>  
                                                    </div>
                                                    <div class="form-grp select-form">
                                            <div class="icon">
                                            
                                            </div>
                                            
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="form-grp">
                                                    <div class="icon">
                                                        <i class="flaticon-user-1"></i>
                                                    </div>
                                                    <div class="form">
                                                        <select id="input_prefix" name="input_prefix" class="form-select" aria-label="Default select example">
                                                            <option value="Mr.">Mr.</option>
                                                            <option value="Mrs.">Mrs.</option>
                                                            <option value="Others">Others..</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-grp">
                                                    <input type="text" id="input_fname" name="input_fname" placeholder="Give Name">
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-grp">
                                                    <input type="text" id="input_lname" name="input_lname" placeholder="Sur Name *">
                                                </div>
                                            </li>

                                            <div class="form-grp select-form">
                                                <div class="icon">
                                                    <!-- <i class="flaticon-phone"></i> -->
                                                </div>
                                                <div class="form"> 
                                                    <select id="input_countriescode" name="input_countriescode" class="form-select">
                                                    <?php 
                                                        $sql_countries = "SELECT * FROM ".$mod_sys_countries." WHERE ".$mod_sys_countries."_status='1' ORDER BY ".$mod_sys_countries."_name ASC";
                                                        $Query_countries=$mysqli->query($sql_countries) OR DIE("Error sql_countries: <br>$sql_countries<br>\n"); ?>
                                                        <option value=""><?php echo $txt_mod["booking:country"]?></option>
                                                        <?php while($Row_countries=$Query_countries->fetch_array()){
                                                            $row_countries_id=$Row_countries[$mod_sys_countries.'_id'];
                                                            $row_countries_telephone=$Row_countries[$mod_sys_countries.'_telephone'];
                                                            $row_countries_name=$Row_countries[$mod_sys_countries.'_name']; 
                                                            if($row_countries_id!=""){ ?>
                                                                <option value="<?php echo $row_countries_id?>"><?php echo $row_countries_name." (+".$row_countries_telephone.")";?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <li>
                                                <div class="form-grp">
                                                    <input type="text" id="input_phone" name="input_phone"  placeholder="Phone *">
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-grp">
                                                    <input type="text" id="input_email" name="input_email" placeholder="E-mail *">
                                                </div>
                                            </li> 
                                        </ul>

                                        
                                        <input type="hidden" id="count_passenger" name="count_passenger" value="1">
                                        <div class="row mb-3"> 
                                            <div class="col-xl-12">
                                                <div class="row g-4">
                                                    <div class="col-lg-6 col-sm-6" style="display:none;">
                                                        <div data-bs-toggle="collapse" onchange="showcollaps(1);">
                                                            <div class="form-check card-radio">
                                                                <input id="paymentMethod01" name="paymentMethod" type="radio" class="form-check-input" value="1" >
                                                                <label class="form-check-label" for="paymentMethod01">
                                                                    <span class="fs-16 text-muted me-2"><i class="ri-qr-code-line align-bottom"></i></span>
                                                                    <span class="fs-14 text-wrap">QR CODE</span>
                                                                </label>
                                                            
                                                            </div>
                                                            <label for="input_pay1"><img src="app-assets/images/bank/BANKPP.png" height="80"></label>
                                                        </div><br>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div data-bs-toggle="collapse" onchange="showcollaps(2);">
                                                            <div class="form-check card-radio">
                                                                <input id="paymentMethod02" name="paymentMethod" type="radio" class="form-check-input" value="2" checked >
                                                                <label class="form-check-label" for="paymentMethod02">
                                                                    <span class="fs-16 text-muted me-2"><i class="ri-bank-card-fill align-bottom"></i></span>
                                                                    <span class="fs-14 text-wrap">Credit / Debit Card</span>
                                                                </label>
                                                            </div>
                                                            <label for="input_pay0" style="margin-top:15px;"><img src="images/credit.png" height="40"></label>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="collapse appshowcollaps " id="paymentmethod_pp" style="display:none;">
                                                    <div class="card border">
                                                        <!-- Card header -->
                                                        <div class="card-header border-bottom">
                                                            <h5 class="mb-0">ชำระเงินด้วยพร้อมเพย์</h5>
                                                        </div>

                                                        <!-- Card body -->
                                                        <div class="card-body text-center">
                                                            <!-- Image -->
                                                            <img src="app-assets/images/bank/BANKPP.png" class="mb-3" alt="PROMPTPAY" style="height: 100px !important;">
                                                            <p class="mb-3"><strong>Tips:</strong> เพียงคลิกที่ปุ่มชำระเงินด้านล่างเพื่อสแกน QR-Code ชำระเงิน</p>

                                                            <!-- Button -->
                                                            <!-- <button type="button" class="btn btn-sm btn-outline-primary mb-0" onclick="modLoadInsertPromtpay()">ชำระเงินด้วยพร้อมเพย์</button> -->
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="collapse appshowcollaps " id="paymentmethodCollapse" style="display:block;" >
                                                    <div class="card border">
                                                        <!-- Card header -->
                                                        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
                                                            <h5 class="mb-2 mb-sm-0">บัตรเครดิต หรือ บัตรเดบิต</h5> 
                                                        </div> 

                                                        <!-- Card body -->
                                                        <div class="card-body">
                                                            <div class="p-4 shadow-none mb-0 mt-4">
                                                                <div class="row gy-3">
                                                                    <div class="col-md-12">
                                                                        <label for="cc-name" class="form-label">Name on
                                                                            card</label>
                                                                        <input type="text" class="form-control" id="holder_name" name="holder_name" placeholder="Enter name">
                                                                        <small class="text-muted">Full name as displayed on
                                                                            card</small>
                                                                    </div>

                                                                    <div class="col-md-5">
                                                                        <label for="cc-number" class="form-label">Credit card
                                                                            number</label>
                                                                        <input type="text" class="form-control" id="number" name="number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx">
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <label for="cc-expiration" class="form-label">Expiration Month</label>
                                                                        <input type="text" class="form-control" id="expiration_month" name="expiration_date"  placeholder="MM">
                                                                    </div> 
                                                                    <div class="col-md-2">
                                                                        <label for="cc-expiration" class="form-label">Expiration Year</label>
                                                                        <input type="text" class="form-control" id="expiration_year" name="expiration_year"  placeholder="YYYY">
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <label for="cc-cvv" class="form-label">CVC</label>
                                                                        <input type="text" class="form-control" id="security_code" name="security_code" maxlength="3" placeholder="xxx">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-muted mt-2 fst-italic">
                                                                <i data-feather="lock" class="text-muted icon-xs"></i> Your
                                                                transaction is secured with SSL encryption
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <script>
                                            let sa_value;
                                            function showcollaps(id){
                                                if(id==1){ 
                                                    document.getElementById('paymentmethod_pp').style.display = "block";
                                                    document.getElementById('paymentmethodCollapse').style.display = "none";
                                                    sa_value=1;
                                                }else{
                                                    document.getElementById('paymentmethod_pp').style.display = "none";
                                                    document.getElementById('paymentmethodCollapse').style.display = "block";
                                                    sa_value=2;
                                                }
                                            }
                                        </script>
                                        <script> 
                                            let card_number_input = document.getElementById("number"); 
                                            card_number_input.onkeydown = e => { 
                                                let key = e.keyCode || e.charCode;
                                                
                                                let is_digit = (key >= 48 && key <= 57) || (key >= 96 && key <= 105);
                                                let is_delete = key == 8 || key == 46;
                                                
                                                if (is_digit || is_delete) { 
                                                let text = e.target.value;
                                                let len = text.length;
                                                
                                                if(is_digit && (len==4 || len==9 || len==14))
                                                    card_number_input.value = text + " ";
                                                }      
                                                else return false;
                                            }  

                                            //For Date formatted input
                                            // var expDate = document.getElementById('expiration_date');
                                            // expDate.onkeyup = function (e) {
                                            //     if (this.value == this.lastValue) return;
                                            //     var caretPosition = this.selectionStart;
                                            //     var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
                                            //     var parts = [];
                                            //     for (var i = 0, len = sanitizedValue.length; i < len; i +=2) { parts.push(sanitizedValue.substring(i, i + 2)); } for (var i=caretPosition - 1; i>= 0; i--) {
                                            //         var c = this.value[i];
                                            //         if (c < '0' || c> '9') {
                                            //             caretPosition--;
                                            //         }
                                            //     }
                                            //     caretPosition += Math.floor(caretPosition / 2);
                                            //     this.value = this.lastValue = parts.join('/');
                                            //     this.selectionStart = this.selectionEnd = caretPosition;
                                            // } 
                                        </script>
                                        
                                        
                                        <div class="form-grp checkbox-grp">
                                            <input type="checkbox" id="confirm_policy" onclick="Loadpolicy(); return false;">
                                            <!-- <label for="checkbox">Add this person to passenger quick pick list</label>  -->
                                            <!-- <input type="checkbox" class="form-check-input" id="confirm_policy" onclick="Loadpolicy(); return false;"> -->
                                            <label class="form-check-label" for="confirm_policy" style="opacity:100%;color:black"><?php echo $txt_mod["tourdetail:understand"] ?>
                                                <a href="javascript:void(0)" onclick="Loadpolicy()"><?php echo $txt_mod["tourdetail:understand2"] ?></a></label>
                                            <div id="warning_confirm_policy" style="color: red;display:none">
                                                **** <?php echo $txt_mod["tourdetail:Please"] ?> ****
                                            </div>
                                        </div>
                                                </div>
                                            </div>
                                            <!-- End Cruise Content -->
                                            
                                        </section>  
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal_policy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" >
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $txt_mod["tourdetail:Terms"]  ?></h5>
                                        </div>
                                        <div class="modal-body" id="body_policy">
                                            <p style=" margin: 10px;padding: 5px;"> 
                                                <?php echo $txt_mod["tourdetail:Terms3"]  ?>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="button" onclick="confirmpolicy()"><?php echo $txt_mod["tourdetail:accept"]  ?></button>
                                            <button class="btn btn-danger" type="button" onclick="Closemodal()"><?php echo $txt_mod["tourdetail:close"]  ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-27">
                                <aside class="booking-sidebar">
                                    <h2 class="main-title">Booking Info</h2>
                                    <div class="widget">
                                        <span><?php echo $txt_mod["booking:date"]?> : </span><?php echo ShowDateFormEng($pickupdate);?><br>
                                        <ul class="flight-info">
                                            <li><img src="<?php echo"uploads/timetable/pictures/".$Row_timetable[$mod_md_timetable."_picname"];?>"  style="width:70px;" onerror="this.onerror=null;this.src='assets/img/placeholder.png'"> </li>
                                            <li><p><?php echo $row_departuretime ?>  <span>(<?php echo $row_startname?>)</span></p></li> 
                                            <li><p><?php echo $row_arrivaltime ?>  <span>(<?php echo $row_endname?>)</span></p></li> 
                                        </ul> 
                                        <?php if($_REQUEST["booking_type"]==2){?><br>
                                            <span><?php echo $txt_mod["booking:date"]?> : </span><?php echo ShowDateFormEng($input_returndate);?><br>
                                            <ul class="flight-info">
                                                <li><img src="<?php echo"uploads/timetable/pictures/".$Row_timetable_return[$mod_md_timetable."_picname"];?>"  style="width:70px;"  onerror="this.onerror=null;this.src='assets/img/placeholder.png'"> </li>
                                                <li><p><?php echo $row_departuretime_return ?>  <span>(<?php echo $row_startname_return?>)</span></p></li> 
                                                <li><p><?php echo $row_arrivaltime_return ?>  <span>(<?php echo $row_endname_return?>)</span></p></li> 
                                            </ul> 
                                        <?php } ?>
                                    </div>
                                    
                                    <div class="widget"> 
                                        <div class="price-summary-detail">
                                            <ul> 
                                                <li>Adult x <?php echo $input_adult ?> <span><?php echo number_format($totaladult,2) ?> <?php echo $_SESSION["front_session_sys_currency"]?></span></li>
                                                <li>Child  x <?php echo $input_child  ?> <span><?php echo number_format($totalchild,2) ?> <?php echo $_SESSION["front_session_sys_currency"]?></span></li>
                                                <li>Infant   x <?php echo $input_infant   ?> <span><?php echo number_format($totalinfant,2) ?> <?php echo $_SESSION["front_session_sys_currency"]?></span></li>
                                                <?php if($_REQUEST["booking_type"]==2){?>
                                                    <hr>
                                                    <li>Return: </li>
                                                    <li>Adult x <?php echo $input_adult ?> <span><?php echo number_format($totaladult_return,2) ?> <?php echo $_SESSION["front_session_sys_currency"]?></span></li>
                                                    <li>Child  x <?php echo $input_child  ?> <span><?php echo number_format($totalchild_return,2) ?> <?php echo $_SESSION["front_session_sys_currency"]?></span></li>
                                                    <li>Infant   x <?php echo $input_infant   ?> <span><?php echo number_format($totalinfant_return,2) ?> <?php echo $_SESSION["front_session_sys_currency"]?></span></li>
                                                <?php } ?> 
                                                
                                                <!-- <li>Discount<span>- 0.00 <?php echo $_SESSION["front_session_sys_currency"]?></span></li> -->
                                                <li>Total Payable<span><?php echo $total1+$total1_return ?> <?php echo $_SESSION["front_session_sys_currency"]?></span></li>
                                            </ul>
                                            <input type="hidden" name="omise_total" id="omise_total" value="<?php echo $total1+$total1_return ?>">
                                            <a href="#" id="addevent" onclick="Loadinsert()" class="btn disabled">Pay now</a>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- booking-details-area-end -->
            <?php } ?>
        </form>
        <div class="modal" tabindex="-1" role="dialog" id="myModalPromptpay" style>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="loadpromptpay">

                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <div id="Step4">

        </div>
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>