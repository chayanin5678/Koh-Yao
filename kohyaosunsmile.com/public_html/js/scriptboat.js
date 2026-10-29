function parseBoatDate(value) {
    var parts = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/.exec(value);
    if (!parts) return null;
    var date = new Date(+parts[3], +parts[2] - 1, +parts[1]);
    return date.getFullYear() === +parts[3] && date.getMonth() === +parts[2] - 1 && date.getDate() === +parts[1] ? date : null;
}

function checkNumber(){
	if (event.keyCode < 48 || event.keyCode > 57){
		event.returnValue = false;
	}
}
function isBlank(myObj) {
		if(myObj.value=='') { return true; }
		return false;
}
function isEmail(str) {
	//alert(str);
  var supported = 0;
  if (window.RegExp) {
    var tempStr = "a";
    var tempReg = new RegExp(tempStr);
    if (tempReg.test(tempStr)) supported = 1;
  }
 //alert(str + '1');
  if (!supported) 
  return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
  var r1 = new RegExp("(@.*@)|(\\.\\.)|(@\\.)|(^\\.)");
  var r2 = new RegExp("^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,3}|[0-9]{1,3})(\\]?)$");
  return (!r1.test(str) && r2.test(str));
}

function bookingtype(id) {
	//alert(id);
	var returnDateEl = document.getElementById("input_returndate");
	if(id==1){
		jQuery("#return").hide();
		jQuery("#returntopname").hide();
		if(returnDateEl){
			returnDateEl.value='';
			returnDateEl.removeAttribute("required");
		}
		jQuery("#loadlocationstart").show();
		jQuery("#loadlocationend").hide();
		jQuery("#classstart").addClass("current");
		jQuery("#classend").removeClass();
	}else{
		jQuery("#return").show();
		if(returnDateEl){
			returnDateEl.setAttribute("required","required");
		}
	}
}
function bookingtype1(id) {
	//alert(id);
	jQuery("#preloader").show();
	if(id==1){
		jQuery("#return").hide();
		jQuery("#returntopname").hide();
		document.getElementById("input_returndate").value='';
		jQuery("#loadlocationstart").show();
		jQuery("#loadlocationend").hide();
		jQuery("#classstart").addClass("current");
		jQuery("#classend").removeClass();
		//ปิดขากลับ
		document.getElementById("boattimereturn").value='';
		jQuery("#loadbookingreturn").hide();
		jQuery("#loadbookingtotal").hide();
		jQuery("#totaldepart").show();
		if(document.getElementById("boattime").value!=""){
			LoadLocationStart();
			LoadLocationEnd();
			LoadBooking(document.getElementById('boattime').value,document.getElementById('input_pickupdate').value,document.getElementById('input_returndate').value,document.getElementById('input_adult').value,document.getElementById('input_child').value,'loadbooking');
		}
	}else{
		jQuery("#loadlocationend").show();
		jQuery("#classend").addClass("current");
		if(document.getElementById("locationstart").value!='' || document.getElementById("locationend").value!=''){
			if(document.getElementById("boattime").value!=""){
				LoadLocationEnd();
			}
		}
		jQuery("#return").hide();
	}
	jQuery("#preloader").show();
}
function LoadLoation(number) {
	//alert(number);
	if(number==1){
		jQuery("#loadlocationstart").show();
		jQuery("#loadlocationend").hide();
		jQuery("#classstart").addClass("current");
		jQuery("#classend").removeClass();
	}else{
		jQuery("#loadlocationstart").hide();
		jQuery("#loadlocationend").show();
		jQuery("#classstart").removeClass();
		jQuery("#classend").addClass("current");
	}
}
function Timetabledetail(timetableid) {
	
	var TYPE="POST";
	var URL="libs/loadbooking.php";
	var dataSet={
	timetableid: timetableid,
	myaction : "loadtimetabledetail"
	};

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#loadtimetabledetail").html(html);
			jQuery("#myBtn1").click();
			
			
		}
	});
}
//Booking
function LoadLocationHome() {

	jQuery("#preloader").show();

	var TYPE="POST";
	var URL="libs/loadbooking.php";
	jQuery('#myaction').val('loadlocationhome');
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#locationend").html(html);
			jQuery("#locationend").show();
			jQuery("#preloader").hide();
			
		}
	});
}
function LoadLocation() {
	
	jQuery("#preloader").show();

	var TYPE="POST";
	var URL="libs/loadbooking.php";
	jQuery('#myaction').val('loadlocation');
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			console.log(html);
			jQuery("#locationend").html(html);
			jQuery("#locationend").show();
			jQuery("#preloader").hide();
			
		}
	});
}
function LoadLocationStart(sessionLang) {
	
	jQuery("#preloader").show();

	// ตรวจสอบวันเลือกใน input_pickupdate
    var selectedDate = parseBoatDate($('#input_pickupdate').val());
    if (!selectedDate) {
        jQuery("#preloader").hide();
        return;
    }
    var today = new Date();

    // ตั้งค่าตัวแปรให้วันที่ในรูปแบบที่สามารถใช้การเปรียบเทียบได้
    today.setHours(0, 0, 0, 0);  // ตั้งเวลาให้เป็นเวลา 00:00 เพื่อเปรียบเทียบวันที่เท่านั้น

    // เปรียบเทียบวันที่
    if (selectedDate < today) {
        // ถ้าวันที่เลือกน้อยกว่าวันปัจจุบัน ให้แจ้งเตือน
        if (sessionLang === 'thai') {
			Swal.fire({
				icon: 'error',
				title: 'วันที่ไม่ถูกต้อง',
				text: 'กรุณาเลือกวันที่ใหม่ วันที่ไม่สามารถเป็นวันที่ย้อนหลังได้',
				confirmButtonText: 'ตกลง'
			});
		} else if (sessionLang === 'eng') {
			Swal.fire({
				icon: 'error',
				title: 'Invalid Date',
				text: 'Please choose a valid date. You cannot select a past date.',
				confirmButtonText: 'OK'
			});
		} else {
			Swal.fire({
				icon: 'error',
				title: 'Invalid Date',
				text: 'Please choose a valid date. You cannot select a past date.',
				confirmButtonText: 'OK'
			});
		}
        // รีเซ็ตค่าใน input_pickupdate
        $('#input_pickupdate').val('');
        jQuery("#preloader").hide();  // ซ่อน preloader
        return;  // หยุดการทำงานของฟังก์ชันถ้าวันที่ไม่ถูกต้อง
    }

	var TYPE="POST";
	var URL="libs/loadbooking.php";
	$('#myaction').val('loadlocationstart');
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#loadlocationstart").html(html);
			//jQuery("#loadlocationstart").show();
			LoadDepart($('#locationstart').val(),'classstart');
			jQuery("#preloader").hide();
			
		}
	});
}

