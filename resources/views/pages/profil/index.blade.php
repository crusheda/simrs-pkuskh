@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Profil /</span> Detail
</h4>

<!-- Header -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      {{-- <div class="user-profile-header-banner">
        <img src="{{ asset('assets-new/img/pages/profile-banner.png') }}" width="100%" alt="Banner image" class="rounded-top">
      </div> --}}
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" height="100" width="100" alt="user image" style="margin-top: 2rem" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
        </div>
        <div class="flex-grow-1 mt-3">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4" style="margin-top: 1rem">
            <div class="user-profile-info">
              <h4>Hai, {{ Auth::user()->name }} <sup><i class="bx bx-badge-check text-primary"></i></sup></h4>
              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <li class="list-inline-item fw-semibold">
                  @foreach($list['user']->roles()->pluck('name') as $role) <span class="badge bg-secondary">{{ $role }}</span> @endforeach
                  <p></p>
                  <i class='bx bx-calendar'></i> Login terakhir : @if (!empty($list['showlog'][1])) {{ \Carbon\Carbon::parse($list['showlog'][1]->log_date)->diffForHumans() }} @else - @endif
                  <p></p>
                  <i class='bx bx-station'></i> Status : <kbd>Aktif</kbd>
                </li>
              </ul>
            </div>
            <a href="javascript:void(0)" class="btn btn-primary text-nowrap">
              <i class='bx bx-edit'></i> Update Profil
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Header -->

