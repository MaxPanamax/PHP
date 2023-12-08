let form = document.getElementById('registration');

form.addEventListener('submit', function(evt){
    evt.preventDefault();

    login = form.querySelector('[name="login"]').value; //получаем поле login
    password = form.querySelector('[name="password"]').value; //получаем поле password
    $.ajax({
    	url:'/HomeWork3/Task2/reg.php',
    	data:{'login':login, 'password': password },
    	dataType: "html",
    	method: "post",
    	success: function(data){
    		$('#mes').html(data);
    	},
    });
});

