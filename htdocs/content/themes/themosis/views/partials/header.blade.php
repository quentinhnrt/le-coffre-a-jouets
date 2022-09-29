<header>
    @if($menus && $menus->menu_header !== null)
        <ul>
            @foreach($menus->menu_header->items as $topMenu)
                <li>
                    <a @if($topMenu->url != '#') href="{{ $topMenu->url }}" @endif>
                        {{ $topMenu->label }}
                    </a>
                    @if(count($topMenu->children) > 0)
                        <ul>
                            @foreach($topMenu->children as $firstDegreeChildren)
                                <li>
                                    <a href="{{ $firstDegreeChildren->url }}">
                                        {{ $firstDegreeChildren->label }}
                                    </a>
                                    @if(count($firstDegreeChildren->children) > 0)
                                        <ul>
                                            @foreach($firstDegreeChildren->children as $secondDegreeChildren)
                                                <li><a href="{{ $secondDegreeChildren->url }}">{{ $secondDegreeChildren->label }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </li>
            @endforeach
        </ul>
    @endif
</header>
