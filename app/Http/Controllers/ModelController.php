<?php

namespace App\Http\Controllers;

abstract class ModelController extends Controller
{
    protected $guardedMethods = [];

    protected $methodsWithoutModels = [];

    protected abstract function getModelClass() : string;

    public function __construct()
    {
        $this->authorizeResource($this->getModelClass());
    }

    protected function resourceAbilityMap()
    {
        $base = parent::resourceAbilityMap();

        return \array_merge($base, $this->guardedMethods);
    }

    protected function resourceMethodsWithoutModels()
    {
        $base = parent::resourceMethodsWithoutModels();

        return \array_merge($base, $this->methodsWithoutModels);
    }
}
