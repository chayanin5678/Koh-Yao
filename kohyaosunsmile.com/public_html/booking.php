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

        $sql_info = "SELECT *  FROM sys_info WHERE 1=1 ORDER BY sys_info_id DESC";
        $Query_info=$mysqli->query($sql_info);
        $Row_info=$Query_info->fetch_array();
        // print_r($Row_info);
        // echo "DDDD: ",$_REQUEST["booking_type"];
        if($_REQUEST["booking_type"]==""){
            $_REQUEST["booking_type"]=1;
        }

        // print_r($_REQUEST);
        if($_REQUEST["locationstart"]=="" || $_REQUEST["locationend"]=="" || $_REQUEST["input_pickupdate"]==""){
            $title=$Row_info[$mod_sys_info."_title".$_SESSION["front_session_sys_language"]]." - ".$txt_mod["booking:simply"];
        }else{
            $sql_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_startid='".$_REQUEST["locationstart"]."' AND ".$mod_md_timetable."_endid='".$_REQUEST["locationend"]."'";
            $sql_timetable .= " ORDER BY ".$mod_md_timetable."_saleadult ASC,".$mod_md_timetable."_priceadult ASC";
            $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");

            $Row_timetable=$Query_timetable->fetch_array();
            $row_startname=getLocationName($Row_timetable[$mod_md_timetable."_startid"]);
            $row_endname=getLocationName($Row_timetable[$mod_md_timetable."_endid"]);
            $row_boattype=getBoatTypeName($Row_timetable[$mod_md_timetable."_boattypeid"]);
            $row_pierstart=getPierName($Row_timetable[$mod_md_timetable."_pierstart"]);
            $row_pierend=getPierName($Row_timetable[$mod_md_timetable."_pierend"]);
            $row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);
            $row_arrivaltime=FormatTime($Row_timetable[$mod_md_timetable."_arrivaltime"]);
            $row_departuretime=FormatTime($Row_timetable[$mod_md_timetable."_departuretime"]);
            $row_time=FormatTimeHour($Row_timetable[$mod_md_timetable."_time"]);
            $row_company=getCompanyName($Row_timetable[$mod_md_timetable."_companyid"]);
            $row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);

            if($Row_timetable[$mod_md_timetable."_saleadult"]!=0){
                $priceadult=$Row_timetable[$mod_md_timetable."_saleadult"];
            }else{
                $priceadult=$Row_timetable[$mod_md_timetable."_priceadult"];
            }

                
            $title=$row_startname." ".$txt_mod["booking:to"]." ".$row_endname." ".$txt_mod["booking:by"]." ".$txt_mod["booking:pricestart"]." ".$priceadult." ".$_SESSION["front_session_sys_currency"];
        }
        ?>

        <?php  include("include/include_header2.php");  ?>

        <!-- main-area -->
        <main>
        <form name="myForm" id="myForm" method="POST" action="">
            <input type="hidden" id="myaction" name="myaction" value="">
            <input type="hidden" id="language" name="language" value="<?php echo $_SESSION["front_session_sys_language"]?>">
            <input type="hidden" id="myid" name="myid" value="">
            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="breadcrumb-content text-center">
                                <h2 class="title" style="color:#031f60;">Booking List</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item" ><a href="index.html"  style="color:#031f60;">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Booking List</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

                <!-- booking-area -->
                <div class="booking-area booking-style-two">
                    <!-- booking-area -->
                    <div class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="booking-tag">
                                        <ul>
                                            <!-- <li><a href="booking-list.html"><i class="flaticon-flight"></i>Flights</a></li>
                                            <li><a href="booking-list.html"><i class="flaticon-car-1"></i>Car Rentals</a></li>
                                            <li><a href="booking-list.html"><i class="flaticon-eiffel-tower"></i>Attractions</a></li>
                                            <li><a href="booking-list.html"><i class="flaticon-taxi"></i>Airport Taxis</a></li> -->
                                        </ul>
                                    </div>
                                    <div class="booking-wrap">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active text-dark" id="bOOKing-tab" data-bs-toggle="tab" data-bs-target="#bOOKing-tab-pane" type="button" style="background: #fff;"
                                                    role="tab" aria-controls="bOOKing-tab-pane" aria-selected="true"><img src="assets/img/icon/boat.png" style="width:45px;" alt=""></a>  &nbsp;&nbsp;FIND A BOAT TRIP</button>
                                                    <!-- <i class="flaticon-flight"></i> -->
                                            </li>
                                            
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="bOOKing-tab-pane" role="tabpanel" aria-labelledby="bOOKing-tab" tabindex="0">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="tab-content-wrap"  style="padding:10px;">
                                                            <div class="content-top">
                                                                <ul>
                                                                    <!-- <li>FIND A BOAT</li> -->
                                                                    <!-- <li><span>FREE PICK UP</span>test</li> -->
                                                                </ul>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="mb-1">
                                                                        <label for="form-label">Trip</label>
                                                                        <!-- bookingtype(this.value);bookingtype1(this.value);LoadLocationEnd(); -->
                                                                        <select id="booking_type" name="booking_type" onchange="LoadLocationStart('<?php echo $_SESSION['front_session_sys_language']?>');LoadLocationEnd();" class="form-select" >  
                                                                            <option value="1" <?php echo ($_REQUEST["booking_type"]==1)?"selected":""?>>One Way</option> 
                                                                            <option value="2" <?php echo ($_REQUEST["booking_type"]==2)?"selected":""?>>Round Trip</option>                                             
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-lg-6"></div> -->
                                                                <div class="col-lg-3">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="basicSelect"><?php echo $txt_mod["index:from"] ?></label> 
                                                                        <select class="form-select" id="locationstart" name="locationstart" onchange="LoadLocation()"> 
                                                                            <option value=""><?php echo $txt_mod["booking:selectstar"];?></option>
                                                                            <?php 
                                                                                $sql_locationstart = "SELECT * FROM ".$mod_md_location." WHERE ".$mod_md_location."_status='1' ORDER BY ".$mod_md_location."_name".$_SESSION["front_session_sys_language"]." ASC";
                                                                                $Query_locationstart=$mysqli->query($sql_locationstart) OR DIE("Error sql_locationstart: <br>$sql_locationstart<br>\n");
                                                                                $count_locationstart=$Query_locationstart->num_rows;
                                                                                while($Row_locationstart=$Query_locationstart->fetch_array()){
                                                                                    $row_locationstart_id=$Row_locationstart[$mod_md_location.'_id'];
                                                                                    $row_locationstart_name=$Row_locationstart[$mod_md_location.'_name'.$_SESSION["front_session_sys_language"]];  
                                                                                                                                
                                                                                ?>                                               
                                                                                    <option value="<?php echo $row_locationstart_id;?>" <?php echo ($_REQUEST["locationstart"]==$row_locationstart_id)?"selected":""?>><?php echo $row_locationstart_name;?></option>
                                                                                <?php 
                                                                                }  
                                                                            ?>                                                             
                                                                        </select> 
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="basicSelect"><?php echo $txt_mod["index:to"] ?></label>

                                                                        <select class="form-select" id="locationend" name="locationend" onchange="LoadLocationStart('<?php echo $_SESSION['front_session_sys_language']?>');LoadLocationEnd();"> 
                                                                            <option value=""><?php echo $txt_mod["booking:selectdestination"]?></option>
                                                                            <?php 
                                                                                $sql_locationstart = "SELECT DISTINCT(".$mod_md_timetable."_endid),  
                                                                                        ".$mod_md_location."_name".$_SESSION["front_session_sys_language"]." 
                                                                                        FROM ".$mod_md_timetable.",".$mod_md_location."  
                                                                                        WHERE ".$mod_md_timetable."_endid = ".$mod_md_location."_id AND ".$mod_md_timetable."_status='1'";
                                                                                if($_REQUEST["locationstart"]!=""){
                                                                                    $sql_locationstart .= " AND ".$mod_md_timetable."_startid='".$_REQUEST["locationstart"]."'";
                                                                                }
                                                                                if($_REQUEST["locationstart"]!=""){
                                                                                    $sql_locationstart .= "AND ".$mod_md_timetable."_endid!='".$_REQUEST["locationstart"]."'";
                                                                                }
                                                                                $sql_locationstart .= " ORDER BY ".$mod_md_location."_name".$_SESSION["front_session_sys_language"]." ASC";
                                                                                $Query_locationstart=$mysqli->query($sql_locationstart) OR DIE("Error sql_locationstart: <br>$sql_locationstart<br>\n");
                                                                                $count_locationstart=$Query_locationstart->num_rows;
                                                                                while($Row_locationstart=$Query_locationstart->fetch_array()){
                                                                                    $row_locationstart_id=$Row_locationstart[0];
                                                                                    $row_locationstart_name=$Row_locationstart[$mod_md_location.'_name'.$_SESSION["front_session_sys_language"]];  
                                                                                ?>                                               
                                                                                    <option value="<?php echo $row_locationstart_id;?>" <?php echo ($_REQUEST["locationend"]==$row_locationstart_id)?"selected":""?>><?php echo $row_locationstart_name;?></option>
                                                                                <?php
                                                                                } 
                                                                            ?>                                          
                                                                        </select>
                                                                          
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="col-lg-3">
                                                                    <div class="mb-1">
                                                                        <label for="form-label"><?php echo $txt_mod["index:depart"] ?></label> 
                                                                        <input type="text" class="form-control calendar-input hasDatepicker" id="input_pickupdate" name="input_pickupdate" autocomplete="off" value="<?php echo $_REQUEST['input_pickupdate'];?>" placeholder="<?php echo $txt_mod["index:depart"] ?>"  onchange="LoadLocationStart('<?php echo $_SESSION['front_session_sys_language']?>');LoadLocationEnd();" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="mb-1"  id="return" <?php if($_REQUEST["booking_type"]=="1"){ echo 'style="display: none;"';}?> onchange="LoadLocationStart('<?php echo $_SESSION['front_session_sys_language']?>');LoadLocationEnd();" >
                                                                        <label for="form-label"><?php echo $txt_mod["index:return"] ?></label>
                                                                        <input type="text" class="form-control" id="input_returndate"  name="input_returndate" autocomplete="off" value="<?php echo $_REQUEST['input_returndate'];?>" placeholder="<?php echo $txt_mod["index:return"] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="basicSelect"><?php echo $txt_mod["index:adult"] ?></label>
                                                                        <select class="form-select" name="input_adult" id="input_adult" >
                                                                            <?php 
                                                                            if($_SESSION["front_session_sys_language"]=="eng"){
                                                                                for($adult=1;$adult<=50;$adult++){
                                                                                    ?>
                                                                                    <option value="<?php echo $adult?>" <?php echo ($_REQUEST["input_adult"]==$adult)?"selected":""?>><?php echo $adult?> <?php echo $txt_mod["index:adult"]?></option>
                                                                                <?php }
                                                                            }else{
                                                                                for($adult=1;$adult<=50;$adult++){
                                                                                ?>
                                                                                <option value="<?php echo $adult?>" <?php echo ($_REQUEST["input_adult"]==$adult)?"selected":""?>><?php echo $txt_mod["index:adult"]?> <?php echo $adult?> <?php echo $txt_mod["booking:persons"]?></option>
                                                                            <?php }
                                                                            }//if($_SESSION["front_session_sys_language"]=="eng"){?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="basicSelect"><?php echo $txt_mod["index:child"] ?></label>
                                                                        <select class="form-select" name="input_child" id="input_child" onchange="LoadBookingPerson(document.getElementById('boattime').value,document.getElementById('boattimereturn').value,document.getElementById('input_pickupdate').value,document.getElementById('input_returndate').value,document.getElementById('input_adult').value,this.value,document.getElementById('input_infant').value)";>
                                                                            <option value="0"><?php echo $txt_mod["index:child"] ?> 0 <?php echo $txt_mod["booking:persons"]?></option>
                                                                            <?php 
                                                                            if($_SESSION["front_session_sys_language"]=="eng"){
                                                                            for($child=1;$child<=30;$child++){
                                                                                ?>
                                                                                <option value="<?php echo $child?>" <?php echo ($_REQUEST["input_child"]==$child)?"selected":""?>><?php echo $child?> <?php echo $txt_mod["index:child"] ?></option>
                                                                            <?php }
                                                                            }else{
                                                                                for($child=1;$child<=30;$child++){
                                                                                ?>
                                                                                <option value="<?php echo $child?>" <?php echo ($_REQUEST["input_child"]==$child)?"selected":""?>><?php echo $txt_mod["index:child"] ?> <?php echo $child?> <?php echo $txt_mod["booking:persons"]?></option>
                                                                            <?php }
                                                                            }//if($_SESSION["front_session_sys_language"]=="eng"){?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="input_infant"><?php echo $txt_mod["index:infant"] ?></label>
                                                                        <select class="form-select" name="input_infant" id="input_infant" onchange="LoadBookingPerson(document.getElementById('boattime').value,document.getElementById('boattimereturn').value,document.getElementById('input_pickupdate').value,document.getElementById('input_returndate').value,document.getElementById('input_adult').value,document.getElementById('input_child').value,this.value)">
                                                                            <option value="0"><?php echo $txt_mod["index:infant"] ?> 0 <?php echo $txt_mod["booking:persons"]?></option>
                                                                            <?php 
                                                                            if($_SESSION["front_session_sys_language"]=="eng"){
                                                                            for($infant=1;$infant<=10;$infant++){
                                                                                ?>
                                                                                <option value="<?php echo $infant?>" <?php echo ($_REQUEST["input_infant"]==$infant)?"selected":""?>><?php echo $infant?> <?php echo $txt_mod["index:infant"] ?></option>
                                                                            <?php }
                                                                            }else{
                                                                                for($infant=1;$infant<=10;$infant++){
                                                                                ?>
                                                                                <option value="<?php echo $infant?>" <?php echo ($_REQUEST["input_infant"]==$infant)?"selected":""?>><?php echo $txt_mod["index:infant"] ?> <?php echo $infant?> <?php echo $txt_mod["booking:persons"]?></option>
                                                                            <?php }
                                                                            }//if($_SESSION["front_session_sys_language"]=="eng"){?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    window.addEventListener('DOMContentLoaded', function () { LoadLocationStart(); });
                                                                </script>
                                                            </div>
                                                            
                                                            <div class="content-bottom">
                                                                <!-- <a href="booking-details.html" class="promo-code">+ Add Promo code</a> -->
                                                                <!-- <i class="flaticon-flight-1"></i> -->
                                                                <!-- <a href="#" class="btn">FIND A BOAT  &nbsp;&nbsp;<img src="assets/img/icon/boat.png" style="width:35px;" alt=""></a></a> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- booking-area-end -->
                 
            </div>
            <!-- booking-area-end -->


            
            <section class="cruise-list">

                <!-- Sort by and View by -->
                <div class="sort-view clearfix">
                    
                    <!-- View by -->
                    <div class="view-by float-left">
                        <ul>
                            <!-- <li><a href="javascript:void(0)" title="" class="current" id="classstart"><i class="fa fa-anchor" aria-hidden="true"></i> <?php echo $txt_mod["booking:depart"]?> : <?php if($_REQUEST["locationstart"]!=""){ echo getLocationName($_REQUEST["locationstart"])." ".$txt_mod["booking:to"]." ".getLocationName($_REQUEST["locationend"]);};?></a></li> -->
                            
                        </ul>
                    </div>
                    <!-- View by -->
                </div>
                <!-- End Sort by and View by -->


                <!-- Cruise Content -->
                <div class="cruise-list-cn" id="loadlocationstart">

                    <?php 
                                // Booking dates are already in dd/mm/yyyy format.
                                //  echo "<br>ff: ".$_POST["locationend"] = DateFormadmY($_POST["locationend"]);
                                if($_POST["locationend"]!="" && $_POST["input_pickupdate"]!=""){
							
										$sql_timetable = "SELECT * FROM ".$mod_md_timetable." INNER JOIN ".$mod_md_location." ON ".$mod_md_timetable."_endid = ".$mod_md_location."_id WHERE ".$mod_md_timetable."_status='1'";
										if($_POST["locationstart"]!=""){
                                            $sql_timetable .= " AND ".$mod_md_timetable."_startid='".$_POST["locationstart"]."'";
                                        }
                                        if($_POST["locationend"]!="" && $_POST["locationstart"]!=$_POST["locationend"]){
                                            $sql_timetable .= " AND ".$mod_md_timetable."_endid='".$_POST["locationend"]."'";
                                        }
											
									  	$sql_timetable .= " ORDER BY ".$mod_md_timetable."_departuretime ASC,".$mod_md_timetable."_priceadult ASC";
                                        $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");
										$counttimetable=$Query_timetable->num_rows;
										$index=0;
                                        if($counttimetable>0){
                                            ?>
                                            <div class="four-item-carousel cruise-item">
                                            <?php
                                                while($Row_timetable=$Query_timetable->fetch_array()){
                                                    $row_startname=getLocationName($Row_timetable[$mod_md_timetable."_startid"]);
                                                    $row_endname=getLocationName($Row_timetable[$mod_md_timetable."_endid"]);
                                                    $row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);
                                                    $row_pierstart=getPierName($Row_timetable[$mod_md_timetable."_pierstart"]);
                                                    $row_pierend=getPierName($Row_timetable[$mod_md_timetable."_pierend"]);
                                                    $row_arrivaltime=FormatTime($Row_timetable[$mod_md_timetable."_arrivaltime"]);
                                                    $row_departuretime=FormatTime($Row_timetable[$mod_md_timetable."_departuretime"]);
                                                    $row_time=FormatTimeHour($Row_timetable[$mod_md_timetable."_time"]);
                                                    $row_company=getCompanyName($Row_timetable[$mod_md_timetable."_companyid"]);
                                                    $row_remark=$Row_timetable[$mod_md_timetable."_remark"];
                                                    $row_detailtransfer=$Row_timetable[$mod_md_timetable."_detailtransfer"];
                                                    $row_id=$Row_timetable[$mod_md_timetable."_id"];
                                                    
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
                                                    }else{
                                                        $showpriceadult=$priceadult;
                                                        $showpricechild=$pricechild;
                                                        $showpriceinfant=$priceinfant;
                                                    }

                                                    //$daydiff=(strtotime(DateFormatInsert($_POST["input_pickupdate"])) - strtotime(date("Y-m-d")))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
                                                    //echo "<br>day=".
                                                    $day=date('Y-m-d H:i:s',strtotime("+".$Row_company[$mod_md_company."_day"]." day"));
                                                    //echo "<br>checkday=".
                                                    $checkday=DateFormatInsert($_POST["input_pickupdate"])." ".$Row_company[$mod_md_company."_closetime"];
                                                    //echo "<br>daydiff=".
                                                    $daydiff=(strtotime($checkday) - strtotime($day))/  ( 60 * 60 * 24 ); 

                                                    if($daydiff>0){

                                                    $sql_boatstop = "SELECT * FROM ".$mod_md_boatstop." WHERE ".$mod_md_boatstop."_timetableid='".$Row_timetable[$mod_md_timetable."_id"]."' AND ".$mod_md_boatstop."_date='".DateFormatInsert($_POST["input_pickupdate"])."' AND ".$mod_md_boatstop."_status='1'";
                                                    $query_boatstop=$mysqli->query($sql_boatstop) or die("Error sql_boatstop: เกิดความผิดพลาด <br>$sql_boatstop");
                                                    $count_boatstop=$query_boatstop->num_rows;
                                                    
                                                if($count_boatstop==0){

                                                    $sql_detail_dd = "SELECT * FROM md_timetabledetail WHERE md_timetabledetail_timetableid='".$Row_timetable[$mod_md_timetable."_id"]."'";
                                                    $query_detail_dd=$mysqli->query($sql_detail_dd);
                                                    $row_detail_dd=$query_detail_dd->fetch_array();
                                                    
                                        ?>
                               		  
									<div class="container"><br>
										<div class="row justify-content-center">
							
											<div class="col-12">
												<div class="booking-list-item">
													<div class="booking-list-item-inner">
														<div class="booking-list-top">
															<div class="flight-airway">
																<div class="flight-logo">
																	<img src="<?php echo"uploads/timetable/pictures/".$Row_timetable[$mod_md_timetable."_picname"];?>" style="width:120px;"  alt="">
																	<h5 class="title"><?php echo $row_startname." - ".$row_endname?></h5>
																</div>
																<span><?php echo $txt_mod["booking:seat"]?> : <?php echo $row_seat?></span>
															</div>
															<ul class="flight-info">   
																<li><?php echo $txt_mod["booking:dep"]." ".$row_departuretime;?> <span><?php echo $row_pierstart;?></span></li>
																<li class="time"><span><?php echo $txt_mod["booking:arr"]." ".$row_arrivaltime;?></span><?php echo $row_pierend;?></li>
																<li><?php echo $txt_mod["booking:traveltime"] ;?><span><?php echo $row_time;?></span></li>
															</ul>
															<div class="flight-price">
																<h4 class="title"><?php echo $txt_mod["booking:adult"]?> <span><?php echo number_format($showpriceadult)?></span> <?php echo $_SESSION["front_session_sys_currency"]?> | <?php echo $txt_mod["booking:child"]?> <span><?php echo number_format($showpricechild)?></span> <?php echo $_SESSION["front_session_sys_currency"]?></h4>
                                                                <a href="#" class="btn"  onclick="if(document.getElementById('booking_type').value==1){Loadstep2('<?php echo $row_id;?>','',document.getElementById('input_pickupdate').value,getElementById('input_returndate').value,document.getElementById('input_adult').value,document.getElementById('input_child').value,document.getElementById('input_infant').value,document.getElementById('booking_type').value,document.getElementById('locationstart').value, document.getElementById('locationend').value);}else{Loadreturn('<?php echo $row_id;?>');}">Select <img src="assets/img/icon/boat.png" style="width:35px;" alt=""></a>
                                                                <!--  -->
															</div>
														</div>
														<div class="booking-list-bottom">
															<ul>
																<li class="detail"><i class="fa-solid fa-angle-down"></i> Boat Detail</li>
																<li>Price per person</li>
															</ul>
														</div>
													</div>
													<div class="flight-detail-wrap">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="flight-date" style="width:100%">
                                                                    <ul>
                                                                        <li><?php echo DateFormatInsert($_POST["input_pickupdate"]) ?></li>
                                                                        <li><?php echo $txt_mod["booking:dep"]." ".$row_departuretime;?> <span><?php echo $row_time;?></span></li>
                                                                        <li><?php echo $txt_mod["booking:arr"]." ".$row_arrivaltime;?></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-6"> 
                                                                <img src="assets/img/icon/boat.png" style="width:35px;" alt="">
                                                                <h6 class="title"><?php echo $row_pierstart;?></h6>
                                                                <div class="flight-detail-info"> 
                                                                    <?php if($row_detail_dd["md_timetabledetail_picname1"]!=''){ ?>
                                                                        <img src="<?php echo "uploads/timetabledetail/".$row_detail_dd["md_timetabledetail_picname1"];?>" alt="" style="width: 150px;">
                                                                    <?php }else{ ?>
                                                                        <img src="<?php echo"uploads/timetable/pictures/".$Row_timetable["md_timetable_picname"];?>" alt="" style="width: 150px;">
                                                                    <?php } ?>
                                                                    <?php if($row_detail_dd['md_timetabledetail_detail'.$_SESSION["front_session_sys_language"].'1']!=''){ ?>
                                                                        <?php echo $row_detail_dd['md_timetabledetail_detail'.$_SESSION["front_session_sys_language"].'1'] ?>
                                                                    <?php } ?> 
                                                                </div>
                                                                <h6 class="title title-two"></span><?php echo $row_pierend;?></h4> 
                                                            </div>
                                                        </div>
													</div>
												</div> 
											</div>
										</div>
									</div>
                                    <?php 
                                        $index++;}//if($count_boatstop>0){
                                        }//if($Row_company[$mod_md_company."_day"]>=$daydiff){
                                    }//while($Row_timetable=$Query_timetable->fetch_array()){?>
                                    <br><br>
                                    <input type="hidden" name="TotalCheckBoxID" id="TotalCheckBoxID" value="<?php echo $index-1?>">
                              	</div>
                                <?php 
                                    if($index==0){
                                        echo '<div align="center" style="padding:40px;">'.$txt_mod["booking:noavailable"].'</div>';
                                    }
                                }else{
                                    echo '<div class="cruise-item" align="center" style="padding:40px;">'.$txt_mod["booking:noavailable"].'</div>';
                                }//if($counttimetable>0){
                                    }else{
                                    echo '<div class="cruise-item" align="center" style="padding:40px;">'.$txt_mod["booking:noavailable1"].'</div>';
                                }//if($_POST["locationend"]!=""){?>

                                <script>
