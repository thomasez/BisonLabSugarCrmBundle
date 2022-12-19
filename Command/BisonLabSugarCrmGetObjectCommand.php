<?php

namespace BisonLab\SugarCrmBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;

use BisonLab\SugarCrmBundle\Model as Model;
use BisonLab\SugarCrmBundle\Manager\Account;
use BisonLab\SugarCrmBundle\Manager\Product;
use BisonLab\SugarCrmBundle\Manager\ProductTemplate;

/**
 * Grab a sugar object. This one only does product and account, can easily
 * be extended.. 
 *
 * @author Thomas Lundquist <github@bisonlab.no>
 */
#[AsCommand(
    name: 'bisonlab:sugarcrm:get-object',
    description: 'Grabs data from SugarCrm.'
)]
class BisonLabSugarCrmGetObjectCommand extends Command
{
    private $verbose = true;

    public function __construct(
        private Account $sugarcrm_account_manager,
        private Product $sugarcrm_product_manager,
        private ProductTemplate $sugarcrm_product_template_manager,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addOption('object', '', InputOption::VALUE_REQUIRED, 'object type')
            ->addOption('id', '', InputOption::VALUE_REQUIRED, 'The ID')
            ->setHelp(<<<EOT
This command is just for grabbing one object from SugarCrm.

Pretty simple, just for testing. Or extending if you need to.
EOT
            );
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->object = strtolower($input->getOption('object'));
        $this->id     = strtolower($input->getOption('id'));
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = $output;
        $this->output->writeln(sprintf('Debug mode is <comment>%s</comment>.', $input->getOption('no-debug') ? 'off' : 'on'));
        $this->output->writeln('');
        
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
        print_r($data);
        return 0;
    }
}
