<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Commands;


use App\ExampleDomain\Services\BrandCreator;
use App\ExampleDomain\ValueObjects\BrandCreatorObject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'example:brand:create')]
final class BrandCreateCommand extends Command
{
    public function __construct(
        private readonly BrandCreator $brandCreator,
        private readonly EntityManagerInterface $entityManager,
    ) {
        parent::__construct('example:brand:create');
    }

    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'Brand name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->brandCreator->create(new BrandCreatorObject($input->getArgument('name')));
        $this->entityManager->flush();

        return self::SUCCESS;
    }

}
