<div class="container">
    <nav>
        <div id="brand">
            <img id="logo" src="{{asset('img/logo_png.png')}}" alt="">
            <a href="">KvartEx</a>
        </div>
        <ul id="links">
            <li><a href="{{URL::to('/')}}">{{__('Naslovna')}}</a></li>
            <li><a href="{{URL::to('/about')}}">{{__('O nama')}}</a></li>
            <li><a href="{{URL::to('/exchange')}}" class="disabled">{{__('Menjacnica')}}</a></li>
            <li><a href="{{URL::to('/contact')}}">{{__('Kontakt')}}</a></li>
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
                        <li><a href="{{URL::to('/account?ordersLimit=5')}}">{{__('Vas Nalog')}}</a></li>
                        @if(!Entrust::hasRole('admin'))
                        <li><a href="{{URL::to('/messages')}}">{{__('Posalji poruku Adminu')}}</a></li>
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