<?php

namespace Vertuoza\Api\Graphql\Resolvers\Settings\UnitTypes;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use React\Promise\Promise;
use Vertuoza\Api\Graphql\Context\RequestContext;
use Vertuoza\Api\Graphql\Types;
use Vertuoza\Repositories\Settings\UnitTypes\UnitTypeMutationData;
use function React\Async\async;
use function React\Promise\resolve;


class UnitTypeMutation
{
    static function get(): array
    {
        return [
            'unitTypeCreate' => [
                'type' => Types::get(UnitType::class),
                'args' => [
                    'input' => new NonNull(Types::string()),
                ],
                'resolve' => static fn ($rootValue, $args, RequestContext $context)
                => $context->useCases->unitType
                    ->unitTypeCreate
                    ->handle($args['input'])
                    ->then(function ($result) {
                        return $result;
                    })
            ],
        ];
    }
}
