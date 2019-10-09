@php
$routeDivision = ['/divisions'];
$routeMember = ['/members'];
$routeTeam = ['/teams'];
@endphp
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('images/logo.svg') }}" alt="Deha Member" style="width: 100px;" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="{{ activeRoute($routeDivision) }}">
                    <a href="{{ route(DIVISION_LIST) }}">
                        <i class="fas fa-object-group"></i>Divisions</a>
                </li>
                <li class="{{ activeRoute($routeMember) }}" >
                    <a href="{{ route(MEMBER_LIST) }}">
                        <i class="fas fa-users"></i>Members</a>
                </li>
                <li class="{{ activeRoute($routeTeam) }}" >
                    <a href="{{ route(TEAM_LIST) }}">
                        <i class="fas fa-users"></i>Teams</a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-calendar-plus"></i>Over Time</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>