function Loadreturn(myid) {
	// console.log(myid);
	jQuery("#preloader").show();

	var TYPE="POST";
	var URL="libs/loadbooking.php";
	$('#myaction').val('Loadreturn');
	$('#myid').val(myid);
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#loadlocationstart").html(html);
			//jQuery("#loadlocationstart").show();
			LoadDepart($('#locationstart').val(),'classstart');
			jQuery("#preloader").hide();
			
		}
	});
}
function LoadLocationEnd() {
	
	jQuery("#preloader").show();

	var TYPE="POST";
	var URL="libs/loadbooking.php";
	$('#myaction').val('loadlocationend');
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#loadlocationend").html(html);
			//jQuery("#loadlocationend").show();
			jQuery("#preloader").hide();
			if(document.getElementById("booking_type").value==1){ 
				bookingtype(document.getElementById("booking_type").value);
				// jQuery("#returntopname").hide();
			}else{
				bookingtype(document.getElementById("booking_type").value);
				LoadReturn();
				// jQuery("#returntopname").show();
			}
		}
	});
}

function LoadDepart() {
	
	//jQuery("#preloader").show();

	var TYPE="POST";
	var URL="libs/loadbooking.php";
	$('#myaction').val('loaddepart');
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#classstart").html(html);
			jQuery("#classstart").show();
			jQuery("#preloader").hide();
			
		}
	});
}
function LoadReturn() {
	
	//jQuery("#preloader").show();

	var TYPE="POST";
	var URL="libs/loadbooking.php";
	$('#myaction').val('loadreturn');
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#classend").html(html);
			jQuery("#classend").show();
			jQuery("#preloader").hide();
			
		}
	});
}
function LoadBooking(myid,pickupdate,returndate,adult,child,infant,div) {
		//alert("adult="+adult+"child="+child);
		if(isBlank(locationstart)) { 
			$("#locationstart").css({'border-color' : '#FF0000'});
			$("#locationstart").css({'color' : '#FF0000'});
			$('#locationstart').focus();return false;
		}else{
			$("#locationstart").css({'border-color' : '#E8E8E8'});
			$("#locationstart").css({'color' : '#000'});
		}	
		if(isBlank(locationend)) { 
			$("#locationend").css({'border-color' : '#FF0000'});
			$("#locationend").css({'color' : '#FF0000'});
			$('#locationend').focus();return false;
		}else{
			$("#locationend").css({'border-color' : '#E8E8E8'});
			$("#locationend").css({'color' : '#000'});
		}
		if(isBlank(input_pickupdate)) { 
			$("#input_pickupdate").css({'border-color' : '#FF0000'});
			$("#input_pickupdate").css({'color' : '#FF0000'});
			$('#input_pickupdate').focus();return false;
		}else{
			$("#input_pickupdate").css({'border-color' : '#E8E8E8'});
			$("#input_pickupdate").css({'color' : '#000'});
		}	
		if(document.getElementById("booking_type").value==2){
			if(isBlank(input_returndate)) { 
				$("#input_returndate").css({'border-color' : '#FF0000'});
				$("#input_returndate").css({'color' : '#FF0000'});
				$('#input_returndate').focus();return false;
			}else{
				$("#input_returndate").css({'border-color' : '#E8E8E8'});
				$("#input_returndate").css({'color' : '#000'});
			}
		}
		
	var TYPE="POST";
	var URL="libs/loadbooking.php";
	var dataSet={
	myid: myid,
	pickupdate : pickupdate ,
	returndate : returndate ,
	adult : adult ,
	child : child ,
	infant : infant ,
	div : div ,
	myaction : "loadbooking"
	};

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){
			jQuery("#btcheckout").show();
			jQuery("#"+div+"").html(html);
			
			LoadBookingTotal();
			//$('#focus').focus();
		}
	});
}

function Loadstep2(myid,returnid,pickupdate,returndate,adult,child,infant,booking_type,locationstart,locationend) {
	function safeParam(value) {
		if (value === undefined || value === null || value === "undefined") {
			return "";
		}
		return value;
	}

	var locationStartValue = safeParam(locationstart);
	var locationEndValue = safeParam(locationend);
	if (locationStartValue === "" && document.getElementById("locationstart")) {
		locationStartValue = safeParam(document.getElementById("locationstart").value);
	}
	if (locationEndValue === "" && document.getElementById("locationend")) {
		locationEndValue = safeParam(document.getElementById("locationend").value);
	}

	var bookingTypeValue = safeParam(booking_type);
	if (bookingTypeValue !== "1" && bookingTypeValue !== "2" && document.getElementById("booking_type")) {
		bookingTypeValue = safeParam(document.getElementById("booking_type").value);
	}

	if (bookingTypeValue === "2" && safeParam(returnid) === "") {
		if (document.getElementById("language") && document.getElementById("language").value === "thai") {
			alert("กรุณาเลือกเที่ยวเรือขากลับ");
		} else {
			alert("Please select a return trip");
		}
		return false;
	}

	var params = [
		"myid=" + encodeURIComponent(safeParam(myid)),
		"boattimereturn=" + encodeURIComponent(safeParam(returnid)),
		"input_pickupdate=" + encodeURIComponent(safeParam(pickupdate)),
		"input_returndate=" + encodeURIComponent(safeParam(returndate)),
		"input_adult=" + encodeURIComponent(safeParam(adult)),
		"input_child=" + encodeURIComponent(safeParam(child)),
		"input_infant=" + encodeURIComponent(safeParam(infant)),
		"booking_type=" + encodeURIComponent(bookingTypeValue),
		"locationstart=" + encodeURIComponent(locationStartValue),
		"locationend=" + encodeURIComponent(locationEndValue)
	];

	window.location.href = "booking-details.php?" + params.join("&");
}


