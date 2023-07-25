<?php

namespace spec\Matcher;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\BasicMatcher;

final class BeGreaterMatcher extends BasicMatcher
{

    protected function matches($subject, array $arguments): bool
    {
        return $subject > $arguments[0];
    }

    protected function getFailureException(string $name, $subject, array $arguments): FailureException
    {
        throw new FailureException(sprintf(
            'La valeur devrait être 0, ce fut "%s"',
            $subject
        ));
    }

    protected function getNegativeFailureException(string $name, $subject, array $arguments): FailureException
    {
        throw new FailureException(sprintf(
            'La valeur ne devrait pas être 0, ce fut "%s"',
            $subject
        ));
    }

    public function supports(string $name, $subject, array $arguments): bool
    {
        return in_array( $name, ['beGreater','beGreaterThan'])
            && is_numeric($subject)
            && count($arguments) === 1
            && is_numeric($arguments[0]);
    }
}