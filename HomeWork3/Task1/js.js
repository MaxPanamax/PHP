let selecter = document.getElementById('ChooseCountry');
let value = selecter.options[selecter.selectedIndex].value;

selecter.addEventListener('change', function(e){
	let countryId= e.target.value;
	$.ajax({
		url: '/HomeWork3/Task1/city.php',
		data: {'countryId':countryId},
		dataType: "html",
		method: "post",
		success: function(data){
			$('#mes').html(data);
		},
	});
});