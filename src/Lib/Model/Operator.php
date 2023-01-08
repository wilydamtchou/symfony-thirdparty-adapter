<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

/**
 * Operator.
 */
class Operator
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $slug;

    /**
     * @var string
     */
    public string $logoUrl;

    /**
     * @var string
     */
    public string $endpoint;

    /**
     * @var string
     */
    public string $regex;

    /**
     * @var string
     */
    public string $countrycode;

    /**
     * @var bool
     */
    public bool $manual;

    /**
     * @var bool
     */
    public bool $comingSoon;

    /**
     * @var bool
     */
    public bool $alertSeuil;

    /**
     * @var bool
     */
    public bool $balanceManual;

    /**
     * @var float|null
     */
    public ?float $balance;

    /**
     * @var float|null
     */
    public ?float $balanceMin;

    /**
     * @var string|null
     */
    public ?string $emails;
}
