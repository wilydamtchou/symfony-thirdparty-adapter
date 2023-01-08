<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequestCollectionRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\OptionResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Option;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;

interface OptionService
{
    /**
     * @throws \Exception
     */
    public function create(OptionRequest $request): OptionResponse;

    public function createList(OptionRequestCollectionRequest $request): OptionCollection;

    public function list(?string $reference = null): ?OptionCollection;

    public function listApi(string $reference): ?OptionCollection;

    public function generateOption(OptionRequest $request): Option;

    public function findByReferenceAndSlug(string $reference, string $slug): Option;
}
