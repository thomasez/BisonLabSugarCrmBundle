<?php

namespace BisonLab\SugarCrmBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use BisonLab\SugarCrmBundle\Model as Model;

/**
 * After all imports we need to process and tie it all together. 
 * This should do that trick.
 *
 * @author Thomas Lundquist <github@bisonlab.no>
 */
class BisonLabSugarCrmGetAccountCommand extends ContainerAwareCommand
{

    private $verbose = true;

    protected function configure()
    {
        $this->setDefinition(
                array(
                new InputArgument('pk_value', InputArgument::REQUIRED, 'The ID'),
                ))
                ->setDescription('Grabs Account data from SugarCrm.')
                ->setHelp(<<<EOT
This command is just for grabbing the Account from SugarCrm.
EOT
            );

        $this->setName('rplp:sugarcrm:get-account');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $this->output->writeln('');

        $this->sugarcrm_account_manager      = $this->getContainer()
                ->get('sugarcrm_account_manager');

        $data = $this->sugarcrm_account_manager->findByKeyVal('name', 'Assasination');
        echo "Found " . count($data) . " accounts\n";
        print_r($data);
        return true;

    }

}
