<?php

namespace BisonLab\SugarCrmBundle\Manager;

use BisonLab\NoOrmBundle\Manager\BaseManager;
use BisonLab\NoOrmBundle\Services\SugarCrmRestReadonly;

class Product extends BaseManager
{

    protected static $_collection = 'Products';
    protected static $_model      = '\BisonLab\SugarCrmBundle\Model\Account';

    public function __construct(
        protected SugarCrmRestReadonly $sugarCrm,
    ) {
        $options['model'] = self::$_model;
        $options['entity_resource'] = $options['new_entity_resource'] = self::$_collection;
        $options['collection_resource'] = self::$_collection;

        parent::__construct($sugarCrm, $options);
    }
}
