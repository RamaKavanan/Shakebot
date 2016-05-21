<?php
require(__DIR__ . "/vendor/autoload.php");

// Load the payment libraries
Httpful\Bootstrap::init();
RESTful\Bootstrap::init();
Balanced\Bootstrap::init();

// Initialize our connection to API with our API key
Balanced\Settings::$api_key = "ak-test-FnGY0l2x8u5JsiD0MKYGoSd1r0DxYoSI";

// Connect to our marketplace
$marketplace = Balanced\Marketplace::mine();

// Create a customer with the submitted form data (Using the database to get the info)
$customer = new \Balanced\Customer(array(
  "name" => $name,
  "email" => $email,
));
$customer->save();

// Now we have to grab the card object and tell it that it belongs to this user
$card = \Balanced\Card::get($cardobject);
$card->associateToCustomer($customer);

// Now we create the order with the amount sent from the checkout
$debit = $card->debits->create(array(
    "amount" => $price,
    "appears_on_statement_as" => "Shakebot LLC payment",
    "description" => "Shakebot LLC payment",
));

$debit;

// And we echo to make sure it succeeded
echo $debit->status;

?>
