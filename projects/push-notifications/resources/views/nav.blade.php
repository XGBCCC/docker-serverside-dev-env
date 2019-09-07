<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <!-- Navbar content -->
    <a class="navbar-brand" href="/">Boxue</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MainMenu" aria-controls="MainMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    @auth
        <div class="collapse navbar-collapse" id="MainMenu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link to="/devices" class="nav-link">Registered Devices</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/notifications" class="nav-link">Notifications</router-link>
                </li>
            </ul>

            <ul class="navbar-nav mr-4">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="UserDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bx11</a>
                    <div class="dropdown-menu" aria-labelledby="UserDropDown">
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" href="#" class="dropdown-item">Logout</a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    @endauth
</nav>
