<?php

namespace Vertuoza\Usecases\Settings\UnitTypes;

use Monolog\Logger;
use React\Promise\Promise;
use Vertuoza\Api\Graphql\Context\RequestContext;
use Vertuoza\Api\Graphql\Context\UserRequestContext;
use Vertuoza\Api\Graphql\Resolvers\Settings\UnitTypes\UnitType;
use Vertuoza\Api\Graphql\Resolvers\Settings\UnitTypes\UnitTypeCreateInput;
use Vertuoza\Entities\Settings\UnitTypeEntity;
use Vertuoza\Repositories\RepositoriesFactory;
use Vertuoza\Repositories\Settings\UnitTypes\UnitTypeMutationData;
use Vertuoza\Repositories\Settings\UnitTypes\UnitTypeRepository;

class UnitTypeCreateUseCase
{
    private UnitTypeRepository $unitTypeRepository;
    private UserRequestContext $userContext;
    public function __construct(
        RepositoriesFactory $repositories,
        UserRequestContext $userContext
    ) {
        $this->unitTypeRepository = $repositories->unitType;
        $this->userContext = $userContext;
    }

    /**
     * @param string $input name of the new Unit type
     * @return Promise<UnitTypeEntity> that was created
     */
    public function handle(String $input): Promise
    {
        $data = new UnitTypeMutationData();
        $data->name = $input;
        $id = $this->unitTypeRepository->create($data, $this->userContext->getTenantId());
        return $this->unitTypeRepository->getById($id, $this->userContext->getTenantId());
    }
}
