<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 15.04.14
 * Time: 21:47
 */

namespace Realtor\UserBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UsersCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('users:load')
            ->setDescription('Load users from emls application.')
            ->addOption('rewrite', null, InputOption::VALUE_REQUIRED, 'make full rewriting of the table.', 'yes')
            ->addOption('message', null, InputOption::VALUE_REQUIRED, 'write output message.', 'no');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getApplication()->getKernel()->getContainer();
        $userManager = $container->get('users.manager');

        $usersResponse =  $userManager->getUsers();
        if(count($usersResponse) <= 0){
            if($input->getOption('message') == 'yes'){
                return $output->writeln('Problem in process load dictionary, not received any element of the dictionary.');
            }
            else{
                return;
            }
        }

        if($input->getOption('rewrite') == 'yes'){
            $userManager->reloadUsers();
        }
        else{
            $userManager->loadUsers();
        }

        if($input->getOption('message') == 'yes'){
            return $output->writeln('Loading process successfully ended. Receive '.count($usersResponse).' elements of the dictionary.');
        }
        else{
            return;
        }
    }
} 