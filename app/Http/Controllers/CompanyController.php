<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanySettingsRequest;
use App\Models\User;
use App\Services\CompanyService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function settings()
    {
        return view('company.settings');
    }

    public function updateSettings(CompanySettingsRequest $request)
    {
        $this->companyService->update($request->validated());

        return redirect()->route('company.settngs')->with('success', 'Settings updated successfully!');
    }

    public function generateInvoice(User $candidate)
    {
        $timesheets = auth()->user()->timesheets;
        $pdf = Pdf::loadView('candidate.invoice', compact('timesheets'));

        return $pdf->download('invoice.pdf');
    }
}
