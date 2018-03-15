<?php

namespace Laravel\Health\Checkers;

use Laravel\Health\Contracts\Checker;

abstract class BaseChecker implements Checker, \JsonSerializable
{
    protected $healthful = true;

    protected $message;

    protected $resources = array();

    public function getResources() : array
    {
        return $this->resources;
    }

    public function setResources(array $resource) : Checker
    {
        $this->resources = $resource;
        return $this;
    }

    public function addResource(string $resource) : Checker
    {
        array_push($this->resources, $resource);
        return $this;
    }

    public function isHealthful() : bool
    {
        return $this->healthful;
    }

    public function setHealthful(bool $healthful) :  Checker
    {
        $this->healthful = $healthful;
        return $this;
    }

    public function getMessage() : ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message) : Checker
    {
        $this->message = $message;
        return $this;
    }

    public function makeResponse(?string $message, bool $healthful = true) : Checker
    {
        $this->setHealthful($healthful);
        $this->setMessage($message);

        return $this;
    }

    public function getResponse() : array
    {
        return [
            'is_healthful' => $this->isHealthful(),
            'message' => $this->getMessage()
        ];
    }

    public function jsonSerialize()
    {
        return $this->getResponse();
    }
}
