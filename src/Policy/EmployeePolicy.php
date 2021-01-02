<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Employee;
use Authorization\IdentityInterface;
use Authorization\Policy\Result;

/**
 * Employee policy
 */
class EmployeePolicy
{
    /**
     * Check if $user can add Employee
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Employee $employee
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Employee $employee)
    {
    }

    /**
     * Check if $user can edit Employee
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Employee $employee
     * @return bool
     */
    public function canEdit(IdentityInterface $user = null, Employee $employee)
    {   
        dump($user);
        dump($employee);die;
        return true;
    }

    /**
     * Check if $user can delete Employee
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Employee $employee
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Employee $employee)
    {
        return true;
    }

    /**
     * Check if $user can view Employee
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Employee $employee
     * @return bool
     */
    public function canView(IdentityInterface $user, Employee $employee)
    {
        return true;
    }

    /**
     * Check if $user can view Employee
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Employee $employee
     * @return bool
     */
    public function canLogin(IdentityInterface $user = null)
    {   
        return true;
    }
}
