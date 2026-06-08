<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Routing extends BaseConfig
{
    public string $directory = 'Controllers';
    public string $controller = 'Worker';
    public string $defaultMethod = 'index';
    public string $defaultNamespace = 'App\\Controllers';
    public string $defaultController = 'Worker';
    public bool $translateURIDashes = false;
    public bool $override404 = false;
    public bool $autoRoute = true;
    public array $routeFiles = [];
    public bool $prioritize = false;
}
