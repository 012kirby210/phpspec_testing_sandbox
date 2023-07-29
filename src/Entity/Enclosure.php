<?php

namespace App\Entity;

use App\Exception\DinosaursAreRunningRampantException;
use App\Exception\NotABuffetException;

class Enclosure
{
    /**
     * @var Dinosaur[]
     */
    private $dinosaurs = [];

    /**
     * @var Security[]
     */
    private $securities = [];

    public function __construct(bool $withSecurity = false, array $initialDinosaurs = [])
    {
        if ( $withSecurity ){
            $this->addSecurity( new Security('Fency', true, $this));
        }

        foreach ( $initialDinosaurs as $dinosaur )
        {
            $this->addDinosaur($dinosaur);
        }
    }

    public function getDinosaurs(): array
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaur $dinosaur): Enclosure
    {

        if( !$this->isSecurityActive() ){
            throw new DinosaursAreRunningRampantException('Are you crazy ?');
        }

        if( !$this->canAddDinosaur($dinosaur) ){
            throw new NotABuffetException();
        }

        $this->dinosaurs[] = $dinosaur;
        return $this;
    }

    private function canAddDinosaur($dinosaur): bool
    {
        return count($this->dinosaurs) === 0
            || ($this->dinosaurs[0]->hasSameDietAs($dinosaur));
    }

    private function isSecurityActive(): bool
    {
        foreach ( $this->securities as $security ){
            if ( $security->getIsActive()){
                return true;
            }
        }
        return false;
    }

    public function addSecurity(Security $security)
    {
        $this->securities[] = $security;
    }
}
