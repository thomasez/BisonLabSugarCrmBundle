<?php

namespace BisonLab\SugarCrmBundle\Manager;

use BisonLab\NoOrmBundle\Manager\BaseManager;
use BisonLab\NoOrmBundle\Services\SugarCrmRestReadonly;

class ProductTemplate extends BaseManager
{

    protected static $_collection = 'ProductTemplates';
    protected static $_model      = '\BisonLab\SugarCrmBundle\Model\ProductTemplate';

    public function __construct(
        protected SugarCrmRestReadonly $sugarCrm,
    ) {
        $options['model'] = self::$_model;
        $options['entity_resource'] = $options['new_entity_resource'] = self::$_collection;
        $options['collection_resource'] = self::$_collection;

        parent::__construct($sugarCrm, $options);
    }
}
