<?php

namespace Vertuoza\Usecases\Settings\UnitTypes;

use React\Promise\Promise;
use Vertuoza\Api\Graphql\Context\UserRequestContext;
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
     * @param array $input name of the new Unit type
     * @return Promise that was created
     */
    public function handle(array $input): Promise
    {
        $data = new UnitTypeMutationData();
        $data->name = $input['name'];

        $id = $this->unitTypeRepository->create($data, $this->userContext->getTenantId());

        return $this->unitTypeRepository->getById($id, $this->userContext->getTenantId());
    }
}
