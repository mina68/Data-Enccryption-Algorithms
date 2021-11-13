$(document).ready(function(){

	$(document).on('keyup', 'input', function(){
		start();
	})

	$(document).on('change', 'select', function(){
		start();
	})

	$('#technique').on('change', function(){
		if($(this).val() == 'ceasar'){
			$('.key').hide();
			$('.offset').show();
		}
		else if($(this).val() == 'playfair'){
			$('.offset').hide();
			$('.key').show();
		}
		else if($(this).val() == 'RC4'){
			$('.offset').hide();
			$('.key').show();
		}
		else{
			$('.offset').hide();
			$('.key').hide();
		}
	})

	function start(){

		let URL = '';

		if($('#technique').val() != "" && $('#type').val() != '' && $('#string').val() != ''){
			let type = $('#type').val();
			let technique = $('#technique').val();
			let string = $('#string').val();
			let key = $('#key').val();
			let offset = Number($('#offset').val());

			if(technique == 'ceasar')
				URL = 'ceasar/ceasarCipher.php';

			else if(technique == 'playfair')
				URL = 'playfair/playfairCipher.php';

			else if(technique == 'RC4')
				URL = 'RC4/RC4.php';

			else if(technique == 'RSA')
				URL = 'RSA/RSA.php';

			$.ajax({
				url:URL,
				type:'POST',
				data:{string:string, type:type, offset:offset, key:key},
				success:function(response){
					$('#result').val(response);
				}
			})
		}
		else{
			$('#result').val('');
		}
	}

})