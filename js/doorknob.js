////////////////////////////////////////////////////////////////////
//
//   Shakebot Checkout Script
//   Author: Nick Germaine
//   Don't steal.
//
///////////////////////////////////////////////////
	
$(document).ready(function(){
/*
	$('#coverForm').on('submit', (function(e){
		e.preventDefault();
		alert('changed');
		var form = $('#coverForm');

		var formData = new FormData(form);
		$.ajax({
			url: 'lib/functions/uploadCover.php',
			type: 'POST',
			data: formData,
			cache:false,
            contentType: false,
            processData: false,
			success: function(response){
				alert(response);
				$('.cover-photo').css('background', 'url(\'' + response + '\')')
			}
		})
	}));


	$('#coverForm input').on('change', function(){
		$('#coverForm').submit();
	});


	*/

	

	$(document).on('click', '.profile-nav li a', function(e){
		e.preventDefault();

		$('.profile-nav li a.active').removeClass('active');
		$(this).addClass('active');
	});

	$(document).on('click', '#cc-submit', function(event){
				alert('clicked');
				window.scrollTo(0,0);		
				postcredit(event);	
	});

	
	$('#cc-number').on('keyup', function(){
		if($(this).val().length !== "0"){
			var cardtype = balanced.card.cardType($('#cc-number').val());
			if(cardtype == "VISA"){
				$('.cc-logo').removeClass('nonfaded');
				$('.cc-logo').addClass('faded');
				$('#visa').removeClass('faded');
				$('#visa').addClass('nonfaded');
			}else if(cardtype == "Mastercard"){
				$('.cc-logo').removeClass('nonfaded');
				$('.cc-logo').addClass('faded');
				$('#mastercard').removeClass('faded');
				$('#mastercard').addClass('nonfaded');
			}else if(cardtype == "Discover Card"){
				$('.cc-logo').removeClass('nonfaded');
				$('.cc-logo').addClass('faded');
				$('#discover').removeClass('faded');
				$('#discover').addClass('nonfaded');
			}else if(cardtype == "American Express"){
				$('.cc-logo').removeClass('nonfaded');
				$('.cc-logo').addClass('faded');
				$('#amex').removeClass('faded');
				$('#amex').addClass('nonfaded');
			}else{
				$('.cc-logo').removeClass('nonfaded');
				$('.cc-logo').addClass('faded');
			}
		}
	});
		
	function calcTotal(){
	};
				
	
	// Assuming they are paying with credit card, this is the function,
	function postcredit(event){
		$('#creditcardpost').hide();

		window.scrollTo(0,0);
		event.preventDefault();

		$('#cc-submit').attr('disabled', 'disabled');
		
			var payload = {
				name: $('#cc-name').val(),
				number: $('#cc-number').val(),
				expiration_month: $('#cc-ex-month').val(),
				expiration_year: $('#cc-ex-year').val(),
				cvv: $('#ex-cvv').val(),
				address: {
					postal_code: $('#ex-postal-code').val()
				}
			};
			
		// Create credit card
		balanced.card.create(payload, handleResponse);	
	};		
		
		
			
			
			
function handleResponse(response) {

			
			
				if (response.status_code === 201) {
					var fundingInstrument = response.cards != null ? response.cards[0] : response.bank_accounts[0];
					
					if(balanced.card.isCVVValid($('#cc-number').val(), $('#ex-cvv').val()) == true){
					
					// Call your backend
					
					$('#creditcardpost').append('<input type="hidden" name="card" value="' + fundingInstrument.href + '" />');
					
					$.ajax({
				
					
						url: 'lib/balanced/example.php',
						type: 'POST',
						data: $('#creditcardpost').serialize(),
						success: function(data){
							alert(data);
						
							if(data.indexOf('succeeded') >= 0){
								
							}
						}
					});	
					
				}
					
			}
				
		};
			

			
		
		});
