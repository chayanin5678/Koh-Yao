

<?php 
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
include("../libs/session.php");
include("../manageadmin/libs/config.php");
include("../manageadmin/libs/connect.php");
include("../libs/function.php");
if($_SESSION["front_session_sys_language"]=="thai"){
	include("../libs/language_thai.php");
}else{
	include("../libs/language_eng.php");
}

if($_POST["myaction"]=="loadlocationhome"){?>
                        <option value=""><?php echo $txt_mod["booking:selectdestination"]?></option>
 						<?php 
                             $sql_locationstart = "SELECT DISTINCT(".$mod_md_timetable."_endid),".$mod_md_location."_name".$_SESSION["front_session_sys_language"]." FROM ".$mod_md_timetable.",".$mod_md_location."  WHERE ".$mod_md_timetable."_endid = ".$mod_md_location."_id AND ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_startid='".$_POST["locationstart"]."' AND ".$mod_md_timetable."_endid!='".$_POST["locationstart"]."'ORDER BY ".$mod_md_location."_name".$_SESSION["front_session_sys_language"]." ASC";
                                  $Query_locationstart=$mysqli->query($sql_locationstart) OR DIE("Error sql_locationstart: <br>$sql_locationstart<br>\n");
                                  $count_locationstart=$Query_locationstart->num_rows;
                                     while($Row_locationstart=$Query_locationstart->fetch_array()){
                                           $row_name=$Row_locationstart[$mod_md_location."_name".$_SESSION["front_session_sys_language"]];
										   $row_id=$Row_locationstart[0]; 
                                                                                                                
                                           echo '<option value="'.$row_id.'">'.$row_name.'</option>';
                                                                
                                      }//while($Row_province=$Query_province->fetch_array()){
                                 ?>	
                      
<?php }else if($_POST["myaction"]=="loadlocation"){?>
                       <option value=""><?php echo $txt_mod["booking:selectdestination"]?></option>
 						<?php 
                           	$sql_locationstart = "SELECT DISTINCT(".$mod_md_timetable."_endid),".$mod_md_location."_name".$_SESSION["front_session_sys_language"]." FROM ".$mod_md_timetable.",".$mod_md_location."  WHERE ".$mod_md_timetable."_endid = ".$mod_md_location."_id AND ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_startid='".$_POST["locationstart"]."' AND ".$mod_md_timetable."_endid!='".$_POST["locationstart"]."'ORDER BY ".$mod_md_location."_name".$_SESSION["front_session_sys_language"]." ASC";
							$Query_locationstart=$mysqli->query($sql_locationstart) OR DIE("Error sql_locationstart: <br>$sql_locationstart<br>\n");
							$count_locationstart=$Query_locationstart->num_rows;
							
								while($Row_locationstart=$Query_locationstart->fetch_array()){
									$row_name=$Row_locationstart[$mod_md_location."_name".$_SESSION["front_session_sys_language"]];
									$row_id=$Row_locationstart[0]; 
																										
									echo '<option value="'.$row_id.'">'.$row_name.'</option>';
														
								}//while($Row_province=$Query_province->fetch_array()){
						?>		
<?php }else if($_POST["myaction"]=="loadlocationstart"){?>	
  		
					<?php 
 						// Booking dates are already in dd/mm/yyyy format.
						//  echo "<br>ff: ".$_REQUEST["locationend"]." ss: ".$_POST["locationstart"];
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
											// echo "<br>day=".
											$day=date('Y-m-d H:i:s',strtotime("+1 hour"));
											// echo "<br>checkday=".
											$checkday=DateFormatInsert($_POST["input_pickupdate"])." ".$Row_company[$mod_md_company."_closetime"];
											//echo "<br>daydiff=".
                                            $daydiff=(strtotime($checkday) - strtotime($day))/  ( 60 * 60 * 24 ); 

                                            if($daydiff>0){

                                            $sql_boatstop = "SELECT * FROM ".$mod_md_boatstop." WHERE ".$mod_md_boatstop."_timetableid='".$Row_timetable[$mod_md_timetable."_id"]."' AND ".$mod_md_boatstop."_date='".DateFormatInsert($_POST["input_pickupdate"])."' AND ".$mod_md_boatstop."_status='1'";
                                            $query_boatstop=$mysqli->query($sql_boatstop) or die("Error sql_boatstop: เกิดความผิดพลาด <br>$sql_boatstop");
                                            $count_boatstop=$query_boatstop->num_rows;
                                            
                                        if($count_boatstop==0){

											$sql_detail_d = "SELECT * FROM md_timetabledetail WHERE md_timetabledetail_timetableid='".$Row_timetable[$mod_md_timetable."_id"]."'";
											$query_detail_d=$mysqli->query($sql_detail_d);
											$row_detail_d=$query_detail_d->fetch_array();
                                ?>
                               		 
									<style>
										@media only screen and (max-width: 768px) {
											/* For mobile phones: */
											.martop {
												margin-top: -25px
											}
										}
									</style>
									<div class="container"><br>
										<div class="row justify-content-center">
											<!-- <input type="hidden" id="myid" name="myid" value="<?php echo $row_id?>"> -->
											<div class="col-12">
												<div class="booking-list-item">
													<div class="booking-list-item-inner">
														<div class="booking-list-top">
															<div class="flight-airway ">
																<div class="" style="display: flex; margin-bottom: 15px;  justify-content: center;  align-items: center;">
																	<img src="<?php echo"uploads/timetable/pictures/".$Row_timetable[$mod_md_timetable."_picname"];?>" style="width:120px;"  alt="" onerror="this.onerror=null;this.src='assets/img/placeholder.png'">
																</div> 
															</div>
															<div class="flight-airway ">
																<div class="flight-logo" style="display: flex; margin-bottom: 15px;  justify-content: center;  align-items: center;">
																	<h5 class="title"><?php echo $row_startname." - ".$row_endname?></h5> 
																</div>  
															</div> 
															<div class="flight-airway ">
																<div class="flight-logo martop" style="display: flex; margin-bottom: 15px;  justify-content: center;  align-items: center;"> 
																	<span><?php echo $txt_mod["booking:seat"]?> : <?php echo $row_seat?></span>
																</div>  
															</div><br>

															<ul class="flight-info">   
																<li><?php echo $txt_mod["booking:dep"]." ".$row_departuretime;?> <span><?php echo $row_pierstart;?></span></li>
																<li class="time"><span><?php echo $txt_mod["booking:arr"]." ".$row_arrivaltime;?></span><?php echo $row_pierend;?></li>
																<li><?php echo $txt_mod["booking:traveltime"] ;?><span><?php echo $row_time;?></span></li>
															</ul>
															<div class="flight-price">
																<h4 class="title"><?php echo $txt_mod["booking:adult"]?> <span><?php echo number_format($showpriceadult)?></span> <?php echo $_SESSION["front_session_sys_currency"]?> | <?php echo $txt_mod["booking:child"]?> <span><?php echo number_format($showpricechild)?></span> <?php echo $_SESSION["front_session_sys_currency"]?></h4>
																<a href="#" class="btn" onclick="if(document.getElementById('booking_type').value==1){Loadstep2('<?php echo $row_id;?>','',document.getElementById('input_pickupdate').value,getElementById('input_returndate').value,document.getElementById('input_adult').value,document.getElementById('input_child').value,document.getElementById('input_infant').value,
																			document.getElementById('booking_type').value, '<?php echo $_REQUEST['locationstart'];?>', '<?php echo $_REQUEST['locationend'];?>');}else{Loadreturn('<?php echo $row_id;?>');}" >Select <img src="assets/img/icon/boat.png" style="width:35px;" alt=""></a>
																<!--  -->
															</div>
														</div>
														<div class="booking-list-bottom">
															<ul>
																<li class="detail"><i class="fa-solid fa-angle-down"></i> Boat Detail</li>
																<li><?php echo $txt_mod["about:priceperperson"] ?></li>
															</ul>
														</div>
													</div>
													<div class="flight-detail-wrap">
														<div class="row">
															<div class="col-4">
																<div class="flight-date" style="width:100%">
																	<ul>
																		<li><?php echo DateFormatInsert($_POST["input_pickupdate"]) ?></li>
																		<li><?php echo $txt_mod["booking:dep"]." ".$row_departuretime;?> <span><?php echo $row_time;?></span></li>
																		<li><?php echo $txt_mod["booking:arr"]." ".$row_arrivaltime;?></li>
																	</ul>
																</div>
															</div>
															<div class="col-8">
																<div class="">
																	<img src="assets/img/icon/boat.png" style="width:35px;" alt="">
																	<h6 class="title"><?php echo $row_pierstart;?></h6>
																	<div class="flight-detail-info"> 
																		<?php if($row_detail_d["md_timetabledetail_picname1"]!=''){ ?>
																			<img src="<?php echo "uploads/timetabledetail/".$row_detail_d["md_timetabledetail_picname1"];?>" alt="" style="width: 150px;">
																		<?php }else{ ?>
																			<img src="<?php echo"uploads/timetable/pictures/".$Row_timetable["md_timetable_picname"];?>" alt="" style="width: 150px;">
																		<?php } ?>
																		<?php echo $row_detail_d['md_timetabledetail_detail'.$_SESSION["front_session_sys_language"].'1'] ?>
																	</div>
																	<h6 class="title title-two"></span><?php echo $row_pierend;?></h4>
																</div>
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
									$('.flight-detail-wrap').slideUp();
									$('.detail').on('click', function () {
										$(this).toggleClass('show');
										$(this).parent().parent().parent().parent().find('.flight-detail-wrap').slideToggle();
									});
								 </script>
								 
<?php }else if($_POST["myaction"]=="Loadreturn"){?>	
  		
		<?php 
			// print_r($_REQUEST);
			// Booking dates are already in dd/mm/yyyy format.
			$return_start_id = $_POST["locationend"];
			$return_end_id = $_POST["locationstart"];
			if($_POST["myid"]!=""){
				$sql_selected_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_id='".$_POST["myid"]."' LIMIT 1";
				$Query_selected_timetable=$mysqli->query($sql_selected_timetable);
				if($Query_selected_timetable && $Query_selected_timetable->num_rows>0){
					$Row_selected_timetable=$Query_selected_timetable->fetch_array();
					$return_start_id=$Row_selected_timetable[$mod_md_timetable."_endid"];
					$return_end_id=$Row_selected_timetable[$mod_md_timetable."_startid"];
				}
			}
			//  echo "<br>ff: ".$_POST["locationend"] = DateFormadmY($_POST["locationend"]);
			if($return_start_id!="" && $_POST["input_returndate"]!=""){
	
				$sql_timetable = "SELECT * FROM ".$mod_md_timetable." INNER JOIN ".$mod_md_location." ON ".$mod_md_timetable."_endid = ".$mod_md_location."_id WHERE ".$mod_md_timetable."_status='1'";
				if($return_start_id!=""){
					$sql_timetable .= " AND ".$mod_md_timetable."_startid='".$return_start_id."'";
				}
				if($return_end_id!="" && $return_end_id!=$return_start_id){
					$sql_timetable .= " AND ".$mod_md_timetable."_endid='".$return_end_id."'";
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

					//$daydiff=(strtotime(DateFormatInsert($_POST["input_returndate"])) - strtotime(date("Y-m-d")))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
					// echo "<br>day=".
					$day=date('Y-m-d H:i:s',strtotime("+1 hour"));
					// echo "<br>checkday=".
					$checkday=DateFormatInsert($_POST["input_returndate"])." ".$Row_company[$mod_md_company."_closetime"];
					//echo "<br>daydiff=".
					$daydiff=(strtotime($checkday) - strtotime($day))/  ( 60 * 60 * 24 ); 

					if($daydiff>0){

					$sql_boatstop = "SELECT * FROM ".$mod_md_boatstop." WHERE ".$mod_md_boatstop."_timetableid='".$Row_timetable[$mod_md_timetable."_id"]."' AND ".$mod_md_boatstop."_date='".DateFormatInsert($_POST["input_returndate"])."' AND ".$mod_md_boatstop."_status='1'";
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
										<img src="<?php echo"uploads/timetable/pictures/".$Row_timetable[$mod_md_timetable."_picname"];?>" style="width:120px;"  alt="" onerror="this.onerror=null;this.src='assets/img/placeholder.png'">
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
									<a href="#" class="btn" onclick="Loadstep2('<?php echo $_REQUEST['myid'];?>','<?php echo $row_id;?>',document.getElementById('input_pickupdate').value,getElementById('input_returndate').value,document.getElementById('input_adult').value,document.getElementById('input_child').value,document.getElementById('input_infant').value,
												document.getElementById('booking_type').value,document.getElementById('locationstart').value, document.getElementById('locationend').value);" >Select <img src="assets/img/icon/boat.png" style="width:35px;" alt=""></a>
									<!--  -->
								</div>
							</div>
							<div class="booking-list-bottom">
								<ul>
									<li class="detail"><i class="fa-solid fa-angle-down"></i> Boat Detail</li>
									<li><?php echo $txt_mod["about:priceperperson"] ?></li>
								</ul>
							</div>
						</div>
						<div class="flight-detail-wrap">
							<div class="row">
								<div class="col-4">
									<div class="flight-date" style="width:100%">
										<ul>
											<li><?php echo DateFormatInsert($_POST["input_returndate"]) ?></li>
											<li><?php echo $txt_mod["booking:dep"]." ".$row_departuretime;?> <span><?php echo $row_time;?></span></li>
											<li><?php echo $txt_mod["booking:arr"]." ".$row_arrivaltime;?></li>
										</ul>
									</div>
								</div>
								<div class="col-8">
									<div class="">
										<img src="assets/img/icon/boat.png" style="width:35px;" alt="">
										<h6 class="title"><?php echo $row_pierstart;?></h6>
										<div class="flight-detail-info"> 
											<?php if($row_detail_dd["md_timetabledetail_picname1"]!=''){ ?>
												<img src="<?php echo "uploads/timetabledetail/".$row_detail_dd["md_timetabledetail_picname1"];?>" alt="" style="width: 150px;">
											<?php }else{ ?>
												<img src="<?php echo"uploads/timetable/pictures/".$Row_timetable["md_timetable_picname"];?>" alt="" style="width: 150px;">
											<?php } ?>
											<?php echo $row_detail_dd['md_timetabledetail_detail'.$_SESSION["front_session_sys_language"].'1'] ?>
										</div>
										<h6 class="title title-two"></span><?php echo $row_pierend;?></h4>
									</div>
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
		$('.flight-detail-wrap').slideUp();
		$('.detail').on('click', function () {
			$(this).toggleClass('show');
			$(this).parent().parent().parent().parent().find('.flight-detail-wrap').slideToggle();
		});
		</script>

		
<?php }else if($_POST["myaction"]=="loadlocationend"){?>
 

<?php }else if($_POST["myaction"]=="loaddepart"){
	
									$sql_locationstart = "SELECT * FROM ".$mod_md_location." WHERE ".$mod_md_location."_status='1'";
                                    if($_POST["locationstart"]!=""){
                                        $sql_locationstart .= " AND ".$mod_md_location."_id='".$_POST["locationstart"]."'";
                                    }
                                    $Query_locationstart=$mysqli->query($sql_locationstart) OR DIE("Error sql_locationstart: <br>$sql_locationstart<br>\n");
                                    $index=1;
                                    $Row_locationstart=$Query_locationstart->fetch_array();
                                    $row_locationstart_name=$Row_locationstart[$mod_md_location.'_name'.$_SESSION["front_session_sys_language"]];
									echo '<i class="fa fa-anchor" aria-hidden="true"></i> '.$txt_mod["booking:depart"].' : '.$row_locationstart_name." ";
									if($_POST["locationend"]!=""){echo $txt_mod["booking:to"]." ".getLocationName($_POST["locationend"]);}
	
?>  
<?php }else if($_POST["myaction"]=="loadreturn"){
	
									$return_start_id = $_POST["locationend"];
									$return_end_id = $_POST["locationstart"];
									if($_POST["myid"]!=""){
										$sql_selected_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_id='".$_POST["myid"]."' LIMIT 1";
										$Query_selected_timetable=$mysqli->query($sql_selected_timetable);
										if($Query_selected_timetable && $Query_selected_timetable->num_rows>0){
											$Row_selected_timetable=$Query_selected_timetable->fetch_array();
											$return_start_id=$Row_selected_timetable[$mod_md_timetable."_endid"];
											$return_end_id=$Row_selected_timetable[$mod_md_timetable."_startid"];
										}
									}
									echo '<i class="fa fa-anchor" aria-hidden="true"></i> '.$txt_mod["booking:return"].' : '.getLocationName($return_start_id)." ".$txt_mod["booking:to"]." ".getLocationName($return_end_id);
	
?>                              
<?php }else if($_POST["myaction"]=="loadbooking"){?>
									<?php
										$sql_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_id='".$_POST["myid"]."'";
                                        $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");
										$Row_timetable=$Query_timetable->fetch_array();
										$row_startname=getLocationName($Row_timetable[$mod_md_timetable."_startid"]);
                                        $row_endname=getLocationName($Row_timetable[$mod_md_timetable."_endid"]);
										$row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);
                                        $row_pierstart=getPierName($Row_timetable[$mod_md_timetable."_pierstart"]);
										$row_pierend=getPierName($Row_timetable[$mod_md_timetable."_pierend"]);
                                        $row_arrivaltime=FormatTime($Row_timetable[$mod_md_timetable."_arrivaltime"]);
                                        $row_departuretime=FormatTime($Row_timetable[$mod_md_timetable."_departuretime"]);
                                        $row_time=FormatTimeHour($Row_timetable[$mod_md_timetable."_time"]);
										$row_remark=$Row_timetable[$mod_md_timetable."_remark"];
										
										$priceadult=$Row_timetable[$mod_md_timetable."_priceadult"];
                                        $pricechild=$Row_timetable[$mod_md_timetable."_pricechild"];
										$priceinfant=$Row_timetable[$mod_md_timetable."_priceinfant"];
										
										$showtotaladult=$priceadult*$_POST["adult"];
										$showtotalchild=$pricechild*$_POST["child"];
										$showtotalinfant=$priceinfant*$_POST["infant"];
										
										$showtotaladult=getExchange($showtotaladult,$_SESSION["front_session_sys_currency"]);
                                        $showtotalchild=getExchange($showtotalchild,$_SESSION["front_session_sys_currency"]);
										$showtotalinfant=getExchange($showtotalinfant,$_SESSION["front_session_sys_currency"]);
										
										$showtotal=$showtotaladult+$showtotalchild+$showtotalinfant;
										 
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
											  $showpriceadult=getExchange($showpriceadult,$_SESSION["front_session_sys_currency"]);
                                              $showpricechild=getExchange($showpricechild,$_SESSION["front_session_sys_currency"]);
											  $showpriceinfant=getExchange($showpriceinfant,$_SESSION["front_session_sys_currency"]);
                                          }
										  
										$totaladult=$showpriceadult*$_POST["adult"];
										$totalchild=$showpricechild*$_POST["child"];
										$totalinfant=$showpriceinfant*$_POST["infant"];

										$total=$totaladult+$totalchild+$totalinfant;
										//$ratetax=getPaypalTax($total,$Row_timetable[$mod_md_timetable."_id"]);
										
										$discount=$showtotal-$total;
										
										$total=$total+$ratetax;
										
										$pickupdate = substr(DateFormatInsert($_POST['pickupdate']),0,10);
										$date=dateLang($pickupdate);
									?>	
									<input type="hidden" id="boattime" name="boattime" value="<?php echo $_POST["myid"];?>" />
									<li style="background-color:#26bdf7;color:#fff">
                                        <div align="center">
                                           	<label><i class="fa fa-anchor" aria-hidden="true"></i> <?php echo $row_startname." ".$txt_mod["booking:to"]." ".$row_endname;?></label>
                                        </div>
                                    </li>
                                    <li style="padding-top:15px;">
                                           	<label style="padding-left:15px;"> <?php echo $txt_mod["booking:depart"]?></label>
                                    </li>
                                    <li style="padding-top:0px;">
                                           	<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"><?php echo $txt_mod["booking:typeseat"]?> : <?php echo $row_seat;?></label>
                                    </li>
                                    <li style="padding-top:0px;">
                                           	<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $date.", ".ShowDateLang($pickupdate);?></label>
                                    </li>
                                    <li style="padding-top:0px;">
                                           	<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:adult"]." : ".$_POST["adult"];if($_POST["child"]!="0"){echo " ".$txt_mod["booking:child"]." : ".$_POST["child"];}if($_POST["infant"]!="0"){echo " ".$txt_mod["booking:infant"]." : ".$_POST["infant"];}?></label>
                                    </li>
                                    <li style="padding-top:0px;">
                                           	<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:dep"]." ".$row_departuretime." ".$txt_mod["booking:arr"]." ".$row_arrivaltime;?></label>
                                    </li>
                                    <li style="background-color:#dddddd;">
                                           	<label style="padding-left:15px;"><?php echo $_POST["adult"]?> <?php echo $txt_mod["booking:adult"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($showtotaladult,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                    </li>
                                    <?php if($_POST["child"]!="0"){?>
                                   <li style="background-color:#e5e5e5;">
                                           	<label style="padding-left:15px;"><?php echo $_POST["child"]?> <?php echo $txt_mod["booking:child"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($showtotalchild,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                    </li> 
                                    <?php }?>
                                    <?php if($_POST["infant"]!="0"){?>
                                   <li style="background-color:#e5e5e5;">
                                           	<label style="padding-left:15px;"><?php echo $_POST["infant"]?> <?php echo $txt_mod["booking:infant"]?> </label><label style="float:right;padding-right:15px"><?php if($showpriceinfant==0){ echo $txt_mod["booking:free"];}else{ echo number_format($showtotalinfant,2)." ".$_SESSION["front_session_sys_currency"];}?></label>
                                    </li> 
                                    <?php }?>   
                                    <!--<div id="totaldepart">
                                    <li style="background-color:#77cbfd;color:#fff">
                                         <label style="padding-left:15px">Service/Tax : </label> <label style="float:right;padding-right:15px"><?php echo number_format($ratetax,2);?> THB</label>
                                    </li>
                                    <li style="background-color:#26bdf7;color:#fff">
                                         <label style="padding-left:15px">Total : </label><label style="float:right;padding-right:15px"><?php echo number_format($total,2);?> THB</label>
                                    </li>
                                    </div>-->
<?php }else if($_POST["myaction"]=="loadbookingreturn"){?>
<?php
										$sql_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_id='".$_POST["myid"]."'";
                                        $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");
										$Row_timetable=$Query_timetable->fetch_array();
										$row_startname=getLocationName($Row_timetable[$mod_md_timetable."_startid"]);
                                        $row_endname=getLocationName($Row_timetable[$mod_md_timetable."_endid"]);
										$row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);
                                        $row_pierstart=getPierName($Row_timetable[$mod_md_timetable."_pierstart"]);
										$row_pierend=getPierName($Row_timetable[$mod_md_timetable."_pierend"]);
                                        $row_arrivaltime=FormatTime($Row_timetable[$mod_md_timetable."_arrivaltime"]);
                                        $row_departuretime=FormatTime($Row_timetable[$mod_md_timetable."_departuretime"]);
                                        $row_time=FormatTimeHour($Row_timetable[$mod_md_timetable."_time"]);
										$row_remark=$Row_timetable[$mod_md_timetable."_remark"];
										
										$priceadult=$Row_timetable[$mod_md_timetable."_priceadult"];
                                        $pricechild=$Row_timetable[$mod_md_timetable."_pricechild"];
										$priceinfant=$Row_timetable[$mod_md_timetable."_priceinfant"];
										
										$showtotaladult=$priceadult*$_POST["adult"];
										$showtotalchild=$pricechild*$_POST["child"];
										$showtotalinfant=$priceinfant*$_POST["infant"];
										
										$showtotaladult=getExchange($showtotaladult,$_SESSION["front_session_sys_currency"]);
                                        $showtotalchild=getExchange($showtotalchild,$_SESSION["front_session_sys_currency"]);
										$showtotalinfant=getExchange($showtotalinfant,$_SESSION["front_session_sys_currency"]);
										
										$showtotal=$showtotaladult+$showtotalchild+$showtotalinfant;
										 
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
											  $showpriceadult=getExchange($showpriceadult,$_SESSION["front_session_sys_currency"]);
                                              $showpricechild=getExchange($showpricechild,$_SESSION["front_session_sys_currency"]);
											  $showpriceinfant=getExchange($showpriceinfant,$_SESSION["front_session_sys_currency"]);
                                          }
										  
										$totaladult=$showpriceadult*$_POST["adult"];
										$totalchild=$showpricechild*$_POST["child"];
										$totalinfant=$showpriceinfant*$_POST["infant"];

										$total=$totaladult+$totalchild+$totalinfant;
										
										
										
										$pickupdate = substr(DateFormatInsert($_POST['returndate']),0,10);
										$date=dateLang($pickupdate);
?>	
									<input type="hidden" id="boattimereturn" name="boattimereturn" value="<?php echo $_POST["myid"];?>" />
									<li style="background-color:#26bdf7;color:#fff">
                                        <div align="center">
                                           	<label><i class="fa fa-anchor" aria-hidden="true"></i> <?php echo $row_startname." ".$txt_mod["booking:to"]." ".$row_endname;?></label>
                                        </div>
                                    </li>
                                    <li style="padding-top:15px;">
                                           	<label style="padding-left:15px;"> <?php echo $txt_mod["booking:return"]?></label>
                                    </li>
                                    <li style="padding-top:0px;">
                                           	<label style="padding-left:15px;font-weight:400;margin-bottom:0px;""><?php echo $txt_mod["booking:typeseat"]?> : <?php echo $row_seat;?></label>
                                    </li>
                                    <li style="padding-top:0px;">
                                           	<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $date.", ".ShowDateLang($pickupdate);?></label>
                                    </li>
                                    <li style="padding-top:0px;">
                                           	<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:adult"]." : ".$_POST["adult"];if($_POST["child"]!="0"){echo " ".$txt_mod["booking:child"]." : ".$_POST["child"];}if($_POST["infant"]!="0"){echo " ".$txt_mod["booking:infant"]." : ".$_POST["infant"];}?></label>
                                    </li>
                                    <li style="padding-top:0px;">
                                           	<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:dep"]." ".$row_departuretime." ".$txt_mod["booking:arr"]." ".$row_arrivaltime;?></label>
                                    </li>
                                    <li style="background-color:#dddddd;">
                                           	<label style="padding-left:15px;"><?php echo $_POST["adult"]." ".$txt_mod["booking:adult"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($showtotaladult,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                    </li>
                                    <?php if($_POST["child"]!="0"){?>
                                   <li style="background-color:#e5e5e5;">
                                           	<label style="padding-left:15px;"><?php echo $_POST["child"]." ".$txt_mod["booking:child"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($showtotalchild,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                    </li>
                                    <?php }?> 
                                    <?php if($_POST["infant"]!="0"){?>
                                   <li style="background-color:#e5e5e5;">
                                           	<label style="padding-left:15px;"><?php echo $_POST["infant"]?> <?php echo $txt_mod["booking:infant"]?> </label><label style="float:right;padding-right:15px"><?php if($showpriceinfant==0){ echo $txt_mod["booking:free"];}else{ echo number_format($showtotalinfant,2)." ".$_SESSION["front_session_sys_currency"];}?></label>
                                    </li> 
                                    <?php }?>  
                                      
 <?php }else if($_POST["myaction"]=="loadbookingtotal"){?>
<?php
										$sql_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_id='".$_POST["boattime"]."'";
                                        $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");
										$Row_timetable=$Query_timetable->fetch_array();
										$priceadult=$Row_timetable[$mod_md_timetable."_priceadult"];
										$pricechild=$Row_timetable[$mod_md_timetable."_pricechild"];
										$priceinfant=$Row_timetable[$mod_md_timetable."_priceinfant"];
										
										
										$showtotaladult=$priceadult*$_POST["input_adult"];
										$showtotalchild=$pricechild*$_POST["input_child"];
										$showtotalinfant=$priceinfant*$_POST["input_infant"];
										
										$showtotaladult=getExchange($showtotaladult,$_SESSION["front_session_sys_currency"]);
                                        $showtotalchild=getExchange($showtotalchild,$_SESSION["front_session_sys_currency"]);
										$showtotalinfant=getExchange($showtotalinfant,$_SESSION["front_session_sys_currency"]);
										//echo "showtotal1=".
										$showtotal1=$showtotaladult+$showtotalchild+$showtotalinfant;
										
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
											  $showpriceadult=getExchange($showpriceadult,$_SESSION["front_session_sys_currency"]);
                                              $showpricechild=getExchange($showpricechild,$_SESSION["front_session_sys_currency"]);
											  $showpriceinfant=getExchange($showpriceinfant,$_SESSION["front_session_sys_currency"]);
                                          }
										  
										$totaladult=$showpriceadult*$_POST["input_adult"];
										$totalchild=$showpricechild*$_POST["input_child"];
										$totalinfant=$showpriceinfant*$_POST["input_infant"];

										//echo "total1=".
										$total_1=$totaladult+$totalchild+$totalinfant;
										$total1=$totaladult+$totalchild+$totalinfant;
										//$ratetax1=getPaypalTax($total1,$Row_timetable[$mod_md_timetable."_id"]);
										$total1=$total1+$ratetax1;
										
										if($_POST["boattimereturn"]!=""){
										$sql_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_id='".$_POST["boattimereturn"]."'";
                                        $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");
										$Row_timetable=$Query_timetable->fetch_array();
										
										$priceadult=$Row_timetable[$mod_md_timetable."_priceadult"];
										$pricechild=$Row_timetable[$mod_md_timetable."_pricechild"];
										$priceinfant=$Row_timetable[$mod_md_timetable."_priceinfant"];
										
										
										$showtotaladult=$priceadult*$_POST["input_adult"];
										$showtotalchild=$pricechild*$_POST["input_child"];
										$showtotalinfant=$priceinfant*$_POST["input_infant"];
										
										$showtotaladult=getExchange($showtotaladult,$_SESSION["front_session_sys_currency"]);
                                        $showtotalchild=getExchange($showtotalchild,$_SESSION["front_session_sys_currency"]);
										$showtotalinfant=getExchange($showtotalinfant,$_SESSION["front_session_sys_currency"]);
										//echo "showtotal2=".
										$showtotal2=$showtotaladult+$showtotalchild+$showtotalinfant;
										
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
											  $showpriceadult=getExchange($showpriceadult,$_SESSION["front_session_sys_currency"]);
                                              $showpricechild=getExchange($showpricechild,$_SESSION["front_session_sys_currency"]);
											  $showpriceinfant=getExchange($showpriceinfant,$_SESSION["front_session_sys_currency"]);
                                          }
										  
										$totaladult=$showpriceadult*$_POST["input_adult"];
										$totalchild=$showpricechild*$_POST["input_child"];
										$totalinfant=$showpriceinfant*$_POST["input_infant"];
										
										//echo "total2=".
										$total_2=$totaladult+$totalchild+$totalinfant;
										$total2=$totaladult+$totalchild+$totalinfant;
										//$ratetax2=getPaypalTax($total2,$Row_timetable[$mod_md_timetable."_id"]);
										$total2=$total2+$ratetax2;
										
										}
                                        
										$total=$total_1+$total_2;
										//echo "showtotal=".
										$showtotal=$showtotal1+$showtotal2;
										
										$discount=$showtotal-$total;
										
										$ratetax=$ratetax1+$ratetax2;
										
										$total=$total1+$total2;
										
										$pickupdate = substr(DateFormatInsert($_POST['pickupdate']),0,10);
										$date=dateLang($pickupdate);
?>	
									<li style="background-color:#77cbfd;color:#fff">
                                         <label style="padding-left:15px"><?php echo $txt_mod["booking:subtotal"]?> </label> <label style="float:right;padding-right:15px"><?php echo number_format($showtotal,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                    </li>
                                    <?php if($discount>0){?>
                                    <li style="background-color:#ff3d54;color:#fff;">
                                           	<label style="padding-left:15px;"><?php echo $txt_mod["booking:discount"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($discount,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                    </li>
                                    <?php }?>
                                    <!--<li style="background-color:#41c6f9;color:#fff">
                                         <label style="padding-left:15px"><?php echo $txt_mod["booking:sevicetax"]?> </label> <label style="float:right;padding-right:15px"><?php echo number_format($ratetax,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                    </li>-->
                                    <!--<li style="background-color:#77cbfd;color:#fff">
                                         <label style="padding-left:15px">Insurance : </label> <label style="float:right;padding-right:15px">Free</label>
                                    </li>-->
                                    <li style="background-color:#26bdf7;color:#fff">
                                         <label style="padding-left:15px"><?php echo $txt_mod["booking:total"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($total,2);?> <?php echo $_SESSION["front_session_sys_currency"]?></label>
                                    </li>
                                   
<?php }else if($_POST["myaction"]=="clearboat"){?>                                   
 									<ul class="widget-ul" id="loadbooking" style="background-color:#fafafa;">
                                        <li>
                                            <div align="center">
                                                <label><i class="fa fa-plus-circle" aria-hidden="true" style="font-size:50px; color: #26bdf7;"></i></label>
                                            </div>
                                            <input type="hidden" id="boattime" name="boattime" value="" />
                                        </li>
                                    </ul>
                                    <ul class="widget-ul" id="loadbookingreturn" style="background-color:#fafafa;display:none;">
                                        <input type="hidden" id="boattimereturn" name="boattimereturn" value="" />
                                    </ul>
                                    <ul class="widget-ul" id="loadbookingtotal" style="background-color:#fafafa;display:none;">
                                    </ul>
                                    <!--<div class="form-submit col-md-12" align="center" style="padding-top: 10px;display:none;" id="btcheckout">
                                            <button type="button" class="awe-btn awe-btn-1 awe-btn-small" onclick="checkout();" id="focus">BOOK NOW</button>
                                    </div>-->
                                    <div class="col-md-12" align="center" style="padding-top: 10px;">
                                            <img src="images/paypal.png" alt="Credit Card Badges" style="height: 28px;">
                                    </div> 
<?php }else if($_POST["myaction"]=="loadtransfer"){?> 
<!-- End Search Result -->
                                <div class="widget-sidebar start-rating-sidebar">
                                        <ul class="widget-ul" style="background-color:#fafafa;">
                                        <?php
                                             $sql_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_id='".$_POST["boattime"]."'";
                                            $Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");
                                            $Row_timetable=$Query_timetable->fetch_array();
                                            $row_startname=getLocationName($Row_timetable[$mod_md_timetable."_startid"]);
                                            $row_endname=getLocationName($Row_timetable[$mod_md_timetable."_endid"]);
                                            $row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);
                                            $row_pierstart=getPierName($Row_timetable[$mod_md_timetable."_pierstart"]);
                                            $row_pierend=getPierName($Row_timetable[$mod_md_timetable."_pierend"]);
                                            $row_arrivaltime=FormatTime($Row_timetable[$mod_md_timetable."_arrivaltime"]);
                                            $row_departuretime=FormatTime($Row_timetable[$mod_md_timetable."_departuretime"]);
                                            $row_time=FormatTimeHour($Row_timetable[$mod_md_timetable."_time"]);
                                            $row_remark=$Row_timetable[$mod_md_timetable."_remark"];
                                            
                                            $priceadult=$Row_timetable[$mod_md_timetable."_priceadult"];
                                            $pricechild=$Row_timetable[$mod_md_timetable."_pricechild"];
											$priceinfant=$Row_timetable[$mod_md_timetable."_priceinfant"];
                                            
                                            $showtotaladult=$priceadult*$_POST["input_adult"];
                                            $showtotalchild=$pricechild*$_POST["input_child"];
											$showtotalinfant=$priceinfant*$_POST["input_infant"];
                                            
                                            $showtotaladult=getExchange($showtotaladult,$_SESSION["front_session_sys_currency"]);
                                            $showtotalchild=getExchange($showtotalchild,$_SESSION["front_session_sys_currency"]);
											$showtotalinfant=getExchange($showtotalinfant,$_SESSION["front_session_sys_currency"]);
                                            
											$showtotal1=$showtotaladult+$showtotalchild+$showtotalinfant;
                                            
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
                                                  $showpriceadult=getExchange($showpriceadult,$_SESSION["front_session_sys_currency"]);
                                                  $showpricechild=getExchange($showpricechild,$_SESSION["front_session_sys_currency"]);
												  $showpriceinfant=getExchange($showpriceinfant,$_SESSION["front_session_sys_currency"]);
                                              }
                                              
                                            $totaladult=$showpriceadult*$_POST["input_adult"];
                                            $totalchild=$showpricechild*$_POST["input_child"];
											$totalinfant=$showpriceinfant*$_POST["input_infant"];
                                            
                                            $pickupdate = substr(DateFormatInsert($_POST['input_pickupdate']),0,10);
                                            $date=dateLang($pickupdate);
											$totalpassenger=$_POST["input_adult"]+$_POST["input_child"];
    ?>	
                                        <li style="background-color:#26bdf7;color:#fff">
                                            <div align="center">
                                                <label><i class="fa fa-anchor" aria-hidden="true"></i> <?php echo $row_startname." ".$txt_mod["booking:to"]." ".$row_endname;?></label>
                                            </div>
                                        </li>
                                        <li style="padding-top:15px;">
                                                <label style="padding-left:15px;"> <?php echo $txt_mod["booking:depart"]?></label>
                                        </li>
                                        <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;""><?php echo $txt_mod["booking:typeseat"]?> : <?php echo $row_seat;?></label>
                                        </li>
                                        <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $date.", ".ShowDateLang($pickupdate);?></label>
                                        </li>
                                        <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:adult"]." : ".$_POST["input_adult"];if($_POST["input_child"]!="0"){echo " ".$txt_mod["booking:child"]." : ".$_POST["input_child"];}if($_POST["input_infant"]!="0"){echo " ".$txt_mod["booking:infant"]." : ".$_POST["input_infant"];}?></label>
                                        </li>
                                        <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:dep"]." ".$row_departuretime." ".$txt_mod["booking:arr"]." ".$row_arrivaltime;?></label>
                                        </li>
                                        <?php if($_POST["input_pickup1"]==1 && $_POST["input_pickuppoint1"]!="" && $_POST["input_carpickup1"]!=""){
											$sql_pickup = "SELECT *  FROM ".$mod_md_pickup." WHERE ".$mod_md_pickup."_transferid='".$_POST["input_pickuppoint1"]."' AND ".$mod_md_pickup."_cartypeid='".$_POST["input_carpickup1"]."' AND ".$mod_md_pickup."_pierid='".$Row_timetable[$mod_md_timetable."_pierstart"]."'";
											$query_pickup=$mysqli->query($sql_pickup);
											$Row_pickup=$query_pickup->fetch_array();
											$row_name=getTransferName($Row_pickup[$mod_md_pickup."_transferid"]);
											$row_pricepickup=$Row_pickup[$mod_md_pickup."_price"];
											
											$timecar =duration($Row_pickup[$mod_md_pickup."_time"],$row_departuretime);
											if($row_pricepickup>0){
												if($_POST["input_carpickup1"]==3){
													$totalpickup1=$row_pricepickup*$totalpassenger;
													$totalpickup1=getExchange($totalpickup1,$_SESSION["front_session_sys_currency"]);
												}else{
													$totalpickup1=$row_pricepickup;
													$totalpickup1=getExchange($totalpickup1,$_SESSION["front_session_sys_currency"]);
												}
											}
											?>
                                        	<li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:transport"]." : ".getCarType($_POST["input_carpickup1"]);?></label>
                                        	</li>
                                            <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:pickup"]." : ".$row_name;?></label>
                                        	</li>
                                            <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:pickuptime"]." : ".$timecar;?></label>
                                        	</li>
                                            
                                        <?php }//if($_POST["input_pickup1"]==1){?>
                                        <?php if($_POST["input_dropoff1"]==1 && $_POST["input_dropoffpoint1"]!="" && $_POST["input_cardropoff1"]!=""){
											$sql_dropoff = "SELECT *  FROM ".$mod_md_dropoff." WHERE ".$mod_md_dropoff."_transferid='".$_POST["input_dropoffpoint1"]."' AND ".$mod_md_dropoff."_cartypeid='".$_POST["input_cardropoff1"]."' AND ".$mod_md_dropoff."_pierid='".$Row_timetable[$mod_md_timetable."_pierend"]."'";
											$query_dropoff=$mysqli->query($sql_dropoff);
											$Row_dropoff=$query_dropoff->fetch_array();
											$row_name=getTransferName($Row_dropoff[$mod_md_dropoff."_transferid"]);
											$row_pricedropoff=$Row_dropoff[$mod_md_dropoff."_price"];
											if($row_pricedropoff>0){
												if($_POST["input_cardropoff1"]==3){
													$totaldropoff1=$row_pricedropoff*$totalpassenger;
													$totaldropoff1=getExchange($totaldropoff1,$_SESSION["front_session_sys_currency"]);
												}else{
													$totaldropoff1=$row_pricedropoff;
													$totaldropoff1=getExchange($totaldropoff1,$_SESSION["front_session_sys_currency"]);
												}
											}
											?>
                                        	<li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:transport"]." : ".getCarType($_POST["input_cardropoff1"]);?></label>
                                        	</li>
                                            <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:dropoff"]." : ".$row_name;?></label>
                                        	</li>
                                        <?php }//if($_POST["input_dropoff1"]==1){
											$totaltransfer1=$totalpickup1+$totaldropoff1;
											if($totaltransfer1>0){
												$transfer=number_format($totaltransfer1,2)." ".$_SESSION["front_session_sys_currency"];
											}else{
												$transfer=$txt_mod["booking:free"];
											}
										if($_POST["input_pickuppoint1"]!="" || $_POST["input_dropoffpoint1"]!=""){?>
                                        	<li style="background-color:#dddddd; margin-bottom:2px;">
                                                <label style="padding-left:15px;"><?php echo $txt_mod["booking:transfer"]?> </label><label style="float:right;padding-right:15px"><?php echo $transfer;?></label>
                                        	</li>
                                         <?php }?>
                                        <li style="background-color:#dddddd;">
                                                <label style="padding-left:15px;"><?php echo $_POST["input_adult"]." ".$txt_mod["booking:adult"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($showtotaladult,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                        </li>
                                        <?php if($_POST["input_child"]!="0"){?>
                                       <li style="background-color:#e5e5e5;">
                                                <label style="padding-left:15px;"><?php echo $_POST["input_child"]." ".$txt_mod["booking:child"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($showtotalchild,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                        </li> 
                                        <?php }?>
                                        <?php if($_POST["input_infant"]!="0"){?>
										   <li style="background-color:#dddddd;">
													<label style="padding-left:15px;"><?php echo $_POST["input_infant"]." ".$txt_mod["booking:infant"]?> </label><label style="float:right;padding-right:15px"><?php if($showpriceinfant==0){ echo $txt_mod["booking:free"];}else{ echo number_format($showtotalinfant,2)." ".$_SESSION["front_session_sys_currency"];}?></label>
											</li>
											<?php }?> 
                                        </ul>
                                        
                                        <?php 
											$total_1=$totaladult+$totalchild+$totalinfant+$totaltransfer1;
											$total1=$totaladult+$totalchild+$totalinfant+$totaltransfer1;
											//$ratetax1=getPaypalTax($total1,$Row_timetable[$mod_md_timetable."_id"]);
											$total1=$total1+$ratetax1;
											
										if($_POST['booking_type']==2){?>
                                        <ul class="widget-ul" style="background-color:#fafafa;">
                                            <?php
												$sql_timetable = "SELECT * FROM ".$mod_md_timetable." WHERE ".$mod_md_timetable."_status='1' AND ".$mod_md_timetable."_id='".$_POST["boattimereturn"]."'";
												$Query_timetable=$mysqli->query($sql_timetable) OR DIE("Error sql_timetable: <br>$sql_timetable<br>\n");
												$Row_timetable=$Query_timetable->fetch_array();
												$row_startname=getLocationName($Row_timetable[$mod_md_timetable."_startid"]);
												$row_endname=getLocationName($Row_timetable[$mod_md_timetable."_endid"]);
												$row_seat=getSeatName($Row_timetable[$mod_md_timetable."_seatid"]);
												$row_pierstart=getPierName($Row_timetable[$mod_md_timetable."_pierstart"]);
												$row_pierend=getPierName($Row_timetable[$mod_md_timetable."_pierend"]);
												$row_arrivaltime=FormatTime($Row_timetable[$mod_md_timetable."_arrivaltime"]);
												$row_departuretime=FormatTime($Row_timetable[$mod_md_timetable."_departuretime"]);
												$row_time=FormatTimeHour($Row_timetable[$mod_md_timetable."_time"]);
												$row_remark=$Row_timetable[$mod_md_timetable."_remark"];
												
												$priceadult=$Row_timetable[$mod_md_timetable."_priceadult"];
												$pricechild=$Row_timetable[$mod_md_timetable."_pricechild"];
												$priceinfant=$Row_timetable[$mod_md_timetable."_priceinfant"];
												
												$showtotaladult=$priceadult*$_POST["input_adult"];
												$showtotalchild=$pricechild*$_POST["input_child"];
												$showtotalinfant=$priceinfant*$_POST["input_infant"];
												
												$showtotaladult=getExchange($showtotaladult,$_SESSION["front_session_sys_currency"]);
												$showtotalchild=getExchange($showtotalchild,$_SESSION["front_session_sys_currency"]);
												$showtotalinfant=getExchange($showtotalinfant,$_SESSION["front_session_sys_currency"]);
												
												$showtotal2=$showtotaladult+$showtotalchild+$showtotalinfant;
												
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
													  $showpriceadult=getExchange($showpriceadult,$_SESSION["front_session_sys_currency"]);
													  $showpricechild=getExchange($showpricechild,$_SESSION["front_session_sys_currency"]);
													  $showpriceinfant=getExchange($showpriceinfant,$_SESSION["front_session_sys_currency"]);
												  }
												  
												$totaladult=$showpriceadult*$_POST["input_adult"];
												$totalchild=$showpricechild*$_POST["input_child"];
												$totalinfant=$showpriceinfant*$_POST["input_infant"];
												
												$returndate = substr(DateFormatInsert($_POST['input_returndate']),0,10);
												$date=dateLang($returndate);
												$totalpassenger=$_POST["input_adult"]+$_POST["input_child"];
		?>	

											<li style="background-color:#26bdf7;color:#fff">
												<div align="center">
													<label><i class="fa fa-anchor" aria-hidden="true"></i> <?php echo $row_startname." ".$txt_mod["booking:to"]." ".$row_endname;?></label>
												</div>
											</li>
											<li style="padding-top:15px;">
													<label style="padding-left:15px;"> <?php echo $txt_mod["booking:return"]?></label>
											</li>
											<li style="padding-top:0px;">
													<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"><?php echo $txt_mod["booking:typeseat"]?> : <?php echo $row_seat;?></label>
											</li>
											<li style="padding-top:0px;">
													<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $date.", ".ShowDateLang($returndate);?></label>
											</li>
											<li style="padding-top:0px;">
													<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:adult"]." : ".$_POST["input_adult"];if($_POST["input_child"]!="0"){echo " ".$txt_mod["booking:child"]." : ".$_POST["input_child"];}if($_POST["input_infant"]!="0"){echo " ".$txt_mod["booking:infant"]." : ".$_POST["input_infant"];}?></label>
											</li>
											<li style="padding-top:0px;">
													<label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:dep"]." ".$row_departuretime." ".$txt_mod["booking:arr"]." ".$row_arrivaltime;?></label>
											</li>
                                            <?php if($_POST["input_pickup2"]==1 && $_POST["input_pickuppoint2"]!="" && $_POST["input_carpickup2"]!=""){
											$sql_pickup = "SELECT *  FROM ".$mod_md_pickup." WHERE ".$mod_md_pickup."_transferid='".$_POST["input_pickuppoint2"]."' AND ".$mod_md_pickup."_cartypeid='".$_POST["input_carpickup2"]."' AND ".$mod_md_pickup."_pierid='".$Row_timetable[$mod_md_timetable."_pierstart"]."'";
											$query_pickup=$mysqli->query($sql_pickup);
											$Row_pickup=$query_pickup->fetch_array();
											$row_name=getTransferName($Row_pickup[$mod_md_pickup."_transferid"]);
											$row_pricepickup=$Row_pickup[$mod_md_pickup."_price"];
											$timecar =duration($Row_pickup[$mod_md_pickup."_time"],$row_departuretime);
											if($row_pricepickup>0){
												if($_POST["input_carpickup2"]==3){
													$totalpickup2=$row_pricepickup*$totalpassenger;
													$totalpickup2=getExchange($totalpickup2,$_SESSION["front_session_sys_currency"]);
												}else{
													$totalpickup2=$row_pricepickup;
													$totalpickup2=getExchange($totalpickup2,$_SESSION["front_session_sys_currency"]);
												}
											}
											?>
                                        	<li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:transport"]." : ".getCarType($_POST["input_carpickup2"]);?></label>
                                        	</li>
                                            <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:pickup"]." : ".$row_name;?></label>
                                        	</li>
                                            <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:pickuptime"]." : ".$timecar;?></label>
                                        	</li>
                                        <?php }//if($_POST["input_pickup2"]==2){?>
                                        <?php if($_POST["input_dropoff2"]==1 && $_POST["input_dropoffpoint2"]!="" && $_POST["input_cardropoff2"]!=""){
											$sql_dropoff = "SELECT *  FROM ".$mod_md_dropoff." WHERE ".$mod_md_dropoff."_transferid='".$_POST["input_dropoffpoint2"]."' AND ".$mod_md_dropoff."_cartypeid='".$_POST["input_cardropoff2"]."'  AND ".$mod_md_dropoff."_pierid='".$Row_timetable[$mod_md_timetable."_pierend"]."'";
											$query_dropoff=$mysqli->query($sql_dropoff);
											$Row_dropoff=$query_dropoff->fetch_array();
											$row_name=getTransferName($Row_dropoff[$mod_md_dropoff."_transferid"]);
											$row_pricedropoff=$Row_dropoff[$mod_md_dropoff."_price"];
											if($row_pricedropoff>0){
												if($_POST["input_cardropoff2"]==3){
													$totaldropoff2=$row_pricedropoff*$totalpassenger;
													$totaldropoff2=getExchange($totaldropoff2,$_SESSION["front_session_sys_currency"]);
												}else{
													$totaldropoff2=$row_pricedropoff;
													$totaldropoff2=getExchange($totaldropoff2,$_SESSION["front_session_sys_currency"]);
												}
											}
											?>
                                        	<li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:transport"]." : ".getCarType($_POST["input_cardropoff2"]);?></label>
                                        	</li>
                                            <li style="padding-top:0px;">
                                                <label style="padding-left:15px;font-weight:400;margin-bottom:0px;"> <?php echo $txt_mod["booking:dropoff"]." : ".$row_name;?></label>
                                        	</li>
                                        <?php }//if($_POST["input_dropoff1"]==2){
											$totaltransfer2=$totalpickup2+$totaldropoff2;
											if($totaltransfer2>0){
												$transfer=number_format($totaltransfer2,2)." ".$_SESSION["front_session_sys_currency"];
											}else{
												$transfer=$txt_mod["booking:free"];
											}
										?>
                                        	<?php if($_POST["input_pickuppoint2"]!="" || $_POST["input_dropoffpoint2"]!=""){?>
                                        	<li style="background-color:#dddddd; margin-bottom:2px;">
                                                <label style="padding-left:15px;"><?php echo $txt_mod["booking:transfer"];?> </label><label style="float:right;padding-right:15px"><?php echo $transfer;?></label>
                                        	</li>
                                            <?php }?>
											<li style="background-color:#dddddd;">
													<label style="padding-left:15px;"><?php echo $_POST["input_adult"]." ".$txt_mod["booking:adult"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($showtotaladult,2)." ".$_SESSION["front_session_sys_currency"];?></label>
											</li>
											<?php if($_POST["input_child"]!="0"){?>
										   <li style="background-color:#e5e5e5;">
													<label style="padding-left:15px;"><?php echo $_POST["input_child"]." ".$txt_mod["booking:child"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($showtotalchild,2)." ".$_SESSION["front_session_sys_currency"];?></label>
											</li>
											<?php }?> 
                                            <?php if($_POST["input_infant"]!="0"){?>
										   <li style="background-color:#dddddd;">
													<label style="padding-left:15px;"><?php echo $_POST["input_infant"]." ".$txt_mod["booking:infant"]?> </label><label style="float:right;padding-right:15px"><?php if($showpriceinfant==0){ echo $txt_mod["booking:free"];}else{ echo number_format($showtotalinfant,2)." ".$_SESSION["front_session_sys_currency"];}?></label>
											</li>
											<?php }?>  
                                        </ul>
                                        <?php 
											
											$total_2=$totaladult+$totalchild+$totalinfant+$totaltransfer2;
											$total2=$totaladult+$totalchild+$totalinfant+$totaltransfer2;
											//$ratetax2=getPaypalTax($total2,$Row_timetable[$mod_md_timetable."_id"]);
											$total2=$total2+$ratetax2;
										
										}//if($_POST['booking_type']==2){
											$total=$total_1+$total_2;
												
											$showtotal=$showtotal1+$showtotal2+$totaltransfer1+$totaltransfer2;
												
											$discount=$showtotal-$total;
											
											$ratetax=$ratetax1+$ratetax2;
											
											$total=$total1+$total2;
										?>
                                        
                                        <ul class="widget-ul" style="background-color:#fafafa;">
                                        	<li style="background-color:#77cbfd;color:#fff">
                                                 <label style="padding-left:15px"><?php echo $txt_mod["booking:subtotal"]?> </label> <label style="float:right;padding-right:15px"><?php echo number_format($showtotal,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                            </li>
                                           
                                            <?php if($discount>0){?>
                                            <li style="background-color:#ff3d54;color:#fff;">
                                                    <label style="padding-left:15px;"><?php echo $txt_mod["booking:discount"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($discount,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                            </li>
                                            <?php }?>
                                            <!--<li style="background-color:#77cbfd;color:#fff">
                                                 <label style="padding-left:15px">Insurance : </label> <label style="float:right;padding-right:15px">Free</label>
                                            </li>-->
                                             <!--<li style="background-color:#41c6f9;color:#fff">
                                             <label style="padding-left:15px"><?php echo $txt_mod["booking:sevicetax"]?> </label> <label style="float:right;padding-right:15px"><?php echo number_format($ratetax,2)." ".$_SESSION["front_session_sys_currency"];?></label>
                                            </li>-->
                                            <li style="background-color:#26bdf7;color:#fff">
                                                 <label style="padding-left:15px"><?php echo $txt_mod["booking:total"]?> </label><label style="float:right;padding-right:15px"><?php echo number_format($total,2);?> <?php echo $_SESSION["front_session_sys_currency"]?></label>
                                            </li>
                                        </ul>

                                        <div class="col-md-12" align="center" style="padding-top: 10px;">
                                                <img src="images/paypal.png" alt="Credit Card Badges" style="height: 28px;">
                                        </div>
                                </div>                
<?php }else if($_POST["myaction"]=="loadlocationtransfer"){?> 
<?php 					if($_POST["carid"]!=''){
						$teble=$_POST["teble"];
						$sql = "SELECT DISTINCT(".$teble."_transferid),".$mod_md_transfer."_name".$_SESSION["front_session_sys_language"]." FROM ".$teble.",".$mod_md_transfer." WHERE ".$teble."_status='1' AND ".$teble."_pierid='".$_POST["pierid"]."' AND ".$teble."_cartypeid='".$_POST["carid"]."' AND ".$mod_md_transfer."_id = ".$teble."_transferid ORDER BY ".$mod_md_transfer."_name".$_SESSION["front_session_sys_language"]." ASC ";
						$query=$mysqli->query($sql);
						?>
                         <option value=""><?php echo $txt_mod["booking:pleaseselect"];?></option>

                        <?php while($Row=$query->fetch_array()){ 
							$row_name=getTransferName($Row[$teble."_transferid"]);
							$row_id=$Row[0];
						?>
						<option value="<?php echo $Row[$teble."_transferid"]?>"><?php echo $row_name?></option>
                        <?php }//while($Row=$Query->fetch_array()){
						}
						?>	
<?php }else if($_POST["myaction"]=="loadairportpoint"){
		$sql = "SELECT * FROM ".$mod_md_transfer." WHERE ".$mod_md_transfer."_id='".$_POST["transferid"]."'";
		$query=$mysqli->query($sql);
		$Row=$query->fetch_array();
		if($Row[$mod_md_transfer."_airport"]!=0){
	?> 
		<div class="form-field col-md-6 col-xs-12">
             <label><?php echo $txt_mod["booking:filghtnumber"]?> :</label>
             <input class="form-control" type="text" id="input_filghtnumberpickup<?php echo $_POST["typeround"]?>" name="input_filghtnumberpickup<?php echo $_POST["typeround"]?>">
        </div>
        <div class="form-field col-md-6 col-xs-12">
        	<label><?php echo $txt_mod["booking:arrivetime"]?> :</label>
        	<select class="form-select" name="input_arrivetimeHH<?php echo $_POST["typeround"]?>" id="input_arrivetimeHH<?php echo $_POST["typeround"]?>">
            	<option value=""><?php echo $txt_mod["booking:mm"]?></option>
              <?php for($HH=0;$HH<=23;$HH++){?>
                <option value="<?php echo sprintf("%02d",$HH)?>"><?php echo sprintf("%02d",$HH)?></option>                       
              <?php }?>
            </select>
		</div>
        <div class="form-field col-md-6 col-xs-12">
        	<label>&nbsp;</label>
        	<select class="form-select"  name="input_arrivetimeMM<?php echo $_POST["typeround"]?>" id="input_arrivetimeMM<?php echo $_POST["typeround"]?>">
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
         	<input type="hidden" id="input_pickupairport<?php echo $_POST["typeround"]?>" name="input_pickupairport<?php echo $_POST["typeround"]?>" value="1">
         <?php }else{?>
         	<input type="hidden" id="input_pickupairport<?php echo $_POST["typeround"]?>" name="input_pickupairport<?php echo $_POST["typeround"]?>" value="">
        <?php }?>
<?php }else if($_POST["myaction"]=="loadtimetabledetail"){
		
		$sql_detail = "SELECT * FROM ".$mod_md_timetabledetail." WHERE ".$mod_md_timetabledetail."_timetableid='".$_POST["timetableid"]."'";
		$query_detail=$mysqli->query($sql_detail);
		$count_totalrecord=$query_detail->num_rows;
		$Row_detail=$query_detail->fetch_array();
?>
		<a href="javascript:void(0)" id="myBtn1"></a>
        <?php if($count_totalrecord>0){?>
        <div id="myModal1" class="modal" style="padding-top:75px;background-color: rgba(0,0,0,0.50);">
    
              <!-- Modal content -->
    
            <div class="modal-content-detail">
            
                <a class="close" id="close" style="display: inline;">x</a>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                  <tr style="background-color:#ebebeb;">
                  	<td>        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr>
                            <td width="25%" align="left">
                            <img src="<?php echo"uploads/timetabledetail/pictures/".$Row_detail[$mod_md_timetabledetail."_picname1"];?>" alt="" /></td>
                            <td align="left">
                                <?php 
								if($_SESSION["front_session_sys_language"]=="thai"){
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detailthai1"]);
								}else{
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detaileng1"]);
								}
								?>
                               
                            </td>
                            </tr>
                        	</tbody>
                        </table>
                    </td>
                  </tr>
                </tbody>
                </table>
                <?php if($Row_detail[$mod_md_timetabledetail."_detailthai2"]!=""){?> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                  <tbody>
                  <tr style="background-color:#ebebeb;">
                  	<td>        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr>
                            <td width="25%" align="left">
                            <img src="<?php echo"uploads/timetabledetail/pictures/".$Row_detail[$mod_md_timetabledetail."_picname2"];?>" alt="" /></td>
                            <td align="left">
                                <?php 
								if($_SESSION["front_session_sys_language"]=="thai"){
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detailthai2"]);
								}else{
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detaileng2"]);
								}
								?>
                            </td>
                            </tr>
                        	</tbody>
                        </table>
                    </td>
                  </tr>
                </tbody>
                </table>
                <?php }?>
                <?php if($Row_detail[$mod_md_timetabledetail."_detailthai3"]!=""){?> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                  <tbody>
                  <tr style="background-color:#ebebeb;">
                  	<td>        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr>
                            <td width="25%" align="left">
                            <img src="<?php echo"uploads/timetabledetail/pictures/".$Row_detail[$mod_md_timetabledetail."_picname3"];?>" alt="" /></td>
                            <td align="left">
                                <?php 
								if($_SESSION["front_session_sys_language"]=="thai"){
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detailthai3"]);
								}else{
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detaileng3"]);
								}
								?>
                            </td>
                            </tr>
                        	</tbody>
                        </table>
                    </td>
                  </tr>
                </tbody>
                </table>
                <?php }?>
                <?php if($Row_detail[$mod_md_timetabledetail."_detailthai4"]!=""){?> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                  <tbody>
                  <tr style="background-color:#ebebeb;">
                  	<td>        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr>
                            <td width="25%" align="left">
                            <img src="<?php echo"uploads/timetabledetail/pictures/".$Row_detail[$mod_md_timetabledetail."_picname4"];?>" alt="" /></td>
                            <td align="left">
                                <?php 
								if($_SESSION["front_session_sys_language"]=="thai"){
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detailthai4"]);
								}else{
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detaileng4"]);
								}
								?>
                            </td>
                            </tr>
                        	</tbody>
                        </table>
                    </td>
                  </tr>
                </tbody>
                </table>
                <?php }?>
                <?php if($Row_detail[$mod_md_timetabledetail."_detailthai5"]!=""){?> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                  <tbody>
                  <tr style="background-color:#ebebeb;">
                  	<td>        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr>
                            <td width="25%" align="left">
                            <img src="<?php echo"uploads/timetabledetail/pictures/".$Row_detail[$mod_md_timetabledetail."_picname5"];?>" alt="" /></td>
                            <td align="left">
                                <?php 
								if($_SESSION["front_session_sys_language"]=="thai"){
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detailthai5"]);
								}else{
									echo rechangeQuot($Row_detail[$mod_md_timetabledetail."_detaileng5"]);
								}
								?>
                            </td>
                            </tr>
                        	</tbody>
                        </table>
                    </td>
                  </tr>
                </tbody>
                </table>
                <?php }?>
            </div>
            
        </div>
        <script>
		// Get the modal
		var modal1 = document.getElementById('myModal1');
		
		// Get the button that opens the modal
		var btn1 = document.getElementById("myBtn1");
		
		// Get the <span> element that closes the modal
		var span1 = document.getElementById("close");
		
		// When the user clicks the button, open the modal
		btn1.onclick = function() {
			modal1.style.display = "block";
		}
		
		// When the user clicks on <span> (x), close the modal
		span1.onclick = function() {
			modal1.style.display = "none";
		}
		
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal1) {
				modal1.style.display = "none";
			}
		}
	</script>        
        <?php }?>
<?php }else if($_POST["myaction"]=="loadstatus"){
	$sql_day = "SELECT * FROM ".$mod_md_boatstop." WHERE ".$mod_md_boatstop."_timetableid='".$_POST["timetableid"]."' AND ".$mod_md_boatstop."_date='".$_POST["datestop"]."'";
$query_day=$mysqli->query($sql_day);
$count_totalrecordday=$query_day->num_rows;
$insertupdate=explode("-",$_POST["datestop"]);
if($count_totalrecordday==0){
					 
					 
					 unset($insert);
					 $insert[$mod_md_boatstop."_timetableid"] = "'".$_POST["timetableid"]."'";
					 $insert[$mod_md_boatstop."_day"] = "'".changeQuot($insertupdate[2])."'";
					 $insert[$mod_md_boatstop."_month"] = "'".changeQuot($insertupdate[1])."'";
					 $insert[$mod_md_boatstop."_year"] = "'".changeQuot($insertupdate[0])."'";

					 $insert[$mod_md_boatstop."_date"] = "'".$_POST["datestop"]."'";
					 
					 //$insert[$mod_md_boatstop."_crebyid"] = "'".$_SESSION["core_session_sys_id"]."'";
					 $insert[$mod_md_boatstop."_credate"] = "NOW()";
					 $insert[$mod_md_boatstop."_status"] = "'1'";
					 //$insert[$mod_md_boatstop."_updatebyid"] = "'".$_SESSION["core_session_sys_id"]."'";
					 $insert[$mod_md_boatstop."_updatedate"] = "NOW()";

			//echo	"<br/>sql_insert=".
					$sql_insert="REPLACE ".$mod_md_boatstop."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
					$Query_insert=$mysqli->query($sql_insert) OR DIE("Error sql_insert: <br>$sql_insert<br>\n");
	?>				
    <button type="button" class="btn bg-red btn-block btn-lg waves-effect" style="width : 90%;" onclick="loadstatus(<?php echo $_POST["timetableid"]?>,'<?php echo $_POST["datestop"]?>','<?php echo $_POST["datestop"]?>')"><?php echo $insertupdate[2]?></button>
<?php }else{
		$sql_delete="DELETE FROM ".$mod_md_boatstop." WHERE ".$mod_md_boatstop."_timetableid='".$_POST["timetableid"]."' AND ".$mod_md_boatstop."_date='".$_POST["datestop"]."'";
		$Query_delete=$mysqli->query($sql_delete)OR DIE("Error sql_delete: <br>$sql_delete<br>\n");
	?>
  <button type="button" class="btn bg-green btn-block btn-lg waves-effect" style="width : 90%;" onclick="loadstatus(<?php echo $_POST["timetableid"]?>,'<?php echo $_POST["datestop"]?>','<?php echo $_POST["datestop"]?>')"><?php echo $insertupdate[2]?></button>
<?php
}
 }?> 
 

 