<?php

/**
 * Description of DateCompare
 *
 * @author Gersain Castañeda Muñoz
 */
class DateCompare 
{
    private $year;
    private $month;
    private $day;
    private $hour;
    private $minute;
    private $second;
    
    public function __construct($date) 
    {
        $this->year = strtok($date, "-");
        $this->month = strtok("-");
        $this->day = strtok("-");
        $this->hour = strtok("-");
        $this->minute = strtok("-");
        $this->second = strtok("-");        
    }
    
    public static function compare(DateCompare $date1, DateCompare $date2)
    {
        if ($date1->year > $date2->year)
            return 1;
        elseif ($date1->year == $date2->year)
        {
            if ($date1->month > $date2->month)
                return 1;
            elseif ($date1->month == $date2->month)
            {
                if ($date1->day > $date2->day)
                    return 1;
                elseif ($date1->day == $date2->day)
                {
                    if ($date1->hour > $date2->hour)
                        return 1;
                    elseif ($date1->hour == $date2->hour)
                    {
                        if ($date1->minute > $date2->minute)
                            return 1;
                        elseif ($date1->minute == $date2->minute)
                        {
                            if ($date1->second > $date2->second)
                                return 1;
                            elseif ($date1->second == $date2->second)
                                return 0;
                            else
                                return -1;
                        }
                        else
                            return -1;
                    }
                    else
                        return -1;
                }
                else
                    return -1;
            }
            else
                return -1;
        }
        else
            return -1;
    }
}
