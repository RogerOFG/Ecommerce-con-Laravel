<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" href="{{ asset('/assets/img/logo/icon/icon-black.ico') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/dashboard.css') }}">

    @yield('head')
</head>

<body>
    <div class="container">
        <!-- Recibir Alertas -->
        @if(session('success'))
            <div class="alert alert-controller alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-controller alert-error">
                {{ session('error') }}
            </div>
        @elseif (session('warning'))
            <div class="alert alert-controller alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        <!-- Validacion de errores -->
        @if ($errors->any())
            <div class="alert alert-controller alert-error">
                <div class="alert__close"> 
                    <i class="bi bi-exclamation-circle"></i>
                </div>

                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="{{ asset('/assets/img/logo/icon/icon-black.ico') }}">
                    <h2>Shop<span class="danger">Xeng</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="{{ route('pageDash') }}" @yield('opDash')>
                    <i class="bi bi-columns-gap"></i>

                    <h3>Dashboard</h3>
                </a>
                <a href="{{ route('pageDashU') }}" @yield('opUser')>
                    <i class="bi bi-person-circle"></i>

                    <h3>Usuarios</h3>
                </a>
                <a href="{{ route('pageDashP') }}" @yield('opProd')>
                    <i class="bi bi-shop"></i>

                    <h3>Productos</h3>
                </a>

                <a href="{{ route('pageDashO') }}" @yield('opOrders')>
                    <i class="bi bi-cart3"></i>

                    <h3>Pedidos</h3>
                    @if ($totalBillsP > 0)
                        <span class="message-count">
                            {{ $totalBillsP }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('pageHome') }}">
                    <i class="bi bi-box-arrow-right"></i>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        @yield('content')

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>{{ $userName }}</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <i class="bi bi-person-circle"></i>
                    </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="{{ asset('/assets/img/logo/icon/icon-black.ico') }}">
                    <h2>ShopXeng</h2>
                    <p>Dashboard</p>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <h2>Reminders</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>

                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            volume_up
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Workshop</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification deactive">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            edit
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Workshop</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp">
                            add
                        </span>
                        <h3>Add Reminder</h3>
                    </div>
                </div>

            </div>

        </div>
        <!-- End of Right Section -->
    </div>

    <script src="{{ asset('/assets/js/dashMenu&Night.js') }}"></script>
    <script>
        const alert = document.querySelector('.alert-controller');

        if(alert){
            setTimeout(() => {
                alert.classList.add('active');

                setTimeout(() => {
                    alert.classList.remove('active');
                }, 4000);
            }, 10);
        }
    </script>
    @yield('scripts')
</body>
</html>