<div class="grid-container">
    <nav class="col-md-2 sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                @foreach (\Vanguard\Plugins\Vanguard::availablePlugins() as $plugin)
                    @include('partials.sidebar.items', ['item' => $plugin->sidebar()])
                @endforeach
            </ul>
        </div>
    </nav>
</div>

