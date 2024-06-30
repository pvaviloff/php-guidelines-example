<?php

declare(strict_types=1);

namespace App\ExampleDomain\Entities;

use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\ExampleDomain\Constants\DbConst;

#[ORM\Entity]
#[ORM\Table(name:DbConst::BRANDS)]
class BrandEntity
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    public readonly Uuid $guid;

    public function __construct(
        #[ORM\Column(length: 140)]
        public string $name,
    ) {
        $this->guid = Uuid::v4();
    }

}
