<?php

namespace SRC;

class Role
{
    protected $id;
    protected $name;
    protected $roleDomain;
    protected $manageUsers;
    protected $manageRoles;
    protected $meta;

    /**
     * Role constructor.
     * @param integer $id
     * @param string $name
     * @param string $roleDomain
     * @param boolean $manageUsers
     * @param boolean $manageRoles
     * @param string $meta
     */
    public function __construct(
        $id,
        $name,
        $roleDomain,
        $manageUsers,
        $manageRoles,
        $meta = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->roleDomain = $roleDomain;
        $this->manageUsers = $manageUsers;
        $this->manageRoles = $manageRoles;
        $this->meta = $meta;
    }

    /**
     * @param array $fileds
     * @return array
     */
    public function toArray($fileds = [])
    {
        $roles = [
            'name' => $this->getName(),
            'manage_users' => $this->canManageUsers(),
            'manage_roles' => $this->canManageRoles(),
            'meta' => $this->getMeta()
        ];
        return array_diff_key($roles, array_flip($fileds));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function canManageUsers()
    {
        return $this->manageUsers;
    }

    /**
     * @return bool
     */
    public function canManageRoles()
    {
        return $this->manageRoles;
    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return json_decode($this->meta);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->roleDomain;
    }

    /**
     * @return string
     */
    public function getRawMeta()
    {
        return $this->meta;
    }

}