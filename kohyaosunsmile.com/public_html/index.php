<?php  

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

        ?>



        <?php  include("include/include_header2.php");  ?>





        <!-- main-area -->

        <main>

            <!-- Google Tag Manager (noscript) -->

            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W6PNXSWQ"

            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

            <!-- End Google Tag Manager (noscript) -->

           



            <form name="myForm" id="myForm" method="POST" action="booking.php">

                <input type="hidden" id="myaction" name="myaction" value="">

                <input type="hidden" id="language" name="language" value="<?php echo $_SESSION["front_session_sys_language"]?>">

                <!-- slider-area -->

                <section class="slider-area">

                    <div class="slider-active">

                        <div class="single-slider slider-bg" > 

                            <div class="video-container">

                                <video src="assets/img/vdo.mp4" autoplay="autoplay" playsinline loop="loop" preload="auto" muted="muted"></video>

                            </div>

    

                            <div class="container">

                                <div class="row">

                                    <div class="col-xl-8 col-lg-10">

                                        <div class="slider-content">

                                            <!-- <h2 class="title" data-animation="fadeInUp" data-delay=".2s">Welcome to Koh Yao Sun Smile.</h2>

                                            <p data-animation="fadeInUp" data-delay=".4s">Book boat online and payment with more options.

                                                    We’re working hard to provide you with the fastest highspeed ferry tickets. Just book the boat ticket with us, 

                                                    it is the same as helping to create job in the community.</p> -->

                                            <!-- <a href="contact.html" class="btn" data-animation="fadeInUp" data-delay=".6s">Sign in / Register</a> -->

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div> 

                    </div>

                </section>

    

                <style> 

                    .video-container{ 

                        position: absolute;

                        margin: auto;

                        width: 100%;

                        height: 100%;

                        

                        background: blue;

                        

                        overflow: hidden;

                        clip-path: 0 0;

                        transform: translatez(0);

                    } 

                    video{

                        transform: translatez(0);

                        position: absolute;

                        top: -100%;

                        bottom: -100%;

                        left: -100%;

                        right: -100%;    



                        margin: auto;



                        min-width: 100%;

                        min-height: 100%;

                    }

                </style>

                <!-- slider-area-end -->

    

                

                <!-- booking-area -->

                <div class="booking-area">

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

                                <div class="booking-wrap" style="margin-top: -120px;">

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item" role="presentation">

                                            <button class="nav-link active" id="bOOKing-tab" data-bs-toggle="tab" data-bs-target="#bOOKing-tab-pane" type="button"

                                                role="tab" aria-controls="bOOKing-tab-pane" aria-selected="true"><img src="assets/img/icon/boat.png" style="width:45px;" alt=""></a>  &nbsp;&nbsp;<?php echo $txt_mod["index:findboat"] ?></button>

                                                <!-- <i class="flaticon-flight"></i> -->

                                        </li> 

                                    </ul>

                                    <?php        

                                        if(!isset($_REQUEST["booking_type"])){

                                            $_REQUEST["booking_type"]=1;

                                        }

                                        $_REQUEST["locationstart"] = isset($_REQUEST["locationstart"]) ? $_REQUEST["locationstart"] : '';

                                        $_REQUEST["locationend"] = isset($_REQUEST["locationend"]) ? $_REQUEST["locationend"] : '';

                                        // echo "LL: ".$_SESSION["front_session_sys_language"];

                                    ?>

                                    <div class="tab-content" id="myTabContent">

                                        <div class="tab-pane fade show active" id="bOOKing-tab-pane" role="tabpanel" aria-labelledby="bOOKing-tab" tabindex="0">

                                            <div class="row">

                                                <div class="col-lg-12">

                                                    <div class="tab-content-wrap">

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

                                                                    <select id="booking_type" name="booking_type" class="form-select" onchange="bookingtype(this.value);" > 

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

                                                                    <input type="text" class="form-control calendar-input hasDatepicker" autocomplete="off" id="input_pickupdate" name="input_pickupdate"  placeholder="<?php echo $txt_mod["index:depart"] ?>"  onchange="LoadLocationStart('<?php echo $_SESSION['front_session_sys_language']?>');LoadLocationEnd();" >

                                                                </div>

                                                            </div>

                                                            <div class="col-lg-3">

                                                                <div class="mb-1" id="return" <?php if($_REQUEST["booking_type"]=="1"){ echo 'style="display: none;"';}?> >

                                                                    <label for="form-label"><?php echo $txt_mod["index:return"] ?></label>

                                                                    <input type="text" class="form-control calendar-input hasDatepicker" autocomplete="off" id="input_returndate" name="input_returndate" placeholder="<?php echo $txt_mod["index:return"] ?>">

                                                                </div>

                                                            </div>

                                                            <div class="col-lg-3">

                                                                <div class="mb-1">

                                                                    <label class="form-label" for="input_adult"><?php echo $txt_mod["index:adult"] ?></label>

                                                                    <select class="form-select" id="input_adult" name="input_adult">

                                                                        <option value="1">1</option> 

                                                                        <option value="2">2</option> 

                                                                        <option value="3">3</option> 

                                                                        <option value="4">4</option> 

                                                                        <option value="5">5</option> 

                                                                        <option value="6">6</option> 

                                                                        <option value="7">7</option> 

                                                                        <option value="8">8</option> 

                                                                        <option value="9">9</option> 

                                                                        <option value="10">10</option> 

                                                                    </select>

                                                                </div>

                                                            </div>

                                                            <div class="col-lg-3">

                                                                <div class="mb-1">

                                                                    <label class="form-label" for="input_child"><?php echo $txt_mod["index:child"] ?></label>

                                                                    <select class="form-select" id="input_child" name="input_child">

                                                                        <option value="0">0</option> 

                                                                        <option value="1">1</option> 

                                                                        <option value="2">2</option> 

                                                                        <option value="3">3</option> 

                                                                        <option value="4">4</option> 

                                                                        <option value="5">5</option> 

                                                                        <option value="6">6</option> 

                                                                        <option value="7">7</option> 

                                                                        <option value="8">8</option> 

                                                                        <option value="9">9</option> 

                                                                        <option value="10">10</option> 


                                                                    </select>

                                                                </div>

                                                            </div>

                                                            <div class="col-lg-3">

                                                                <div class="mb-1">

                                                                    <label class="form-label" for="input_infant"><?php echo $txt_mod["index:infant"] ?></label>

                                                                    <select class="form-select" id="input_infant" name="input_infant">

                                                                        <option value="0">0</option> 

                                                                        <option value="1">1</option> 

                                                                        <option value="2">2</option> 

                                                                        <option value="3">3</option> 

                                                                        <option value="4">4</option> 

                                                                        <option value="5">5</option>

                                                                        <option value="6">6</option> 

                                                                        <option value="7">7</option> 

                                                                        <option value="8">8</option> 

                                                                        <option value="9">9</option> 

                                                                        <option value="10">10</option>

                                                                    </select>

                                                                </div>
                                                            </div>

                                                        </div>

                                                        

                                                        <div class="content-bottom">

                                                            <!-- <a href="booking-details.html" class="promo-code">+ Add Promo code</a> -->

                                                            <!-- <i class="flaticon-flight-1"></i> -->

                                                            <button type="submit" class="btn"><?php echo $txt_mod["index:findboat"] ?>  &nbsp;&nbsp;<img src="assets/img/icon/boat.png" style="width:35px;" alt=""></button></a>

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



                <!-- features-area -->

                <section class="features-area" style="margin-top:-20px;">

                    <div class="container">

                        <div class="row justify-content-center">

                            <div class="col-xl-4 col-lg-6 col-sm-10">

                                <div class="features-item">

                                    <div class="features-icon">

                                        <i class="flaticon-help" style="color: #000000;"></i>

                                    </div>

                                    <div class="features-content">

                                        <h6 class="title">We are now available</h6>

                                        <p>Call <?php echo $Row_info['sys_info_phone'] ?> for contact with us</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-6 col-sm-10">

                                <div class="features-item">

                                    <!-- features-icon -->

                                    <div class="">

                                        <!-- <i class="flaticon-plane"></i> -->

                                        <img src="assets/img/icon/boat.png" style="width:85px;" alt="">

                                    </div>

                                    <div class="features-content" style="margin-left: 11px;">

                                        <h6 class="title">Contact Boat</h6>

                                        <p>Call <?php echo $Row_info['sys_info_phone'] ?> for booking assistance</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-6 col-sm-10">

                                <div class="features-item">

                                    <!-- features-icon -->

                                    <div class="">

                                        <!-- <i class="flaticon-money-back-guarantee"></i> -->

                                        <img src="assets/img/icon/location.png" style="width:80px;" alt="">

                                    </div>

                                    <div class="features-content">

                                        <h6 class="title">Contact Us</h6>

                                        <p><?php echo $Row_info['sys_info_addressthai'] ?></p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <!-- features-area-end -->

 

                <!-- destination-area -->

                <section class="destination-area  destination-bg" style="background-color: #1DC6CD;">

                    <div class="container">

                        <div class="row">

                            <div class="col-lg-8">

                                <div class="section-title">

                                    <span class="sub-title">kohyaosunsmile</span>

                                    <h2 class="title"><?php echo $txt_mod["index:title"] ?></h2>

                                </div>

                                <div class="destination-content">

                                    <p><?php echo $txt_mod["index:subtitle"] ?></p>

                                    <ul>

                                        <li>

                                            <div class="counter-item">

                                                <div class="counter-content">

                                                    <h2 class="count"><span class="odometer" data-count="5830"></span>+</h2>

                                                    <p>Happy Customers</p>

                                                </div>

                                                <div class="counter-icon">

                                                    <i class="flaticon-group"></i>

                                                </div>

                                            </div>

                                        </li>

                                        <li>

                                            <div class="counter-item">

                                                <div class="counter-content">

                                                    <h2 class="count"><span class="odometer" data-count="100"></span>%</h2>

                                                    <p>Client Setisfied</p>

                                                </div>

                                                <div class="counter-icon">

                                                    <i class="flaticon-globe"></i>

                                                </div>

                                            </div>

                                        </li>

                                    </ul>

                                    <div class="content-bottom">

                                        <p><?php echo $txt_mod["index:discover"] ?></p>

                                        <a href="contact.php"><?php echo $txt_mod["index:contact"] ?></a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <!-- destination-area-end -->



                <!-- fly-next-area -->

                <section class="fly-next-area">

                    <div class="container">

                        <div class="row justify-content-center">

                            <div class="col-lg-8">

                                <div class="section-title text-center">

                                    <span class="sub-title">BOAT RECOMMENDED</span>

                                    <h2 class="title"><?php echo $txt_mod["index:recomment"] ?></h2>

                                </div>

                            </div>

                        </div>

                        <div class="row justify-content-center">

                            <div class="col-lg-7">

                                <div class="fly-next-nav">

                                    <!-- <button class="active" data-filter="*">Flights <i class="flaticon-flight"></i></button>

                                    <button class="" data-filter=".cat-one">Car Rentals <i class="flaticon-car-1"></i></button>

                                    <button class="" data-filter=".cat-two">Taxis <i class="flaticon-taxi"></i></button> -->

                                </div>

                            </div>

                        </div>

                        <div class="row fly-next-active justify-content-center"> 

                            <?php 



                                $sql_timetable = "SELECT * FROM ".$mod_md_timetable.",".$mod_md_location." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_recoment='1' AND ".$mod_md_timetable."_startid=".$mod_md_location."_id ORDER BY ".$mod_md_location."_name".$_SESSION["front_session_sys_language"]." ASC";

                                $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");

                                //$indextimetable=1;

                                $countindex=1;

                                while($Row_timetable=$Query_timetable->fetch_array()){

                                    $row_star=$Row_timetable[$mod_md_timetable."_startid"];

                                    $row_end=$Row_timetable[$mod_md_timetable."_endid"];

                                    $row_startname=getLocationName($Row_timetable[$mod_md_timetable."_startid"]);

                                    $row_endname=getLocationName($Row_timetable[$mod_md_timetable."_endid"]);

                                    $row_pier=getPierName($Row_timetable[$mod_md_timetable."_pierstart"]);

                                    $row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);

                                    $row_arrivaltime=FormatTime($Row_timetable[$mod_md_timetable."_arrivaltime"]);

                                    $row_departuretime=FormatTime($Row_timetable[$mod_md_timetable."_departuretime"]);

                                    $row_time=FormatTimeHour($Row_timetable[$mod_md_timetable."_time"]);

                                    $row_remark=$Row_timetable[$mod_md_timetable."_remark"];

                                    $row_company=getCompanyName($Row_timetable[$mod_md_timetable."_companyid"]);



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

                                    $input_pickupdate=date('d/m/Y');

                                    ?>

                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 grid-item grid-sizer cat-two">

                                        <div class="fly-next-item ">

                                            <div class="fly-next-thumb text-center">

                                                <a href="#" ><img src="<?php echo "uploads/timetable/pictures/".$Row_timetable[$mod_md_timetable."_picname"];?>" alt="" style="height: 170px;" onerror="this.onerror=null;this.src='assets/img/placeholder.png'"></a>

                                            </div>

                                            <div class="fly-next-content">

                                                <!-- <span>09 Jun 2022 - 16 Jun 2022</span> -->

                                                <h4 class="title" style="color:#094345;"><?php echo $row_startname ?>

                                                <i class="fa fa-long-arrow-right"></i>

                                                <?php echo $row_endname ?></h4>

                                                <!-- <a href="#" class="air-logo"><img src="assets/img/icon/fly_icon01.jpg" alt=""></a><hr> -->

                                                <div class="content-bottom">

                                                    <?php 

                                                    $detail =$txt_mod["booking:boatoff"]." ".$row_startname." ".$row_pier." ".$txt_mod["booking:to"]." ".$row_endname." ".$txt_mod["booking:traveltime"]." ".$row_time.".";

                                                    $string = $detail; //mb_substr($detail, 0, 65, 'UTF-8') . "..."; 

                                                    ?>

                                                    <p style="color:#094345;"><?php echo $string ?></p> 

                                                </div><br>

                                                <div class="text-end">

                                                    <h4 class="price"><?php echo number_format($showpriceadult)?> <?php echo $_SESSION["front_session_sys_currency"]?></h4>

                                                </div><br>

                                                <a class="btn" href="booking.php?locationstart=<?php echo $row_star?>&&locationend=<?php echo $row_end?>&&booking_type=1&&input_pickupdate=<?php echo $input_pickupdate?>" style="background-color: #ffb300 !important;">Booking</a>



                                            </div>

                                        </div>

                                    </div>

                                <?php } ?>

                            </div>

                        </div>

                    </div>

                </section>

                <!-- fly-next-area-end -->



                <style>

                    .img-box {

                    background-color: #fff;

                    border-radius: 100%;

                    width: 103px;

                    padding: 23px;

                    } 

                </style>

                <!-- brand-area -->

                <div class="brand-area brand-bg"> 

                    <div class="container"> 

                        <div class="row justify-content-center"> 

                            <div class="col-xl-3 col-lg-6 col-md-6">

                                <div class=" h-100">

                                    <center>

                                    <div class="service-icon img-box">

                                        <img src="assets/img/icon/service_icon02.png" alt="" style="width:80px;">

                                    </div> 

                                    <div class="service-content"> 

                                        <h2 class="title text-warning"><?php echo $txt_mod["index:lifejacket"] ?></h2>

                                        <div class="service-list">

                                            <!-- <ul>

                                                <li>What will it be, window or aisle? <i class="flaticon-check-mark"></i></li>

                                                <li>Select your preferred seat prior <i class="flaticon-check-mark"></i></li>

                                                <li>Reserved for you. <i class="flaticon-check-mark"></i></li>

                                            </ul> -->

                                            <p class="text-white"><?php echo $txt_mod["index:lifejacket2"] ?></p>

                                        </div>

                                    </div>

                                    </center>

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6">

                                <div class=" h-100">

                                    <center>

                                        <div class="service-icon img-box"> 

                                            <img src="assets/img/icon/service_icon01.png" alt="" style="width:80px;">

                                        </div>

                                        <div class="service-content"> 

                                            <h2 class="title text-warning"><?php echo $txt_mod["index:freepickup"] ?></h2>

                                            <div class="service-list">

                                                <!-- <ul>

                                                    <li>Pre-book your baggage <i class="flaticon-check-mark"></i></li>

                                                    <li>Allowance now and save up <i class="flaticon-check-mark"></i></li>

                                                    <li>90% of baggage charges <i class="flaticon-check-mark"></i></li>

                                                </ul> -->

                                                <p class="text-white"><?php echo $txt_mod["index:freepickup2"] ?> <P style="color:red;"><?php echo $txt_mod["index:freepickup3"] ?></P></p>

                                            </div>

                                        </div>

                                    </center>

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6">

                                <div class=" h-100">

                                    <center>

                                        <div class="service-icon img-box">

                                            <img src="assets/img/icon/service_icon03.png" alt="" style="width:80px;">

                                        </div>

                                        <div class="service-content"> 

                                            <h2 class="title text-warning"><?php echo $txt_mod["index:cancellation"] ?></h2>

                                            <div class="service-list">

                                                <!-- <ul>

                                                    <li>Travel stress-free by getting<i class="flaticon-check-mark"></i></li>

                                                    <li>Covered for flight modification <i class="flaticon-check-mark"></i></li>

                                                    <li>Cancellation, accident & medical <i class="flaticon-check-mark"></i></li>

                                                </ul> -->

                                                <p class="text-white"><?php echo $txt_mod["index:cancellation2"] ?></p>

                                            </div>

                                        </div>

                                    </center>

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6">

                                <div class=" h-100">

                                    <center>

                                        <div class="service-icon img-box">

                                            <img src="assets/img/icon/service_icon04.png" alt=""  style="width:80px;">

                                        </div>

                                        <div class="service-content"> 

                                            <h2 class="title text-warning"><?php echo $txt_mod["index:insurance"] ?></h2>

                                            <div class="service-list">

                                                <!-- <ul>

                                                    <li>Travel stress-free by getting<i class="flaticon-check-mark"></i></li>

                                                    <li>Covered for flight modification <i class="flaticon-check-mark"></i></li>

                                                    <li>Cancellation, accident & medical <i class="flaticon-check-mark"></i></li>

                                                </ul> -->

                                                <p class="text-white"><?php echo $txt_mod["index:insurance2"] ?></p>

                                            </div>

                                        </div>

                                    </center>

                                </div>

                            </div>

                        </div>

                    </div> 

                </div>

                <!-- brand-area-end -->



            



                <!-- blog-area -->

                <section class="blog-area blog-bg">

                    <div class="container">

                        <div class="row justify-content-center">

                            <div class="col-lg-8">

                                <div class="section-title text-center">

                                    <span class="sub-title">our News Feeds</span>

                                    <h2 class="title"><?php echo $txt_mod["index:lastnewupdate"] ?></h2>

                                </div>

                            </div>

                        </div>

                        <div class="row justify-content-center">

                            <div class="col-53">

                            <?php

                                $sql = "SELECT * FROM md_news WHERE   md_news_status='1' order by md_news_id DESC limit 0,1";

                                $query=$mysqli->query($sql) or die("Error sql:  <br/>$sql<br />\n"); 

                                while($Row=$query->fetch_array()){

                                    $row_id=isset($Row['md_news_id']) ? $Row['md_news_id'] : '';   

                                    $row_subject=isset($Row['md_news_subject']) ? $Row['md_news_subject'] : '';  

                                    $row_title=isset($Row['md_news_title']) ? $Row['md_news_title'] : '';   

                                    $row_picname=isset($Row['md_news_picname']) ? $Row['md_news_picname'] : '';   

                                    $row_credate=isset($Row['md_news_credate']) ? $Row['md_news_credate'] : ''; 

                                    ?>

                                    <div class="blog-item">

                                        <div class="blog-thumb">

                                            <a href="#"><img src="manageadmin/uploads/blog/<?php echo $row_picname ?>" alt=""></a>

                                        </div>

                                        <div class="blog-content">

                                            <div class="blog-meta">

                                                <ul>

                                                    <!-- <li><i class="fa-regular fa-user"></i> <a href="#">Emely Watson</a></li> -->

                                                    <li><i class="fa-solid fa-calendar-days"></i> <?php echo ShowDateFormThai($row_credate); ?></li>

                                                </ul>

                                            </div>

                                            <h2 class="title"><a href="#"><?php echo $row_title ?></a></h2>

                                        </div>

                                    </div>

                                <?php } ?>

                            </div>

                            <div class="col-47">

                                <?php

                                $sql = "SELECT * FROM md_news WHERE   md_news_status='1' order by md_news_id DESC limit 1,5";

                                $query=$mysqli->query($sql) or die("Error sql:  <br/>$sql<br />\n"); 

                                while($Row=$query->fetch_array()){

                                    $row_id=isset($Row['md_news_id']) ? $Row['md_news_id'] : '';   

                                    $row_subject=isset($Row['md_news_subject']) ? $Row['md_news_subject'] : '';  

                                    $row_title=isset($Row['md_news_title']) ? $Row['md_news_title'] : '';   

                                    $row_picname=isset($Row['md_news_picname']) ? $Row['md_news_picname'] : '';   

                                    $row_credate=isset($Row['md_news_credate']) ? $Row['md_news_credate'] : ''; 

                                    ?>

                                    <div class="blog-item small-item">

                                        <div class="blog-thumb">

                                            <a href="#"><img src="manageadmin/uploads/blog/<?php echo $row_picname ?>" alt=""></a>

                                        </div>

                                        <div class="blog-content">

                                            <div class="blog-meta">

                                                <ul>

                                                    <!-- <li><i class="fa-regular fa-user"></i> <a href="#">Emely Watson</a></li> -->

                                                    <li><i class="fa-solid fa-calendar-days"></i> <?php echo ShowDateFormThai($row_credate); ?></li>

                                                </ul>

                                            </div>

                                            <h2 class="title"><a href="#"><?php echo $row_title ?></a></h2>

                                        </div>

                                    </div>

                                <?php } ?>

                            </div>

                        </div>

                    </div>

                </section>

                <!-- blog-area-end -->

            </form>

        </main> 

        <!-- main-area-end -->

        <script type="text/javascript" src="js/scriptboat.js"></script>

        <!-- เพิ่ม SweetAlert ในไฟล์ HTML -->

        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->



        

        <?php  include("include/include_footer.php");  ?>



        <?php  include("include/include_foot.php");  ?>