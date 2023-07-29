<?php

namespace spec\App\Entity;

use App\Entity\Dinosaur;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;

class DinosaurSpec extends ObjectBehavior
{
    public function getMatchers(): array
    {
        return [
          'returnZero' => function($subject){
            if ( $subject !== 0 ){
                throw new FailureException(sprintf(
                    'La valeur devrait être 0, ce fut "%s"',
                    $subject
                ));
            }
            return true;
          }
        ];
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Dinosaur::class);
    }

    function it_should_default_to_zero_length()
    {
        $this->getLength()->shouldReturn(0);
    }

    function it_should_default_to_zero_length_using_custom_matcher()
    {
        $this->getLength()->shouldReturnZero();
    }

    function it_should_allow_to_set_length()
    {
        $this->setLength(9);
        $this->getLength()->shouldReturn(9);
    }

    function it_should_not_shrink()
    {
        $this->setLength(15);
        $this->getLength()->shouldBeGreaterThan(12);
    }

    function it_should_return_full_description()
    {
        $this->getDescription()->shouldReturn('The Unknown non-carnivorous dinosaur is 0 meters long');
    }

    function it_should_return_full_description_for_tyrannosaurus()
    {
        $this->beConstructedWith('Tyrannosaurus', true);
        $this->setLength(12);

        $this->getDescription()->shouldReturn('The Tyrannosaurus carnivorous dinosaur is 12 meters long');
    }

    function it_grows_a_triceratops()
    {

    }

    function it_grows_a_small_velociraptor()
    {
        if (!class_exists('Nanny')){
            throw new SkippingException('omeone needs to look over dino puppies');
        }
    }

    function it_should_be_herbivore_by_default()
    {
        $this->shouldNotBeCarnivorous();
    }

    function it_should_be_allow_to_check_if_dinosaur_is_carnivorous()
    {
        $this->beConstructedWith("Valociraptor",true);
        $this->shouldBeCarnivorous();

    }

    function it_should_allow_to_check_if_two_dinosaurs_have_the_same_diet()
    {
        $this->shouldHaveSameDietAs(new Dinosaur());
    }
}
