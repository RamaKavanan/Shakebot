

<div class="row">
	<img src="img/ShakeBot_Final_72.png" class="fullLogo" />

<div class="content">
<h2>Contact Us</h2>
<form id="sendMail">
	<input name="email" value="<?php echo $loggedInUser->email; ?>" placeholder="Enter your email address" /><br /><br />
	<input name="subject" value="" placeholder="Subject" /><br /><br />
	<textarea name="message" value="" placeholder="Write your message"></textarea><br />
</form>
<button class="btn btn-primary" id="sendMailButton"><span class="fa fa-envelope"> </span> &nbsp; Send Message</button>
</div>
</div>