<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5><i class="fa fa-fw fa-flag"></i> Levels</h5>
    </div>
    <div class="ibox-content no-padding">
        <ul class="list-group">
            @foreach($log->menu() as $level => $item)
                @if ($item['count'] === 0)
                    <a href="#" class="list-group-item disabled">
                        <span class="badge">
                            {{ $item['count'] }}
                        </span>
                        {!! $item['icon'] !!} {{ $item['name'] }}
                    </a>
                @else
                    <a href="{{ $item['url'] }}" class="list-group-item {{ $level }}">
                        <span class="badge level-{{ $level }}">
                            {{ $item['count'] }}
                        </span>
                        <span class="level level-{{ $level }}">
                            {!! $item['icon'] !!} {{ $item['name'] }}
                        </span>
                    </a>
                @endif
            @endforeach
        </ul>
    </div>
</div>
