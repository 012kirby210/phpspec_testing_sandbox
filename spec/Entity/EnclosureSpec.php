<?php

namespace spec\App\Entity;

use App\Entity\Dinosaur;
use App\Entity\Enclosure;
use App\Exception\DinosaursAreRunningRampantException;
use App\Exception\NotABuffetException;
use App\Factory\DinosaurFactory;
use PhpSpec\ObjectBehavior;

class EnclosureSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Enclosure::class);
    }

    function it_should_have_no_dino_by_default()
    {
        $this->getDinosaurs()->shouldHaveCount(0);
    }

    function it_should_be_able_to_add_dinosaurs()
    {
        $this->addDinosaur(new Dinosaur());
        $this->addDinosaur(new Dinosaur());

        $this->getDinosaurs()->shouldHaveCount(2);
    }

    function it_should_not_be_able_to_mix_carnivorous_and_non_carnivorous()
    {
        $this->addDinosaur(new Dinosaur('vegg-eater',true));

        $this->shouldThrow(NotABuffetException::class)
            ->during('addDinosaur',[new Dinosaur('herb eater',false)]);
    }

    function it_should_not_enclose_dinosaur_if_there_no_security()
    {
        $this->shouldThrow(new DinosaursAreRunningRampantException('Are you crazy ?'))
            ->duringAddDinosaur(new Dinosaur('Velociraptor',true));
    }
}