function Loadstep3() {
	var needapick = document.getElementById('input_pickup1').checked;
	if(needapick==true){
		if(isBlank(input_carpickup1)) { 
			$("#input_carpickup1").css({'border-color' : '#FF0000'});
			$("#input_carpickup1").css({'color' : '#FF0000'});
			$('#input_carpickup1').focus();return false;
		}else{
			$("#input_carpickup1").css({'border-color' : '#E8E8E8'});
			$("#input_carpickup1").css({'color' : '#000'});
		}	
		if(isBlank(input_pickuppoint1)) { 
			$("#input_pickuppoint1").css({'border-color' : '#FF0000'});
			$("#input_pickuppoint1").css({'color' : '#FF0000'});
			$('#input_pickuppoint1').focus();return false;
		}else{
			$("#input_pickuppoint1").css({'border-color' : '#E8E8E8'});
			$("#input_pickuppoint1").css({'color' : '#000'});
		}	
		if(isBlank(input_hotelpickup1)) { 
			$("#input_hotelpickup1").css({'border-color' : '#FF0000'});
			$("#input_hotelpickup1").css({'color' : '#FF0000'});
			$('#input_hotelpickup1').focus();return false;
		}else{
			$("#input_hotelpickup1").css({'border-color' : '#E8E8E8'});
			$("#input_hotelpickup1").css({'color' : '#000'});
		}	
	}
	

	jQuery("#preloader").hide();
	var TYPE="POST";  
	var formData = new FormData(document.getElementById("myForm"));  
	var TYPE="POST";
	var URL="booking-details-step3.php"; 
	var dataSet= formData;  //$("#myForm").serialize();
	// console.log(dataSet);
	jQuery.ajax({type:TYPE,url:URL,data:dataSet,contentType: false,cache: false,processData: false,
		success:function(html){ 
			jQuery("#loadstep").show();
			jQuery("#loadstep").html(html);
			
			
		}
	});
	// window.location.href = "booking-details-step3.php?myid="+myid+"&input_pickupdate="+pickupdate+"&input_returndate="+returndate+"&input_adult="+adult+"&input_child="+child+"&input_infant=0&booking_type="+booking_type+"&locationstart="+locationstart+"&locationend="+locationend;
}

function LoadBookingReturn(myid,pickupdate,returndate,adult,child,infant,div) {
	
	if(isBlank(locationstart)) { 
			$("#locationstart").css({'border-color' : '#FF0000'});
			$("#locationstart").css({'color' : '#FF0000'});
			$('#locationstart').focus();return false;
		}else{
			$("#locationstart").css({'border-color' : '#E8E8E8'});
			$("#locationstart").css({'color' : '#000'});
		}	
		if(isBlank(locationend)) { 
			$("#locationend").css({'border-color' : '#FF0000'});
			$("#locationend").css({'color' : '#FF0000'});
			$('#locationend').focus();return false;
		}else{
			$("#locationend1").css({'border-color' : '#E8E8E8'});
			$("#locationend1").css({'color' : '#000'});
		}
		if(isBlank(input_pickupdate)) { 
			$("#input_pickupdate").css({'border-color' : '#FF0000'});
			$("#input_pickupdate").css({'color' : '#FF0000'});
			$('#input_pickupdate').focus();return false;
		}else{
			$("#input_pickupdate").css({'border-color' : '#E8E8E8'});
			$("#input_pickupdate").css({'color' : '#000'});
		}	
		if(document.getElementById("booking_type").value==2){
			if(isBlank(input_returndate)) { 
				$("#input_returndate").css({'border-color' : '#FF0000'});
				$("#input_returndate").css({'color' : '#FF0000'});
				$('#input_returndate').focus();return false;
			}else{
				$("#input_returndate").css({'border-color' : '#E8E8E8'});
				$("#input_returndate").css({'color' : '#000'});
			}
		}
	var TYPE="POST";
	var URL="libs/loadbooking.php";
	var dataSet={
	myid: myid,
	pickupdate : pickupdate ,
	returndate : returndate ,
	adult : adult ,
	child : child ,
	infant : infant ,
	div : div ,
	myaction : "loadbookingreturn"
	};

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){
			jQuery("#totaldepart").hide();
			jQuery("#"+div+"").show();
			jQuery("#"+div+"").html(html);
			LoadBookingTotal();
			//$('#focus').focus();
		}
	});
}
function LoadBookingTotal() {
	if(document.getElementById("boattime").value!=""){
		var TYPE="POST";
		var URL="libs/loadbooking.php";
		$('#myaction').val('loadbookingtotal');
		var dataSet= jQuery("#myForm").serialize();
	
		jQuery.ajax({type:TYPE,url:URL,data:dataSet,
			success:function(html){
				jQuery("#loadbookingtotal").show()
				jQuery("#loadbookingtotal").html(html)
				
			}
		});
	}
}

function ClearBoat() {

	var TYPE="POST";
	var URL="libs/loadbooking.php";
	$('#myaction').val('clearboat');
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){
			jQuery("#clearboat").show()
			jQuery("#clearboat").html(html)
			
		}
	});
}

function Paging_CountChecked(txtCheckBoxFirstName,intTotalItems) {
		var intChecked = 0;
		if(intTotalItems>0)
			for(i=0;i<=intTotalItems;i++)
				if(document.getElementById(txtCheckBoxFirstName+i).checked) 
					intChecked ++;
		return intChecked ;
}

function LoadBookingPerson(start,end,pickupdate,returndate,adult,child,infant) {
	if(Paging_CountChecked('input_boat',document.myForm.TotalCheckBoxID.value)>=0) {		
		LoadBooking(start,pickupdate,returndate,adult,child,infant,'loadbooking');
		if(end!=""){
			LoadBookingReturn(end,pickupdate,returndate,adult,child,infant,'loadbookingreturn');
		}
	}

}

