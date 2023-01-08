<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequestCollectionRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\OptionService;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

class OptionFixtures extends Fixture
{
    private OptionService $optionService;
    private KernelInterface $kernel;

    public function __construct(OptionService $optionService, KernelInterface $kernel)
    {
        $this->optionService = $optionService;
        $this->kernel = $kernel;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadOption($manager);
    }

    private function loadOption(ObjectManager $manager)
    {
        $data = Yaml::parse(file_get_contents($this->kernel->getProjectDir().$_ENV['OPTIONS_FILE']));

        $request = new OptionRequestCollectionRequest();

        foreach ($data[AppConstants::OPTIONS] as $key => $value) {
            $optionRequest = new OptionRequest();

            $optionRequest->slug = $key;
            $optionRequest->name = $value[AppConstants::NAME];
            $optionRequest->amount = $value[AppConstants::AMOUNT];

            $request->add($optionRequest);
        }

        $this->optionService->createList($request);
    }
}
