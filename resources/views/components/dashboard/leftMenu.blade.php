<ul>
    <li>
        <a href="#" id="menuDock">
            <span class="glyphicon glyphicon-menu-left"></span>
            <span class="linkText">{{__('Smanji')}}</span>
        </a>
    </li>
    <li>
        <a href="{{URL::to('/dashboard')}}">
            <span class="glyphicon glyphicon-home"></span>
            <span class="linkText">{{__('Dashboard')}}</span>
        </a>
    </li>
    <li>
        <a href="{{URL::to('/user')}}">
            <span class="glyphicon glyphicon-user"></span>
            <span class="linkText">{{__('Korisnici')}}</span>
        </a>
    </li>
    <li>
        <a href="{{URL::to('/dashboardMessages')}}">
            <span class="glyphicon glyphicon-envelope"></span>
            <span class="linkText">{{__('Poruke')}}</span>
        </a>
    </li>
    <li>
        <a href="{{URL::to('/order')}}">
            <span class="glyphicon glyphicon-shopping-cart"></span>
            <span class="linkText">{{__('Narudzbine')}}</span>
        </a>
    </li>
    <li>
        <a href="{{URL::to('/currency')}}">
            <span class="glyphicon glyphicon-bitcoin"></span>
            <span class="linkText">{{__('Valute')}}</span>
        </a>
    </li>
    <li>
        <a href="{{URL::to('/config')}}">
            <span class="glyphicon glyphicon-cog"></span>
            <span class="linkText">{{__('Konfiguracije')}}</span>
        </a>
    </li>
</ul>