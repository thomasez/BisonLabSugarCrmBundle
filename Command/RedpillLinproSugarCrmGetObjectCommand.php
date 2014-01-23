<?php

namespace RedpillLinpro\SugarCrmBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use RedpillLinpro\SugarCrmBundle\Model as Model;

/**
 * Grab a sugar object. This one only does product and account, can easily
 * be extended.. 
 *
 * @author Thomas Lundquist <thomasez@redpill-linpro.com>
 */
class RedpillLinproSugarCrmGetObjectCommand extends ContainerAwareCommand
{

    private $verbose = true;

    protected function configure()
    {
        $this->setDefinition(
                array(
                new InputOption('object', '', InputOption::VALUE_REQUIRED, 'object type (Default: Site)'),
                new InputOption('id', '', InputOption::VALUE_REQUIRED, 'The ID'),
                ))
                ->setDescription('Grabs data from SugarCrm.')
                ->setHelp(<<<EOT
This command is just for grabbing one object from SugarCrm.

Pretty simple, just for testing. Or extending if you need to.
EOT
            );

        $this->setName('rplp:sugarcrm:get-object');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->object     = strtolower($input->getOption('object'));
        $this->id     = strtolower($input->getOption('id'));

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

        
        $data = array();

        switch (strtolower($this->object)) {
            case "account":
                $data = $this->sugarcrm_account_manager->findOneById($this->id);
                break;
            case "product":
                $data = $this->sugarcrm_product_manager->findOneById($this->id);
                break;
            case "producttemplate":
            case "product_template":
                $data = $this->sugarcrm_product_template_manager->findOneById($this->id);
                break;
        }

        echo "Found " . count($data) . " accounts\n";
        print_r($data);
        return true;

    }
}

