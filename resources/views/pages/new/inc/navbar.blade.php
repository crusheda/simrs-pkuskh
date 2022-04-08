<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> --}}
    </ul>
    {{-- <div class="search-element">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
      <button class="btn" type="submit"><i class="fas fa-search"></i></button>
      <div class="search-backdrop"></div>
      <div class="search-result">
        <div class="search-header">
          Histories
        </div>
        <div class="search-item">
          <a href="#">How to hack NASA using CSS</a>
          <a href="#" class="search-close"><i class="fas fa-times"></i></a>
        </div>
        <div class="search-item">
          <a href="#">Kodinger.com</a>
          <a href="#" class="search-close"><i class="fas fa-times"></i></a>
        </div>
        <div class="search-item">
          <a href="#">#Stisla</a>
          <a href="#" class="search-close"><i class="fas fa-times"></i></a>
        </div>
        <div class="search-header">
          Result
        </div>
        <div class="search-item">
          <a href="#">
            <img class="mr-3 rounded" width="30" src="assets/img/products/product-3-50.png" alt="product">
            oPhone S9 Limited Edition
          </a>
        </div>
        <div class="search-item">
          <a href="#">
            <img class="mr-3 rounded" width="30" src="assets/img/products/product-2-50.png" alt="product">
            Drone X2 New Gen-7
          </a>
        </div>
        <div class="search-item">
          <a href="#">
            <img class="mr-3 rounded" width="30" src="assets/img/products/product-1-50.png" alt="product">
            Headphone Blitz
          </a>
        </div>
        <div class="search-header">
          Projects
        </div>
        <div class="search-item">
          <a href="#">
            <div class="search-icon bg-danger text-white mr-3">
              <i class="fas fa-code"></i>
            </div>
            Stisla Admin Template
          </a>
        </div>
        <div class="search-item">
          <a href="#">
            <div class="search-icon bg-primary text-white mr-3">
              <i class="fas fa-laptop"></i>
            </div>
            Create a new Homepage Design
          </a>
        </div>
      </div>
    </div> --}}
  </form>
  <ul class="navbar-nav navbar-right">
    {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Messages
          <div class="float-right">
            <a href="#">Mark All As Read</a>
          </div>
        </div>
        <div class="dropdown-list-content dropdown-list-message">
          <a href="#" class="dropdown-item dropdown-item-unread">
            <div class="dropdown-item-avatar">
              <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
              <div class="is-online"></div>
            </div>
            <div class="dropdown-item-desc">
              <b>Kusnaedi</b>
              <p>Hello, Bro!</p>
              <div class="time">10 Hours Ago</div>
            </div>
          </a>
          <a href="#" class="dropdown-item dropdown-item-unread">
            <div class="dropdown-item-avatar">
              <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle">
            </div>
            <div class="dropdown-item-desc">
              <b>Dedik Sugiharto</b>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              <div class="time">12 Hours Ago</div>
            </div>
          </a>
          <a href="#" class="dropdown-item dropdown-item-unread">
            <div class="dropdown-item-avatar">
              <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle">
              <div class="is-online"></div>
            </div>
            <div class="dropdown-item-desc">
              <b>Agung Ardiansyah</b>
              <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <div class="time">12 Hours Ago</div>
            </div>
          </a>
          <a href="#" class="dropdown-item">
            <div class="dropdown-item-avatar">
              <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle">
            </div>
            <div class="dropdown-item-desc">
              <b>Ardian Rahardiansyah</b>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
              <div class="time">16 Hours Ago</div>
            </div>
          </a>
          <a href="#" class="dropdown-item">
            <div class="dropdown-item-avatar">
              <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle">
            </div>
            <div class="dropdown-item-desc">
              <b>Alfa Zulkarnain</b>
              <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
              <div class="time">Yesterday</div>
            </div>
          </a>
        </div>
        <div class="dropdown-footer text-center">
          <a href="#">View All <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </li> --}}
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg" onclick="lihatNotif()"><i class="far fa-bell"></i></a>
    {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg" onclick="lihatNotif()"><i class="far fa-bell-slash"></i></a> --}}
      <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifikasi
          {{-- <div class="float-right">
            <a href="#">Mark All As Read</a>
          </div> --}}
        </div>
        <div class="dropdown-list-content dropdown-list-icons" id="notif">
          {{-- <a href="#" class="dropdown-item dropdown-item-unread">
            <div class="dropdown-item-icon bg-primary text-white">
              <i class="fas fa-code"></i>
            </div>
            <div class="dropdown-item-desc">
              Kami sedang melakukan update tampilan pada website Simrsmu
              <div class="time text-primary">2 Min Ago</div>
            </div>
          </a> --}}
        </div>
        <div class="dropdown-footer text-center">
          <a href="#">Lihat Semua <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <?php $foto_profil = DB::table('foto_profil')->where('user_id', Auth::user()->id)->first(); ?>
      @if (!empty($foto_profil->filename))
        <img alt="image" src="{{ url('storage/'.substr($foto_profil->filename,7,1000)) }}" class="rounded-circle mr-1">
      @else
        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
      @endif
      <div class="d-sm-none d-lg-inline-block">Hai, {{ Auth::user()->name }}</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title" style="margin-bottom: -10px"><i class="fas fa-clock"></i>&nbsp;@if (!empty($list['showlog'][1])) {{ \Carbon\Carbon::parse($list['showlog'][1]->log_date)->diffForHumans() }} @else - @endif</div>
        <hr>
        <a href="{{ route('profil.index') }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profil
        </a>
        {{-- <a href="features-activities.html" class="dropdown-item has-icon">
          <i class="fas fa-bolt"></i> Activities
        </a> --}}
        <a href="{{ route('auth.change_password') }}" class="dropdown-item has-icon">
          <i class="fas fa-cog"></i> Ubah Password
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<script>
  $(document).ready( function () {
    $.ajax({
      url: "../././././api/notif",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        if (res.length != 0) {
          $('.notification-toggle').addClass('beep');
        }
      }
    });
  })
</script>
<script>
  function lihatNotif() {
    $('#notif').empty();
    $.ajax({
      url: "../././././api/notif",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        res.forEach(item => {
            var tgl = item.tgl.substring(0,7);
            content = "<a href='#' class='dropdown-item'>" 
                        + "<div class='dropdown-item-icon text-white' style='background-color: " + item.color + "'>" 
                        + "<i class='fas " + item.icon + "'></i>" 
                        + "</div>" 
                        + "<div class='dropdown-item-desc'>"
                        + item.ket + "<div class='time'>" + tgl + "</div>"
                        + "</div>"
                        + "</a>";
            $('#notif').append(content);
        });
      }
    });
  }
</script>
#6777ef