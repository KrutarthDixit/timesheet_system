<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompanyService
{
    public function update(array $data)
    {
        $user = Auth::user();

        $user->update([
            'hourly_wage' => $data['hourly_wage'] ?? $user->hourly_wage,
            'travel_allowance' => $data['travel_allowance'] ?? $user->travel_allowance,
            'mileage_rate' => $data['mileage_rate'] ?? $user->mileage_rate,
        ]);

        return $user;
    }
}
