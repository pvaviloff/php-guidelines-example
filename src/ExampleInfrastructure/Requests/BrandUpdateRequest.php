<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Requests;


use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class BrandUpdateRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[SerializedName('brand_name')]
        public string $brandName,
    ) {}

}
