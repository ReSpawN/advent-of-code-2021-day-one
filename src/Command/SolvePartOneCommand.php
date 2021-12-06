<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SolvePartOneCommand extends Command
{
    protected static $defaultName = 'solve:part-one';


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sequence = array_filter(explode("\n", file_get_contents('data/input.txt')));

        $output->writeln(sprintf('There are %d lines', count($sequence)));

        $increments = $decrements = 0;
        $max = reset($sequence);

        foreach ($sequence as $count) {
            if ($count === $max) {
                $output->writeln($count);
                continue;
            }

            if ($count > $max) {
                $increments++;
                $output->writeln(sprintf("%d +%s\t%s", $count, str_pad($count - $max, 2, '0', STR_PAD_LEFT), 'Increment'));
            } else {
                $decrements++;
                $output->writeln(sprintf("%d -%s\t%s", $count, str_pad($max - $count, 2, '0', STR_PAD_LEFT), 'Decrement'));
            }

            $max = $count;
        }

        $output->writeln(sprintf('There were %d increments', $increments));
        $output->writeln(sprintf('There were %d decrements', $decrements));

        return Command::SUCCESS;
    }
}
