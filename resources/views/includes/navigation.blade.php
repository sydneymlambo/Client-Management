@auth
<nav class="p-6 flex flex-wrap">
    <ul class="items-center main-nav w-full">
        <li><h2 class="mb-3">MENU</h2></li>
        <li>
            <i class="icon icon-home" style="background-image: url({{ asset('img/home.png') }})"></i> <a class="p-3" href="/">HOME</a>
        </li>
        <li>
           <i class="icon icon-dash" style="background-image: url({{ asset('img/dashboard.png') }})"></i> <a class="p-3" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li>
           <i class="icon icon-clients" style="background-image: url({{ asset('img/crm.png') }})"></i> <a class="p-3" href="{{ route('clients') }}">Clients</a>
        </li>
        <li>
            <i class="icon icon-companies" style="background-image: url({{ asset('img/companies.png') }})"></i> <a class="p-3" href="{{ route('companies') }}">Companies</a>
        </li>
        <li>
            <i class="icon icon-payment" style="background-image: url({{ asset('img/payment.png') }})"></i> <a class="p-3" href="{{ route('payments') }}">Payments</a>
        </li>
        <li>
            <i class="icon icon-payment" style="background-image: url({{ asset('img/payment.png') }})"></i> <a class="p-3" href="{{ route('document-repository') }}">Document Repository</a>
        </li>
    </ul>

    <ul class="items-center sec-nav w-full">
        @if(auth()->user())
            <li>
                <i class="icon icon-user" style="background-image: url({{ asset('img/user.png') }})"></i> <a href="{{ route('profile') }}"><span class="p-3">{{ auth()->user()->name }}</span></a>
            </li>
        @endif
        @if(auth()->user()->user_role == 1)
            <li>
                <i class="icon icon-register" style="background-image: url({{ asset('img/register.png') }})"></i>  <a href="{{ route('register') }}"><span class="p-3">Register a user</span></a>
            </li>
        @endif
        <li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="p-3 logout-btn"><i class="icon icon-exit" style="background-image: url({{ asset('img/exit.png') }})"></i> Logout</button>
            </form>
        </li>
    </ul>
</nav>
@endauth