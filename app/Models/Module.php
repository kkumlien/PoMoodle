<?php

namespace App\Models;


class Module
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $instance;

    /**
     * @var int
     */
    public $visible;

    /**
     * @var int
     */
    public $visibleoncoursepage;

    /**
     * @var string
     */
    public $modicon;

    /**
     * @var string
     */
    public $modname;

    /**
     * @var string
     *
     */
    public $modplural;

    /**
     * @var CompletionStatus
     */
    public $completionStatus;


}