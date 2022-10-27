<?php

namespace BisonLab\SugarCrmBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use BisonLab\SugarCrmBundle\Model as Model;
use BisonLab\SugarCrmBundle\Manager\Account;

/**
 * After all imports we need to process and tie it all together. 
 * This should do that trick.
 *
 * @author Thomas Lundquist <github@bisonlab.no>
 */
class BisonLabSugarCrmGetAccountCommand extends Command
{
    protected static $defaultName = 'bisonlab:sugarcrm:get-account';

    private $verbose = true;

    public function __construct(
        private Account $sugarcrm_account_manager,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Grabs Account data from SugarCrm.')
            ->addArgument('pk_value', InputArgument::REQUIRED, 'The ID')
            ->setHelp(<<<EOT
This command is just for grabbing the Account from SugarCrm.
EOT
            );
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = $output;
        $this->output->writeln('');

        $data = $this->sugarcrm_account_manager->findByKeyVal('name', 'Assasination');
        echo "Found " . count($data) . " accounts\n";
        print_r($data);
        return 0;
    }
}
