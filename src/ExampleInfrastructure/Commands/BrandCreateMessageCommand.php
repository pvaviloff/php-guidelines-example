<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Commands;


use App\ExampleDomain\ValueObjects\BrandCreatorObject;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'example:brand:create:message')]
final class BrandCreateMessageCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $bus,
    ) {
        parent::__construct('example:brand:create:message');
    }

    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'Brand name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatch(new BrandCreatorObject($input->getArgument('name')));

        return self::SUCCESS;
    }

}
