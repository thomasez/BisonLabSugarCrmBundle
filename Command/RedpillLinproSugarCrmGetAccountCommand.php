<?php

namespace RedpillLinpro\SugarCrmBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use RedpillLinpro\SugarCrmBundle\Model as Model;

/**
 * After all imports we need to process and tie it all together. 
 * This should do that trick.
 *
 * @author Thomas Lundquist <thomasez@redpill-linpro.com>
 */
class RedpillLinproSugarCrmGetAccountCommand extends ContainerAwareCommand
{

    private $verbose = true;

    protected function configure()
    {
        $this->setDefinition(
                array(
                new InputOption('object_type', '', InputOption::VALUE_REQUIRED, 'object type (Default: Site)'),
                new InputOption('pk_value', '', InputOption::VALUE_REQUIRED, 'The ID'),
                ))
                ->setDescription('Grabs data from SugarCrm.')
                ->setHelp(<<<EOT
This command is just for grabbing one object from SugarCrm.
EOT
            );

        $this->setName('rplp:sugarcrm:get-account');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        // $this->class     = strtolower($input->getOption('object_type'));

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        gc_enable();

        $this->output->writeln(sprintf('Debug mode is <comment>%s</comment>.', $input->getOption('no-debug') ? 'off' : 'on'));
        $this->output->writeln('');

        $this->sugarcrm_product_manager      = $this->getContainer()
                ->get('sugarcrm_product_manager');

        $this->sugarcrm_account_manager      = $this->getContainer()
                ->get('sugarcrm_account_manager');

        $this->sugarcrm_product_template_manager      = $this->getContainer()
                ->get('sugarcrm_product_template_manager');

/*
        $data = $this->sugarcrm_account_manager->findByKeyVal('name', 'Assasination');
echo "Found " . count($data) . " accounts\n";
// print_r($data);
       return true;

        // Account:
        $data = $this->sugarcrm_account_manager->findOneById('850c04dd-23a4-9604-dd02-52a1b424c47f');
echo("Navn:" . $data['name'] . "\n");
*/
        // Product
        $data = $this->sugarcrm_product_manager->findOneById('f30f6f70-3d01-0e8d-0f46-52dfcd72c9c6');

echo("Navn:" . $data['product_template_name'] . "\n");

        // Product
        $data = $this->sugarcrm_product_template_manager->findOneById($data['product_template_id']);

echo("Speed:" . $data['speed_c'] . "\n");
echo("Kategori:" . $data['category_name'] . "\n");
echo "\nKom meg hit esse\n";
// print_r($data);
    }


}

