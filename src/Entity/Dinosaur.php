<?php

namespace App\Entity;

class Dinosaur
{
    private $length = 0;
    private string $genus;
    private bool $carnivorous;


    public function __construct(string $genus = 'Unknown', bool $carnivorous = false)
    {

        $this->genus = $genus;
        $this->carnivorous = $carnivorous;
    }

    public static function growVelociraptor(int $length) :self
    {
        $dinossaur = new static('Velociraptor', true);
        $dinossaur->setLength($length);

        return $dinossaur;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
    }

    public function getDescription()
    {
        return sprintf(
            'The %s %scarnivorous dinosaur is %d meters long',
            $this->genus,
            $this->carnivorous ? '' : 'non-',
            $this->getLength()
        )
            ;
    }

    public function getGenus(): string
    {
        return $this->genus;
    }
}
