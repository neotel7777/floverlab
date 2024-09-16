<nav class="navbar navbar-expand-sm">
    <ul class="navbar-nav mega-menu horizontal-megamenu">
        @foreach ($data['menu'] as $item)
            @include('storefront::public.layout.navigation.menuitem', ['type' => 'primary_menu'])
        @endforeach
    </ul>
</nav>
