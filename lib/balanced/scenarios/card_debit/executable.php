<?php

require(__DIR__ . '/vendor/autoload.php');

Httpful\Bootstrap::init();
RESTful\Bootstrap::init();
Balanced\Bootstrap::init();

Balanced\Settings::$api_key = "ak-test-19GwHG7jYR8FFKR9rBIVyiY1uXBemYVov";

$card = Balanced\Card::get("/cards/CC3KykwD9fCcY10zNx28tJrG");
$card->debits->create(array(
    "amount" => "5000",
    "appears_on_statement_as" => "Statement text",
    "description" => "Some descriptive text for the debit in the dashboard",
));

?>