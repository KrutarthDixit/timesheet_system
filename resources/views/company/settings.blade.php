<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('company.updateSettings') }}" method="POST" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="hourly_wage" :value="__('Hourly Wage')" />
                            <x-text-input id="hourly_wage" name="hourly_wage" type="number" step="0.01" class="mt-1 block w-full" :value="old('hourly_wage', auth()->user()->hourly_wage)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('hourly_wage')" />
                        </div>

                        <div>
                            <x-input-label for="travel_allowance" :value="__('Travel Allowance')" />
                            <x-text-input id="travel_allowance" name="travel_allowance" type="number" step="0.01" class="mt-1 block w-full" :value="old('travel_allowance', auth()->user()->travel_allowance)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('travel_allowance')" />
                        </div>

                        <div>
                            <x-input-label for="mileage_rate" :value="__('Mileage Rate')" />
                            <x-text-input id="mileage_rate" name="mileage_rate" type="number" step="0.01" class="mt-1 block w-full" :value="old('mileage_rate', auth()->user()->mileage_rate)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('mileage_rate')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
