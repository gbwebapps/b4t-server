<?php 

namespace App\Models\frontend;

class ContactsModel extends FrontendModel 
{
	protected $table = 'contacts';
	protected $primaryKey = 'contacts_id';

	protected $allowedFields = ['contacts_firstname', 
								'contacts_lastname', 
								'contacts_email', 
								'contacts_phone', 
								'contacts_message'];

	protected $selectGetID = '*';

	protected $controller = 'contacts';

	public $validationRules = [
		'contacts_firstname' => [
			'label'  => 'frontend/contacts.contactsForm.firstnameField',
			'rules'  => 'required' //  filtro per stringa'
		], 
		'contacts_lastname' => [
			'label'  => 'frontend/contacts.contactsForm.lastnameField',
			'rules'  => 'required' //  filtro per stringa'
		],
		'contacts_email' => [
			'label'  => 'frontend/contacts.contactsForm.emailField',
			'rules'  => 'required|valid_email' //  filtro per stringa'
		],
		'contacts_phone' => [
			'label'  => 'frontend/contacts.contactsForm.phoneField',
			'rules'  => 'required' //  filtro per stringa'
		],
		'contacts_message' => [
			'label'  => 'frontend/contacts.contactsForm.messageField',
			'rules'  => 'required' //  filtro per stringa'
		],
		'contacts_authorize' => [
			'label'  => 'frontend/contacts.contactsForm.authorizeField',
			'rules'  => 'required|in_list[1]' //  filtro per stringa'
		],
	];

	public function add(Array $posts): Array
	{
		$this->db->transBegin();

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			$posts['contacts_created_at'] = date('Y-m-d H:i:s');

			$this->builder->insert($posts);
			$id = $this->db->insertID();

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('frontend/contacts.messages.insertFail')];
        else:
            $this->db->transCommit();
            $contact = $this->getID($id);
            // qui si invia la mail all'amministratore per avvertirlo che abbiamo un contatto
            return ['result' => true, 'message' => lang('frontend/contacts.messages.insertSuccess', [esc($contact->contacts_firstname), esc($contact->contacts_lastname)])];
        endif;
	}
}