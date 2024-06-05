<!-- App Bottom Menu -->
<div class="appBottomMenu">
        <a href="/dashboard" class="item {{ request()-> is('dashboard') ? 'active' : ''}}">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="/monitoring" class="item {{ request()-> is('monitoring') ? 'active' : ''}}">
            <div class="col">
                <ion-icon name="calendar-outline" role="img" class="md hydrated"
                    aria-label="calendar outline"></ion-icon>
                <strong>Monitoring</strong>
            </div>
        </a>

        <a href="/profil" class="item {{ request()-> is('profil') ? 'active' : ''}}">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                <strong>Profil</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->