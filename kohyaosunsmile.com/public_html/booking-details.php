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
        // print_r($Row_info);
        // print_r($_REQUEST);
        ?>

        <?php  include("include/include_header2.php");  ?>
       
        <!-- main-area -->
        <main>
 
            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="breadcrumb-content text-center">
                                <h2 class="title"  style="color:#031f60;">Booking Details</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item" ><a href="#"  style="color:#031f60;">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Booking Details</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->


            <!-- customer-details-area -->
            <section class="customer-details-area" id="loadstep">
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
                                            <div class="progress-bar" role="progressbar" style="width: 35%;" aria-valuenow="25" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <div class="customer-progress-step" >
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
                <!-- customer-details-area-end --> 
                <?php
                    $booking_type = $_REQUEST['booking_type'];
                    $locationstart = $_REQUEST['locationstart'];
                    $locationend = $_REQUEST['locationend'];
                    $input_pickupdate = $_REQUEST['input_pickupdate'];
                    $input_returndate = $_REQUEST['input_returndate'];
                    $input_adult = $_REQUEST['input_adult'];
                    $input_child = $_REQUEST['input_child'];
                    $input_infant = $_REQUEST['input_infant'];
                    $boattime = $_REQUEST['myid'];
                    $boattimereturn = $_REQUEST['boattimereturn'];

                    if($locationstart=="undefined"){
                        $locationstart = "";
                    }
                    if($locationend=="undefined"){
                        $locationend = "";
                    }
                    if($booking_type!="1" && $booking_type!="2"){
                        $booking_type = ($boattimereturn!="") ? "2" : "1";
                    }

                    if(($locationstart=="" || $locationend=="") && $boattime!=""){
                        $sql_timetable_selected = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_id='".$boattime."' LIMIT 1";
                        $Query_timetable_selected = $mysqli->query($sql_timetable_selected);
                        if($Query_timetable_selected && $Query_timetable_selected->num_rows>0){
                            $Row_timetable_selected = $Query_timetable_selected->fetch_array();
                            if($locationstart==""){
                                $locationstart = $Row_timetable_selected[$mod_md_timetable."_startid"];
                            }
                            if($locationend==""){
                                $locationend = $Row_timetable_selected[$mod_md_timetable."_endid"];
                            }
                        }
                    }
                ?>
                <form name="myForm" id="myForm" method="POST" action="">
                    <input type="hidden" id="myaction" name="myaction" value="">
                    <input type="hidden" id="language" name="language" value="<?php echo $_SESSION["front_session_sys_language"]?>">
                    <input type="hidden" id="booking_type" name="booking_type" value="<?php echo $booking_type?>">
                    <input type="hidden" id="locationstart" name="locationstart" value="<?php echo $locationstart?>">
                    <input type="hidden" id="locationend" name="locationend" value="<?php echo $locationend?>">
                    <input type="hidden" id="input_pickupdate" name="input_pickupdate" value="<?php echo $input_pickupdate?>">
                    <input type="hidden" id="input_returndate" name="input_returndate" value="<?php echo $input_returndate?>">
                    <input type="hidden" id="input_adult" name="input_adult" value="<?php echo $input_adult?>">
                    <input type="hidden" id="input_child" name="input_child" value="<?php echo $input_child?>">
                    <input type="hidden" id="input_infant" name="input_infant" value="<?php echo $input_infant?>">
                    <input type="hidden" id="myid" name="myid" value="<?php echo $boattime?>">
                    <input type="hidden" id="boattime" name="boattime" value="<?php echo $boattime?>">
                    <input type="hidden" id="boattimereturn" name="boattimereturn" value="<?php echo $boattimereturn?>"> 
                    <?php  
                        // print_r($_REQUEST);
                        
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
                                    <a href="#" onclick="backfn()" class="btn">Back</a>
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

                                                    <!-- Sort by and View by -->
                                                    
                                                    <!-- End Sort by and View by -->
                                                    <!-- Cruise Content -->
                                                    <div class="cruise-list-cn">
                                                        <div class="sort-view clearfix">  
                                                            <div class="view-by float-left">
                                                                <a href="javascript:void(0)" title="" class="current"><i class="fa fa-anchor" aria-hidden="true"></i> <?php echo $txt_mod["booking:depart"]?> : <?php if($_REQUEST["locationstart"]!=""){echo getLocationName($_REQUEST["locationstart"])." ".$txt_mod["booking:to"]." ".getLocationName($_REQUEST["locationend"]);}else{ echo getLocationName("2")." ".$txt_mod["booking:to"]." ".getLocationName("6");}?></a> 
                                                            </div> 
                                                        </div>
                                                        
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
                                                                    $daylast=date('Y-m-d H:i:s',strtotime("+1 hour"));
                                                                    $ddate = DateFormYmd2($pickupdate);
                                                                    // echo "<br>pickupdatetransfer=".
                                                                    $pickupdatetransfer=$ddate." ".$Row_company[$mod_md_company.'_closetransfer'];
                                                                    // echo "<br>daydiff=".
                                                                    $daydiff=strtotime($daylast) <= strtotime($pickupdatetransfer);
                                                                    // echo "<br>daydiff=".
                                                                    // $daydiff= strtotime($pickupdatetransfer) - strtotime($daylast); 
                                                                ?> 
                                                                <div class="payment-price"> 
                                                                    <figure>
                                                                        <img src="<?php echo "uploads/timetable/pictures/".$Row_timetable[$mod_md_timetable."_picname"];?>" style="width:120px;"  alt="" onerror="this.onerror=null;this.src='assets/img/placeholder.png'">
                                                                    </figure> 
                                                                </div>
                                                            </div>
                                                            <div class="payment-room col-7">
                                                                <?php
                                                                //เช็คว่าเส้นทางสนามบินรึป่าว
                                                                $airport=0;
                                                                $sql_location = "SELECT *  FROM ".$mod_md_location." WHERE ".$mod_md_location."_id='".$Row_timetable[$mod_md_timetable."_startid"]."'";
                                                                $Query_location=$mysqli->query($sql_location);
                                                                while($Row_location=$Query_location->fetch_array()){
                                                                    $airport=$airport+$Row_location[$mod_md_location."_airport"];
                                                                }
                                                            
                                                                if($airport==1){//เช็คว่าคือสนามบินรึป่าว ?>
                                                                    <input type="hidden" id="input_pickup1" name="input_pickup1">
                                                                    <input type="hidden" id="input_pickupairport" name="input_pickupairport" value="1">
                                                                    <div class="payment-room col-lg-12">
                                                                        <div class="payment-price">
                                                                            <div class="total-trip" style="margin-left:0;">
                                                                                <span>
                                                                                    <div class="radio-checkbox">
                                                                                        &nbsp;&nbsp;<b><i class="fa fa-bus"></i>
                                                                                            <?php echo $txt_mod["booking:filghtarrival"]?></b>
                                                                                    </div>
                                                                                </span>
                                                                                <p>&nbsp;</p>
                                                                                <div class="form-field col-md-4 col-xs-12">
                                                                                    <label><?php echo $txt_mod["booking:filghtnumber"]?> :</label>
                                                                                    <input class="form-control" type="text" id="input_filghtnumberpickup" name="input_filghtnumberpickup">
                                                                                </div>
                                                                                <div class="form-field col-md-4 col-xs-12">
                                                                                    <label><?php echo $txt_mod["booking:arrivetime"]?> :</label>
                                                                                    <select class="form-select" name="input_arrivetimeHH" id="input_arrivetimeHH">
                                                                                        <option value=""><?php echo $txt_mod["booking:hh"]?></option>
                                                                                        <?php for($HH=0;$HH<=23;$HH++){?>
                                                                                        <option value="<?php echo sprintf("%02d",$HH)?>"><?php echo sprintf("%02d",$HH)?>
                                                                                        </option>
                                                                                        <?php }?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-field col-md-4 col-xs-12">
                                                                                    <label>&nbsp;</label>
                                                                                    <select class="form-select" name="input_arrivetimeMM" id="input_arrivetimeMM">
                                                                                        <option value=""><?php echo $txt_mod["booking:mm"]?></option>
                                                                                        <option value="00">00</option>
                                                                                        <option value="05">05</option>
                                                                                        <option value="10">10</option>
                                                                                        <option value="15">15</option>
                                                                                        <option value="20">20</option>
                                                                                        <option value="25">25</option>
                                                                                        <option value="30">30</option>
                                                                                        <option value="35">35</option>
                                                                                        <option value="40">40</option>
                                                                                        <option value="45">45</option>
                                                                                        <option value="50">50</option>
                                                                                        <option value="55">55</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 

                                                                    
                                                                <?php }else{ //if($airport==1){?> 
                                                                    <?php if($airport==1){ ?>
                                                                        <input type="hidden" id="input_pickupairport" name="input_pickupairport" value=""><?php 
                                                                    }?>
            
                                                                    <?php if($Row_timetable[$mod_md_timetable."_pickup"]==1 && $daydiff>0){ ?>
                                                                        <div class="payment-room col-lg-12">
                                                                            <div class="payment-price">
                                                                                <div class="total-trip" style="margin-left:0;">
                                                                                    <span>
                                                                                        <div class="radio-checkbox">
                                                                                            <input type="checkbox" class="checkbox" id="input_pickup1" name="input_pickup1"
                                                                                                value="1" onclick="pickup(1);loadtransfer();" checked="checked" />
                                                                                            <label for="input_pickup1"><i class="fa fa-bus"></i>
                                                                                                <?php echo $txt_mod["booking:needpickup"]?></label>
                                                                                        </div>
                                                                                    </span>

                                                                                    <div id="pickup1"> 
                                                                                        <div class="row">
                                                                                            <div class="form-field col-md-6 col-xs-12">
                                                                                                <label><?php echo $txt_mod["booking:transport"]?> :</label>
                                                                                                <select class="col-xs-12 form-select" id="input_carpickup1" name="input_carpickup1" onchange="LoadLocationTransfer(this.value,<?php echo $Row_timetable[$mod_md_timetable.'_companyid']?>,<?php echo $Row_timetable[$mod_md_timetable.'_pierstart']?>,'md_pickup','input_pickuppoint1');loadtransfer();">
                                                                                                    <option value=""><?php echo $txt_mod["booking:selecttransport"]?></option>
                                                                                                    <?php
                                                                                                        $sql_carpickup = "SELECT DISTINCT(".$mod_md_pickup."_cartypeid) FROM ".$mod_md_pickup.",".$mod_md_transfer." WHERE ".$mod_md_pickup."_status='1'  AND ".$mod_md_pickup."_pierid='".$Row_timetable[$mod_md_timetable."_pierstart"]."' ORDER BY ".$mod_md_transfer."_id ASC ";
                                                                                                        $query_carpickup=$mysqli->query($sql_carpickup);
                                                                                                    ?> 
                                                                                                        <?php 
                                                                                                        while($Row_carpickup=$query_carpickup->fetch_array()){ 
                                                                                                        $row_carname=getCarType($Row_carpickup[0])." ".$txt_mod["booking:carperson"][$Row_carpickup[0]];
                                                                                                        $row_cartypeid=$Row_carpickup[0]; ?>
                                                                                                            <option value="<?php echo $row_cartypeid?>"><?php echo $row_carname?></option>
                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                            </div>

                                                                                            <div class="form-field col-md-6 col-xs-12">
                                                                                                <label><?php echo $txt_mod["booking:pickup"]?> :</label>
                                                                                                <select class="col-xs-12 form-select" id="input_pickuppoint1" name="input_pickuppoint1" onchange="loadtransfer();loadairportpoint(this.value,1,'loadairportpickup1')">
                                                                                                </select>
                                                                                            </div>

                                                                                            <div class="form-field col-md-6 col-xs-12">
                                                                                                <label><?php echo $txt_mod["booking:pickuppoint"]?> :</label>
                                                                                                <input class="form-control" type="text" id="input_hotelpickup1" name="input_hotelpickup1">
                                                                                            </div>
                                                                                            <div id="loadairportpickup1" class="row"><input class="form-control" type="hidden" id="input_pickupairport1" name="input_pickupairport1" value=""></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><br>
                                                                    <?php }else{ //if($Row_timetable[$mod_md_timetable."_pickup"]==1 && $daydiff>0){?>
                                                                        <div class="payment-room col-lg-12">
                                                                            <div class="payment-price">
                                                                                <div class="total-trip" style="margin-left:0;">
                                                                                    <span>
                                                                                        <div class="radio-checkbox">
                                                                                            <input type="checkbox" class="checkbox" id="input_pickup1" name="input_pickup1"
                                                                                                disabled="disabled">
                                                                                            <label for="input_pickup1"><i class="fa fa-bus"></i>
                                                                                                <?php echo $txt_mod["booking:nopickup"]?></label>
                                                                                        </div> 
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php }//if($Row_timetable[$mod_md_timetable."_pickup"]==1 && $daydiff>0){?> 
                                                                <?php }//if($airport==1){?>


                                                                <?php //เช็คว่าเส้นทางสนามบินรึป่าว
                                                                $airport=0;
                                                                $sql_location = "SELECT *  FROM ".$mod_md_location." WHERE ".$mod_md_location."_id='".$Row_timetable[$mod_md_timetable."_endid"]."'";
                                                                $Query_location=$mysqli->query($sql_location);
                                                                while($Row_location=$Query_location->fetch_array()){
                                                                    $airport=$airport+$Row_location[$mod_md_location."_airport"];
                                                                }
                                                                if($airport==1){//เช็คว่าคือสนามบินรึป่าว ?>
                                                                    <input type="hidden" id="input_dropoff1" name="input_dropoff1">
                                                                    <input type="hidden" id="input_pickupairport" name="input_pickupairport" value="1">
                                                                    <div class="payment-room col-lg-12">
                                                                        <div class="payment-price">
                                                                            <div class="total-trip" style="margin-left:0;">
                                                                                <span>
                                                                                    <div class="radio-checkbox">
                                                                                        &nbsp;&nbsp;<b><i class="fa fa-bus"></i>
                                                                                            <?php echo $txt_mod["booking:filghtdeparture"]?></b>
                                                                                    </div>
                                                                                </span>
                                                                                <p>&nbsp;</p>
                                                                                <div class="form-field col-md-4 col-xs-12">
                                                                                    <label><?php echo $txt_mod["booking:filghtnumber"]?> :</label>
                                                                                    <input class="form-control" type="text" id="input_filghtnumberpickup" name="input_filghtnumberpickup">
                                                                                </div>
                                                                                <div class="form-field col-md-4 col-xs-12">
                                                                                    <label><?php echo $txt_mod["booking:departtime"]?> :</label>
                                                                                    <select name="input_arrivetimeHH" id="input_arrivetimeHH">
                                                                                        <option value=""><?php echo $txt_mod["booking:hh"]?></option>
                                                                                        <?php for($HH=0;$HH<=23;$HH++){?>
                                                                                        <option value="<?php echo sprintf("%02d",$HH)?>"><?php echo sprintf("%02d",$HH)?>
                                                                                        </option>
                                                                                        <?php }?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-field col-md-4 col-xs-12">
                                                                                    <label>&nbsp;</label>
                                                                                    <select name="input_arrivetimeMM" id="input_arrivetimeMM">
                                                                                        <option value=""><?php echo $txt_mod["booking:mm"]?></option>
                                                                                        <option value="00">00</option>
                                                                                        <option value="05">05</option>
                                                                                        <option value="10">10</option>
                                                                                        <option value="15">15</option>
                                                                                        <option value="20">20</option>
                                                                                        <option value="25">25</option>
                                                                                        <option value="30">30</option>
                                                                                        <option value="35">35</option>
                                                                                        <option value="40">40</option>
                                                                                        <option value="45">45</option>
                                                                                        <option value="50">50</option>
                                                                                        <option value="55">55</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                <?php }else{//if($airport==1){?>
                                                                    <?php if($airport==1){?>
                                                                        <input type="hidden" id="input_dropoffairport" name="input_dropoffairport" value=""><?php }
                                                                    ?>
                                                                    <?php if($Row_timetable[$mod_md_timetable."_dropoff"]==1 && $daydiff>0){?>
                                                                        <div class="payment-room col-lg-12">
                                                                            <div class="payment-price">
                                                                                <div class="total-trip" style="margin-left:0;">
                                                                                    <span>
                                                                                        <div class="radio-checkbox">

                                                                                            <input type="checkbox" class="checkbox" id="input_dropoff1" name="input_dropoff1"
                                                                                                value="1" onclick="dropoff(1);loadtransfer();" checked="input_dropoff">
                                                                                            <label for="input_dropoff1"><i class="fa fa-bus"></i>
                                                                                                <?php echo $txt_mod["booking:needdropoff"]?></label>
                                                                                        </div>
                                                                                    </span>

                                                                                    <div id="dropoff1">
                                                                                        <p>&nbsp;</p>
                                                                                        <div class="form-field col-md-4 col-xs-12">
                                                                                            <label><?php echo $txt_mod["booking:transport"]?> :</label>
                                                                                            <select class="col-xs-12" id="input_cardropoff1" name="input_cardropoff1"
                                                                                                onchange="LoadLocationTransfer(this.value,<?php echo $Row_timetable[$mod_md_timetable."_companyid"]?>,<?php echo $Row_timetable[$mod_md_timetable."_pierend"]?>,'md_dropoff','input_dropoffpoint1');loadtransfer();">
                                                                                                <option value=""><?php echo $txt_mod["booking:selecttransport"]?></option>
                                                                                                <?php
                                                                                                                            $sql_cardropoff = "SELECT DISTINCT(".$mod_md_dropoff."_cartypeid) FROM ".$mod_md_dropoff.",".$mod_md_transfer." WHERE ".$mod_md_dropoff."_status='1'  AND ".$mod_md_dropoff."_pierid='".$Row_timetable[$mod_md_timetable."_pierend"]."' ORDER BY ".$mod_md_transfer."_id ASC ";
                                                                                                                            $query_cardropoff=$mysqli->query($sql_cardropoff);
                                                                                                                        ?>

                                                                                                <?php while($Row_cardropoff=$query_cardropoff->fetch_array()){ 
                                                                                                                                        $row_carname=getCarType($Row_cardropoff[0])." ".$txt_mod["booking:carperson"][$Row_cardropoff[0]];
                                                                                                                                        $row_cartypeid=$Row_cardropoff[0];
                                                                                                                        ?>
                                                                                                <option value="<?php echo $row_cartypeid?>"><?php echo $row_carname?></option>
                                                                                                <?php }//while($Row=$Query->fetch_array()){
                                                                                                                    ?>
                                                                                            </select>
                                                                                        </div>

                                                                                        <div class="form-field col-md-4 col-xs-12">
                                                                                            <label><?php echo $txt_mod["booking:dropoff"]?> :</label>
                                                                                            <select class="col-xs-12" id="input_dropoffpoint1" name="input_dropoffpoint1"
                                                                                                onchange="loadtransfer();">
                                                                                            </select>
                                                                                        </div>

                                                                                        <div class="form-field col-md-4 col-xs-12">
                                                                                            <label><?php echo $txt_mod["booking:dropoffpoint"]?> :</label>
                                                                                            <input type="text" id="input_hoteldropoff1" name="input_hoteldropoff1">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php }else{//if($Row_timetable[$mod_md_timetable."_dropoff"]==1 && $daydiff>0){?>
                                                                        <div class="payment-room col-lg-12">
                                                                            <div class="payment-price">
                                                                                <div class="total-trip" style="margin-left:0;">
                                                                                    <span>
                                                                                        <div class="radio-checkbox">

                                                                                            <input type="checkbox" class="checkbox" id="input_dropoff1" name="input_dropoff1"
                                                                                                disabled="disabled">
                                                                                            <label for="input_dropoff1"><i class="fa fa-bus"></i>
                                                                                                <?php echo $txt_mod["booking:nodropoff"]?></label>
                                                                                        </div>

                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php }//if($Row_timetable[$mod_md_timetable."_dropoff"]==1 && $daydiff>0){?>
                                                                <?php }//if($airport==1){?> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Cruise Content -->
                                                    <?php if($_REQUEST["booking_type"]==2){?>
                                                        <div style="padding: 6px 10px 12px 10px;">
                                                            <hr style="margin:0;border:0;height:1px;background:#000;border-radius:999px;opacity:1;">
                                                        </div>
                                                        <div class="sort-view clearfix">  
                                                            <div class="view-by float-left">
                                                                <a href="javascript:void(0)" title="" class="current"><i class="fa fa-anchor" aria-hidden="true"></i> <?php echo $txt_mod["booking:depart"]?> : <?php if($_REQUEST["locationstart"]!=""){echo getLocationName($_REQUEST["locationend"])." ".$txt_mod["booking:to"]." ".getLocationName($_REQUEST["locationstart"]);}else{ echo getLocationName("2")." ".$txt_mod["booking:to"]." ".getLocationName("6");}?></a> 
                                                            </div> 
                                                        </div>
                                                        <div class="cruise-list-cn" >
                                                            <div class="cruise-item row" style="padding:0">
                                                                <div class="payment-room col-5">
                                                                    <?php
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
                                                                    <div class="payment-price"> 
                                                                        <figure>
                                                                            <img src="<?php echo"uploads/timetable/pictures/".$Row_timetable_return[$mod_md_timetable."_picname"];?>"  onerror="this.onerror=null;this.src='assets/img/placeholder.png'">
                                                                        </figure> 
                                                                    </div>
                                                                </div>
                                                                <div class="payment-room col-7">
                                                                    <?php
                                                                    //เช็คว่าเส้นทางสนามบินรึป่าว
                                                                    $airport=0;
                                                                    $sql_location = "SELECT *  FROM ".$mod_md_location." WHERE ".$mod_md_location."_id='".$Row_timetable_return[$mod_md_timetable."_startid"]."'";
                                                                    $Query_location=$mysqli->query($sql_location);
                                                                    while($Row_location=$Query_location->fetch_array()){
                                                                        $airport=$airport+$Row_location[$mod_md_location."_airport"];
                                                                    }
                                                                
                                                                    if($airport==1){//เช็คว่าคือสนามบินรึป่าว ?>
                                                                        <input type="hidden" id="input_pickup2" name="input_pickup2">
                                                                        <input type="hidden" id="input_pickupairport" name="input_pickupairport" value="1">
                                                                        <div class="payment-room col-lg-12">
                                                                            <div class="payment-price">
                                                                                <div class="total-trip" style="margin-left:0;">
                                                                                    <span>
                                                                                        <div class="radio-checkbox">
                                                                                            &nbsp;&nbsp;<b><i class="fa fa-bus"></i>
                                                                                                <?php echo $txt_mod["booking:filghtarrival"]?></b>
                                                                                        </div>
                                                                                    </span>
                                                                                    <p>&nbsp;</p>
                                                                                    <div class="form-field col-md-4 col-xs-12">
                                                                                        <label><?php echo $txt_mod["booking:filghtnumber"]?> :</label>
                                                                                        <input class="form-control" type="text" id="input_filghtnumberpickup" name="input_filghtnumberpickup">
                                                                                    </div>
                                                                                    <div class="form-field col-md-4 col-xs-12">
                                                                                        <label><?php echo $txt_mod["booking:arrivetime"]?> :</label>
                                                                                        <select class="form-select" name="input_arrivetimeHH" id="input_arrivetimeHH">
                                                                                            <option value=""><?php echo $txt_mod["booking:hh"]?></option>
                                                                                            <?php for($HH=0;$HH<=23;$HH++){?>
                                                                                            <option value="<?php echo sprintf("%02d",$HH)?>"><?php echo sprintf("%02d",$HH)?>
                                                                                            </option>
                                                                                            <?php }?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-field col-md-4 col-xs-12">
                                                                                        <label>&nbsp;</label>
                                                                                        <select class="form-select" name="input_arrivetimeMM" id="input_arrivetimeMM">
                                                                                            <option value=""><?php echo $txt_mod["booking:mm"]?></option>
                                                                                            <option value="00">00</option>
                                                                                            <option value="05">05</option>
                                                                                            <option value="10">10</option>
                                                                                            <option value="15">15</option>
                                                                                            <option value="20">20</option>
                                                                                            <option value="25">25</option>
                                                                                            <option value="30">30</option>
                                                                                            <option value="35">35</option>
                                                                                            <option value="40">40</option>
                                                                                            <option value="45">45</option>
                                                                                            <option value="50">50</option>
                                                                                            <option value="55">55</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div> 

                                                                        
                                                                    <?php }else{ //if($airport==1){?> 
                                                                        <?php if($airport==1){ ?>
                                                                            <input type="hidden" id="input_pickupairport" name="input_pickupairport" value=""><?php 
                                                                        }?>
                
                                                                        <?php if($Row_timetable_return[$mod_md_timetable."_pickup"]==1 && $daydiff>0){ ?>
                                                                            <div class="payment-room col-lg-12">
                                                                                <div class="payment-price">
                                                                                    <div class="total-trip" style="margin-left:0;">
                                                                                        <span>
                                                                                            <div class="radio-checkbox">
                                                                                                <input type="checkbox" class="checkbox" id="input_pickup2" name="input_pickup2"
                                                                                                    value="1" onclick="pickup(2);loadtransfer();" checked="checked" />
                                                                                                <label for="input_pickup2"><i class="fa fa-bus"></i>
                                                                                                    <?php echo $txt_mod["booking:needpickup"]?></label>
                                                                                            </div>
                                                                                        </span>

                                                                                        <div id="pickup2"> 
                                                                                            <div class="row">
                                                                                                <div class="form-field col-md-6 col-xs-12">
                                                                                                    <label><?php echo $txt_mod["booking:transport"]?> :</label>
                                                                                                    <select class="col-xs-12 form-select" id="input_carpickup2" name="input_carpickup2" onchange="LoadLocationTransfer(this.value,<?php echo $Row_timetable_return[$mod_md_timetable.'_companyid']?>,<?php echo $Row_timetable_return[$mod_md_timetable.'_pierstart']?>,'md_pickup','input_pickuppoint2');loadtransfer();">
                                                                                                        <option value=""><?php echo $txt_mod["booking:selecttransport"]?></option>
                                                                                                        <?php
                                                                                                            $sql_carpickup = "SELECT DISTINCT(".$mod_md_pickup."_cartypeid) FROM ".$mod_md_pickup.",".$mod_md_transfer." WHERE ".$mod_md_pickup."_status='1'  AND ".$mod_md_pickup."_pierid='".$Row_timetable_return[$mod_md_timetable."_pierstart"]."' ORDER BY ".$mod_md_transfer."_id ASC ";
                                                                                                            $query_carpickup=$mysqli->query($sql_carpickup);
                                                                                                        ?> 
                                                                                                            <?php 
                                                                                                            while($Row_carpickup=$query_carpickup->fetch_array()){ 
                                                                                                            $row_carname=getCarType($Row_carpickup[0])." ".$txt_mod["booking:carperson"][$Row_carpickup[0]];
                                                                                                            $row_cartypeid=$Row_carpickup[0]; ?>
                                                                                                                <option value="<?php echo $row_cartypeid?>"><?php echo $row_carname?></option>
                                                                                                        <?php } ?>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class="form-field col-md-6 col-xs-12">
                                                                                                    <label><?php echo $txt_mod["booking:pickup"]?> :</label>
                                                                                                    <select class="col-xs-12 form-select" id="input_pickuppoint2" name="input_pickuppoint2" onchange="loadtransfer();loadairportpoint(this.value,2,'loadairportpickup2')">
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class="form-field col-md-6 col-xs-12">
                                                                                                    <label><?php echo $txt_mod["booking:pickuppoint"]?> :</label>
                                                                                                    <input class="form-control" type="text" id="input_hotelpickup2" name="input_hotelpickup2">
                                                                                                </div>
                                                                                                <div id="loadairportpickup2" class="row"><input class="form-control" type="hidden" id="input_pickupairport2" name="input_pickupairport2" value=""></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div><br>
                                                                        <?php }else{ //if($Row_timetable_return[$mod_md_timetable."_pickup"]==1 && $daydiff>0){?>
                                                                            <div class="payment-room col-lg-12">
                                                                                <div class="payment-price">
                                                                                    <div class="total-trip" style="margin-left:0;">
                                                                                        <span>
                                                                                            <div class="radio-checkbox">
                                                                                                <input type="checkbox" class="checkbox" id="input_pickup2" name="input_pickup2"
                                                                                                    disabled="disabled">
                                                                                                <label for="input_pickup2"><i class="fa fa-bus"></i>
                                                                                                    <?php echo $txt_mod["booking:nopickup"]?></label>
                                                                                            </div> 
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }//if($Row_timetable_return[$mod_md_timetable."_pickup"]==1 && $daydiff>0){?> 
                                                                    <?php }//if($airport==1){?>


                                                                    <?php //เช็คว่าเส้นทางสนามบินรึป่าว
                                                                    $airport=0;
                                                                    $sql_location = "SELECT *  FROM ".$mod_md_location." WHERE ".$mod_md_location."_id='".$Row_timetable_return[$mod_md_timetable."_endid"]."'";
                                                                    $Query_location=$mysqli->query($sql_location);
                                                                    while($Row_location=$Query_location->fetch_array()){
                                                                        $airport=$airport+$Row_location[$mod_md_location."_airport"];
                                                                    }
                                                                    if($airport==1){//เช็คว่าคือสนามบินรึป่าว ?>
                                                                        <input type="hidden" id="input_dropoff1" name="input_dropoff1">
                                                                        <input type="hidden" id="input_pickupairport" name="input_pickupairport" value="1">
                                                                        <div class="payment-room col-lg-12">
                                                                            <div class="payment-price">
                                                                                <div class="total-trip" style="margin-left:0;">
                                                                                    <span>
                                                                                        <div class="radio-checkbox">
                                                                                            &nbsp;&nbsp;<b><i class="fa fa-bus"></i>
                                                                                                <?php echo $txt_mod["booking:filghtdeparture"]?></b>
                                                                                        </div>
                                                                                    </span>
                                                                                    <p>&nbsp;</p>
                                                                                    <div class="form-field col-md-4 col-xs-12">
                                                                                        <label><?php echo $txt_mod["booking:filghtnumber"]?> :</label>
                                                                                        <input class="form-control" type="text" id="input_filghtnumberpickup" name="input_filghtnumberpickup">
                                                                                    </div>
                                                                                    <div class="form-field col-md-4 col-xs-12">
                                                                                        <label><?php echo $txt_mod["booking:departtime"]?> :</label>
                                                                                        <select name="input_arrivetimeHH" id="input_arrivetimeHH">
                                                                                            <option value=""><?php echo $txt_mod["booking:hh"]?></option>
                                                                                            <?php for($HH=0;$HH<=23;$HH++){?>
                                                                                            <option value="<?php echo sprintf("%02d",$HH)?>"><?php echo sprintf("%02d",$HH)?>
                                                                                            </option>
                                                                                            <?php }?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-field col-md-4 col-xs-12">
                                                                                        <label>&nbsp;</label>
                                                                                        <select name="input_arrivetimeMM" id="input_arrivetimeMM">
                                                                                            <option value=""><?php echo $txt_mod["booking:mm"]?></option>
                                                                                            <option value="00">00</option>
                                                                                            <option value="05">05</option>
                                                                                            <option value="10">10</option>
                                                                                            <option value="15">15</option>
                                                                                            <option value="20">20</option>
                                                                                            <option value="25">25</option>
                                                                                            <option value="30">30</option>
                                                                                            <option value="35">35</option>
                                                                                            <option value="40">40</option>
                                                                                            <option value="45">45</option>
                                                                                            <option value="50">50</option>
                                                                                            <option value="55">55</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <?php }else{//if($airport==1){?>
                                                                        <?php if($airport==1){?>
                                                                            <input type="hidden" id="input_dropoffairport" name="input_dropoffairport" value=""><?php }
                                                                        ?>
                                                                        <?php if($Row_timetable_return[$mod_md_timetable."_dropoff"]==1 && $daydiff>0){?>
                                                                            <div class="payment-room col-lg-12">
                                                                                <div class="payment-price">
                                                                                    <div class="total-trip" style="margin-left:0;">
                                                                                        <span>
                                                                                            <div class="radio-checkbox">

                                                                                                <input type="checkbox" class="checkbox" id="input_dropoff1" name="input_dropoff1"
                                                                                                    value="1" onclick="dropoff(1);loadtransfer();" checked="input_dropoff">
                                                                                                <label for="input_dropoff1"><i class="fa fa-bus"></i>
                                                                                                    <?php echo $txt_mod["booking:needdropoff"]?></label>
                                                                                            </div>
                                                                                        </span>

                                                                                        <div id="dropoff1">
                                                                                            <p>&nbsp;</p>
                                                                                            <div class="form-field col-md-4 col-xs-12">
                                                                                                <label><?php echo $txt_mod["booking:transport"]?> :</label>
                                                                                                <select class="col-xs-12" id="input_cardropoff1" name="input_cardropoff1"
                                                                                                    onchange="LoadLocationTransfer(this.value,<?php echo $Row_timetable_return[$mod_md_timetable."_companyid"]?>,<?php echo $Row_timetable_return[$mod_md_timetable."_pierend"]?>,'md_dropoff','input_dropoffpoint1');loadtransfer();">
                                                                                                    <option value=""><?php echo $txt_mod["booking:selecttransport"]?></option>
                                                                                                    <?php
                                                                                                                                $sql_cardropoff = "SELECT DISTINCT(".$mod_md_dropoff."_cartypeid) FROM ".$mod_md_dropoff.",".$mod_md_transfer." WHERE ".$mod_md_dropoff."_status='1'  AND ".$mod_md_dropoff."_pierid='".$Row_timetable_return[$mod_md_timetable."_pierend"]."' ORDER BY ".$mod_md_transfer."_id ASC ";
                                                                                                                                $query_cardropoff=$mysqli->query($sql_cardropoff);
                                                                                                                            ?>

                                                                                                    <?php while($Row_cardropoff=$query_cardropoff->fetch_array()){ 
                                                                                                                                            $row_carname=getCarType($Row_cardropoff[0])." ".$txt_mod["booking:carperson"][$Row_cardropoff[0]];
                                                                                                                                            $row_cartypeid=$Row_cardropoff[0];
                                                                                                                            ?>
                                                                                                    <option value="<?php echo $row_cartypeid?>"><?php echo $row_carname?></option>
                                                                                                    <?php }//while($Row=$Query->fetch_array()){
                                                                                                                        ?>
                                                                                                </select>
                                                                                            </div>

                                                                                            <div class="form-field col-md-4 col-xs-12">
                                                                                                <label><?php echo $txt_mod["booking:dropoff"]?> :</label>
                                                                                                <select class="col-xs-12" id="input_dropoffpoint1" name="input_dropoffpoint1"
                                                                                                    onchange="loadtransfer();">
                                                                                                </select>
                                                                                            </div>

                                                                                            <div class="form-field col-md-4 col-xs-12">
                                                                                                <label><?php echo $txt_mod["booking:dropoffpoint"]?> :</label>
                                                                                                <input type="text" id="input_hoteldropoff1" name="input_hoteldropoff1">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }else{//if($Row_timetable_return[$mod_md_timetable."_dropoff"]==1 && $daydiff>0){?>
                                                                            <div class="payment-room col-lg-12">
                                                                                <div class="payment-price">
                                                                                    <div class="total-trip" style="margin-left:0;">
                                                                                        <span>
                                                                                            <div class="radio-checkbox">

                                                                                                <input type="checkbox" class="checkbox" id="input_dropoff1" name="input_dropoff1"
                                                                                                    disabled="disabled">
                                                                                                <label for="input_dropoff1"><i class="fa fa-bus"></i>
                                                                                                    <?php echo $txt_mod["booking:nodropoff"]?></label>
                                                                                            </div>

                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }//if($Row_timetable_return[$mod_md_timetable."_dropoff"]==1 && $daydiff>0){?>
                                                                    <?php }//if($airport==1){?> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- End Cruise Content -->
                                                </section>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-27">
                                        <aside class="booking-sidebar">
                                            <h2 class="main-title">Booking Info</h2>
                                            <div class="widget">
                                                <span><?php echo $txt_mod["booking:date"]?> : </span><?php echo ShowDateFormEng($pickupdate);?><br>
                                                <ul class="flight-info">
                                                    <li><img src="<?php echo"uploads/timetable/pictures/".$Row_timetable[$mod_md_timetable."_picname"];?>"  style="width:70px;"  onerror="this.onerror=null;this.src='assets/img/placeholder.png'"> </li>
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
                                                    <a href="#" onclick="Loadstep3()" class="btn">Next Step</a>
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
                
            </section>
            <section class="customer-details-area" id="loadstep4">
            </section>
        </main>
        <!-- main-area-end -->
        
        <script src="https://cdn.omise.co/omise.js"></script>
        <script type="text/javascript" src="js/scriptboat.js"></script>
        
        <?php  include("include/include_footer.php");  ?>

        <?php  include("include/include_foot.php");  ?>