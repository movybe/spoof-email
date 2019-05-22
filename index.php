<?php echo $_SERVER["DOCUMENT_ROOT"];?>
<style>
body {
	width: 610px;
}

#frmEnquiry {
	border-top: #F0F0F0 2px solid;
	background: #FAF8F8;
	padding: 15px 30px;
}

#frmEnquiry div {
	margin-bottom: 20px;
}

#frmEnquiry div label {
	margin-left: 5px
}

.demoInputBox {
	padding: 10px;
	border: #F0F0F0 1px solid;
	border-radius: 4px;
	background-color: #FFF;
	width: 100%;
}

.demoInputBox:focus {
    outline:none;
}

.error {
	background-color: #FF6600;
	border: #AA4502 1px solid;
	padding: 5px 10px;
	color: #FFFFFF;
	border-radius: 4px;
}

.success {
	background-color: #9fd2a1;
	border: #91bf93 1px solid;
	padding: 5px 10px;
	color: #3d503d;
	border-radius: 4px;
    cursor: pointer;
    font-size: 0.9em;
}

.info {
	font-size: .8em;
	color: #FF6600;
	letter-spacing: 2px;
	padding-left: 5px;
}

.btnAction {
	background-color: #263327;
	border: 0;
	padding: 10px 40px;
	color: #FFF;
	border: #F0F0F0 1px solid;
	border-radius: 4px;
    cursor:pointer;
}
.btnAction:focus {
    outline:none;
}
.invalid {
    background: #fbf2f2;
    border: #e8e0e0 1px solid;
}
</style>
<script src="jquery-3.2.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function (e){
$("#frmEnquiry").on('submit',(function(e){
	e.preventDefault();
	$('#loader-icon').show();
	var valid;	
	valid = validateContact();
	if(valid) {
		$.ajax({
		url: "mail-send.php",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success: function(data){
		$("#mail-status").html(data);
		$('#loader-icon').hide();
		},
		error: function(){} 	        
		
		});
	}
}));

function validateContact() {
	var valid = true;	
	$(".demoInputBox").css('background-color','');
	$(".info").html('');
	$("#userName").removeClass("invalid");
	$("#userEmail").removeClass("invalid");
	$("#subject").removeClass("invalid");
	$("#content").removeClass("invalid");
	
	if(!$("#userName").val()) {
		$("#userName").addClass("invalid");
        $("#userName").attr("title","Required");
        valid = false;
	}
    if(!$("#userEmail").val()) {
        $("#userEmail").addClass("invalid");
        $("#userEmail").attr("title","Required");
        valid = false;
    }
    if(!$("#userEmail").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
        $("#userEmail").addClass("invalid");
        $("#userEmail").attr("title","Invalid Email");
        valid = false;
    }
	if(!$("#subject").val()) {
		$("#subject").addClass("invalid");
        $("#subject").attr("title","Required");
		valid = false;
	}
	if(!$("#content").val()) {
		$("#content").addClass("invalid");
        $("#content").attr("title","Required");
		valid = false;
	}
	
	return valid;
}

});
</script>
<form id="frmEnquiry" action="" method="post" enctype='multipart/form-data'>
    <div id="mail-status"></div>
    <div>
        <input
            type="text" name="userName" id="userName"
            class="demoInputBox" placeholder="YOUR NAME">
    </div>
    
	<div>
        <input
            type="email" name="userFakeEmail" id="userFakeEmail"
            class="demoInputBox" placeholder="YOUR FAKE EMAIL">
    </div>
<div>
<input
            type="text" name="receiverName" id="receiveName"
            class="demoInputBox" placeholder="YOUR RECEIVER NAME">
    </div>
    
	<div>
<input
            type="email" name="replyTo" id="replyTo"
            class="demoInputBox" placeholder="REPLY-TO">
    </div>

	<div>
        <input type="email" name="userEmail" id="userEmail"
            class="demoInputBox" placeholder="RECEIPIENT EMAIL">
    </div>
    <div>
        <input type="text" name="subject" id="subject"
            class="demoInputBox" placeholder="SUBJECT">
    </div>
	
	
    <div>
        <textarea name="content" id="content" class="demoInputBox"
            cols="60" rows="6" placeholder="CONTENT"></textarea>
    </div>
	<div>
	<label for = "send_to">Send to</label>
	    <select name = "send_to" id = "sendto">
		<option value = "gmail">Gmail</option>
		<option value = "Other">Other</option>
		</select>
    </div>
    <div>
        <label>Attachment</label><br /> <input type="file"
            name="attachment[]" class="demoInputBox" multiple="multiple">
    </div>
    <div>
        <input type="submit" value="Send" class="btnAction" />
    </div>
</form>
<div id="loader-icon" style="display: none;">
    <img src="LoaderIcon.gif" />
</div>