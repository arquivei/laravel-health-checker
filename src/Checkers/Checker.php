<?php

namespace Laravel\Health\Checkers;

class Checker
{
    private $checker;

    public function __construct(\Laravel\Health\Contracts\Checker $checker)
    {
        $this->checker = $checker;
    }

    public function check()
    {
        return $this->checker->check();
    }

    public function setResources(array $resources) : Checker
    {
        $this->checker->setResources($resources);
        return $this;
    }
}
