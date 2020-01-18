<?php

namespace BisonLab\SugarCrmBundle\Manager;

use BisonLab\NoOrmBundle\Manager\BaseManager;

class ProductCategory extends BaseManager
{
  // The MongoDB Collection name, should be the same as the base model name.
  protected static $_collection = 'ProductCategories';
  protected static $_model       = '\BisonLab\SugarCrmBundle\Model\ProductCategory';

    public function __construct($access_service, $options = array())
    {
        $options['model'] = self::$_model;
        $options['entity_resource'] = $options['new_entity_resource'] = self::$_collection;
        $options['collection_resource'] = self::$_collection;

        parent::__construct($access_service, $options);
    }
}
