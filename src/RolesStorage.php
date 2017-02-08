<?php

namespace SRC;

use SRC\Exception\RoleNotFoundException;
use Doctrine\DBAL\Connection;

class RolesStorage
{

    protected $db;
    protected $roles;


    /**
     * RolesStorage constructor.
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }


    /**
     * @param integer $roleId
     * @return Role
     * @throws RoleNotFoundException
     */
    public function getById($roleId)
    {
        $role = $this->db->createQueryBuilder()
            ->select('id', 'name', 'role_domain', 'manage_users', 'manage_roles', 'meta')
            ->from('roles')
            ->where('id = :id')->setParameter('id', $roleId)
            ->execute()->fetch();
        if ($role) {
            return self::build($role);
        }
        throw new RoleNotFoundException('role doesn\'t exists', 500);
    }

    /**
     * @param array $role
     * @return Role
     */
    public static function build($role)
    {
        return new Role($role['id'], $role['name'], $role['role_domain'], $role['manage_users'], $role['manage_roles'],
            $role['meta']);
    }


    /**
     * @param string $domain
     * @return array
     */
    public function fetchByDomain($domain)
    {
        $results = $this->db->createQueryBuilder()
            ->select('id', 'name', 'role_domain', 'manage_users', 'manage_roles', 'meta')
            ->from('roles')
            ->where('role_domain = :role_domain')->setParameter('role_domain', $domain)
            ->groupBy('id')
            ->execute()->fetchAll();
        $roles = [];
        foreach ($results as $role) {
            $roles[] = (new Role($role['id'], $role['name'], $role['role_domain'], $role['manage_users'],
                $role['manage_roles'], $role['meta']))->toArray();
        }
        return $roles;
    }


    /**
     * @param Role $role
     * @return bool|string
     */
    public function create(Role $role)
    {
        return ($this->db->insert('roles', [
            'name' => $role->getName(),
            'role_domain' => $role->getDomain(),
            'manage_users' => $role->canManageUsers(),
            'manage_roles' => $role->canManageRoles(),
            'meta' => $role->getRawMeta()
        ])) ? $this->db->lastInsertId() : false;
    }


    /**
     * @param Role $role
     * @return int
     */
    public function update(Role $role)
    {
        $data = [
            'name' => $role->getName(),
            'role_domain' => $role->getDomain(),
            'manage_users' => $role->canManageUsers(),
            'manage_roles' => $role->canManageRoles(),
            'meta' => $role->getRawMeta()
        ];
        $identifier = [
            'id' => $role->getId(),
        ];
        return $this->db->update('roles', $data, $identifier);
    }


    /**
     * @param integer $id
     * @return int
     */
    public function delete($id)
    {
        return $this->db->delete('roles', ['id' => $id]);
    }

}