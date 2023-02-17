<!doctype html>
<html class="fixed">
	<head>
        <title>@yield('title')</title>
        @include('layouts.header')
        @yield('header')
    </head>
    <body>

            <section class="body">

                <!-- start: header -->
                <header class="header">
                    @include('layouts.topbar')
                </header>

                <div class="inner-wrapper">
                @include('layouts.sidebar')

                <section role="main" class="content-body">

                    @component('layouts.body-header')
                        @slot('menu')
                            @yield('menu')
                        @endslot
                    @endcomponent
                    @include('layouts.errors')
                    @yield('content')

                </section>

                @include('layouts.body-sidebar')

                </div>

                @include('layouts.scripts')
                @yield('scripts')
            </section>
    </body>
</html>
