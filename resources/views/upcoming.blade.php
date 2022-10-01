<x-dashboard-tile :position="$position" refresh-interval="60">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="overflow-hidden rounded-md bg-white shadow">
        <ul role="list" class="divide-y divide-gray-200">
            @foreach ($priority as $match)
                @php
                    $date = Carbon\Carbon::parse($match['date'])->timezone(@env('APP_TZ', 'UTC'));
                    $datestr = '';
                    if ($date->isToday()) {
                        $datestr = 'Today';
                    } elseif ($date->isTomorrow()) {
                        $datestr = 'Tomorrow';
                    } else {
                        $datesrt = $date->diffForHumans();
                    }

                    $time = $date->format('H:i');
                @endphp

                @if ($date->isPast())
                    @continue
                @endif
                <li class="px-2 py-1 bg-gray-100">
                    <div class="flex w-full justify-between items-center">
                        <div class="flex items-center justify-between w-1/3 text-xs">
                            <img class="h-8 w-8 text-gray-300" src="{{ $match['home']['crest'] }}" />
                            <p>{{ $match['home']['name'] }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold">vs</h4>
                        </div>
                        <div class="flex items-center justify-between w-1/3 text-xs">
                            <p>{{ $match['away']['name'] }}</p>
                            <img class="h-8 w-8 text-gray-300" src="{{ $match['away']['crest'] }}" />
                        </div>
                        <div class="flex w-1/5 flex-col items-center justify-between text-xs">
                            <div class="text-gray-600 text-xs flex items-center justify-between">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                {{ $datestr }}
                            </div>
                            <div class="text-gray-600 text-xs flex items-center justify-around">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $time }}
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
            @foreach ($data as $match)
                @if (in_array($match, $priority))
                    @continue
                @endif
                @php
                    $date = Carbon\Carbon::parse($match['date'])->timezone(@env('APP_TZ', 'UTC'));
                    $datestr = '';
                    if ($date->isToday()) {
                        $datestr = 'Today';
                    } elseif ($date->isTomorrow()) {
                        $datestr = 'Tomorrow';
                    } else {
                        $datesrt = $date->diffForHumans();
                    }

                    $time = $date->format('H:i');
                @endphp

                @if ($date->isPast())
                    @continue
                @endif
                <li class="px-3 py-2">
                    <div class="flex w-full justify-between items-center">
                        <div class="flex w-1/5 flex-col items-center justify-between text-xs">
                            <div class="text-gray-600 text-xs flex items-center justify-between">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                {{ $datestr }}
                            </div>
                            <div class="text-gray-600 text-xs flex items-center justify-around">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $time }}
                            </div>
                        </div>
                        <div class="flex items-center justify-around w-1/3 text-xs">
                            <img class="h-4 w-4 text-gray-300" src="{{ $match['home']['crest'] }}" />
                            <p>{{ $match['home']['name'] }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold">vs</h4>
                        </div>
                        <div class="flex items-center justify-around w-1/3 text-xs">
                            <img class="h-4 w-4 text-gray-300" src="{{ $match['away']['crest'] }}" />
                            <p>{{ $match['away']['name'] }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-dashboard-tile>
