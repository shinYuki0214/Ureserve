<?php

namespace App\Services;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use Carbon\Carbon;

class EventService
{
    public static function checkEventDuplication($eventDate, $startTime, $endTime)
    {

        $check = DB::table('events')
            ->whereDate('start_date', $eventDate)
            ->whereTime('end_date', '>', $startTime)
            ->whereTime('start_date', '<', $endTime)
            ->exists();

        return $check;
    }
    public static function countEventDuplication($eventDate, $startTime, $endTime)
    {

        $check = DB::table('events')
            ->whereDate('start_date', $eventDate)
            ->whereTime('end_date', '>', $startTime)
            ->whereTime('start_date', '<', $endTime)
            ->count();

        return $check;
    }

    public static function joinDateAndTime($date, $time)
    {
        $join = $date . " " . $time;
        $dateTime = Carbon::createFromFormat(
            'Y-m-d H:i',
            $join
        );
        return $dateTime;
    }
}
