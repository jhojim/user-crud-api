<?php

namespace SRC;

use SRC\Exception\UnauthorizedRequestException;

class CurrentUser
{
    protected $usersStorage;
    private $user;

    /**
     * CurrentUser constructor.
     * @param UsersStorage $usersStorage
     */
    public function __construct(UsersStorage $usersStorage)
    {
        $this->usersStorage = $usersStorage;
    }

    /**
     * @param string $email
     * @param string $domain
     * @throws UnauthorizedRequestException
     */
    public function initialize($email, $domain = '')
    {
        if (empty($domain)) {
            $domains = $this->usersStorage->fetchForEmail($email);
            if (empty($domains)) {
                throw new UnauthorizedRequestException('Access denied', 401);
            }
            $this->user = new User($email, '', 0, '', new Role(0, '', '', false, false));
        } else {
            $this->user = $this->usersStorage->fetch($email, $domain);
        }
    }

    /**
     * @return string
     */
    public function getRoleId()
    {
        return $this->user->getRoleId();
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->user->getRole();
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->user->getEmail();
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->user->getDomain();
    }

    /**
     * @throws UnauthorizedRequestException
     */
    public function canGetUsers()
    {
        if (!$this->user->getRole()->canManageUsers()) {
            throw new UnauthorizedRequestException('Access denied', 401);
        }
    }

    /**
     * @throws UnauthorizedRequestException
     */
    public function canManageRoles()
    {
        if (!$this->user->getRole()->canManageRoles()) {
            throw new UnauthorizedRequestException('You haven\'t permission to manage roles', 401);
        }
    }

    /**
     * @param User $newUser
     * @throws UnauthorizedRequestException
     */
    public function canManageUsers(User $newUser)
    {
        if (!$this->user->getRole()->canManageUsers()) {
            throw new UnauthorizedRequestException('You haven\'t permission to manage users', 401);
        }
        if ($newUser->getRole()->canManageRoles() && !$this->user->getRole()->canManageRoles()) {
            throw new UnauthorizedRequestException('Access denied', 401);
        }
        if ($newUser->getRole()->getDomain() != $this->user->getRole()->getDomain()) {
            throw new UnauthorizedRequestException('This role assigned to another domain', 401);
        }
    }
}