<?php
namespace DMS\Bundle\LauncherBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * PreUser Entity Service
 */
class PreUserService
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $entityRepository;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository('DMSLauncherBundle:PreUser');
    }

    /**
     * Get the PreUser
     *
     * @param $id
     * @return object
     */
    public function get($id)
    {
        return $this->entityRepository->find($id);
    }

    /**
     * Inserts/Updates an User
     *
     * @param \DMS\Bundle\LauncherBundle\Entity\PreUser $preUser
     */
    public function save($preUser)
    {
        $this->entityManager->persist($preUser);
        $this->entityManager->flush();
    }

    /**
     * Get all preUsers
     *
     * @return array
     */
    public function getAll()
    {
       return $this->entityRepository->findAll();
    }

    /**
     * Creates a new PreUser
     *
     * @param \DMS\Bundle\LauncherBundle\Entity\PreUser $preUser
     * @return mixed
     */
    public function create($preUser)
    {
        $preUser->setRegisteredOn(new \DateTime('now'));
        $this->save($preUser);

        //Generate Token based on ID assigned
        $preUser->setToken(base_convert($preUser->getId() + 100000000, 10, 32));
        $this->save($preUser);

        return $preUser;
    }
}
