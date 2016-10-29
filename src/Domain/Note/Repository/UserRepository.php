<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 03/08/16
 * Time: 13:44
 */

namespace MyStuff\Domain\Repository;

use MyStuff\Domain\Entitie\User;
use MyStuff\Exception\UserNotFoundException;

class UserRepository extends RepositoryAbstract
{

    /**
     * @var User
     */
    private $user;

    /**
     * RepositoryUsuario constructor.
     * @param User $user
     * @internal param Usuario $usuario
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct($user);
    }

    public function save(array $input)
    {
        $this->user
             ->setNome($input['nome'])
             ->setEmail($input['email'])
             ->setNomeUsuario($input['nomeUsuario'])
             ->setApelido($input['apelido'])
             ->setSenha($input['senha'])
             ->setAdministrador($input['administrador']);

        $this->persist($this->user);
        $this->flush();

        return $this->user;
    }

    public function update(string $id, array $input)
    {
        $this->user = $this->getQuery()->find($id);

        $this->user
            ->setNome($input['nome'])
            ->setEmail($input['email'])
            ->setNomeUsuario($input['nomeUsuario'])
            ->setApelido($input['apelido'])
            ->setSenha($input['senha'])
            ->setAdministrador($input['administrador']);

        $this->persist($this->user);
        $this->flush();

        return $this->user;
    }

    public function find(string $id)
    {
        $user = $this->getQuery()->find($id);

        if ($user == null) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function remove($id)
    {
        $user = $this->find($id);

        $this->getConnection()->remove($user);

        $this->flush();

        return true;
    }






}