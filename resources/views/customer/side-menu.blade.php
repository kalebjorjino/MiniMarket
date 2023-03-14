<ul class="list-group account-side-menu">

    <li class="list-group-item">
        <a class="nav-link" href="{{ url('/account/dashboard') }}">
            <i class="fas fa-gauge" style="padding: 5px;"></i>
            Dashboard
        </a>
    </li>


    <li class="list-group-item">
        <a class="nav-link" href="{{ url('/account/orders') }}">
            <i class="fas fa-bag-shopping" style="padding: 5px;"></i>
            My Orders
        </a>
    </li>


    <li class="list-group-item">
        <a class="nav-link" href="{{ url('/account/profile') }}">
            <i class="fa-solid fa-user" style="padding: 5px;"></i>
            Edit Profile
        </a>
    </li>


    <li class="list-group-item">
        <a class="nav-link" href="{{ url('/account/changePassword') }}">
            <i class="fas fa-unlock-alt" style="padding: 5px;"></i>
            Change Password
        </a>
    </li>

    <li class="list-group-item">
        <form method="POST" action="{{ route('userLogout') }}" style="padding: 0">
            @csrf
            <a href="{{ route('userLogout') }}"
                onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link ">
                <i class="fas fa-right-from-bracket" style="padding: 5px;"></i>
                Logout
        </form>
    </li>
</ul>