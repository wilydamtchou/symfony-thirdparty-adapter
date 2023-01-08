<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Converter;

use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BasicConverter.
 */
abstract class BasicConverter implements ParamConverterInterface
{
    protected string $converterClass;

    protected string $converterFormat;

    protected string $converterName;

    /**
     * apply.
     */
    abstract public function apply(Request $request, ParamConverter $configuration): bool;

    /**
     * supports.
     */
    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getName() === $this->converterName;
    }

    /**
     * processData.
     *
     * @throws \Exception
     */
    protected function processData(Request $request, string $requestClass, ParamConverter $configuration): void
    {
        $data = $request->getContent();

        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(
                new SerializedNameAnnotationStrategy(
                    new IdenticalPropertyNamingStrategy()
                )
            )
            ->build();

        $object = $serializer->deserialize($data, $requestClass, $this->converterFormat);

        $request->attributes->set($configuration->getName(), $object);
    }
}
