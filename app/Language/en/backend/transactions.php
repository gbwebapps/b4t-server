<?php

return [
	'title' => [
		'list' => 'Transactions list', 
		'add' => 'Add transaction', 
		'show' => 'Show transaction', 
	], 
	'form' => [
		'organizerIdField' => 'Organizer', 
		'organizersSelect' => '--- Select an organizer ---', 
		'reasonCodeField' => 'Transaction reasons', 
		'reasonCodeSelect' => '--- Select a transaction reason ---', 
		'addCoins' => '+ Deposit coins', 
		'removeCoins' => '- Withdraw coins', 
		'amountField' => 'Amount', 
		'amountPlaceholder' => 'Put here the coins amount...', 
		'reasonDeposit' => '+ Coins deposit', 
		'reasonWithdraw' => '- Coins withdraw', 
		'reasonFirstDeposit' => '+ First coins deposit', 
		'eventWithdraw' => '- Event coins withdraw', 
	], 
	'showAll' => [
		'idColumn' => 'ID', 
		'organizerColumn' => 'Organizer', 
		'reasonColumn' => 'Transaction reasons', 
		'amountColumn' => 'Amount', 
		'currentBalanceColumn' => 'Balance', 
		'idLabel' => 'ID', 
		'idPlaceholder' => 'Search by ID...', 
		'organizerIdLabel' => 'Organizer', 
		'organizerIdSelect' => '--- Select an organizer ---', 
		'eventIdLabel' => 'Event', 
		'eventIdSelect' => '--- Select an event ---', 
		'reasonCodeLabel' => 'Transaction reasons', 
		'reasonCodeSelect' => '--- Select a transaction reason ---', 
	], 
	'messages' => [
		'insertSuccess' => 'Transaction with ID <b>{0}</b>, has been added successfully!', 
		'insertFail' => 'There was an error in attempting to add the transaction!', 
	], 
	'links' => [
		'backToList' => 'Back to Transaction list', 
	]
];
