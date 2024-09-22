<?php

namespace App\Services;

use App\Models\Timesheet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CandidateService
{
    public function store(array $data)
    {

        $dailyEarnings = $this->calculateWage($data['start_time'], $data['end_time']);

        Timesheet::create([
            'user_id' => auth()->id(),
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'daily_earnings' => $dailyEarnings,
        ]);

        $previousEntry = $this->previousEntry($data['date']);

        if ($previousEntry) {
            $travelAllowance = $this->companyDetails()->travel_allowance;
            $previousEntry->daily_earnings += $travelAllowance;
            $previousEntry->save();
        }
    }

    public function destroy($timesheet)
    {
        if ($timesheet) {
            $travelAllowance = $this->companyDetails()->travel_allowance;

            $previousEntry = $this->previousEntry($timesheet->date);

            if ($previousEntry) {
                $previousEntry->daily_earnings -= $travelAllowance;
                $previousEntry->daily_earnings = max(0, $previousEntry->daily_earnings);
                $previousEntry->save();
            }

            $timesheet->delete();
        }
    }

    protected function calculateWage(String $start_time, String $end_time)
    {
        $startTime = Carbon::parse($start_time);
        $endTime = Carbon::parse($end_time);
        $hoursWorked = $endTime->diffInHours($startTime);
        $hourlyWage = $this->companyDetails()->hourly_wage;
        return $hoursWorked * $hourlyWage;
    }

    protected function previousEntry(string $date = null)
    {
        if (empty($date)) return false;

        return Timesheet::where('user_id', auth()->id())
            ->where('date', '<', $date)
            ->latest('date')
            ->first();
    }

    public function companyDetails()
    {
        return User::where('role', 'company')->first();
    }
}
