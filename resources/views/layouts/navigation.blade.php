<nav>
    <x-nav-link :href="url('/')">{{ __("Home") }}</x-nav-link>
    <x-nav-link :href="route('album.index')">{{ __("Portfolio") }}</x-nav-link>
    <x-nav-link :href="url('/')">{{ __("Gallery") }}</x-nav-link>
    <x-nav-link :href="route('post.index')">{{ __("Blog") }}</x-nav-link>
</nav>
