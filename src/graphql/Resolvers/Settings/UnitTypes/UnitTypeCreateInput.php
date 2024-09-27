<?php

namespace Vertuoza\Api\Graphql\Resolvers\Settings\UnitTypes;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ObjectType;
use Vertuoza\Api\Graphql\Types;

class UnitTypeCreateInput extends InputObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'UnitTypeCreateInput',
            'description' => 'Input for Unit Type create mutation',
            'fields' => static fn (): array => [
                'name' => [
                    'description' => "Name of the new unit type",
                    'type' => new NonNull(Types::string())
                ],
            ],
        ]);
    }
}