function checkbooking() {

	with(document.myForm) {
		if(isBlank(locationstart)) { 
			$("#locationstart").css({'border-color' : '#FF0000'});
			$("#locationstart").css({'color' : '#FF0000'});
			$('#locationstart').focus();return false;
		}else{
			$("#locationstart").css({'border-color' : '#E8E8E8'});
			$("#locationstart").css({'color' : '#000'});
		}	
		if(isBlank(locationend)) { 
			$("#locationend").css({'border-color' : '#FF0000'});
			$("#locationend").css({'color' : '#FF0000'});
			$('#locationend').focus();return false;
		}else{
			$("#locationend").css({'border-color' : '#E8E8E8'});
			$("#locationend").css({'color' : '#000'});
		}
		if(isBlank(input_pickupdate)) { 
			$("#input_pickupdate").css({'border-color' : '#FF0000'});
			$("#input_pickupdate").css({'color' : '#FF0000'});
			$('#input_pickupdate').focus();return false;
		}else{
			$("#input_pickupdate").css({'border-color' : '#E8E8E8'});
			$("#input_pickupdate").css({'color' : '#000'});
		}	
		if(document.getElementById("radio-6").checked==true){
			if(isBlank(input_returndate)) { 
				$("#input_returndate").css({'border-color' : '#FF0000'});
				$("#input_returndate").css({'color' : '#FF0000'});
				$('#input_returndate').focus();return false;
			}else{
				$("#input_returndate").css({'border-color' : '#E8E8E8'});
				$("#input_returndate").css({'color' : '#000'});
			}
		}
	}
	document.getElementById("myForm").submit();
}
function nextstep2() {

	with(document.myForm) {
		if(isBlank(locationstart)) { 
			$("#locationstart").css({'border-color' : '#FF0000'});
			$("#locationstart").css({'color' : '#FF0000'});
			$('#locationstart').focus();return false;
		}else{
			$("#locationstart1").css({'border-color' : '#E8E8E8'});
			$("#locationstart1").css({'color' : '#000'});
		}	
		if(isBlank(locationend)) { 
			$("#locationend").css({'border-color' : '#FF0000'});
			$("#locationend").css({'color' : '#FF0000'});
			$('#locationend').focus();return false;
		}else{
			$("#locationend").css({'border-color' : '#E8E8E8'});
			$("#locationend").css({'color' : '#000'});
		}
		if(isBlank(input_pickupdate)) { 
			$("#input_pickupdate").css({'border-color' : '#FF0000'});
			$("#input_pickupdate").css({'color' : '#FF0000'});
			$('#input_pickupdate').focus();return false;
		}else{
			$("#input_pickupdate").css({'border-color' : '#E8E8E8'});
			$("#input_pickupdate").css({'color' : '#000'});
		}	
		if(isBlank(boattime)) { 
				if(document.getElementById("language").value=="thai") { 
					alert("กรุณาเลือกเที่ยวเรือของท่าน");
				}else{
					alert("Your booking is incomplete, please continue with your reservation process");
				}
				return false;
			}
		if(document.getElementById("booking_type").value==2){
			if(isBlank(boattimereturn)) { 
				if(document.getElementById("language").value=="thai") { 
					alert("กรุณาเลือกเที่ยวเรือของท่าน");
				}else{
					alert("Your booking is incomplete, please reserve both your departure and return trips");
				}
				return false;
			}
		}
	}
	var TYPE="POST";
	var URL="step2.php";
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#Step1").hide();
			jQuery("#Step2").show();
			jQuery("#Step2").html(html);
			jQuery("#preloader").hide();
			
		}
	});
}
function nextstep3() {

	with(document.myForm) {
		
			if(document.getElementById("input_pickup1").checked==true) { 
				if(isBlank(input_carpickup1)) { 
					$("#input_carpickup1").css({'border-color' : '#FF0000'});
					$("#input_carpickup1").css({'color' : '#FF0000'});
					$('#input_carpickup1').focus();return false;
				}else{
					$("#input_carpickup1").css({'border-color' : '#e8e8e8 '});
					$("#input_carpickup1").css({'color' : '#000'});
				}
				if(isBlank(input_pickuppoint1)) { 
					$("#input_pickuppoint1").css({'border-color' : '#FF0000'});
					$("#input_pickuppoint1").css({'color' : '#FF0000'});
					$('#input_pickuppoint1').focus();return false;
				}else{
					$("#input_pickuppoint1").css({'border-color' : '#e8e8e8 '});
					$("#input_pickuppoint1").css({'color' : '#000'});
				}
				if(isBlank(input_hotelpickup1)) { 
					$("#input_hotelpickup1").css({'border-color' : '#FF0000'});
					$("#input_hotelpickup1").css({'color' : '#FF0000'});
					$('#input_hotelpickup1').focus();return false;
				}else{
					$("#input_hotelpickup1").css({'border-color' : '#e8e8e8 '});
					$("#input_hotelpickup1").css({'color' : '#000'});
				}	
				
				if(document.getElementById("input_pickupairport1").value==1) {
					if(isBlank(input_filghtnumberpickup1)) { 
						$("#input_filghtnumberpickup1").css({'border-color' : '#FF0000'});
						$("#input_filghtnumberpickup1").css({'color' : '#FF0000'});
						$('#input_filghtnumberpickup1').focus();return false;
					}else{
						$("#input_filghtnumberpickup1").css({'border-color' : '#e8e8e8 '});
						$("#input_filghtnumberpickup1").css({'color' : '#000'});
					}
					if(isBlank(input_arrivetimeHH1)) { 
						$("#input_arrivetimeHH1").css({'border-color' : '#FF0000'});
						$("#input_arrivetimeHH1").css({'color' : '#FF0000'});
						$('#input_arrivetimeHH1').focus();return false;
					}else{
						$("#input_arrivetimeHH1").css({'border-color' : '#e8e8e8 '});
						$("#input_arrivetimeHH1").css({'color' : '#000'});
					}
					if(isBlank(input_arrivetimeMM1)) { 
						$("#input_arrivetimeMM1").css({'border-color' : '#FF0000'});
						$("#input_arrivetimeMM1").css({'color' : '#FF0000'});
						$('#input_arrivetimeMM1').focus();return false;
					}else{
						$("#input_arrivetimeMM1").css({'border-color' : '#e8e8e8 '});
						$("#input_arrivetimeMM1").css({'color' : '#000'});
					}
				}//if(document.getElementById("input_pickupairport1").value==1) { 
				
			}//if(document.getElementById("input_pickup1").checked==true) { 
			
			
			if(document.getElementById("input_pickupairport").value==1) {//เช็คว่าคือสนามบินรึป่าว
				if(isBlank(input_filghtnumberpickup)) { 
					$("#input_filghtnumberpickup").css({'border-color' : '#FF0000'});
					$("#input_filghtnumberpickup").css({'color' : '#FF0000'});
					$('#input_filghtnumberpickup').focus();return false;
				}else{
					$("#input_filghtnumberpickup").css({'border-color' : '#e8e8e8 '});
					$("#input_filghtnumberpickup").css({'color' : '#000'});
				}
				if(isBlank(input_arrivetimeHH)) { 
					$("#input_arrivetimeHH").css({'border-color' : '#FF0000'});
					$("#input_arrivetimeHH").css({'color' : '#FF0000'});
					$('#input_arrivetimeHH').focus();return false;
				}else{
					$("#input_arrivetimeHH").css({'border-color' : '#e8e8e8 '});
					$("#input_arrivetimeHH").css({'color' : '#000'});
				}
				if(isBlank(input_arrivetimeMM)) { 
					$("#input_arrivetimeMM").css({'border-color' : '#FF0000'});
					$("#input_arrivetimeMM").css({'color' : '#FF0000'});
					$('#input_arrivetimeMM').focus();return false;
				}else{
					$("#input_arrivetimeMM").css({'border-color' : '#e8e8e8 '});
					$("#input_arrivetimeMM").css({'color' : '#000'});
				}
			}//if(document.getElementById("input_pickupairport").value==1) {
				
			if(document.getElementById("input_dropoff1").checked==true) { 
				if(isBlank(input_cardropoff1)) { 
					$("#input_cardropoff1").css({'border-color' : '#FF0000'});
					$("#input_cardropoff1").css({'color' : '#FF0000'});
					$('#input_cardropoff1').focus();return false;
				}else{
					$("#input_cardropoff1").css({'border-color' : '#e8e8e8 '});
					$("#input_cardropoff1").css({'color' : '#000'});
				}
				if(isBlank(input_dropoffpoint1)) { 
					$("#input_dropoffpoint1").css({'border-color' : '#FF0000'});
					$("#input_dropoffpoint1").css({'color' : '#FF0000'});
					$('#input_dropoffpoint1').focus();return false;
				}else{
					$("#input_dropoffpoint1").css({'border-color' : '#e8e8e8 '});
					$("#input_dropoffpoint1").css({'color' : '#000'});
				}	
				if(isBlank(input_hoteldropoff1)) { 
					$("#input_hoteldropoff1").css({'border-color' : '#FF0000'});
					$("#input_hoteldropoff1").css({'color' : '#FF0000'});
					$('#input_hoteldropoff1').focus();return false;
				}else{
					$("#input_hoteldropoff1").css({'border-color' : '#e8e8e8 '});
					$("#input_hoteldropoff1").css({'color' : '#000'});
				}
				
			}//if(document.getElementById("input_dropoff1").checked==true) { 
			
				
			if(document.getElementById("booking_type").value==2){
				
					if(document.getElementById("input_pickup2").checked==true) { 
						if(isBlank(input_carpickup2)) { 
							$("#input_carpickup2").css({'border-color' : '#FF0000'});
							$("#input_carpickup2").css({'color' : '#FF0000'});
							$('#input_carpickup2').focus();return false;
						}else{
							$("#input_carpickup2").css({'border-color' : '#e8e8e8 '});
							$("#input_carpickup2").css({'color' : '#000'});
						}
						if(isBlank(input_pickuppoint2)) { 
							$("#input_pickuppoint2").css({'border-color' : '#FF0000'});
							$("#input_pickuppoint2").css({'color' : '#FF0000'});
							$('#input_pickuppoint2').focus();return false;
						}else{
							$("#input_pickuppoint2").css({'border-color' : '#e8e8e8 '});
							$("#input_pickuppoint2").css({'color' : '#000'});
						}
						if(isBlank(input_hotelpickup2)) { 
							$("#input_hotelpickup2").css({'border-color' : '#FF0000'});
							$("#input_hotelpickup2").css({'color' : '#FF0000'});
							$('#input_hotelpickup2').focus();return false;
						}else{
							$("#input_hotelpickup2").css({'border-color' : '#e8e8e8 '});
							$("#input_hotelpickup2").css({'color' : '#000'});
						}	
						
						if(document.getElementById("input_pickupairport2").value==1) {
							if(isBlank(input_filghtnumberpickup2)) { 
								$("#input_filghtnumberpickup2").css({'border-color' : '#FF0000'});
								$("#input_filghtnumberpickup2").css({'color' : '#FF0000'});
								$('#input_filghtnumberpickup2').focus();return false;
							}else{
								$("#input_filghtnumberpickup2").css({'border-color' : '#e8e8e8 '});
								$("#input_filghtnumberpickup2").css({'color' : '#000'});
							}
							if(isBlank(input_arrivetimeHH2)) { 
								$("#input_arrivetimeHH2").css({'border-color' : '#FF0000'});
								$("#input_arrivetimeHH2").css({'color' : '#FF0000'});
								$('#input_arrivetimeHH2').focus();return false;
							}else{
								$("#input_arrivetimeHH2").css({'border-color' : '#e8e8e8 '});
								$("#input_arrivetimeHH2").css({'color' : '#000'});
							}
							if(isBlank(input_arrivetimeMM2)) { 
								$("#input_arrivetimeMM2").css({'border-color' : '#FF0000'});
								$("#input_arrivetimeMM2").css({'color' : '#FF0000'});
								$('#input_arrivetimeMM2').focus();return false;
							}else{
								$("#input_arrivetimeMM2").css({'border-color' : '#e8e8e8 '});
								$("#input_arrivetimeMM2").css({'color' : '#000'});
							}
						}//if(document.getElementById("input_pickupairport2").value==1) {	
						
					}//if(document.getElementById("input_pickup2").checked==true) { 
					
					
					if(document.getElementById("input_dropoffairport").value==1) {//เช็คว่าคือสนามบินรึป่าว
					
						if(isBlank(input_filghtnumberdropoff)) { 
							$("#input_filghtnumberdropoff").css({'border-color' : '#FF0000'});
							$("#input_filghtnumberdropoff").css({'color' : '#FF0000'});
							$('#input_filghtnumberdropoff').focus();return false;
						}else{
							$("#input_filghtnumberdropoff").css({'border-color' : '#e8e8e8 '});
							$("#input_filghtnumberdropoff").css({'color' : '#000'});
						}
						if(isBlank(input_departtimeHH)) { 
							$("#input_departtimeHH").css({'border-color' : '#FF0000'});
							$("#input_departtimeHH").css({'color' : '#FF0000'});
							$('#input_departtimeHH').focus();return false;
						}else{
							$("#input_departtimeHH").css({'border-color' : '#e8e8e8 '});
							$("#input_departtimeHH").css({'color' : '#000'});
						}
						if(isBlank(input_departtimeMM)) { 
							$("#input_departtimeMM").css({'border-color' : '#FF0000'});
							$("#input_departtimeMM").css({'color' : '#FF0000'});
							$('#input_departtimeMM').focus();return false;
						}else{
							$("#input_departtimeMM").css({'border-color' : '#e8e8e8 '});
							$("#input_departtimeMM").css({'color' : '#000'});
						}
						
					}//if(document.getElementById("input_dropoffairport").value==1) {
					
					if(document.getElementById("input_dropoff2").checked==true) { 
						if(isBlank(input_cardropoff2)) { 
							$("#input_cardropoff2").css({'border-color' : '#FF0000'});
							$("#input_cardropoff2").css({'color' : '#FF0000'});
							$('#input_cardropoff2').focus();return false;
						}else{
							$("#input_cardropoff2").css({'border-color' : '#e8e8e8 '});
							$("#input_cardropoff2").css({'color' : '#000'});
						}
						if(isBlank(input_dropoffpoint2)) { 
							$("#input_dropoffpoint2").css({'border-color' : '#FF0000'});
							$("#input_dropoffpoint2").css({'color' : '#FF0000'});
							$('#input_dropoffpoint2').focus();return false;
						}else{
							$("#input_dropoffpoint2").css({'border-color' : '#e8e8e8 '});
							$("#input_dropoffpoint2").css({'color' : '#000'});
						}	
						if(isBlank(input_hoteldropoff2)) { 
							$("#input_hoteldropoff2").css({'border-color' : '#FF0000'});
							$("#input_hoteldropoff2").css({'color' : '#FF0000'});
							$('#input_hoteldropoff2').focus();return false;
						}else{
							$("#input_hoteldropoff2").css({'border-color' : '#e8e8e8 '});
							$("#input_hoteldropoff2").css({'color' : '#000'});
						}
					}//if(document.getElementById("input_dropoff2").checked==true) { 
				
			}//if(document.getElementById("booking_type").value==2){
				
	}
	var TYPE="POST";
	var URL="step3.php";
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#Step2").hide();
			jQuery("#Step3").show();
			jQuery("#Step3").html(html);
			jQuery("#preloader").hide();
			
		}
	});
}
function prevstep1(){
	jQuery("#Step1").show();
	jQuery("#Step2").hide();
}
function prevstep2(){
	jQuery("#Step2").show();
	jQuery("#Step3").hide();
}
function pickup(myid){
	if(myid==1){
		if(document.getElementById("input_pickup1").checked==true) { 
			jQuery("#pickup1").show();
		}else{
			jQuery("#pickup1").hide();
		}
	}else{
		if(document.getElementById("input_pickup2").checked==true) { 
			jQuery("#pickup2").show();
		}else{
			jQuery("#pickup2").hide();
		}
	}
}
function dropoff(myid){
	if(myid==1){
		if(document.getElementById("input_dropoff1").checked==true) { 
			jQuery("#dropoff1").show();
		}else{
			jQuery("#dropoff1").hide();
		}
	}else{
		if(document.getElementById("input_dropoff2").checked==true) { 
			jQuery("#dropoff2").show();
		}else{
			jQuery("#dropoff2").hide();
		}
	}
}
function loadtransfer(){

	var TYPE="POST";
	var URL="libs/loadbooking.php";
	$('#myaction').val('loadtransfer');
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){
			jQuery("#loadtransfer").show();
			jQuery("#loadtransfer").html(html);
			
		}
	});
 
}
function loadairportpoint(transferid,typeround,div) {
	
	jQuery("#preloader").show();
	
	var TYPE="POST";
	var URL="libs/loadbooking.php";
	var dataSet={
	transferid: transferid,
	typeround: typeround,
	div : div ,
	myaction : "loadairportpoint"
	};

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){
			jQuery("#"+div+"").html(html)
			jQuery("#preloader").hide();
			
		}
	});
}

