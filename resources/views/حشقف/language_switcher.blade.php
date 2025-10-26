<li class="nav-item dropdown">
    {{-- الزر الذي يعرض اللغة الحالية --}}
    <a class="nav-link" data-toggle="dropdown" href="#" title="{{ __('Change Language') }}">
        <i class="fas fa-globe"></i>
        <span class="d-none d-sm-inline ml-1">{{ strtoupper(app()->getLocale()) }}</span>
    </a>

    {{-- قائمة اللغات المتاحة --}}
    <div class="dropdown-menu dropdown-menu-right p-0">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if ($localeCode != app()->getLocale())
                <a rel="alternate"
                   hreflang="{{ $localeCode }}"
                   class="dropdown-item"
                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    <i class="fas fa-flag"></i> {{ $properties['native'] }}
                </a>
            @endif
        @endforeach
    </div>
</li>