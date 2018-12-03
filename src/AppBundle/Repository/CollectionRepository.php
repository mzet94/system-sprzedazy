<?php
/**
 * Collection repository.
 */
namespace AppBundle\Repository;

use AppBundle\Entity\Collection;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * CollectionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CollectionRepository extends EntityRepository
{
    /**
     * Save entity.
     *
     * @param Collecton $collection Collecton entity
     */
    public function save(Collecton $collection)
    {
        $this->_em->persist($collection);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Collecton $collection Collecton entity
     */
    public function delete(Collecton $collection)
    {
        $this->_em->remove($collection);
        $this->_em->flush();
    }

    /**
     * Gets all records paginated.
     *
     * @param int $page Page number
     *
     * @return \Pagerfanta\Pagerfanta Result
     */
    public function findAllPaginated($page = 1)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($this->queryAll(), false));
        $paginator->setMaxPerPage(Collecton::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
    /**
     * Query all entities.
     *
     * @return \Doctrine\ORM\Query
     */
    protected function queryAll()
    {
        return $this->createQueryBuilder('collection');
    }
}