function LoadLocationTransfer(carid,companyid,pierid,teble,div) {
	
	jQuery("#preloader").show();
	
	var TYPE="POST";
	var URL="libs/loadbooking.php";
	var dataSet={
	carid: carid,
	companyid: companyid,
	pierid: pierid,
	teble : teble ,
	div : div ,
	myaction : "loadlocationtransfer"
	};

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){
			jQuery("#"+div+"").html(html)
			jQuery("#preloader").hide();
			
		}
	});
}

function CheckSubmit(){
	with(document.myForm) {
			
			if(isBlank(input_prefix)) { 
				$("#input_prefix").css({'border-color' : '#FF0000'});
				$('#input_prefix').focus();return false;
			}else{
				$("#input_prefix").css({'border-color' : '#dedede'});
			}
			
			var passenger=document.getElementById("count_passenger").value;
			for(i=1;i<=passenger;i++){
				if(document.getElementById("input_passenger"+i).value=="") { 
					$("#input_passenger"+i).css({'border-color' : '#FF0000'});
					$('#input_passenger'+i).focus();return false;
				}else{
					$("#input_passenger"+i).css({'border-color' : '#dedede'});
				}
			}
			
			if(isBlank(input_countriescode)) { 
				$("#input_countriescode").css({'border-color' : '#FF0000'});
				$('#input_countriescode').focus();return false;
			}else{
				$("#input_countriescode").css({'border-color' : '#dedede'});
			}
			if(isBlank(input_phone)) { 
				$("#input_phone").css({'border-color' : '#FF0000'});
				$('#input_phone').focus();return false;
			}else{
				$("#input_phone").css({'border-color' : '#dedede'});
			}

			if(isBlank(input_email)) { 
				$("#input_email").css({'border-color' : '#FF0000'});
				$('#input_email').focus();return false;
			}else{
				if(!isEmail($("#input_email").val())){
					if(document.getElementById("language").value=="thai") { 
						alert("รูปแบบอีเมลไม่ถูกต้อง");
					}else{
						alert("Invalid email format.");
					}
					$("#input_email").css({'border-color' : '#FF0000'});
					$('#input_email').focus();return false;
				}else{
					$("#input_email").css({'border-color' : '#dedede'});
				}
			}
			if(document.getElementById("input_pay0").checked==true) { 
				if(isBlank(number)) { 
					$("#number").css({'border-color' : '#FF0000'});
					$('#number').focus();return false;
				}else{
					$("#number").css({'border-color' : '#dedede'});
				}
				if(isBlank(holder_name)) { 
					$("#holder_name").css({'border-color' : '#FF0000'});
					$('#holder_name').focus();return false;
				}else{
					$("#holder_name").css({'border-color' : '#dedede'});
				}
				if(isBlank(expiration_month)) { 
					$("#expiration_month").css({'border-color' : '#FF0000'});
					$('#expiration_month').focus();return false;
				}else{
					$("#expiration_month").css({'border-color' : '#dedede'});
				}
				if(isBlank(expiration_year)) { 
					$("#expiration_year").css({'border-color' : '#FF0000'});
					$('#expiration_year').focus();return false;
				}else{
					$("#expiration_year").css({'border-color' : '#dedede'});
				}
				if(isBlank(security_code)) { 
					$("#security_code").css({'border-color' : '#FF0000'});
					$('#security_code').focus();return false;
				}else{
					$("#security_code").css({'border-color' : '#dedede'});
				}
			}
			if(document.getElementById("check_agree").checked!=true) { 
				if(document.getElementById("language").value=="thai") { 
					alert("กรุณายอมรับเงือนไขการให้บริการและการยกเลิก");
				}else{
					alert("Please accept terms of service and cancellation");
				}
				$("#check_agree1").css({'color' : '#FF0000'});
				$('#check_agree').focus();return false;
			}else{
				$("#check_agree1").css({'color' : '#555'});
			}
			//alert("Please check your information");
	}
	if(document.getElementById("language").value=="thai") { 
		if(confirm('คุณต้องการทำรายการจองพร้อมกับชำระเงินหรือไม่?')) {
			confirmbooking();
		}
	}else{
		if(confirm('You want to make a reservation with your payment?')) {
			confirmbooking();
		}
	}
 
}
function backstep2(id) {
	jQuery("#preloader").show();
	jQuery("#topstep2").removeClass("step-select");
	jQuery("#Step2").hide();
	jQuery("#Step1").show();
	jQuery("#preloader").hide();
}

