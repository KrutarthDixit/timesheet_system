<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateTimesheetRequest;
use App\Models\Timesheet;
use App\Models\User;
use App\Services\CandidateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    private CandidateService $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function timesheet()
    {
        $companyDetails = $this->candidateService->companyDetails();

        if (empty($companyDetails->hourly_wage) || empty($companyDetails->travel_allowance)) {
            $companyDetails = null;
        }

        $timesheets = Timesheet::where('user_id', Auth::id())->get();
        $totalEarnings = $timesheets ? $timesheets->sum('daily_earnings') : null;

        return view('candidate.timesheet', [
            'timesheets' => $timesheets,
            'totalEarnings' => $totalEarnings,
            'companyDetails' => $companyDetails
        ]);
    }

    public function storeTimesheet(CandidateTimesheetRequest $request)
    {
        $this->candidateService->store($request->validated());

        return redirect()->back()->with('success', 'Timesheet entry added!');
    }

    public function destroyTimesheet(Timesheet $timesheet)
    {
        $this->candidateService->destroy($timesheet);

        return redirect()->back()->with('success', 'Timesheet entry deleted!');
    }
}
