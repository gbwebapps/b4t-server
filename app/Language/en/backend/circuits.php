<?php

return [
	'title' => [
		'main' => 'Circuits section', 
		'list' => 'Circuits list', 
		'add' => 'Add circuit', 
		'edit' => 'Edit circuit', 
		'show' => 'Show circuit', 
	], 
	'form' => [
		'circuitField' => 'Circuit', 
		'circuitPlaceholder' => 'Enter here the circuit name...', 
		'addressField' => 'Address', 
		'addressPlaceholder' => 'Enter here the circuit address...', 
		'emailField' => 'Email', 
		'emailPlaceholder' => 'Enter here the circuit email...', 
		'phoneField' => 'Phone', 
		'phonePlaceholder' => 'Enter here the circuit phone...', 
		'logoField' => 'Circuit logo', 
		'openingTimeField' => 'Opening time', 
		'openingTimeFieldPlaceholder' => 'Enter here the circuit opening time...', 
		'shortDescriptionField' => 'Short description', 
		'shortDescriptionFieldPlaceholder' => 'Enter here the circuit short description...', 
		'longDescriptionField' => 'Long description', 
		'longDescriptionFieldPlaceholder' => 'Enter here the circuit long description...', 
		'filesField' => 'Circuit files', 
		'typesField' => 'Circuit types', 
		'servicesField' => 'Circuit services', 
		'typesSelect' => '--- Select a circuit type ---'
	], 
	'formHeader' => [], 
	'formImage' => [], 
	'formMetaTags' => [], 
	'showAll' => [
		'idColumn' => 'ID', 
		'circuitColumn' => 'Circuit', 
		'emailColumn' => 'Email', 
		'phoneColumn' => 'Phone', 
		'idLabel' => 'ID', 
		'idPlaceholder' => 'Search by ID...', 
		'circuitLabel' => 'Circuit', 
		'circuitPlaceholder' => 'Search by circuit...', 
		'emailLabel' => 'Email', 
		'emailPlaceholder' => 'Search by email...', 
		'phoneLabel' => 'Phone', 
		'phonePlaceholder' => 'Search by phone...', 
	], 
	'messages' => [
		'insertSuccess' => '<b>{0}</b> circuit, with ID <b>{1}</b>, has been added successfully!', 
		'insertFail' => 'There was an error in attempting to add the circuit!', 
		'updateSuccess' => '<b>{0}</b> circuit, with ID <b>{1}</b>, has been updated successfully!', 
		'updateFail' => 'There was an error in attempting to edit the circuit!', 
		'updateNotChanged' => 'There are no changes about <b>{0}</b> circuit!',
		'deleteSuccess' => '<b>{0}</b> circuit, with ID <b>{1}</b>, has been deleted successfully!', 
		'deleteFail' => 'There was an error in attempting to delete the circuit!', 
		'deleteConfirm' => 'Are you sure to delete {0} circuit?',
		'restoreSuccess' => '<b>{0}</b> circuit, with ID <b>{1}</b>, has been restored successfully!', 
		'restoreFail' => 'There was an error in attempting to restore the circuit!', 
		'restoreConfirm' => 'Are you sure to restore {0} circuit?',
	], 
	'links' => [
		'backToList' => 'Back to Circuit list', 
	], 
	'buttons' => [
		'addTypesServices' => 'Add the circuit types and the related services'
	], 
	'panels' => [
		'typesAndServices' => 'Circuits types and services',
	], 
	'errors' => [
		'typesError' => 'Circuit types missing', 
		'servicesError' => 'Circuit services missing', 
	]
];