function Loadinsert(){ 
	// console.log(document.getElementById("paymentMethod02").checked);
	Omise.setPublicKey('pkey_5xm78uqgao6svr8xhfo'); //pkey_test_5xkmjpync1ilutv70b2
	if(document.getElementById("paymentMethod02").checked==true) {
		
		var myForm = document.getElementById('myForm')
		var card = {
			name: myForm.holder_name.value,
			number: myForm.number.value,
			expiration_month: myForm.expiration_month.value,
			expiration_year: myForm.expiration_year.value,
			security_code: myForm.security_code.value
		};
		console.log("card: "+omise_total);
		Omise.createToken("card", card, function (statusCode, response) {
			if (response.object == "error") {
				// jQuery("#Step4").show();
				// jQuery("#Step4").html(response.message);
			} else {
				myForm.omise_token.value = response.id;
				var TYPE = "POST";
				var URL = "insertbooking.php";
				var dataSet = jQuery("#myForm").serialize();
				jQuery.ajax({
					type: TYPE, url: URL, data: dataSet,
					success: function (html) {
						console.log(html);
						jQuery("#loadstep4").show();
						jQuery("#loadstep4").html(html);
					}
				});
			}
		});
	}else{  
		var myForm = document.getElementById('myForm')
		var totalpay = myForm.omise_total.value;
		var total = parseFloat(totalpay) * 100;
		var total = parseInt(total);
		var ebankingtype = "promptpay"; //myForm.bank_type.value;
		var ebankingInformation = {
			amount: total,
			currency: "THB"
		};
		// console.log("promptpay: "+omise_total);
		Omise.createSource(ebankingtype, ebankingInformation, function (statusCode, response) {
			console.log(statusCode);
			if (statusCode === 200) { 
				var TYPE = "POST";
				var URL = "insertbooking.php";
				$('#omise_source').val(response.id);
				// alert(": "+response.id);	
				var dataSet = jQuery("#myForm").serialize();
				jQuery.ajax({
					type: TYPE, url: URL, data: dataSet,
					success: function (html) {
						// alert("insert: "+html);	
						jQuery("#loadpromptpay").show();
						jQuery("#loadpromptpay").html(html);
	 
						jQuery('#myModalPromptpay').css({ 'display': 'block' });
						// jQuery("#load_mainwaiting").hide();
	
						var countDownDate = new Date();
						countDownDate.setMinutes(countDownDate.getMinutes() + 30);
	
						// Update the count down every 1 second
						var x = setInterval(function () {
	
							// Get today's date and time
							var now = new Date();
	
							// Find the distance between now and the count down date
							var distance = countDownDate - now;
	
							// Time calculations for days, hours, minutes and seconds
							var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
							var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	
							// Display the result in the element with id="demo"
							document.getElementById("checktime").innerHTML = minutes + "m " + seconds + "s ";
	
							// If the count down is finished, write some text
							if (distance < 0) {
								clearInterval(x);
								document.getElementById("checktime").innerHTML = "EXPIRED";
								window.location.href = 'booking.php';
							}
						}, 1000);
	
						setInterval(function () { // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที
							// 1 วินาที่ เท่า 1000
							// คำสั่งที่ต้องการให้ทำงาน ทุก ๆ 3 วินาที
							var getPromptpay = $.ajax({ // ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล
								url: "booking-checkpromptpay.php",
								async: false,
								success: function (getPromptpay) {
									if (getPromptpay.includes("200")) {
										let timerInterval
										Swal.fire({
											title: 'การชำระเงินสำเร็จ',
											html: 'กรุณารอสักครู่.',
											timer: 2000,
											timerProgressBar: true,
											didOpen: () => {
												Swal.showLoading()
												const b = Swal.getHtmlContainer().querySelector('b')
												timerInterval = setInterval(() => {
													b.textContent = Swal.getTimerLeft()
												}, 100)
											},
											willClose: () => {
												clearInterval(timerInterval)
											}
										}).then((result) => {
											/* Read more about handling dismissals below */
											if (result.dismiss === Swal.DismissReason.timer) {
												window.location.href = 'booking.php';
											}
										})
										// modLoadContent();
									}else if (getPromptpay.includes("201")) {
										let timerInterval
										Swal.fire({
											title: 'การชำระเงินไม่สำเร็จ !!',
											html: 'เกิดข้อผิดพลาดบางอย่าง.',
											timer: 2000,
											timerProgressBar: true,
											didOpen: () => {
												Swal.showLoading()
												const b = Swal.getHtmlContainer().querySelector('b')
												timerInterval = setInterval(() => {
													b.textContent = Swal.getTimerLeft()
												}, 100)
											},
											willClose: () => {
												clearInterval(timerInterval)
											}
										}).then((result) => {
											/* Read more about handling dismissals below */
											if (result.dismiss === Swal.DismissReason.timer) {
												location.reload();
											}
										})
										// modLoadContent();
									}
								}
								// $("#checkpromptpay").html(getPromptpay); // ส่วนที่ 3 นำข้อมูลมาแสดง
								
							}).responseText;
	
	
						}, 5000);
	
					}
				});
			} else {
				alert("error");	
				jQuery("#token_errors").show();
				jQuery("#token_errors").html(response.message);
				jQuery("#preloader").hide();
				// Error: display an error message. Note that `response.message` contains
				// a preformatted error message. Also note that `response.code` will be
				// "invalid_card" in case of validation error on the card.
			}
		});
	} 
}

