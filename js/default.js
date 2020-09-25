
$(document).ready(function () {
	$("#frm_user_login").submit(function (event) {
		event.preventDefault();
		validateLogin();
	});

	$(".btnUser").on('click', function(){
		$('#userSave')[0].reset();
				$('#uid').val('-1');
		$('.modalSave').modal('show');
	})

	$('#userSave').submit(function(event){
		event.preventDefault();
		saveUser();
	})
	$(".btnEdit").on('click', function(){
		var userId = $(this).closest('tr').attr('id');
		getUser(userId);
	})
	$(".btnDel").on('click', function(){
		var userId = $(this).closest('tr').attr('id');
		deleteUser(userId);
	})
	

	$(".btn_img").on('click', function(){
		var userId = $(this).closest('tr').attr('id');
		$('#userImgId').val(userId);
		getAllImagesByUser(userId);
	})

	$('#imageSave').submit(function(event){
		event.preventDefault();
		saveImage();
	})


});



function saveImage(){
	var form_data = new FormData();
	form_data.append('fileName', $('#img').prop('files')[0]);
	form_data.append('userId', $('#userImgId').val());
	$.ajax({
		type: "POST",
		cache: false,
		enctype: 'multipart/form-data',
		url: "../application/user/UserCtl.php",
		data:  form_data,
		processData: false,
		contentType: false,
		dataType: 'json',
		success: function (jsnResponse) {
			console.log(jsnResponse);
			if (jsnResponse.status) {
				alert('image Uploaded');
				$('#imageSave')[0].reset();
				getAllImagesByUser($('#userImgId').val());
			} else {
				alert(jsnResponse.data);
			}
		},
		error: function (err) {
			console.log(err.responseText);
		}
	});
}
function getAllImagesByUser(user){
	$('.modalImage').modal('show');
	$.ajax({
		url: "../application/user/UserCtl.php",
		type: 'POST',
		cache: false,
		data: {	getUserImage: user },
		dataType: 'JSON',
		success: function (responce) {
			$('.tblImage tbody tr').empty();
			var user = responce.data;
			console.log(user);
			if(responce.status)	{
			for(var i=0; i< user.length; i++){
				$('.tblImage tbody').append('<tr><td>'+ (i+1)+'</td><td> <img src="images/users/'+ user[i].image +'" style="width: 50px;height: 54px;"></td></tr>')
			}
		}else{
			$('.tblImage tbody').append('<tr colspan="2"><td>No Images Uploaded</tr>');
			}
										
		},
		error: function (err) {
			console.log(err.responseText);
		},
	});	
}

function deleteUser(user){
	console.log('dsds');
	$.ajax({
		url: "../application/user/UserCtl.php",
		type: 'POST',
		cache: false,
		data: {	deleteUser: user },
		dataType: 'JSON',
		success: function (responce) {
			var jsonData = responce;
			console.log(jsonData);
			if (jsonData.status) {
				location.reload(true);
			} else {
				alert("User Not Deleted, try again");
			}
		},
		error: function (err) {
			console.log(err.responseText);
		},
	});	
}

function getUser(user){
	$.ajax({
		url: "../application/user/UserCtl.php",
		type: 'POST',
		cache: false,
		data: {	getUser: user },
		dataType: 'JSON',
		success: function (responce) {
			var user = responce.user;
			$('#uid').val(user.id);
			$('#name').val(user.name);
			$('#email').val(user.email);
			$('#phone').val(user.phone);
			$('.modalSave').modal('show');						
		},
		error: function (err) {
			console.log(err.responseText);
		},
	});	
}
function saveUser(){
	var logArray = {};
	logArray['id'] = document.getElementById('uid').value;
	logArray['name'] = document.getElementById('name').value;
	logArray['email'] = document.getElementById('email').value;
	logArray['phone'] = document.getElementById('phone').value;
	var jsdata = JSON.stringify(logArray);
	$.ajax({
		url: "../application/user/UserCtl.php",
		type: 'POST',
		cache: false,
		data: {	userSave: jsdata},
		dataType: 'JSON',
		success: function (responce) {
			var jsonData = responce;
			console.log(jsonData);
			if (jsonData.status) {
				$('#userSave')[0].reset();
				$('#uid').val('-1');
				$('.modalSave').modal('hide');
				location.reload(true);
			} else {
				alert("Invalid User Id and Password");
			}
		},
		error: function (err) {
			console.log(err.responseText);
		},
	});	
}

function validateLogin() {
	var logArray = {};
	logArray['loginId'] = document.getElementById('txt_loginId').value;
	logArray['password'] = document.getElementById('txt_loginpwd').value;
	var jsdata = JSON.stringify(logArray);
	$.ajax({
		url: "../application/login/LoginCtl.php",
		type: 'POST',
		cache: false,
		data: {	login: jsdata},
		dataType: 'JSON',
		success: function (responce) {
			var jsonData = responce;
			if (jsonData.status) {
				window.location = "http://localhost/" + jsonData.url;
			} else {
				alert("Invalid User Id and Password");
			}
		},
		error: function (err) {
			console.log(err.responseText);
		},
	});

}
