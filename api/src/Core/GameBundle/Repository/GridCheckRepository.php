<?php

namespace Core\GameBundle\Repository;

use Core\GameBundle\Entity\Grid;
use Doctrine\ORM\EntityRepository;

/**
 * GridCheckRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GridCheckRepository extends \Belka\BizlayBundle\Repository\AbstractRepository
{
    /**
     * Get the Grid by an checked position.
     *
     * @param Grid $grid
     * @param $colpos
     * @param $rowpos
     *
     * @return Grid
     */
    public function getGridByPos(Grid $grid, $colpos, $rowpos)
    {
        $qb = $this->createQueryBuilder('gc');

        $qb
            ->join('gc.grid', 'g')
            ->where($qb->expr()->eq('gc.colPos', ':colPos'))
            ->andWhere($qb->expr()->eq('gc.rowPos', ':rowPos'))
            ->andWhere($qb->expr()->eq('gc.grid', ':grid'))
            ->andWhere($qb->expr()->eq('gc.isActive', ':true'))
            ->andWhere($qb->expr()->eq('g.isActive', ':true'))
            ->setParameters(array(
                'colPos' => $colpos,
                'rowPos' => $rowpos,
                'grid' => $grid,
                'true' => true
            ))
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
