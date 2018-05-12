<div class="container">
    <nav>
        <div id="brand">
            <div id="logo">
                <a href="{{URL::to('/')}}">
                    <img src="{{asset('img/logo_png.png')}}" class="img-responsive" alt="">
                </a>
            </div>
            <a href="{{URL::to('/')}}">KvartEx</a>
        </div>
        <ul id="links">
            <li>
                <a href="{{URL::to('/')}}" class="{{ Request::is('/') ? 'active' : '' }}">{{__('Naslovna')}}</a>
            </li>
            <li>
                <a href="{{URL::to('/goals')}}" class="{{ Request::is('goals') ? 'active' : '' }}">{{__('Naša vizija')}}</a>
            </li>
            <li>
                <a href="{{URL::to('/about')}}" class="{{ Request::is('about') ? 'active' : '' }}">{{__('O nama')}}</a>
            </li>
            <li>
                <a href="{{URL::to('/exchange')}}"
                   class="{{ Request::is('exchange') ? 'active' : '' }}">{{__('Menjačnica')}}</a>
            </li>
            <li>
                <a href="{{URL::to('/contact')}}"
                   class="{{ Request::is('contact') ? 'active' : '' }}">{{__('Kontakt')}}</a>
            </li>
        </ul>
        <div id="auth">
            <div class="btn-group">
                <button type="button" class="btn btn-yellow dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user())
                        {{Auth::user()->name}}
                    @else
                        {{__('Login')}}/{{__('Registracija')}}
                    @endif
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    @if(Auth::user())
                        <li><a href="{{URL::to('/account?ordersLimit=5')}}">{{__('Vaš Nalog')}}</a></li>
                        @if(!Entrust::hasRole('admin'))
                            <li><a href="{{URL::to('/messages')}}">{{__('Pošalji poruku Adminu')}}</a></li>
                        @endif
                        @if(Entrust::hasRole('admin'))
                            <li><a href="{{URL::to('/dashboard')}}">{{__('Dashboard')}}</a></li>
                        @endif
                        <li><a href="{{URL::to('/logout')}}">{{__('Izloguj se')}}</a></li>
                    @else
                        <li><a href="{{URL::to('/login')}}">{{__('Uloguj se')}}</a></li>
                        <li><a href="{{URL::to('/register')}}">{{__('Registracija')}}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>