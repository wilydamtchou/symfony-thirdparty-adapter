<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

interface UtilService
{
    public function randomString(int $length = 6): string;

    public function normalizePhone(string $phone);

    public function slugify(string $text, string $divider = '-'): string;

    public function clean(string $string): string;

    public function dashesToCamelCase(string $string, string $separator, bool $capitalizeFirstCharacter = false): string;

    public function cast($instance, $className): mixed;

    /**
     * @throws \Exception
     */
    public function convertDate(string $date, string $timeZone, string $convertTimeZone): \DateTime;

    /**
     * @throws \Exception
     */
    public function convertDateToGMT(string $date, string $timeZone): \DateTime;

    public function arrayToText(array $data): string;
}
