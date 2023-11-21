<div class="p-6 lg:p-8 bg-white border-b border-gray-200" wire:poll.60s>
    <h1 class="text-xl font-medium text-gray-900">
        Visitors By Stage
    </h1>

    @if (empty($stageVisitors))
        <p>No Data Available</p>
    @else
        <ul>
            @foreach ($stageVisitors as $stage => $count)
                @if ($stage == null)
                    <li>Null: {{ $count }}</li>
                @else
                    <li>{{ $stage }}: {{ $count }}</li>
                @endif
            @endforeach
        </ul>
    @endif
</div>
