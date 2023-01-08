<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Option;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao\OptionManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequestCollectionRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\OptionResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Option as BaseOption;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BadReferenceException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\InvalidReferenceSlugOptionException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\OptionAlreadyExistException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\OptionApiDisabledException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RequiredOptionAmountException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RequiredOptionNameException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Option as ModelOption;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\OptionEntityCollection;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\OptionService as BaseOptionService;

class OptionService implements BaseOptionService
{
    protected OptionManager $optionManager;
    protected UtilService $utilService;

    public function __construct(OptionManager $optionManager, UtilService $utilService)
    {
        $this->optionManager = $optionManager;
        $this->utilService = $utilService;
    }

    /**
     * @throws \Exception
     */
    public function create(OptionRequest $request): OptionResponse
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_ENABLED']) {
            throw new OptionApiDisabledException();
        }

        $option = $this->optionManager->save($this->generateOption($request));

        $model = new ModelOption();

        foreach (get_object_vars($model) as $key => $value) {
            $model->$key = $option->$key;
        }

        $model->optionId = $option->optionId;

        $response = new OptionResponse();
        $response->result = $model;

        return $response;
    }

    public function createList(OptionRequestCollectionRequest $request): OptionCollection
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_ENABLED']) {
            throw new OptionApiDisabledException();
        }

        $options = new OptionEntityCollection();

        foreach ($request->all() as $value) {
            $options->add($this->generateOption($value));
        }

        return $this->optionManager->saveList($options);
    }

    public function list(?string $reference = null): ?OptionCollection
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_ENABLED']) {
            throw new OptionApiDisabledException();
        }

        if (AppConstants::PARAMETER_FALSE_VALUE == $_ENV['SEARCH_OPTION_WITH_REFERENCE'] && $reference) {
            throw new OptionApiDisabledException();
        }

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['SEARCH_OPTION_WITH_REFERENCE'] && !preg_match($_ENV['REFERENCE_REGEX'], $reference)) {
            throw new BadReferenceException($reference);
        }

        $options = null;

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['SEARCH_OPTION_WITH_REFERENCE']) {
            $options = $this->optionManager->findByReference($reference, false);
        } else {
            $options = $this->optionManager->findAll(false);
        }

        if (!$options && AppConstants::PARAMETER_TRUE_VALUE == $_ENV['OPTION_API_ENABLED']) {
            $options = $this->listApi();
        }

        return $options;
    }

    public function listApi(string $reference): ?OptionCollection
    {
        throw new OptionApiDisabledException();
    }

    public function generateOption(OptionRequest $request): BaseOption
    {
        if (!$request->name) {
            throw new RequiredOptionNameException();
        }

        if (!$request->amount) {
            throw new RequiredOptionAmountException();
        }

        if (!$request->slug) {
            $request->slug = $this->utilService->slugify($request->name);
        }

        if ($this->optionManager->findOneBySlug($request->slug, false)) {
            throw new OptionAlreadyExistException($request->slug);
        }

        if ($request->reference && !preg_match($_ENV['REFERENCE_REGEX'], $request->reference)) {
            throw new BadReferenceException($request->reference);
        }

        $option = new Option();
        $option->name = $request->name;
        $option->amount = $request->amount;
        $option->slug = $request->slug;
        $option->reference = $request->reference;

        return $option;
    }

    public function findByReferenceAndSlug(string $reference, string $slug): Option
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_ENABLED']) {
            throw new OptionApiDisabledException();
        }

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['SEARCH_OPTION_WITH_REFERENCE'] && !preg_match($_ENV['REFERENCE_REGEX'], $reference)) {
            throw new BadReferenceException($reference);
        }

        $option = null;

        if (AppConstants::PARAMETER_FALSE_VALUE == $_ENV['SEARCH_OPTION_WITH_REFERENCE']) {
            $option = $this->optionManager->findOneBySlug($slug);
        } elseif (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['SEARCH_OPTION_WITH_REFERENCE']) {
            $option = $this->optionManager->findOneByReferenceAndSlug($reference, $slug, false);
        }

        if (!$option) {
            if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_API_ENABLED']) {
                throw new InvalidReferenceSlugOptionException($reference, $slug);
            }

            $this->listApi($reference);

            $option = $this->optionManager->findOneByReferenceAndSlug($reference, $slug);
        }

        return $option;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneBySlug(string $slug, bool $throw = true): ?Option {
        return $this->optionManager->findOneBySlug($slug, $throw);
    }
}
