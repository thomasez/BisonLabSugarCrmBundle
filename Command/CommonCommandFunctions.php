<?php

namespace BisonLab\SugarCrmBundle\Command;

use Symfony\Component\Console\Command\Command;

trait CommonCommandFunctions 
{
    // Better get autowiring of the noorm managers for sure.
    public function __construct($sugar_wrapper, $sugarcrm_account_manager, $sugarcrm_product_manager, $sugarcrm_product_category_manager, $sugarcrm_product_template_manager)
    {
        $this->sugar_wrapper =  $sugar_wrapper;
        $this->sugarcrm_account_manager = $sugarcrm_account_manager;
        $this->sugarcrm_product_manager = $sugarcrm_product_manager;
        $this->sugarcrm_product_category_manager = $sugarcrm_product_category_manager;
        $this->sugarcrm_product_template_manager = $sugarcrm_product_template_manager;
        parent::__construct();
    }
}
