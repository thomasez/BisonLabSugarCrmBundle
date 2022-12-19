<?php

namespace BisonLab\SugarCrmBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;

use BisonLab\SugarCrmBundle\Service\SugarWrapper;
use BisonLab\SugarCrmBundle\Model as Model;

/**
 * Grab a sugar object. This one only does product and account, can easily
 * be extended.. 
 * 
 * This one uses the Sugar7 wrapper directly, or rather, through it's service.
 *
 * @author Thomas Lundquist <github@bisonlab.no>
 */
#[AsCommand(
    name: 'bisonlab:sugarcrmwrapper:get-object',
    description: 'Grabs data from SugarCrm.'
)]
class BisonLabSugarCrmWrapperGetObjectCommand extends Command
{
    private $verbose = true;

    public function __construct(
        private SugarWrapper $sugarWrapper,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addOption('object', '', InputOption::VALUE_REQUIRED, 'object type (Default: Site)')
            ->addOption('id', '', InputOption::VALUE_REQUIRED, 'The ID')
            ->setHelp(<<<EOT
This command is just for grabbing one object from SugarCrm.

Pretty simple, just for documenting / example and testing. 
Or extending if you need to.

The "object" is the exact name used in Sugar. (Different from the NoSqlBundle based one, which does not pluralize.

And here you *have* to capitalize correctly, since Sugar is case sensitive.
EOT
            );
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->object = $input->getOption('object');
        $this->id     = $input->getOption('id');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->sugar = $this->sugarWrapper->getSugar();

        $data = $this->sugar->Retrieve($this->object, $this->id);

        // Unless you use "Search" above and not Retrieve, you'll get only one.
        // Or none..
        echo "Found " . count($data) . " lines\n";
        print_r($data);
        return 0;
    }
}
