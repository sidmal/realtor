<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 29.03.14
 * Time: 20:06
 */

namespace Realtor\DictionaryBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AdvertisingSourceCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('dictionary:advertising_source:load')
            ->setDescription('Load advertising source dictionary from emls application.')
            ->addOption('rewrite', null, InputOption::VALUE_REQUIRED, 'make full rewriting of the table.', 'yes')
            ->addOption('message', null, InputOption::VALUE_REQUIRED, 'write output message.', 'no');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getApplication()->getKernel()->getContainer();
        $advertisingSourceManager = $container->get('advertising_source.manager');

        $advertisingSourceResponse =  $advertisingSourceManager->getAdvertisingSource();
        if(count($advertisingSourceResponse) <= 0){
            if($input->getOption('message') == 'yes'){
                return $output->writeln('Problem in process load dictionary, not received any element of the dictionary.');
            }
            else{
                return;
            }
        }

        if($input->getOption('rewrite') === true){
            $container->get('advertising_source.manager')->reLoadAdvertisingSource();
        }
        else{
            $container->get('advertising_source.manager')->loadAdvertisingSource();
        }

        if($input->getOption('message') == 'yes'){
            return $output->writeln('Loading process successfully ended. Receive '.count($advertisingSourceResponse).' elements of the dictionary.');
        }
        else{
            return;
        }
    }
} 