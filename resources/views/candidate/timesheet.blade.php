<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timesheet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (empty($companyDetails))
                        <p class="font-semibold text-md text-red-400">
                            Contact Your Company Admin to Update Hourly Wage and Travel Allounce
                        </p>
                    @else
                        <form action="{{ route('candidate.storeTimesheet') }}" method="POST" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="date" :value="__('Date')" />
                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full"
                                    required date_format="Y-m-d" value="{{ old('date') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('date')" />
                            </div>
                            <div>
                                <x-input-label for="start_time" :value="__('Start Time')" />
                                <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full"
                                    value="{{ old('start_time') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                            </div>

                            <div>
                                <x-input-label for="end_time" :value="__('End Time')" />
                                <x-text-input id="end_time" name="end_time" type="time" class="mt-1 block w-full"
                                    value="{{ old('end_time') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Submit') }}</x-primary-button>
                            </div>
                        </form>

                        <div class="pt-5">
                            <h2>{{ __('Total Earnings:') }} <strong>{{ $totalEarnings }}</strong></h2>

                            @if (!empty($timesheets) && count($timesheets))

                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Date
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Start Time
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                End Time
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Earning
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($timesheets as $timesheet)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $timesheet->date }}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $timesheet->start_time }}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $timesheet->end_time }}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $timesheet->daily_earnings }}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="flex align-center gap-2">
                                                        <a href="{{ route('genetate-invoice') }}">
                                                            <svg width="25" height="25" fill="#000000"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M15,8a1,1,0,0,1-1,1H6A1,1,0,0,1,6,7h8A1,1,0,0,1,15,8Zm-1,3H6a1,1,0,0,0,0,2h8a1,1,0,0,0,0-2Zm-4,4H6a1,1,0,0,0,0,2h4a1,1,0,0,0,0-2Zm13-3v8a3,3,0,0,1-3,3H4a3,3,0,0,1-3-3V4A3,3,0,0,1,4,1H16a3,3,0,0,1,3,3v7h3A1,1,0,0,1,23,12ZM17,4a1,1,0,0,0-1-1H4A1,1,0,0,0,3,4V20a1,1,0,0,0,1,1H17Zm4,9H19v8h1a1,1,0,0,0,1-1Z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                        <form
                                                            action="{{ route('candidate.destroyTimesheet', $timesheet->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('Delete')

                                                            <button type="submit">
                                                                <svg width="25" height="25" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                        stroke-linejoin="round"></g>
                                                                    <g id="SVGRepo_iconCarrier">
                                                                        <path d="M10 12V17" stroke="#000000"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path d="M14 12V17" stroke="#000000"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path d="M4 7H20" stroke="#000000"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10"
                                                                            stroke="#000000" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                                            stroke="#000000" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                    </g>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
