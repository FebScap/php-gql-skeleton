<?php

namespace Vertuoza\Api\Graphql\Resolvers\Settings\UnitTypes;

use GraphQL\Type\Definition\NonNull;
use Vertuoza\Api\Graphql\Context\RequestContext;
use Vertuoza\Api\Graphql\Types;
use Vertuoza\Entities\Settings\UnitTypeEntity;


class UnitTypeMutation
{
    static function get()
    {
        return [
            'unitTypeCreate' => [
                'type' => Types::get(UnitType::class),
                'args' => [
                    'input' => new NonNull(Types::get(UnitTypeCreateInput::class)),
                ],
                'resolve' => static fn ($rootValue, $args, RequestContext $context)
                => $context->useCases->unitType
                    ->unitTypeCreate
                    ->handle($args['input'])
            ],
        ];
    }
}
