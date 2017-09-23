jQuery(document).ready(function() {

     $('.zbutton').click(function () {
		 form = $("#zakazform");
		 
		if($(".pl1").val()!=''&&$(".pl2").val()!=''&&$(".pl3").val()!=''){
			var val1=$(".pl1").val();
			var val2=$(".pl2").val();
			var val3=$(".pl3").val();
			//var $form = $("#zakazform"),
		
			
			$("#zakazform")[0].reset();
		  jQuery("#m_zakaz").modal({"show":true});
		  
		  	$.ajax({
						type: 'POST',
						url: 'send.php',
						data: {"pole1":val1 ,"pole2":val2,"pole3":val3},
						success: function(result){
						if(result == 'true'){
				
						
						}
						else 
						{
						
						}
					}
				});
		}
		else{
			alert('Заполните все поля!');
		}
			/*
			//var checker = checkForm(form);
			
			
		
				$.ajax({
						type: 'POST',
						url: 'send.php',
						data: $(form).serialize(),
						success: function(result){
						if(result == 'true'){
				
						$("#zakazform")[0].reset();
						  window.location.href = "./thanks.php";
						//$('#m_send').modal('show');
						
						}
						else 
						{
							$('#m_zakaz .send_txt').html(result);
							$('.send_txt').show();
							//$('#m_send').modal('show');
						}
					}
				});
			*/


});


     $('.vbutton').click(function () {
			var val1=$(this).data('vivod');
		jQuery(this).parent().parent().remove();
		  	$.ajax({
						type: 'GET',
						url: 'del.php',
						data: {"del":val1},
						success: function(result){
						if(result == 'true'){
						
						jQuery("#m_zakaz").modal({"show":true});
						
						}
						else 
						{
						
						}
					}
				});
		
			


});

});
/*
[object Object]
*/