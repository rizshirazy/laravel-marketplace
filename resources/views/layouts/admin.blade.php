<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="icon" href="/images/admin-logo.svg">
    <title>@yield('title')</title>

    {{-- Styles --}}
    @stack('prepend-styles')
    @include('includes.style')
    @stack('addon-styles')

  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="/images/admin-logo.svg" alt="" class="my-4" style="max-width: 150px" />
          </div>
          <div class="list-group list-group-flush">
            <a href="{{ route('admin.dashboard') }}"
               class="list-group-item list-group-item-action {{ (request()->is('admin')) ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.products.index') }}"
               class="list-group-item list-group-item-action {{ (request()->is('admin/products*')) ? 'active' : '' }}">Products</a>
            <a href="{{ route('admin.categories.index') }}"
               class="list-group-item list-group-item-action {{ (request()->is('admin/categories*')) ? 'active' : '' }}">Categories</a>
            <a href="#"
               class="list-group-item list-group-item-action">Transactions</a>
            <a href="{{ route('admin.users.index') }}"
               class="list-group-item list-group-item-action {{ (request()->is('admin/users*')) ? 'active' : '' }}">Users</a>
            <a href="#"
               class="list-group-item list-group-item-action">Sign Out</a>
          </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <nav class="navbar navbar-store navbar-expand-lg navbar-light fixed-top"
               data-aos="fade-down">
            <button class="btn btn-secondary d-md-none mr-auto mr-2"
                    id="menu-toggle">
              &laquo; Menu
            </button>

            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto d-none d-lg-flex">
                <li class="nav-item dropdown">
                  <a class="nav-link"
                     href="#"
                     id="navbarDropdown"
                     role="button"
                     data-toggle="dropdown"
                     aria-haspopup="true"
                     aria-expanded="false">
                    <img src="/images/icon-user.png"
                         alt=""
                         class="rounded-circle mr-2 profile-picture" />
                    Hi, Angga
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/">Sign Out</a>
                  </div>
                </li>
              </ul>
              <!-- Mobile Menu -->
              <ul class="navbar-nav d-block d-lg-none mt-3">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    Hi, Angga
                  </a>
                </li>
              </ul>
            </div>
          </nav>

          {{-- Main Content --}}
          @yield('content')
        </div>
        <!-- /#page-content-wrapper -->
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-scripts')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function (e) {
                  e.preventDefault();
                  $("#wrapper").toggleClass("toggled");
              });
    </script>

    @stack('addon-scripts')
  </body>

</html>