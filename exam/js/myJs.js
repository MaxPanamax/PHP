"use strict";
let selecter = document.getElementById('ChooseTeam');
let value = selecter.options[selecter.selectedIndex].value;

selecter.addEventListener('change', function(e){
	let TeamId= e.target.value;
	$.ajax({
		url: './pages/teamPlayerList.php',
		data: {'TeamId':TeamId},
		dataType: "html",
		method: "post",
		success: function(data){
			$('#mes').html(data);
		},
	});
});