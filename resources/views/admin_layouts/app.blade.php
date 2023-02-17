<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>
        <title>@yield('title')</title>
        @include('admin_layouts.header')
        @yield('header')
    </head>
    <body>
        
            <section class="body">
    
                <!-- start: header -->
                <header class="header">
                    @include('admin_layouts.topbar')
                </header>

                <div class="inner-wrapper">
                @include('admin_layouts.sidebar')

                <section role="main" class="content-body">

                    @component('admin_layouts.body-header')
                        @slot('menu')
                            @yield('menu')
                        @endslot
                    @endcomponent
                    @include('admin_layouts.errors')
                    @yield('content')
                    
                </section>

                @include('admin_layouts.body-sidebar')
                    
                </div>

                @include('admin_layouts.scripts')
                @yield('scripts')
            </section>
    </body>
</html>