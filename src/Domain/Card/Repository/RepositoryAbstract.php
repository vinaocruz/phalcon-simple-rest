<?php declare(strict_types = 1);

namespace MyStuff\Domain\Repository;

use MyStuff\Application;
use MyStuff\Domain\Entitie\EntityInterface;

abstract class RepositoryAbstract
{

    protected $connection;

    protected $entity;

    protected $wheres = [];

    public function __construct(EntityInterface $entity)
    {
        $app = new Application();

        $this->connection = $app['db'];

        $this->entity = $entity;

    }

    public function persist(EntityInterface $entityInterface)
    {
        $this->connection->persist($entityInterface);

    }

    public function flush()
    {
        $this->connection->flush();

        return $this->entity;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function getQuery()
    {
        return $this->getConnection()->getRepository(get_class($this->entity));
    }

    public function all(array $criterio = [], $page = 1, $count = 10)
    {

        return $this->getConnection()->createQueryBuilder(get_class($this->entity))
            ->where("function() { return ". $this->getWheres().";}")
            ->getQuery()
            ->execute();

    }

    public function where(string $field, string $criteria, string $value)
    {
        $this->wheres[] = [
            'query' => "this.{$field} {$criteria} '{$value}'",
            'operator' => "&&"
        ];
        return $this;
    }

    public function orWhere(string $field, string $criteria, string $value)
    {
        $this->wheres[] = [
            'query' => "this.{$field} {$criteria} '{$value}'",
            'operator' => "||"
        ];
        return $this;
    }

    public function getWheres()
    {
        $string = "";

        $arrayWhere = $this->wheresArray();

        foreach ($arrayWhere as $key => $where) {

            $string .= $where['query'];

            if ($key+1 < count($this->wheres)) {
                $string .= ' ' . $arrayWhere[$key+1]['operator'] . ' ';
            }
        }

        return $string;

    }

    public function wheresArray() : array
    {
        return $this->wheres;
    }

}