<div class="col-md-12">
  <div class="nav-align-top mb-4">
    <ul class="nav nav-pills flex-column flex-sm-row mb-4" role="tablist">
      <li class="nav-item">
        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#pills1" aria-controls="pills1" aria-selected="true"><i class="tf-icons bx bx-user"></i> Biodata</button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#pills2" aria-controls="pills2" aria-selected="false"><i class="tf-icons bx bx-calendar-check"></i> Aktivitas</button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#pills3" aria-controls="pills3" aria-selected="false"><i class="tf-icons bx bx-message-square"></i> Notifikasi</button>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade show active" id="pills1">
        <!-- User Profile Content -->
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
              <div class="card-body">
                <small class="text-muted text-uppercase">Privasi</small>
                <ul class="list-unstyled mb-4 mt-3">
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-id-card"></i><span class="fw-semibold mx-2">NIK:</span> <span>{{ $list['show']->nik }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="fas fa-hospital-user"></i><span class="fw-semibold mx-2">NIP:</span> <span>{{ $list['show']->nip }}</span></li>
                </ul>
                <small class="text-muted text-uppercase">Data Diri</small>
                <ul class="list-unstyled mb-4 mt-3">
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Nama Lengkap, Gelar:</span> <span>{{ $list['show']->nama }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-user-check"></i><span class="fw-semibold mx-2">Panggilan:</span> <span>{{ $list['show']->nick }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-calendar-check"></i><span class="fw-semibold mx-2">Tempat, Tanggal Lahir:</span> <span>{{ $list['show']->temp_lahir }}, {{ \Carbon\Carbon::parse($list['show']->tgl_lahir)->isoFormat('D MMM Y') }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="fas fa-venus-mars"></i><span class="fw-semibold mx-2">Jenis Kelamin:</span> <span style="text-transform: lowercase;">{{ ucfirst($list['show']->jns_kelamin) }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="fas fa-heart"></i><span class="fw-semibold mx-2">Status Kawin:</span> <span style="text-transform: lowercase;">{{ $list['show']->status_kawin }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-semibold mx-2">Status Karyawan:</span> <span>{{ $list['show']->status != 1? 'Aktif':'Non Aktif' }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span class="fw-semibold mx-2">Jabatan:</span> <span>@foreach($list['user']->roles()->pluck('name') as $role) <span class="badge bg-secondary">{{ $role }}</span> @endforeach</span></li>
                </ul>
                <small class="text-muted text-uppercase">Kontak</small>
                <ul class="list-unstyled mb-4 mt-3">
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span class="fw-semibold mx-2">No. HP:</span> <span>{{ $list['show']->no_hp }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="fab fa-instagram"></i><span class="fw-semibold mx-2">Instagram:</span> <span>{{ $list['show']->ig }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="fab fa-facebook"></i><span class="fw-semibold mx-2">Facebook:</span> <span>{{ $list['show']->fb }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span class="fw-semibold mx-2">Email:</span> <span>{{ $list['show']->email }}</span></li>
                </ul>
                <small class="text-muted text-uppercase">Alamat</small>
                <ul class="list-unstyled mt-3 mb-0">
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Kelurahan:</span> <span>{{ $list['show']->ktp_kelurahan }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Kecamatan:</span> <span>{{ $list['show']->ktp_kecamatan }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Kabupaten:</span> <span>{{ $list['show']->ktp_kabupaten }}</span></li>
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Provinsi:</span> <span>{{ $list['show']->ktp_provinsi }}</span></li>
                  <hr>
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Alamat Lengkap:</span></li>
                  <li><span>{{ $list['show']->alamat_ktp }}</span></li>
                </ul>
              </div>
            </div>
            <!--/ About User -->
            <!-- Profile Overview -->
            {{-- <div class="card mb-4">
              <div class="card-body">
                <small class="text-muted text-uppercase">Overview</small>
                <ul class="list-unstyled mt-3 mb-0">
                  <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-semibold mx-2">Task Compiled:</span> <span>13.5k</span></li>
                  <li class="d-flex align-items-center mb-3"><i class='bx bx-customize'></i><span class="fw-semibold mx-2">Projects Compiled:</span> <span>146</span></li>
                  <li class="d-flex align-items-center"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Connections:</span> <span>897</span></li>
                </ul>
              </div>
            </div> --}}
            <!--/ Profile Overview -->
          </div>
          {{-- <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Activity Timeline -->
            <div class="card card-action mb-4">
              <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0"><i class='bx bx-list-ul me-2'></i>Activity Timeline</h5>
                <div class="card-action-element">
                  <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                      <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <ul class="timeline ms-2">
                  <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-warning"></span>
                    <div class="timeline-event">
                      <div class="timeline-header mb-1">
                        <h6 class="mb-0">Client Meeting</h6>
                        <small class="text-muted">Today</small>
                      </div>
                      <p class="mb-2">Project meeting with john @10:15am</p>
                      <div class="d-flex flex-wrap">
                        <div class="avatar me-3">
                          <img src="{{ asset('assets-new/img/avatars/3.png') }}" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div>
                          <h6 class="mb-0">Lester McCarthy (Client)</h6>
                          <span>CEO of Infibeam</span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-info"></span>
                    <div class="timeline-event">
                      <div class="timeline-header mb-1">
                        <h6 class="mb-0">Create a new project for client</h6>
                        <small class="text-muted">2 Day Ago</small>
                      </div>
                      <p class="mb-0">Add files to new design folder</p>
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-primary"></span>
                    <div class="timeline-event">
                      <div class="timeline-header mb-1">
                        <h6 class="mb-0">Shared 2 New Project Files</h6>
                        <small class="text-muted">6 Day Ago</small>
                      </div>
                      <p class="mb-2">Sent by Mollie Dixon <img src="{{ asset('assets-new/img/avatars/4.png') }}" class="rounded-circle ms-3" alt="avatar" height="20" width="20"></p>
                      <div class="d-flex flex-wrap gap-2">
                        <a href="javascript:void(0)" class="me-3">
                          <img src="{{ asset('assets-new/img/icons/misc/pdf.png') }}" alt="Document image" width="20" class="me-2">
                          <span class="h6">App Guidelines</span>
                        </a>
                        <a href="javascript:void(0)">
                          <img src="{{ asset('assets-new/img/icons/misc/doc.png') }}" alt="Excel image" width="20" class="me-2">
                          <span class="h6">Testing Results</span>
                        </a>
                      </div>
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-success"></span>
                    <div class="timeline-event pb-0">
                      <div class="timeline-header mb-1">
                        <h6 class="mb-0">Project status updated</h6>
                        <small class="text-muted">10 Day Ago</small>
                      </div>
                      <p class="mb-0">Woocommerce iOS App Completed</p>
                    </div>
                  </li>
                  <li class="timeline-end-indicator">
                    <i class="bx bx-check-circle"></i>
                  </li>
                </ul>
              </div>
            </div>
            <!--/ Activity Timeline -->
            <div class="row">
              <!-- Connections -->
              <div class="col-lg-12 col-xl-6">
                <div class="card card-action mb-4">
                  <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Connections</h5>
                    <div class="card-action-element">
                      <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item" href="javascript:void(0);">Share connections</a></li>
                          <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled mb-0">
                      <li class="mb-3">
                        <div class="d-flex align-items-start">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/avatars/2.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-2">
                              <h6 class="mb-0">Cecilia Payne</h6>
                              <small class="text-muted">45 Connections</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <button class="btn btn-label-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                          </div>
                        </div>
                      </li>
                      <li class="mb-3">
                        <div class="d-flex align-items-start">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/avatars/3.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-2">
                              <h6 class="mb-0">Curtis Fletcher</h6>
                              <small class="text-muted">1.32k Connections</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <button class="btn btn-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                          </div>
                        </div>
                      </li>
                      <li class="mb-3">
                        <div class="d-flex align-items-start">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/avatars/10.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-2">
                              <h6 class="mb-0">Alice Stone</h6>
                              <small class="text-muted">125 Connections</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <button class="btn btn-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                          </div>
                        </div>
                      </li>
                      <li class="mb-3">
                        <div class="d-flex align-items-start">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/avatars/7.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-2">
                              <h6 class="mb-0">Darrell Barnes</h6>
                              <small class="text-muted">456 Connections</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <button class="btn btn-label-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                          </div>
                        </div>
                      <li class="mb-3">
                        <div class="d-flex align-items-start">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/avatars/12.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-2">
                              <h6 class="mb-0">Eugenia Moore</h6>
                              <small class="text-muted">1.2k Connections</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <button class="btn btn-label-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                          </div>
                        </div>
                      </li>
                      <li class="text-center">
                        <a href="javascript:;">View all connections</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!--/ Connections -->
              <!-- Teams -->
              <div class="col-lg-12 col-xl-6">
                <div class="card card-action mb-4">
                  <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Teams</h5>
                    <div class="card-action-element">
                      <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item" href="javascript:void(0);">Share teams</a></li>
                          <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled mb-0">
                      <li class="mb-3">
                        <div class="d-flex align-items-center">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/icons/brands/react-label.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-2">
                              <h6 class="mb-0">React Developers</h6>
                              <small class="text-muted">72 Members</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                          </div>
                        </div>
                      </li>
                      <li class="mb-3">
                        <div class="d-flex align-items-center">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/icons/brands/support-label.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-2">
                              <h6 class="mb-0">Support Team</h6>
                              <small class="text-muted">122 Members</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <a href="javascript:;"><span class="badge bg-label-primary">Support</span></a>
                          </div>
                        </div>
                      </li>
                      <li class="mb-3">
                        <div class="d-flex align-items-center">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/icons/brands/figma-label.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-2">
                              <h6 class="mb-0">UI Designers</h6>
                              <small class="text-muted">7 Members</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <a href="javascript:;"><span class="badge bg-label-info">Designer</span></a>
                          </div>
                        </div>
                      </li>
                      <li class="mb-3">
                        <div class="d-flex align-items-center">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/icons/brands/vue-label.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-2">
                              <h6 class="mb-0">Vue.js Developers</h6>
                              <small class="text-muted">289 Members</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                          </div>
                        </div>
                      </li>
                      <li class="mb-3">
                        <div class="d-flex align-items-center">
                          <div class="d-flex align-items-start">
                            <div class="avatar me-3">
                              <img src="{{ asset('assets-new/img/icons/brands/twitter-label.png') }}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="me-w">
                              <h6 class="mb-0">Digital Marketing</h6>
                              <small class="text-muted">24 Members</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <a href="javascript:;"><span class="badge bg-label-secondary">Marketing</span></a>
                          </div>
                        </div>
                      </li>
                      <li class="text-center">
                        <a href="javascript:;">View all teams</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!--/ Teams -->
            </div>
          </div> --}}
        </div>
        <!--/ User Profile Content -->
      </div>
      <div class="tab-pane fade" id="pills2" role="tabpanel">
        Maaf, kami sedang dalam perbaikan sistem
      </div>
      <div class="tab-pane fade" id="pills3" role="tabpanel">
        Maaf, kami sedang dalam perbaikan sistem
      </div>
    </div>
  </div>
</div>

@endsection