window.addEventListener('DOMContentLoaded', function () {
                                    $('.flight-detail-wrap').slideUp();
                                    $('.detail').on('click', function () {
                                        $(this).toggleClass('show');
                                        $(this).parent().parent().parent().parent().find('.flight-detail-wrap').slideToggle();
                                    });
                                
});
</script>
                </div>
                <!-- End Cruise Content -->
            </section>

            <section class="cruise-list">
                <!-- Sort by and View by -->
                <div class="sort-view clearfix">
                    
                    <!-- View by -->
                    <div class="view-by float-left">
                        <ul>
                            <li id="returntopname" <?php if($_REQUEST["booking_type"]!=2){?> style="display:none;" <?php }?>><a href="javascript:void(0)" title="" class="current" id="classend"><i class="fa fa-anchor" aria-hidden="true"></i> <?php echo $txt_mod["booking:return"];?> : <?php if($_REQUEST["locationstart"]!=""){ echo getLocationName($_REQUEST["locationend"])." ".$txt_mod["booking:to"]." ".getLocationName($_REQUEST["locationstart"]);};?></a></li>
                        </ul>
                    </div>
                    <!-- View by -->
                </div>
                <!-- End Sort by and View by -->

                <div class="cruise-list-cn" id="loadlocationend" <?php if($_REQUEST["booking_type"]!=2){?> style="display:none;" <?php }?>>
                    <?php 
                    if($_REQUEST["locationend"]!=""){
                        $sql_locationstart = "SELECT * FROM ".$mod_md_location." WHERE ".$mod_md_location."_status='1'";
                        if($_REQUEST["locationend"]!=""){
                            $sql_locationstart .= " AND ".$mod_md_location."_id='".$_REQUEST["locationend"]."'";
                        }else{
                            $sql_locationstart .= " AND ".$mod_md_location."_id='6'";
                        }
                        $sql_locationstart .= " ORDER BY ".$mod_md_location."_name".$_SESSION["front_session_sys_language"]." ASC";
                        $Query_locationstart=$mysqli->query($sql_locationstart) OR DIE("Error sql_locationstart: <br>$sql_locationstart<br>\n");
                        $Row_locationstart=$Query_locationstart->fetch_array();
                        $row_locationstart_id=$Row_locationstart[$mod_md_location.'_id'];
                        $row_locationstart_name=$Row_locationstart[$mod_md_location.'_name'.$_SESSION["front_session_sys_language"]];

                            $sql_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1'";
                            if($_REQUEST["locationend"]!=""){
                                $sql_timetable .= " AND ".$mod_md_timetable."_startid='".$_REQUEST["locationend"]."'";
                                }else{
                                $sql_timetable .= " AND ".$mod_md_timetable."_startid='2'";
                            }
                            if($_REQUEST["locationstart"]!=""){
                                $sql_timetable .= " AND ".$mod_md_timetable."_endid='".$_REQUEST["locationstart"]."'";
                            }else{
                                $sql_timetable .= " AND ".$mod_md_timetable."_endid='6'";
                            }
                            $sql_timetable .= " ORDER BY ".$mod_md_timetable."_departuretime ASC,".$mod_md_timetable."_priceadult ASC";
                            $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");
                            $counttimetable=$Query_timetable->num_rows;
                            $index=0;
                    if($counttimetable>0){ ?>
                    <div class="four-item-carousel cruise-item">
                        <?php
                        while($Row_timetable=$Query_timetable->fetch_array()){
                            $row_id=$Row_timetable[$mod_md_timetable."_id"];
                            $row_startname=getLocationName($Row_timetable[$mod_md_timetable."_startid"]);
                            $row_endname=getLocationName($Row_timetable[$mod_md_timetable."_endid"]);
                            $row_pierstart=getPierName($Row_timetable[$mod_md_timetable."_pierstart"]);
                            $row_pierend=getPierName($Row_timetable[$mod_md_timetable."_pierend"]);
                            $row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);
                            $row_arrivaltime=FormatTime($Row_timetable[$mod_md_timetable."_arrivaltime"]);
                            $row_departuretime=FormatTime($Row_timetable[$mod_md_timetable."_departuretime"]);
                            $row_time=FormatTimeHour($Row_timetable[$mod_md_timetable."_time"]);
                            $row_company=getCompanyName($Row_timetable[$mod_md_timetable."_companyid"]);
                            $row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);
                            $row_remark=$Row_timetable[$mod_md_timetable."_remark"];
                            $row_detailtransfer=$Row_timetable[$mod_md_timetable."_detailtransfer"];
                            

                            $priceadult=$Row_timetable[$mod_md_timetable."_priceadult"];
                            $pricechild=$Row_timetable[$mod_md_timetable."_pricechild"];

                            $priceadult_date=$Row_timetable[$mod_md_timetable."_saleadult"];
                            $pricechild_date=$Row_timetable[$mod_md_timetable."_salechild"];
                            if($priceadult_date!="0"){
                                $showpriceadult=$priceadult_date;
                                $showpricechild=$pricechild_date;  
                            }else{
                                $showpriceadult=$priceadult;
                                $showpricechild=$pricechild;  
                            }
                            
                            $sql_company = "SELECT * FROM ".$mod_md_company." WHERE ".$mod_md_company."_id='".$Row_timetable[$mod_md_timetable."_companyid"]."'";
                            $Query_company=$mysqli->query($sql_company) OR DIE("Error sql_company: <br>$sql_company<br>\n");
                            $Row_company=$Query_company->fetch_array();

                            $day=date('Y-m-d H:i:s',strtotime("+".$Row_company[$mod_md_company."_day"]." day"));
                            //echo "<br>checkday=".
                            $checkday=DateFormatInsert($_REQUEST["input_returndate"])." ".$Row_company[$mod_md_company."_closetime"];
                            //echo "<br>daydiff=".
                            $daydiff=(strtotime($checkday) - strtotime($day))/  ( 60 * 60 * 24 ); 

                            if($daydiff>0){

                            $sql_boatstop = "SELECT * FROM ".$mod_md_boatstop." WHERE ".$mod_md_boatstop."_timetableid='".$Row_timetable[$mod_md_timetable."_id"]."' AND ".$mod_md_boatstop."_date='".DateFormatInsert($_REQUEST["input_returndate"])."' AND ".$mod_md_boatstop."_status='1'";
                            $query_boatstop=$mysqli->query($sql_boatstop) or die("Error sql_boatstop: เกิดความผิดพลาด <br>$sql_boatstop");
                            $count_boatstop=$query_boatstop->num_rows;
                            
                        if($count_boatstop==0){
                        ?>
                        <!--boat Box-->
                            <div class="boat-box">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="check-box-container">
                                            <input type="radio" value="<?php echo $row_id?>" name="input_boatreturn" id="input_boatreturn<?php echo $row_id?>" onclick="LoadBookingReturn(<?php echo $row_id;?>,document.getElementById('input_pickupdate').value,document.getElementById('input_returndate').value,document.getElementById('input_adult').value,document.getElementById('input_child').value,document.getElementById('input_infant').value,'loadbookingreturn');Timetabledetail(<?php echo $Row_timetable[$mod_md_timetable."_id"]?>);">
                                            <label for="input_boatreturn<?php echo $row_id?>">
                                                <span></span>
                                                <?php echo $txt_mod["booking:selectboat"]?>
                                            </label>
                                        </div>
                                        
                                        <label for="input_boatreturn<?php echo $row_id?>" style="cursor:pointer">
                                        <img src="<?php echo"uploads/timetable/pictures/".$Row_timetable[$mod_md_timetable."_picname"];?>" alt=""/>
                                        </label>
                                    </div>
                                    <!--Lower Content-->
                                    <label for="input_boatreturn<?php echo $row_id?>" style="cursor:pointer">
                                    <div class="lower-content">
                                    
                                    <h3><a href="javascript:void(0)"><?php echo $row_startname." - ".$row_endname?></a></h3>
                                    <div class="seat"><?php echo $txt_mod["booking:company"]?> : <?php echo $row_company?></div>
                                    <div class="seat"><?php echo $txt_mod["booking:seat"]?> : <?php echo $row_seat?></div>
                                        <div class="detail">
                                        <p><?php echo $txt_mod["booking:dep"]." ".$row_departuretime;?> | <?php echo $row_pierstart;?></p>
                                        <p><?php echo $txt_mod["booking:arr"]." ".$row_arrivaltime;?> | <?php echo $row_pierend;?></p>
                                        <p><?php echo $txt_mod["booking:traveltime"]." ".$row_time;?></p>
                                    </div>
                                    <div class="price clearfix"><?php echo $txt_mod["booking:adult"]?> <span><?php echo number_format($showpriceadult)?></span> <?php echo $_SESSION["front_session_sys_currency"]?> | <?php echo $txt_mod["booking:child"]?> <span><?php echo number_format($showpricechild)?></span> <?php echo $_SESSION["front_session_sys_currency"]?>
                                    </div>
                                    
                                    <?php if($row_remark!="" || $row_detailtransfer!=""){?>
                                    <div class="detail">
                                        <p style="color: red;font-size: 10px;"><?php echo $txt_mod["booking:remark"]?> : <?php echo $row_remark." ".$row_detailtransfer;?></p>
                                    </div>
                                    <?php }?>
                                    </div>
                                    </label>
                                </div>
                            </div>

                            
                        <?php 
                            $index++;}//if($count_price>0){
                            }//if($daydiff>=$Row_company[$mod_md_company."_day"]){
                        }//while($Row_timetable=$Query_timetable->fetch_array()){
                        ?>

                    </div>
                    <?php 
                        if($index==0){
                            echo '<div align="center" style="padding:40px;">'.$txt_mod["booking:noavailable"].'</div>';
                        }//if($index==0){   
                    }else{
                        echo '<div class="cruise-item" align="center" style="padding:40px;">'.$txt_mod["booking:noavailable"].'</div>';
                    }//if($counttimetable>0){

                    }else{
                        echo '<div class="cruise-item" align="center" style="padding:40px;">'.$txt_mod["booking:noavailable1"].'</div>';
                    }//if($_REQUEST["locationend"]!=""){
                    ?>
                </div>
                <!-- End Cruise Content -->

            </section>

             
            
            </form>
        </main>
        <!-- main-area-end -->
        <script type="text/javascript" src="js/scriptboat.js"></script>
        
        <?php  include("include/include_footer.php");  ?>

        <?php  include("include/include_foot.php");  ?>
        
  