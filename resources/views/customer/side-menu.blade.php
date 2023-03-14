<ul class="list-group account-side-menu ">

    <li class="list-group-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-gauge"></i>
            Dashboard
        </a>
    </li>


    <li class="list-group-item">
        <a class="nav-link" href="{{ url('/orders') }}">
            <i class="fas fa-bag-shopping"></i>
            My Orders
        </a>
    </li>


    <li class="list-group-item">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-calendar"></i>
            Edit Profile
        </a>
    </li>


    <li class="list-group-item">
        <a class="nav-link" href="{{ url('/change-password') }}">
            <i class="fas fa-unlock-alt"></i>
            Change Password
        </a>
    </li>

    <li class="list-group-item">
        <form action="/logout/user" method="POST" style="padding: 0" id="logout">
            @csrf
            <a class="nav-link " href="javascript:{}" onclick="document.getElementById('logout').submit();">
                <i class="fas fa-right-from-bracket"></i>
                Logout
            </a>
        </form>
    </li>
</ul>