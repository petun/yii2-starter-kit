<?php
declare(strict_types=1);

namespace common\helpers;

use DateTime;
use DateTimeZone;

class DateHelper
{
    public const TIMEZONE_DEFAULT = 'Europe/Moscow';

    public const DATE_FORMAT = 'd.m.Y';

    public const DATE_MONTH_FORMAT = 'm.Y';

    public const DATE_TIME_FORMAT = 'd.m.Y H:i:s';

    public const DATE_SHORT_TIME_FORMAT = 'd.m.Y H:i';

    public const DATE_RANGE_SEPARATOR = '-';

    public const JS_DATE_FORMAT = 'dd.mm.yyyy';

    public const JS_DATE_TIME_FORMAT = 'dd.mm.yyyy hh:ii:ss';

    const JS_TIME_FORMAT = 'hh:ii';

    public const DATE_FORMAT_ISO = 'Y.m.d';

    public const DATE_DB_FORMAT = 'Y-m-d';

    public const DATE_TIME_DB_FORMAT = 'Y-m-d H:i:s';

    public const DISTANT_FUTURE_DATE = '2030-01-01';

    public const DOOGLYS_DATE_TIME_FORMAT = 'd.m.y / H:i';

    /**
     * @param string $monthFormat
     *
     * @return array
     */
    public static function getMonthsList($monthFormat = 'MMM')
    {
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $key = \sprintf('%02d', $i);
            $result[$key] = \Yii::$app->formatter->asDate("2000-$key-01", $monthFormat);
        }

        return $result;
    }

    /**
     * @param string $dayFormat
     *
     * @return array
     */
    public static function getDaysList($dayFormat = 'EE')
    {
        $result = [];
        for ($i = 1; $i <= 7; $i++) {
            $key = \sprintf('%02d', $i);
            $result[$i] = \Yii::$app->formatter->asDate("2001-01-$key", $dayFormat);
        }

        return $result;
    }

    public static function getRange($range = 'today')
    {
        $from = \strtotime($range);

        $interval = (new DateTime())->diff(new DateTime($range));

        $to = \time();
        $daysDiff = $interval->format('%R%a');

        if ($daysDiff < 0 && \abs($daysDiff) < 7) {
            $to = $from;
        }

        return \date(self::DATE_FORMAT, $from)
            . self::DATE_RANGE_SEPARATOR
            . \date(self::DATE_FORMAT, $to);
    }

    public static function getYearRange($min, $max)
    {
        return \array_combine(\range($min, $max), \range($min, $max));
    }

    /**
     * Позволяет получить массив временных зон для городов.
     */
    public static function getTimeZones()
    {
        $timeZones = [];

        foreach (DateTimeZone::listIdentifiers(DateTimeZone::ALL) as $timeZone) {
            $timeZones[$timeZone] = $timeZone;
        }

        return $timeZones;
    }

    /**
     * Берет timestamp или дату, и возвращает начало (00:00:00) дня в unix timestamp.
     *
     * @param $date
     *
     * @return false|int
     * * //todo написать тесты на эти два метода
     */
    public static function dayBegin($date)
    {
        if (!\is_numeric($date)) {
            $date = \strtotime($date);
        }

        return \strtotime('today', $date);
    }

    /**
     * Берет timestamp или дату, и возвращает конец (23:59:59) дня в unix timestamp.
     *
     * @param $date
     *
     * @return false|int
     * //todo написать тесты на эти два метода
     */
    public static function dayEnd($date)
    {
        if (!\is_numeric($date)) {
            $date = \strtotime($date);
        }

        return \strtotime('tomorrow', $date) - 1;
    }

    /**
     * @return array
     */
    public static function getTimeZoneList()
    {
        $zones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return \array_combine($zones, $zones);
    }
}
