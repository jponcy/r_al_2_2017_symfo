<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MangaRepository extends EntityRepository {

    public function findAll() {
        return $this->findBy([], ['name' => 'ASC']);
    }
}
