@php
    $route = Route::currentRouteName();
    $title = null;
    $b1 = null;
    $b2 = null;
    $b3 = null;
    $b4 = null;
    $b5 = null;
    $b6 = null;
    // print_r($route);
    // die();

    if ($route == 'welcome') {
      $title = 'Dashboard';
      $b1 = 'Dashboard'; 
    }
    if ($route == 'profil.index') {
      $title = 'Ubah Profil Karyawan';
      $b1 = 'Dashboard'; 
      $b2 = 'Profil'; 
    }
    if ($route == 'lab.antigen.index') {
      $title = 'Data Antigen';
      $b1 = 'Dashboard'; 
      $b2 = 'Lab'; 
      $b3 = 'Antigen'; 
    }

@endphp
<h1>{{ $title }}</h1>
<nav class="section-header-breadcrumb" aria-label="breadcrumb" style="margin-bottom: -10px">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      @if ($b2 != null)
        <a href="#">{{ $b1 }}</a>
      @else
        {{ $b1 }}
      @endif
    </li>

    @if ($b2 != null)
      <li class="breadcrumb-item active">
        @if ($b3 != null)
          <a href="#">{{ $b2 }}</a>
        @else
          {{ $b2 }}
        @endif
      </li>
    @endif
    
    @if ($b3 != null)
      <li class="breadcrumb-item active">
        @if ($b4 != null)
          <a href="#">{{ $b3 }}</a>
        @else
          {{ $b3 }}
        @endif
      </li>
    @endif
    
    @if ($b4 != null)
      <li class="breadcrumb-item active">
        @if ($b5 != null)
          <a href="#">{{ $b4 }}</a>
        @else
          {{ $b4 }}
        @endif
      </li>
    @endif
    
    @if ($b6 != null)
      <li class="breadcrumb-item active">
        {{ $b6 }}
      </li>
    @endif
  </ol>
</nav>