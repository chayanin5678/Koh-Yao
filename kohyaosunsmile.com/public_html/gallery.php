<?php  
        require_once("manageadmin/libs/config.php");
        require_once("manageadmin/libs/connect.php");
        require_once("libs/session.php");
        // require_once("libs/function.php"); 
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
        <link rel="stylesheet" href="assets/css/gallery.css">
        <?php  include("include/include_header2.php");  ?>


        <!-- main-area -->
        <main>
            <form name="myForm" id="myForm" method="POST" action="booking.php">
                <input type="hidden" id="myaction" name="myaction" value="">
                <input type="hidden" id="language" name="language" value="<?php echo $_SESSION["front_session_sys_language"]?>">
                
                <!-- breadcrumb-area -->
                <section class="breadcrumb-area breadcrumb-bg" style="padding: 120px 0 80px;">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="breadcrumb-content text-center">
                                    <h2 class="title" style="color:#031f60;">Gallery</h2>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php" style="color:#031f60;">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div><br><br>
                        </div>
                        <style> 
                            .nav-link{  
                                color: #fff;
                                background-color: #fff;
                                border-color: #fff;
                            }
                            .nav-link:hover{
                                background-color: #fff;
                                border-color: #fff;
                            }
                            .nav-link:focus,
                            .nav-link:active,
                            .nav-link.active {
                                background-color: #fff;
                                border-color: #000000;
                            }
                        </style>
                        <div class="row justify-content-center">
                            <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top:50px;">
                                <?php
                                    
                                    $sql = "SELECT * FROM md_album WHERE   md_album_status='1'";
                                    $query=$mysqli->query($sql) or die("Error sql:  <br/>$sql<br />\n"); 
                                    while($Row=$query->fetch_array()){
                                        $row_id=isset($Row['md_album_id']) ? $Row['md_album_id'] : '';     
                                        $row_name=isset($Row['md_album_name']) ? $Row['md_album_name'] : '';   
                                        $row_picname=isset($Row['md_album_picname']) ? $Row['md_album_picname'] : '';   
                                        $row_credate=isset($Row['md_album_credate']) ? $Row['md_album_credate'] : ''; 
                                        ?> 
                                        <li class="nav-item" role="presentation" onclick="loadgallery('<?php echo $row_id ?>');">
                                            <button class="nav-link " id="bOOKing-tab" data-bs-toggle="tab" data-bs-target="#bOOKing-tab-pane" type="button" role="tab"  
                                            aria-controls="bOOKing-tab-pane" aria-selected="true" style="color:#031f60;">  <?php echo $row_name ?> </button>
                                        </li>&nbsp;
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- breadcrumb-area-end -->

                <?php        
                    if(!isset($_REQUEST["booking_type"])){
                        $_REQUEST["booking_type"]=1;
                    }
                    $_REQUEST["locationstart"] = isset($_REQUEST["locationstart"]) ? $_REQUEST["locationstart"] : '';
                    $_REQUEST["locationend"] = isset($_REQUEST["locationend"]) ? $_REQUEST["locationend"] : '';
                    // echo "LL: ".$_SESSION["front_session_sys_language"];
                ?>
                <!-- booking-area -->
                <div class=" meu-sticky">
                    <div class="card">         
                    
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="form-label">Trip</label>
                                    <select id="booking_type" name="booking_type" class="form-select" > 
                                        <option value="1" <?php echo ($_REQUEST["booking_type"]==1)?"selected":""?>>One Way</option> 
                                        <option value="2" <?php echo ($_REQUEST["booking_type"]==2)?"selected":""?>>Round Trip</option>     
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="form-label" for="basicSelect"><?php echo $txt_mod["index:to"] ?></label> 
                                    <select class="form-select" id="locationend" name="locationend" onchange="LoadLocationStart();LoadLocationEnd();"> 
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
                            
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="form-label"><?php echo $txt_mod["index:depart"] ?></label> 
                                    <input type="text" class="form-control calendar-input hasDatepicker" id="input_pickupdate" name="input_pickupdate"  placeholder="<?php echo $txt_mod["index:depart"] ?>"  onchange="LoadLocationStart();LoadLocationEnd();" >
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-1" id="return" <?php if($_REQUEST["booking_type"]=="1"){ echo 'style="display: none;"';}?>>
                                    <label for="form-label"><?php echo $txt_mod["index:return"] ?></label>
                                    <input type="date" class="form-control" id="basicInput" placeholder="<?php echo $txt_mod["index:return"] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="form-label" for="basicSelect"><?php echo $txt_mod["index:adult"] ?></label>
                                    <select class="form-select" id="basicSelect">
                                        <option>1</option> 
                                        <option>2</option> 
                                        <option>3</option> 
                                        <option>4</option> 
                                        <option>5</option> 
                                        <option>6</option> 
                                        <option>7</option> 
                                        <option>8</option> 
                                        <option>9</option> 
                                        <option>10</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="form-label" for="basicSelect"><?php echo $txt_mod["index:child"] ?></label>
                                    <select class="form-select" id="basicSelect">
                                        <option>0</option> 
                                        <option>1</option> 
                                        <option>2</option> 
                                        <option>3</option> 
                                        <option>4</option> 
                                        <option>5</option> 
                                        <option>6</option> 
                                        <option>7</option> 
                                        <option>8</option> 
                                        <option>9</option> 
                                        <option>10</option> 
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
                <!-- booking-area-end -->
            

                <!-- features-area -->
                <section class="features-area" style="margin-top:-20px;" >
                    <div class="container">
                        <div class=" " id="gallery">
                            <?php
                                $sql_album = "SELECT * FROM md_album WHERE   md_album_status='1' order by md_album_id asc limit 1";
                                $query_album=$mysqli->query($sql_album);
                                $Row_album=$query_album->fetch_array();

                                $sql_pic = "SELECT * FROM md_albumpic WHERE   md_albumpic_albumid='".$Row_album['md_album_id']."' ";
                                $query_pic=$mysqli->query($sql_pic); 
                                while($Row_pic=$query_pic->fetch_array()){
                                    $row_id_pic=isset($Row_pic['md_albumpic_id']) ? $Row_pic['md_albumpic_id'] : '';     
                                    $row_name_pic=isset($Row_pic['md_albumpic_filename']) ? $Row_pic['md_albumpic_filename'] : ''; 
                                    ?> 
                                    
                                    <div class="row ">  
                                        <?php
                                        $sql_pic = "SELECT * FROM md_albumpic WHERE md_albumpic_albumid='".$Row_album['md_album_id']."'";
                                        $query_pic=$mysqli->query($sql_pic) or die("Error sql_pic:  <br/>$sql_pic<br />\n");
                                        while($row_pic=$query_pic->fetch_array()){
                                            ?> 
                                            <div class="col-4">
                                                <img class=" " src="uploads/gallery/<?php echo $row_pic['md_albumpic_filename'] ?>"   data-bs-toggle="modal" data-bs-target="#imagessmodal<?php echo $row_pic["md_albumpic_id"] ?>"  />
                                                <spen style="padding:2px;display: flex; justify-content: end;color: red;" > </spen>
                                            </div>  
                                            <div class="modal" id="imagessmodal<?php echo $row_pic["md_albumpic_id"] ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header"> 
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <img class=" " src="uploads/gallery/<?php echo $row_pic['md_albumpic_filename'] ?>"    />
                                                    </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>  
                            <?php } ?>
                        </div>
                    </div>
                </section>
                <!-- features-area-end -->
                <br>
            </form> 
        </main>
        <!-- main-area-end -->
        <!-- <script src="assets/js/gallery.js"></script> -->
        <script type="text/javascript" src="js/scriptboat.js"></script>
        
        <?php  include("include/include_footer.php");  ?>

        <?php  include("include/include_foot.php");  ?>

        <script> 
            const footer = document.querySelector('.footer-area');
            const meuSticky = document.querySelector('.meu-sticky');
            meuSticky.style.height = `${ footer.offsetTop - 0 }px`;
        </script>

        <style>
            .meu-sticky {
                position: absolute;
                right: 0;
                width: 480px;
                /*   background: red; */
            } 
            .meu-sticky .card {
                position: sticky;
                top: calc(33vh - 7rem);
                background: #fff;
                padding: 1.5rem;
                color: blueviolet;
                text-align: center;
                font-weight: bold;
                box-shadow: 0 0 30px rgba(0,0,0, .08);
                z-index: 0001;
                width: 92%;
                transform: translateY(-2em);
                border-radius: 1em;
            } 
        </style>

        <script>
                        
            function loadgallery(my_id) { 
                var TYPE="POST";
                var URL="gallery_action.php"; 
                var dataSet= {
                    my_id : my_id,
                    myaction : 'loadgallery'
                };
                jQuery.ajax({type:TYPE,url:URL,data:dataSet,
                    success:function(html){
                        jQuery("#gallery").show();
                        jQuery("#gallery").html(html); 
                    }
                });
            }
        </script>