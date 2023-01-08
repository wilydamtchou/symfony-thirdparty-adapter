<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\UtilService as BaseUtilService;

class UtilService implements BaseUtilService
{
    /**
     * RandomString.
     *
     * @param int $length Length
     */
    public function randomString(int $length = 6): string
    {
        $str = '';
        $characters = array_merge(range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }

        return $str;
    }

    public function normalizePhone(string $phone): string
    {
        $result = "$phone";

        if (9 == strlen($phone) && str_starts_with($phone, '6')) {
            $result = '237'.$phone;
        } elseif (8 == strlen($phone)) {
            $result = '2376'.$phone;
        } elseif (7 == strlen($phone) && str_starts_with($phone, '7')) {
            $result = '23767'.$phone;
        } elseif (7 == strlen($phone) && str_starts_with($phone, '9')) {
            $result = '23769'.$phone;
        } elseif (7 == strlen($phone) && str_starts_with($phone, '6')) {
            $result = '23766'.$phone;
        } elseif (7 == strlen($phone) && (str_starts_with($phone, '2') || str_starts_with($phone, '3'))) {
            $result = '23762'.$phone;
        }

        return $result;
    }

    public function slugify(string $text, string $divider = '-'): string
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function clean(string $string): string
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public function dashesToCamelCase(string $string, string $separator, bool $capitalizeFirstCharacter = false): string
    {
        $str = str_replace(' ', '', ucwords(str_replace($separator, ' ', strtolower($string))));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

    public function cast($instance, $className): mixed
    {
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            \strlen($className),
            $className,
            strstr(strstr(serialize($instance), '"'), ':')
        ));
    }

    /**
     * @throws \Exception
     */
    public function convertDate(string $date, string $timeZone, string $convertTimeZone): \DateTime
    {
        $result = new \DateTime($date, new \DateTimeZone($timeZone));
        $result->setTimezone(new \DateTimeZone($convertTimeZone));

        return $result;
    }

    /**
     * @throws \Exception
     */
    public function convertDateToGMT(string $date, string $timeZone): \DateTime
    {
        $result = new \DateTime($date, new \DateTimeZone($timeZone));
        $result->setTimezone(new \DateTimeZone('UTC'));

        return $result;
    }

    public function arrayToText(array $data): string
    {
        return http_build_query($data, '', ',');
    }
}
