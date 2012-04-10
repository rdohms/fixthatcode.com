<?php
namespace FTC\Bundle\CodeBundle\Service;

use FTC\Bundle\CoreBundle\Service\EntityService;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CodeEntry Service
 *
 * Handles requests for Code Entries
 */
class CodeEntryService extends EntityService
{

    protected $entityClass = "FTC\Bundle\CodeBundle\Entity\CodeEntry";

    /**
     * Return latest entries
     *
     * @param int $max
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getLatest($max = 10)
    {
        return new ArrayCollection($this->entityRepository->getLatest($max));
    }

    /**
     * Return a QueryBuilder for this entity
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->entityRepository->createQueryBuilder('e');
    }

}
