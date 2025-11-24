<?php

class WebUser extends CWebUser
{
    // This assumes UserIdentity sets: $this->setState('role', $account->accountType->type);

    public function isSuperAdmin()
    {
        return $this->getState('role') === 'super admin';
    }

    public function isAdmin()
    {
        // Check for 'admin' role (Secretary)
        return $this->getState('role') === 'admin';
    }

    public function isDoctor()
    {
        return $this->getState('role') === 'doctor';
    }

    public function isPatient()
    {
        return $this->getState('role') === 'patient';
    }
}
