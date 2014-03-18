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
 * This one uses the Sugar7 wrapper directly, or rather, through it's service.
 *
 * @author Thomas Lundquist <thomasez@redpill-linpro.com>
 */
class RedpillLinproSugarCrmWrapperGetObjectCommand extends ContainerAwareCommand
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

Pretty simple, just for documenting / example and testing. 
Or extending if you need to.

The "object" is the exact name used in Sugar. (Different from the NoSqlBundle based one, which does not pluralize.

And here you *have* to capitalize correctly, since Sugar is case sensitive.
EOT
            );

        $this->setName('rplp:sugarcrmwrapper:get-object');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->object = $input->getOption('object');
        $this->id     = $input->getOption('id');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->sugarservice = $this->getContainer()
                ->get('sugar_wrapper');

        $this->sugar = $this->sugarservice->getSugar();

        $data = $this->sugar->Retrieve($this->object, $this->id);

        // Unless you use "Search" above and not Retrieve, you'll get only one.
        // Or none..
        echo "Found " . count($data) . " lines\n";
        print_r($data);
        return true;

    }
}

