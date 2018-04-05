<div id="brand">
    <a href="{{URL::to('/')}}">KvartEx</a>
</div>
<div id="breadcrumb">
    <ol class="breadcrumb">
        @if(request()->getPathInfo() === '/dashboard')
            <li class="active">{{__('Dashboard')}}</li>
        @else
            <li><a href="{{URL::to('/dashboard')}}">{{__('Dashboard')}}</a></li>
        @endif
        @yield('breadcrumbs')
    </ol>
</div>
<div>

</div>