<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('BD') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Black Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug  == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @auth
            <li @if ($pageSlug  == 'profile') class="active " @endif>
                <a href="{{ route('profile.edit')  }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('User Profile') }}</p>
                </a>
            </li>
            @if (Auth::user()->rol == "admin")
                <li @if ($pageSlug  == 'users') class="active " @endif>
                    <a href="{{ route('user.index')  }}">
                        <i class="tim-icons icon-bullet-list-67"></i>
                        <p>{{ __('User Management') }}</p>
                    </a>
                </li>    
                    @endif
            @endauth
            <li @if ($pageSlug == 'ruleta') class="active " @endif>
                <a href="{{ route('ruleta.index') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ __('Ruleta') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'buscaminas') class="active " @endif>
                <a href="{{ route('buscaminas.index') }}">
                    <i class="tim-icons icon-controller"></i>
                    <p>{{ __('Buscaminas') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'coinflip') class="active " @endif>
                <a href="{{ route('coinflip.index') }}">
                    <i class="tim-icons icon-support-17"></i>
                    <p>{{ __('Coinflip') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
