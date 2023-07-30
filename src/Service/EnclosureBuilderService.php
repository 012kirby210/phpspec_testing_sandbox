<?php

namespace App\Service;

use App\Entity\Enclosure;
use App\Entity\Security;
use App\Factory\DinosaurFactory;

class EnclosureBuilderService
{

    /**
     * @var DinosaurFactory
     */
    private $dinosaurFactory;
    private EntityManagerInterface $entityManager;

    /**
     * @param DinosaurFactory $factory
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(DinosaurFactory        $factory,
                                EntityManagerInterface $entityManager)
    {
        $this->dinosaurFactory = $factory;
        $this->entityManager = $entityManager;
    }

    public function buildeEnclosure(int $numberOfSecuritySystems = 1,
                                    int $numberOfDinosaurs = 3
    ): Enclosure
    {
        $enclosure = new Enclosure();

        $this->addSecuritySystems( $numberOfSecuritySystems, $enclosure);
        $this->addDinosaurs($numberOfDinosaurs, $enclosure);

        $this->entityManager->persist($enclosure);
        $this->entityManager->flush();

        return $enclosure;
    }

    private function addSecuritySystems(int $numberOfSecuritySystems, Enclosure $enclosure)
    {
        for ($i=0; $i < $numberOfSecuritySystems; $i++){
            $securityName = array_rand(['Fence','Electric fence', 'Guard tower']);
            $security = new Security($securityName,true, $enclosure);

            $enclosure->addSecurity($security);
        }
    }

    private function addDinosaurs(int $numberOfDinosaurs, Enclosure $enclosure)
    {
        for ($i=0; $i < $numberOfDinosaurs; $i++){
            $enclosure->addDinosaur($this->dinosaurFactory->growVelociraptor(5 + $i));
        }
    }
}
