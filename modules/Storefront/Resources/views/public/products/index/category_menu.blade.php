<section class="categoryWrap">
    <div class="category-nav-home flex-column-start-start">
        <nav class="home_category_list">
            <ul class="horizontal-catmenu flex-row-start-center">
                @foreach ($categories as $item)
                    <li class="nav-item flex-row-center-center">
                        <a href="{{ $item['url'] }}" class="nav-link menu-item" target="{{ $item['target'] }}" data-text="{{ $item['name'] }}">
                            {{ $item['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</section>



