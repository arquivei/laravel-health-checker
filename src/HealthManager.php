<?php

namespace Laravel\Health;

use Laravel\Health\Checkers\Checker;
use Laravel\Health\Exceptions\EmptyConfigException;
use Laravel\Health\Exceptions\LoaderFailureException;
use Laravel\Health\Exceptions\CheckerNotFoundException;

class HealthManager
{
    private $loader = false;

    private $checkers = array();

    public function eagerLoader(array $config): HealthManager
    {
        $this->validateConfigIsEmpty($config);

        $this->addCheckersFromConfig($config);

        $this->changeLoaderToSuccessState();

        return $this;
    }

    public function oneLoader(array $config, string $checker): HealthManager
    {
        $this->validateConfigIsEmpty($config);

        $this->validateConfigHasChecker($config, $checker);

        $this->addChecker($checker, $config);

        $this->changeLoaderToSuccessState();

        return $this;
    }

    public function getHealthStatus(): array
    {
        $this->isLoaded();

        return $this->checkers;
    }

    private function addCheckersFromConfig(array $config): void
    {
        foreach ($config['services'] as $key => $checker) {
            $this->addChecker($key, $config);
        }
    }

    private function addChecker(string $key, array $config): void
    {
        $this->checkers[$key] = (new Checker(new $config['services'][$key]()))
            ->setResources($config['resources'][$key])
            ->check();
    }

    private function validateConfigHasChecker(array $config, string $checker): void
    {
        if (!array_key_exists($checker, $config['services'])) {
            throw new CheckerNotFoundException();
        }
    }

    private function changeLoaderToSuccessState(): void
    {
        $this->loader = true;
    }

    private function validateConfigIsEmpty(array $config)
    {
        if (empty($config)) {
            throw new EmptyConfigException();
        }
    }

    private function isLoaded()
    {
        if (!$this->loader) {
            throw new LoaderFailureException();
        }
    }
}
