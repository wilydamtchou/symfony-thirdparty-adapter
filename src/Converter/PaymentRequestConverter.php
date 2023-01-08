<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Converter;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Converter\BasicConverter;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\PaymentRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PaymentRequestConverter.
 */
class PaymentRequestConverter extends BasicConverter
{
    /**
     * RequestConverter constructor.
     */
    public function __construct(
        string $converterName = AppConstants::CONVERTER_REQUEST,
        string $converterFormat = AppConstants::CONVERTER_FORMAT,
        string $converterClass = PaymentRequest::class
    ) {
        $this->converterClass = $converterClass;
        $this->converterFormat = $converterFormat;
        $this->converterName = $converterName;
    }

    /**
     * apply.
     *
     * @throws \Exception
     */
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $this->processData($request, $this->converterClass, $configuration);

        return true;
    }
}
