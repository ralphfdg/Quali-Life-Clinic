<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user against the database.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// Find the account by username
		$account = Account::model()->with('accountType')->find(
			'LOWER(username)=:username',
			array(':username' => strtolower($this->username))
		);

		if ($account === null) {
			// No user found
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if ($account->status_id != 1) {
			// User is not active
			$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
			$this->errorMessage = 'This account is inactive.';
		} else if (!$account->validatePassword($this->password)) {
			// Invalid password
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			// Authentication successful
			$this->errorCode = self::ERROR_NONE;

			// Store user's ID
			$this->_id = $account->id;

			// Store user's name (from the related user table, if exists)
			$userProfile = User::model()->find('account_id=:aid', array(':aid' => $account->id));
			$displayName = $userProfile ? $userProfile->firstname : $account->username;

			// Set user states (session variables)
			$this->setState('id', $account->id);
			$this->setState('username', $account->username);
			$this->setState('displayName', $displayName);
			$this->setState('role', $account->accountType->type); // e.g., "super admin", "doctor"

			// We use the Account ID as the target
			if(class_exists('AuditHelper')) {
                AuditHelper::log(
                    'LOGIN', 
                    'tbl_account', 
                    $account->id, 
                    'User logged in successfully.',
                    $account->id // <--- FORCE THE ACTOR ID HERE
                );
            }
		}

		return !$this->errorCode;
	}

	/**
	 * @return integer the ID of the user
	 */
	public function getId()
	{
		return $this->_id;
	}
}
