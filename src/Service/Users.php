<?php

namespace SRC\Service;

use SRC\CurrentUser;
use SRC\Exception\UserNotFoundException;
use SRC\RolesStorage;
use SRC\UsersStorage;
use SRC\Exception\DatabaseErrorException;
use SRC\User;

class Users
{
    protected $user;
    protected $usersStorage;
    protected $rolesStorage;
    protected $currentUser;


    /**
     * Users constructor.
     * @param UsersStorage $usersStorage
     * @param RolesStorage $rolesStorage
     * @param CurrentUser $currentUser
     */
    public function __construct(
        UsersStorage $usersStorage,
        RolesStorage $rolesStorage,
        CurrentUser $currentUser
    ) {
        $this->usersStorage = $usersStorage;
        $this->rolesStorage = $rolesStorage;
        $this->currentUser = $currentUser;
    }

    /**
     * @param string $sitename
     * @return array
     */
    public function getByDomain($sitename)
    {
        $this->currentUser->canGetUsers();
        return $this->usersStorage->fetchForDomain($sitename);
    }

    /**
     * @param string $email
     * @return array
     */
    public function getByEmail($email)
    {
        return [
            'email' => $email,
            'domains' => $this->usersStorage->fetchForEmail($email)
        ];
    }


    /**
     * @param string $email
     * @param array $meta
     * @param integer $roleId
     * @param string $sitename
     * @return array
     * @throws DatabaseErrorException
     */
    public function create($email, $meta, $roleId, $sitename)
    {
        $user = $this->buildUser($email, $meta, $roleId, $sitename);

        try {
            $this->usersStorage->fetch($user->getEmail(), $sitename);
        }
        catch (UserNotFoundException $exception) {
            if (!$this->usersStorage->create($user)) {
                throw new DatabaseErrorException('db user creation fails', 500);
            }
            return $user->toArray();
        }
        throw new DatabaseErrorException('user already exists', 500);
    }

    /**
     * @param string $email
     * @param array $meta
     * @param integer $roleId
     * @param string $sitename
     * @return User
     * @throws DatabaseErrorException
     */
    private function buildUser($email, $meta, $roleId, $sitename)
    {
        $role = $this->rolesStorage->getById($roleId);

        if (!$role) {
            throw new DatabaseErrorException('role doesn\'t exists', 500);
        }

        $user = new User($email, $sitename, $roleId,
            json_encode($meta), $role);

        $this->currentUser->canManageUsers($user);

        return $user;
    }

    /**
     * @param string $email
     * @param array $meta
     * @param integer $roleId
     * @param string $sitename
     * @return array
     * @throws DatabaseErrorException
     */
    public function update($email, $meta, $roleId, $sitename)
    {
        $user = $this->buildUser($email, $meta, $roleId, $sitename);

        $this->usersStorage->fetch($user->getEmail(), $sitename);

        if (!$this->usersStorage->update($user)) {
            throw new DatabaseErrorException('db user updating fails', 500);
        }

        return $this->usersStorage->fetch($user->getEmail(), $sitename)->toArray();
    }

    /**
     * @param string $email
     * @param string $sitename
     * @return bool
     * @throws DatabaseErrorException
     */
    public function delete($email, $sitename)
    {
        $user = $this->usersStorage->fetch($email, $sitename);

        $this->currentUser->canManageUsers($user);

        if (!$this->usersStorage->unAttach($user)) {
            throw new DatabaseErrorException('User deletion fails', 500);
        }

        return true;
    }
}