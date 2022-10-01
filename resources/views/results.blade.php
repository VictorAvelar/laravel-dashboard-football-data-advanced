<x-dashboard-tile :position="$position" refresh-interval="60">
    <h3 class="font-bold text-base text-center">
        Results from previous days
    </h3>
    <div class="overflow-scroll rounded-md bg-white shadow">
        <ul role="list" class="divide-y divide-gray-200">
            @foreach ($priority as $match)
                @php
                    $date = Carbon\Carbon::parse($match['date'])->timezone(@env('APP_TZ', 'UTC'));
                @endphp

                @if ($date->isFuture())
                    @continue
                @endif
                <li class="px-3 py-2 bg-gray-300">
                    <div class="flex w-full justify-between items-center">
                        <div class="flex items-center justify-between w-1/3 text-xs">
                            <img class="h-4 w-4 text-gray-300" src="{{ $match['home']['crest'] }}" />
                            <p>{{ $match['home']['name'] }}</p>
                            <p>{{ $match['result']['home'] }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold">vs</h4>
                        </div>
                        <div class="flex items-center justify-between w-1/3 text-xs">
                            <p>{{ $match['result']['away'] }}</p>
                            <p>{{ $match['away']['name'] }}</p>
                            <img class="h-4 w-4 text-gray-300" src="{{ $match['away']['crest'] }}" />
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
                @endphp

                @if ($date->isFuture())
                    @continue
                @endif
                <li class="px-3 py-2">
                    <div class="flex w-full justify-between items-center">
                        <div class="flex items-center justify-between w-1/3 text-xs">
                            <img class="h-4 w-4 text-gray-300" src="{{ $match['home']['crest'] }}" />
                            <p>{{ $match['home']['name'] }}</p>
                            <p>{{ $match['result']['home'] }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold">vs</h4>
                        </div>
                        <div class="flex items-center justify-between w-1/3 text-xs">
                            <p>{{ $match['result']['away'] }}</p>
                            <p>{{ $match['away']['name'] }}</p>
                            <img class="h-4 w-4 text-gray-300" src="{{ $match['away']['crest'] }}" />
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <ul>
</x-dashboard-tile>
