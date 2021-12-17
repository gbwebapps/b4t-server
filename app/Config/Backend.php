<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Backend extends BaseConfig
{
    /**
     * @var string
     * The name of the application
     */
    public $applicationName = 'Book4Track';

    /**
     * @var string
     * The main email of the application
     */
    public $applicationEmail = 'gbwebapps@gmail.com';

    /**
     * @var int
     * How many records we list in Show All pages
     */
    public $rowsPerPage = 5;
}