function modChangelanguage(leng, url) {
    // showLoader();
    var TYPE = "POST";
    var URL = "libs/loadleng.php";
    var dataSet = {
        leng: leng,
        url: url
    };
	// console.log(dataSet);
    jQuery.ajax({
        type: TYPE, url: URL, data: dataSet,
        success: function (html) {
            // hideLoader();
			// console.log(html);
            if (html.includes("success")) {
                window.location.href = "" + url;
            }

        }
    });
}

function confirmbooking(){
	
	jQuery("#preloader").show();
	
	if(document.getElementById("input_pay0").checked==true) { 
		
		Omise.setPublicKey('pkey_5h7hhmvfku482egfdft');
		
		var myForm = document.getElementById('myForm')
		
		  var cardInformation = {
			name:             myForm.holder_name.value,
			number:           myForm.number.value,
			expiration_month: myForm.expiration_month.value,
			expiration_year:  myForm.expiration_year.value,
			security_code:    myForm.security_code.value
			
		  };
		
		  Omise.createToken('card', cardInformation, function(statusCode, response) {

			if (statusCode === 200) {
			  // Success: send back the TOKEN_ID to your server. The TOKEN_ID can be
			  // found in `response.id`.
			  myForm.omise_token.value = response.id;
			  //myForm.submit();
			  //alert(response.id);
			  //alert(response.code);
			  	var TYPE="POST";
				var URL="insertbooking.php";
				var dataSet= jQuery("#myForm").serialize();
			
				jQuery.ajax({type:TYPE,url:URL,data:dataSet,
					success:function(html){			
					//alert("insert");	
						jQuery("#Step4").show();
						jQuery("#Step4").html(html);
						//jQuery("#preloader").hide();
					}
				});
		  }else {
				jQuery("#token_errors").show();
				jQuery("#token_errors").html(response.message);
				jQuery("#preloader").hide();
			  // Error: display an error message. Note that `response.message` contains
			  // a preformatted error message. Also note that `response.code` will be
			  // "invalid_card" in case of validation error on the card.
			}
		  });
	}else{
		var TYPE="POST";
		var URL="insertbooking.php";
		var dataSet= jQuery("#myForm").serialize();
	
		jQuery.ajax({type:TYPE,url:URL,data:dataSet,
			success:function(html){			
				
				jQuery("#Step4").show();
				jQuery("#Step4").html(html);
				if(document.getElementById("input_pay1").checked==true) { 
					document.getElementById("myFormCredit").submit();
				}
				//jQuery("#preloader").hide();
			}
		});
	}
}

