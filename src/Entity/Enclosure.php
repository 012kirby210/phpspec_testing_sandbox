<?php

namespace App\Entity;

class Enclosure
{
    /**
     * @var @var Dinosaur[]
     */
    private $dinosaurs = [];
    public function getDinosaurs(): array
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaur $dinosaur): Enclosure
    {
        $this->dinosaurs[] = $dinosaur;
        return $this;
    }
}
