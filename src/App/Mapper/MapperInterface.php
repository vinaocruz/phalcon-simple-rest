<?php

namespace App\Mapper;

use App\Entity\AbstractEntity;

interface MapperInterface
{
    public function save(AbstractEntity $entity);

    public function update(AbstractEntity $entity);

    public function delete(AbstractEntity $entity);

    public function get($id);

    public function findAll($options = null);
}