function SubmitContact(){
	with(document.myForm) {
		
			if(isBlank(input_name)) { 
				$("#input_name").css({'border-color' : '#FF0000'});
				$('#input_name').focus();return false;
			}else{
				$("#input_name").css({'border-color' : '#ccc'});
			}
			if(isBlank(input_email)) { 
				$("#input_email").css({'border-color' : '#FF0000'});
				$('#input_email').focus();return false;
			}else{
				if(!isEmail($("#input_email").val())){
					alert("Invalid email format.");
					$("#input_email").css({'border-color' : '#FF0000'});
					$('#input_email').focus();return false;
				}else{
					$("#input_email").css({'border-color' : '#ccc'});
				}
			}
			if(isBlank(input_phone)) { 
				$("#input_phone").css({'border-color' : '#FF0000'});
				$('#input_phone').focus();return false;
			}else{
				$("#input_phone").css({'border-color' : '#ccc'});
			}
			if(isBlank(input_subject)) { 
				$("#input_subject").css({'border-color' : '#FF0000'});
				$('#input_subject').focus();return false;
			}else{
				$("#input_subject").css({'border-color' : '#ccc'});
			}
			if(isBlank(input_message)) { 
				$("#input_message").css({'border-color' : '#FF0000'});
				$('#input_message').focus();return false;
			}else{
				$("#input_message").css({'border-color' : '#ccc'});
			}
			if(isBlank(inputkeyCode)) { 
				$("#inputkeyCode").css({'border-color' : '#FF0000'});
				$('#inputkeyCode').focus();return false;
			}else{
				$("#inputkeyCode").css({'border-color' : '#ccc'});
			}
	}
	jQuery("#preloader").show();

	var TYPE="POST";
	var URL="insertcontact.php";
	var dataSet= jQuery("#myForm").serialize();

	jQuery.ajax({type:TYPE,url:URL,data:dataSet,
		success:function(html){			
			
			jQuery("#contact-content").show();
			jQuery("#contact-content").html(html)
			jQuery("#preloader").hide();
			
		}
	});
 
}


function backfn() {
    // location.reload();
	window.history.back();
}
function backfn2() {
    location.reload();
	// window.history.back();
}

function Loadpolicy() {
    jQuery("#body_policy").show();
    // jQuery('#exampleModal_policy').css({ 'display': 'block' });
	jQuery("#exampleModal_policy").modal('show');
}

function confirmpolicy() {
    var checkbox = document.getElementById("confirm_policy");
	console.log(checkbox);
    if (checkbox.checked) {
    } else {
        checkbox.checked = true;
		var el = document.getElementById('addevent');
  			el.classList.remove("disabled"); 
        Closemodal();
    } 
}
function Closemodal() {
    // jQuery('#exampleModal_policy').css({ 'display': 'none' });
	jQuery("#exampleModal_policy").modal('hide');
}
