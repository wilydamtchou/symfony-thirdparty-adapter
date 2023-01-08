<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller\ConfigController as BaseConfigController;

/**
 * Class AppController.
 */
#[Route('/config')]
class ConfigController extends BaseConfigController
{
}
