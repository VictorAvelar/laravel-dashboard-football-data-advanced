<x-dashboard-tile :position="$position" refresh-interval="60">
    <h3 class="text-center text-base">{{ $competition }} Standings</h3>
    <div>
        <table class="w-full flex flex-col">
            <thead>
                <tr class="flex w-full">
                    <th class="flex-1 text-left px-2">Team</th>
                    <th class="w-1/6">W</th>
                    <th class="w-1/6">D</th>
                    <th class="w-1/6">L</th>
                    <th class="w-1/6">PTS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr @class([
                        'w-full',
                        'flex',
                        'text-sm',
                        'py-1',
                        'text-gray-800',
                        'bg-gray-300' => in_array($row['team']['tla'], $priorityList),
                    ])>
                        <td class="flex-1 text-left flex items-center px-2 truncate">
                            <img
                                class="h-4 w-4 rounded-full mr-2"
                                src="{{ $row['team']['crest'] }}"
                                alt="{{ $row['team']['name'] }}">
                            <div class="font-medium truncates">{{ $row['team']['shortName'] }}</div>
                        </td>
                        <td class="w-1/6 text-center">
                            <div>{{ $row['won'] }}</div>
                        </td>
                        <td class="w-1/6 text-center">
                            <div>{{{ $row['draw'] }}}</div>
                        </td>
                        <td class="w-1/6 text-center">
                            <div>{{{ $row['lost'] }}}</div>
                        </td>
                        <td class="w-1/6 text-center">
                            <div>{{{ $row['points'] }}}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-dashboard-tile>
