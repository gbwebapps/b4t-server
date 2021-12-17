<?php

return [
	'title' => [
		'list' => 'Comments list', 
		'add' => 'Add comment', 
		'edit' => 'Edit comment', 
		'show' => 'Show comment', 
	], 
	'form' => [
		'titleField' => 'Title', 
		'titlePlaceholder' => 'Enter here the title...', 
		'eventField' => 'Event', 
		'eventIdSelect' => '--- Select an event ---', 
		'contentField' => 'Content', 
		'contentPlaceholder' => 'Enter here the content...', 
		'memberField' => 'Member', 
	], 
	'show' => [
		'idLabel' => 'ID', 
		'titleLabel' => 'Title', 
	], 
	'showAll' => [
		'idColumn' => 'ID', 
		'titleColumn' => 'Title', 
		'memberColumn' => 'Member', 
		'eventColumn' => 'Event', 
		'idLabel' => 'ID', 
		'idPlaceholder' => 'Search by ID...', 
		'titleLabel' => 'Title', 
		'titlePlaceholder' => 'Search by title...', 
		'memberIdLabel' => 'Member', 
		'memberIdSelect' => '--- Select a member ---', 
		'eventIdSelect' => '--- Select an event ---', 
	], 
	'messages' => [
		'insertSuccess' => '<b>{0}</b> comment, with ID <b>{1}</b>, has been added successfully!', 
		'insertFail' => 'There was an error in attempting to add the comment!', 
		'updateSuccess' => '<b>{0}</b> comment, with ID <b>{1}</b>, has been updated successfully!', 
		'updateFail' => 'There was an error in attempting to edit the comment!', 
		'updateNotChanged' => 'There are no changes about <b>{0}</b> comment!',
		'deleteSuccess' => '<b>{0}</b> comment, with ID <b>{1}</b>, has been deleted successfully!', 
		'deleteFail' => 'There was an error in attempting to delete the comment!', 
		'deleteConfirm' => 'Are you sure to delete {0} comment?',
		'restoreSuccess' => '<b>{0}</b> comment, with ID <b>{1}</b>, has been restored successfully!', 
		'restoreFail' => 'There was an error in attempting to restore the comment!', 
		'restoreConfirm' => 'Are you sure to restore {0} comment?',
		'statusActiveConfirm' => 'Are you sure to activate {0} comment?',
		'statusInactiveConfirm' => 'Are you sure to inactivate {0} comment?',
		'statusActiveSuccess' => '<b>{0}</b> comment, with ID <b>{1}</b>, has been activated!', 
		'statusActiveFail' => 'There was an error in attempting to activate this comment!', 
		'statusInactiveSuccess' => '<b>{0}</b> comment, with ID <b>{1}</b>, has been inactivated!', 
		'statusInactiveFail' => 'There was an error in attempting to inactivate this comment!', 
	], 
	'links' => [
		'backToList' => 'Back to Comment list', 
	]
];
