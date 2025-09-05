<?php

declare(strict_types=1);

namespace App\ExampleDomain\Entities;

use App\ExampleDomain\Constants\DbConst;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: DbConst::BRANDS)]
class BrandEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    public readonly Uuid $guid;

    public function __construct(
        #[ORM\Column(length: 140)]
        public string $name,
    ) {
        $this->guid = Uuid::v4();
    }
}
