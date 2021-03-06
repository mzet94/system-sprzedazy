<?php
/**
 * Play repository.
 */
namespace AppBundle\Repository;

use AppBundle\Entity\Play;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * PlayRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlayRepository extends EntityRepository
{
    /**
     * Save entity.
     *
     * @param Play $play Play entity
     */
    public function save(Play $play)
    {
        $this->_em->persist($play);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Play $play Play entity
     */
    public function delete(Play $play)
    {
        $this->_em->remove($play);
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
        $paginator->setMaxPerPage(Play::NUM_ITEMS);
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
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->orderBy('p.title', 'ASC');

        return $qb;
    }
}
