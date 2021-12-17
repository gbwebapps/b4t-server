<div class="col-md-10 offset-md-1">
	<form id="contactForm" method="post" class=" my-4">
		<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="contacts_firstname">
						<?= lang('frontend/contacts.contactsForm.firstnameField'); ?>
					</label>
					<input type="text" name="contacts_firstname" id="contacts_firstname" class="form-control" 
					autocomplete="off" placeholder="<?= lang('frontend/contacts.contactsForm.firstnamePlaceholder'); ?>" autofocus>
					<div class="error_contacts_firstname text-danger font-weight-bold pt-1"></div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="contacts_lastname">
						<?= lang('frontend/contacts.contactsForm.lastnameField'); ?>
					</label>
					<input type="text" name="contacts_lastname" id="contacts_lastname" class="form-control" 
					autocomplete="off" placeholder="<?= lang('frontend/contacts.contactsForm.lastnamePlaceholder'); ?>">
					<div class="error_contacts_lastname text-danger font-weight-bold pt-1"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="contacts_email">
						<?= lang('frontend/contacts.contactsForm.emailField'); ?>
					</label>
					<input type="text" name="contacts_email" id="contacts_email" class="form-control" 
					autocomplete="off" placeholder="<?= lang('frontend/contacts.contactsForm.emailPlaceholder'); ?>">
					<div class="error_contacts_email text-danger font-weight-bold pt-1"></div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="contacts_phone">
						<?= lang('frontend/contacts.contactsForm.phoneField'); ?>
					</label>
					<input type="text" name="contacts_phone" id="contacts_phone" class="form-control" 
					autocomplete="off" placeholder="<?= lang('frontend/contacts.contactsForm.phonePlaceholder'); ?>">
					<div class="error_contacts_phone text-danger font-weight-bold pt-1"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="contacts_message">
						<?= lang('frontend/contacts.contactsForm.messageField'); ?>
					</label>
					<textarea name="contacts_message" id="contacts_message" cols="30" rows="10" class="form-control" 
					autocomplete="off" placeholder="<?= lang('frontend/contacts.contactsForm.messagePlaceholder'); ?>"></textarea>
					<div class="error_contacts_message text-danger font-weight-bold pt-1"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 text-left pt-2">
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="contacts_authorize" name="contacts_authorize" value="1">
					<label class="form-check-label" for="contacts_authorize"><?= lang('frontend/contacts.contactsForm.authorizePlaceholder'); ?></label>
					<div class="error_contacts_authorize text-danger font-weight-bold pt-1"></div>
				</div>
			</div>
			<div class="col-md-6 text-right">
				<div class="form-group">
					<button class="btn btn-primary"><?= lang('frontend/global.buttons.sendData'); ?></button>
				</div>
			</div>
		</div>
	</form>
</div>