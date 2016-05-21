<?php session_start();

require '../../config.php';  
require '../functions/functions.php';
require '../classes/classes.php'; ?>


<div class="row">
	<div class="small-12 small-centered columns">
	<h1>Shakebot Checkout</h1>
	
	<form id="creditcardpost">
	<div class="row">
		<div class="small-12 columns">
			<h4>Personal Information</h4>
			</div>
		<div class="small-6 columns">
			
			<input type="text" name="name" class="contact-form required" required placeholder="Name (required)" value="<?php echo $loggedInUser->fullname; ?>" />
			<input type="email" name="email" required value="<?php echo $email; ?>" class="contact-form required" placeholder="Email Address (required)" value="<?php echo $loggedInUser->email; ?>" />
			<input type="text" name="phone" class="form2" placeholder="Phone Number (Optional)" /><br /><br />
			</div>
		<div class="small-6 columns physicaladdress">
					
		<input type="text" name="street" placeholder="Street Address" class="form2" />
		<input type="text" name="apt" placeholder="Apartment / Suite #" class="form2" />
		<input type="text" name="city" placeholder="City" class="form2" />
		<input type="text" name="state" placeholder="State" class="form2" />
		<input type="text" name="zip" placeholder="Zip / Postal Code" class="form2" />
		<input type="text" name="country" placeholder="Country" class="form2" />
		
		</div>
		</div>
		<div class="row">
		<div class="small-12 columns">
				<h4>Payment Details</h4>
		</div>
		<div class="small-6 columns">
		<b><input required name="payment" type="radio" id="paycredit" value="creditcard" /> Credit Card</b>
		<div id="creditcarddetails">		
		<input class="contact-form" type="text" name="cc-name" id="cc-name" autocomplete="off" placeholder="Cardholders Name" />
		
		<img class="pull-left cc-logo faded" src="img/amex.png" id="amex" />
		<img class="pull-left cc-logo faded" src="img/discover.png" id="discover" />
		<img class="pull-left cc-logo faded" src="img/mastercard.png" id="mastercard" />
		<img class="pull-left cc-logo faded" src="img/visa.png" id="visa" /><br />
		
		<input class="contact-form" type="text" name="cc-number" id="cc-number" autocomplete="off" placeholder="Credit Card Number" maxlength="16" /><br />
			<div class="small-6 columns no-pad-left">
				<!--<input required class="contact-form" type="text" name="cc-ex-month" id="cc-ex-month" autocomplete="off" placeholder="Expiration Month" maxlength="2" />-->
				<select required class="contact-form" type="text" name="cc-ex-month" id="cc-ex-month">
				<option>Expiration Month</option>
				<option value="01">January (01)</option>
				<option value="02">February (02)</option>
				<option value="03">March (03)</option>
				<option value="04">April (04)</option>
				<option value="05">May (05)</option>
				<option value="06">June (06)</option>
				<option value="07">July (07)</option>
				<option value="08">August (08)</option>
				<option value="09">September (09)</option>
				<option value="10">October (10)</option>
				<option value="11">November (11)</option>
				<option value="12">December (12)</option>
				</select>
				<br />  
			</div>
			<div class="small-6 columns no-pad-right">
				
<!--<input required name="cc-ex-year" class="contact-form" type="text" id="cc-ex-year" autocomplete="off" placeholder="Expiration Year" maxlength="4" />-->
				<select required name="cc-ex-year" class="contact-form" id="cc-ex-year" placeholder="Expiration Year">
				<option>Expiration Year</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
				<option value="2021">2021</option>
				<option value="2022">2022</option>
				<option value="2023">2023</option>
				<option value="2024">2024</option>
				<option value="2025">2025</option>
				<option value="2026">2026</option>
				<option value="2027">2027</option>
				<option value="2028">2028</option>
				<option value="2029">2029</option>
				<option value="2030">2030</option>
				</select><br />				</div> 
		<input class="contact-form" type="text" name="ex-cvv" id="ex-cvv" autocomplete="off" placeholder="Card Verification Number" maxlength="4" /><br /> 
		<input class="contact-form" type="text" name="ex-postal-code" id="ex-postal-code" autocomplete="off" placeholder="Postal Code" />
		</div>		
		<!-- #This grabs the response from the credit card validation check.  Commented out because I might not need it.
		<div id="response" class="col-lg-12" style="display: none;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Response</h3>
                    </div>
                    <div class="panel-body">
                        <pre></pre>
                    </div>
                </div>
            </div>
		-->
		
        </div>
       
		<div class="small-6 columns">
			<b><input required name="payment" type="radio" id="paypal" value="paypal" /> PayPal</b><br />
			<img id="paypallogo" src="img/paypal.png" class="img-responsive center faded" /><br />
			<h5>After Paypal processes the payment, please allow it to redirect back to this site to process the order in our systems.</h5>
		</div>
		</div>
		

		<div class="row">
		<div class="small-6 columns">
		<h3>Total:</h3>
		</div>

		</div>
		
		</form>
		<button class="button success" id="cc-submit">Submit Order</button><br /><br /><br />
	</div>
</div>