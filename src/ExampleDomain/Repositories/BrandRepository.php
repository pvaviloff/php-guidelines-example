<?php

declare(strict_types=1);

namespace App\ExampleDomain\Repositories;


use App\ExampleDomain\Constants\DbConst;
use App\ExampleDomain\Entities\BrandEntity;
use App\ExampleDomain\ValueObjects\BrandListObject;
use App\ExampleDomain\ValueObjects\BrandObject;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class BrandRepository
{
    public function __construct(
        private readonly Connection $connection,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function isExistByName(string $name): bool
    {
        $builder = $this->connection->createQueryBuilder();
        $guid = $builder->select(
            'guid',
        )->from(DbConst::BRANDS)
            ->andWhere("name = {$builder->createNamedParameter($name)}")
            ->fetchFirstColumn();

        return !empty($guid);
    }

    public function isExistByGuid(Uuid $guid): bool
    {
        $builder = $this->connection->createQueryBuilder();
        $existGuid = $builder->select(
            'guid',
        )->from(DbConst::BRANDS)
            ->andWhere("guid = {$builder->createNamedParameter($guid->toString())}")
            ->fetchFirstColumn();

        return !empty($existGuid);
    }

    public function getByGuid(Uuid $guid): BrandEntity
    {
        $builder = $this->entityManager->getRepository(BrandEntity::class)->createQueryBuilder('b');

        return $builder
            ->where("b.guid = :guid")
            ->setParameter(':guid', $guid->toString())
            ->getQuery()
            ->getSingleResult();
    }

    public function getCount(): int
    {
        $builder = $this->connection->createQueryBuilder();
        $count = $builder->select('count(guid) as count')
            ->from(DbConst::BRANDS)
            ->fetchOne();

        return (int) $count;
    }

    public function getList(BrandListObject $listObject): \Generator
    {
        $builder = $this->connection->createQueryBuilder();
        $query = $builder->select(
            'guid',
            'name',
        )->from(DbConst::BRANDS)
            ->setMaxResults($listObject->limit)
            ->setFirstResult($listObject->getOffset());

        foreach ($query->executeQuery()->iterateAssociative() as $brand) {

            yield new BrandObject(
                Uuid::fromString($brand['guid']),
                $brand['name'],
            );
        }
    }

}
