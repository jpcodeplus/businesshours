<?php

namespace app\code;

/**
 * The Holidays class manages holiday data and allows filtering based on dates and states.
 */
class Holidays
{
    /**
     * @var array $data Stores the holiday data.
     */
    private array $data;

    /**
     * Constructor for the class.
     * @param array $data Initial data for holidays.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Filters holidays by a date range.
     * @param string|null $fromDate Start date of the range in 'Y-m-d' format, or null for today's date.
     * @param string|null $toDate End date of the range in 'Y-m-d' format, or null for today's date.
     * @return array Filtered list of holidays.
     */
    public function getByDates(string $fromDate = null, string $toDate = null): array
    {
        $from = $fromDate !== null ? strtotime($fromDate) : strtotime(date('Y-m-d'));
        $to = $toDate !== null ? strtotime($toDate) : strtotime(date('Y-m-d'));

        $filteredHolidays = [];
        foreach ($this->data as $data) {
            $currentDate = strtotime($data['Date']);
            if ($currentDate >= $from && $currentDate <= $to) {
                $filteredHolidays[] = $data;
            }
        }

        return $filteredHolidays;
    }

    /**
     * Filters holidays by states.
     * @param array $datas Array of holidays to filter, or empty to use internal data.
     * @param array $possibleStates Array of states to filter by.
     * @return array Filtered list of holidays.
     */
    public function filterByStates(array $datas = [], array $possibleStates = ['all']): array
    {
        $data = count($datas) < 1 ? $this->data : $datas;

        $filteredHolidays = [];

        foreach ($this->data as $holiday) {
            $holidayStates = array_map('strtoupper', $holiday['State']);
            $possibleStatesUpper = array_map('strtoupper', $possibleStates);

            $foundAllStates = true;
            foreach ($possibleStatesUpper as $state) {
                if (!in_array($state, $holidayStates)) {
                    $foundAllStates = false;
                    break;
                }
            }

            if ($foundAllStates) {
                $filteredHolidays[] = $holiday;
            }
        }

        return $filteredHolidays;
    }

    /**
     * Sorts holidays by date.
     * @param array $data Array of holidays to sort, or empty to use internal data.
     * @return array List of holidays sorted by date.
     */
    public function orderByDate(array $data = []): array
    {
        $sortedData = count($data) < 1 ? $this->data : $data;

        usort($sortedData, function ($a, $b) {
            return strtotime($a['Date']) - strtotime($b['Date']);
        });

        return $sortedData;
    }
}
