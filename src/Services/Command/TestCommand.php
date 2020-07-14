<?php
declare(strict_types=1);

namespace App\Services\Command;

use App\Domain\Mappers\MappedStringCreator;
use App\Domain\Mappers\NumberMapper\BiggerThanMapper;
use App\Domain\Mappers\NumberMapper\DividerMapper;
use App\Domain\Mappers\NumberMapper\ValueInArrayMapper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore
 */
class TestCommand extends Command
{
    protected static $defaultName = 'app:hatee-ho';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Test start',
            '============',
            '',
        ]);

        $stringCreator = new MappedStringCreator();

        $stringCreator->setMappers(
            new DividerMapper(3, 'pa'),
            new DividerMapper(5, 'pow')
        );

        $output->writeln([
            'Task 1',
            '============',
            $stringCreator->mapNumbersToString(1, 20, ' '),
            ''
        ]);

        $stringCreator->setMappers(
            new DividerMapper(2, 'hatee'),
            new DividerMapper(7, 'ho')
        );

        $output->writeln([
            'Task 2',
            '============',
            $stringCreator->mapNumbersToString(1, 15, '-'),
            ''
        ]);

        $stringCreator->setMappers(
            new ValueInArrayMapper('joff', 1, 4, 9),
            new BiggerThanMapper(5, 'tchoff')
        );

        $output->writeln([
            'Task 3',
            '============',
            $stringCreator->mapNumbersToString(1, 10, '-'),
            ''
        ]);

        return 0;
    }
}
