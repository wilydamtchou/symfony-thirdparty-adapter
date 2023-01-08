<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

class BaseEntity
{
    public \DateTime $createdDate;
    public \DateTime $lastUpdatedDate;
    public Status $status;
    public ?string $date;

    /**
     * void.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdDate = new \DateTime('now', new \DateTimeZone($_ENV['TIME_ZONE']));
        $this->lastUpdatedDate = $this->createdDate;
        $this->status = Status::PENDING;
        $this->date = $this->lastUpdatedDate->format($_ENV['API_DATE_FORMAT']);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toEmailString(?string $title = null): string
    {
        $text = "$title<hr>";

        foreach ($this->toArray() as $key => $value) {
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:m:s');
            } elseif ($value instanceof Status) {
                $value = $value->value;
            } elseif ($value instanceof BaseEntity) {
                $value = $value->toEmailString();
            } elseif (is_object($value)) {
                $value = 'List';
            }
            $text .= "$key : $value<br>";
        }

        return $text;
    }
}
