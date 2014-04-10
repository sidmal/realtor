<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 30.03.14
 * Time: 22:40
 */

namespace Realtor\DictionaryBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BranchesCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('dictionary:branches:load')
            ->setDescription('Load branches dictionary from emls application.')
            ->addOption('rewrite', null, InputOption::VALUE_REQUIRED, 'make full rewriting of the table.', 'yes')
            ->addOption('message', null, InputOption::VALUE_REQUIRED, 'write output message.', 'no');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getApplication()->getKernel()->getContainer();
        $branchesManager = $container->get('branches.manager');

        $branchesManagerResponse =  $branchesManager->getBranches();
        if(count($branchesManagerResponse) <= 0){
            if($input->getOption('message') == 'yes'){
                return $output->writeln('Problem in process load dictionary, not received any element of the dictionary.');
            }
            else{
                return;
            }
        }

        if($input->getOption('rewrite') == 'yes'){
            $branchesManager->reLoadBranches();
        }
        else{
            $branchesManager->loadBranches();
        }

        if($input->getOption('message') == 'yes'){
            return $output->writeln('Loading process successfully ended. Receive '.count($branchesManagerResponse).' elements of the dictionary.');
        }
        else{
            return;
        }
    }
} 