<?php

namespace SRC\Service;

use SRC\Role;
use SRC\CurrentUser;
use SRC\RolesStorage;
use SRC\UsersStorage;
use SRC\Exception\DatabaseErrorException;
use SRC\Exception\UnauthorizedRequestException;

class Roles
{

    protected $rolesStorage;
    protected $userStorage;
    protected $currentUser;


    /**
     * Roles constructor.
     * @param RolesStorage $rolesStorage
     * @param UsersStorage $userStorage
     * @param CurrentUser $currentUser
     */
    public function __construct(
        RolesStorage $rolesStorage,
        UsersStorage $userStorage,
        CurrentUser $currentUser
    ) {
        $this->rolesStorage = $rolesStorage;
        $this->userStorage = $userStorage;
        $this->currentUser = $currentUser;
    }


    /**
     * @param integer $id
     * @return array
     */
    public function getById($id)
    {
        return $this->rolesStorage->getById($id)->toArray();
    }


    /**
     * @param string $sitename
     * @return array
     */
    public function getByDomain($sitename)
    {
        return $this->rolesStorage->fetchByDomain($sitename);
    }

    /**
     * @param string $name
     * @param boolean $manage_users
     * @param boolean $manage_roles
     * @param array $meta
     * @param string $sitename
     * @return array
     * @throws DatabaseErrorException
     */
    public function create($name, $manage_users, $manage_roles, $meta, $sitename)
    {
        $role = new Role(0, $name, $sitename, $manage_users, $manage_roles, json_encode($meta));
        if (!$roleId = $this->rolesStorage->create($role)
        ) {
            throw new DatabaseErrorException('db role creation fails', 500);
        }

        return $this->rolesStorage->getById($roleId)->toArray();
    }

    /**
     * @param string $name
     * @param boolean $manage_users
     * @param boolean $manage_roles
     * @param array $meta
     * @param string $sitename
     * @param integer $id
     * @return array
     * @throws DatabaseErrorException
     */
    public function update($name, $manage_users, $manage_roles, $meta, $sitename, $id)
    {
        $role = new Role($id, $name, $sitename, $manage_users, $manage_roles, json_encode($meta));
        if (!$this->rolesStorage->update($role)
        ) {
            throw new DatabaseErrorException('db role updating fails', 500);
        }

        return $this->rolesStorage->getById($id)->toArray();
    }

    /**
     * @param integer $id
     * @return bool
     * @throws DatabaseErrorException
     * @throws UnauthorizedRequestException
     */
    public function delete($id)
    {
        if ($this->currentUser->getDomain() != $this->rolesStorage->getById($id)->getDomain()) {
            throw new UnauthorizedRequestException('This role assigned to another domain', 401);
        }

        if (count($this->userStorage->fetchForRole($id))) {
            throw new DatabaseErrorException('User with this role exists', 500);
        }

        if (!$result = $this->rolesStorage->delete($id)) {
            throw new DatabaseErrorException('Role deletion fails', 500);
        }

        return true;
    }
}