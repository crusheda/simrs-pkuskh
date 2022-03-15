@extends('layouts.newAdmin')

@section('content')
<h2 class="section-title">Hai, {{ Auth::user()->name }}</h2>
<p class="section-lead">
  Ubah informasi profil anda.
</p>

<div class="row mt-sm-4">
  <div class="col-12 col-md-12 col-lg-5">
    <div class="card profile-widget">
      <div class="profile-widget-header">
        @if (!empty($list['foto']->filename))
          <img alt="image" src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" class="rounded-circle profile-widget-picture">
        @else
          <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
        @endif
        <div class="profile-widget-items">
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Posts</div>
            <div class="profile-widget-item-value">187</div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Followers</div>
            <div class="profile-widget-item-value">6,8K</div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Following</div>
            <div class="profile-widget-item-value">2,1K</div>
          </div>
        </div>
      </div>
      <div class="profile-widget-description">
        <div class="profile-widget-name">{{ Auth::user()->nama }} <div class="text-muted d-inline font-weight-normal">&mdash; @foreach($list['user']->roles()->pluck('name') as $role) <span class="badge badge-light">{{ $role }}</span> @endforeach</div></div>
        {{-- {{ $list['user']->bio }} --}}
      </div>
      <div class="card-footer text-center">
        <div class="font-weight-bold mb-2">Follow RS PKU Muhammadiyah Sukoharjo</div>
        <a href="http://pkusukoharjo.com/" class="btn btn-social-icon btn-dark mr-1" target="_blank">
          <i class="fas fa-globe"></i>
        </a>
        <a href="https://www.facebook.com/rspkusukoharjo" class="btn btn-social-icon btn-facebook mr-1" target="_blank">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://twitter.com/rspkusukoharjo" class="btn btn-social-icon btn-twitter mr-1" target="_blank">
          <i class="fab fa-twitter"></i>
        </a>
        {{-- <a href="https://www.tiktok.com/@rspkusukoharjo" class="btn btn-social-icon btn-github mr-1" target="_blank">
          <i class="fab fa-tiktok"></i>
        </a> --}}
        <a href="https://www.instagram.com/rspkusukoharjo/" class="btn btn-social-icon btn-instagram mr-1" target="_blank" style="background-color: rgb(243, 109, 176)">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.youtube.com/channel/UChgodAUFt7N3Hfcs6RPlOTQ" class="btn btn-social-icon btn-danger" target="_blank">
          <i class="fab fa-youtube"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-12 col-lg-7">
    <div class="card">
      <form method="post" class="needs-validation" novalidate="">
        <div class="card-header">
          <h4>Ubah Profil</h4>
        </div>
        <div class="card-body">
            <div class="row">
              <div class="form-group col-md-5 col-12">
                <label>Nama Akun</label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
              </div>
              <div class="form-group col-md-7 col-12">
                <label>NIK</label>
                <input type="text" class="form-control" value="ujang@maman.com" required="">
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
              <div class="form-group col-md-8 col-12">
                <label>Nama Lengkap, Gelar</label>
                <input type="text" class="form-control" value="{{ $list['user']->nama }}">
                <div class="invalid-feedback">
                  Tuliskan Nama Lengkap Anda.
                </div>
              </div>
              <div class="form-group col-md-4 col-12">
                <label>Nama Panggilan</label>
                <input type="text" class="form-control" value="{{ Auth::user()->nick }}">
                <div class="invalid-feedback">
                  Tuliskan Nama Panggilan Anda.
                </div>
              </div>
              <div class="form-group col-md-4 col-12">
                <label>Tempat Lahir</label>
                <input type="text" class="form-control" value="ujang@maman.com" required="">
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
              <div class="form-group col-md-3 col-12">
                <label>Tanggal Lahir</label>
                <input type="text" class="form-control" value="ujang@maman.com" required="">
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
              <div class="form-group col-md-3 col-12">
                <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="form-control selectric">
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                  </select>
                </div>
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
              <div class="form-group col-md-2 col-12">
                <div class="form-group">
                  <label>Status Kawin</label>
                  <select class="form-control selectric">
                    <option>Belum</option>
                    <option>Sudah</option>
                    <option>Cerai</option>
                    <option>Tidak ingin memberi tahu</option>
                  </select>
                </div>
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
            </div>
            <hr style="margin-top: -5px">
            <div class="row">
              <div class="form-group col-md-6 col-12">
                <label>Email</label>
                <input type="email" class="form-control" value="ujang@maman.com" required="">
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
              <div class="form-group col-md-6 col-12">
                <label>No. HP / Whatsapp</label>
                <input type="text" class="form-control" value="ujang@maman.com" required="">
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
              <div class="form-group col-md-6 col-12">
                <label>Instagram</label>
                <input type="text" class="form-control" value="ujang@maman.com" required="">
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
              <div class="form-group col-md-6 col-12">
                <label>Facebook</label>
                <input type="text" class="form-control" value="ujang@maman.com" required="">
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12">
                <label>Bio</label>
                <textarea class="form-control summernote-simple">Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.</textarea>
              </div>
            </div>
            <hr style="margin-top: -5px">
            <div class="row">
              <div class="form-group col-md-6 col-12">
                <div class="form-group">
                  <label>Provinsi</label>
                  <select class="form-control selectric">
                    @foreach($list['provinsi'] as $item)
                        <option value="{{ $item->provinsi }}" @if ($item->provinsi == $list['showuser']->ktp_provinsi) echo selected @endif>{{ $item->provinsi }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group col-md-6 col-12">
                <div class="form-group">
                  <label>Kabupaten</label>
                  <select class="form-control selectric">
                    @if (!empty($list['showuser']->ktp_kabupaten))
                        <option value="{{ $list['showuser']->ktp_kabupaten }}">{{ $list['showuser']->ktp_kabupaten }}</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group col-md-6 col-12">
                <div class="form-group">
                  <label>Kecamatan</label>
                  <select class="form-control selectric">
                    @if (!empty($list['showuser']->ktp_kecamatan))
                        <option value="{{ $list['showuser']->ktp_kecamatan }}">{{ $list['showuser']->ktp_kecamatan }}</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group col-md-6 col-12">
                <div class="form-group">
                  <label>Kelurahan</label>
                  <select class="form-control selectric">
                    @if (!empty($list['showuser']->ktp_kelurahan))
                        <option value="{{ $list['showuser']->ktp_kelurahan }}">{{ $list['showuser']->ktp_kelurahan }}</option>
                    @endif
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group mb-0 col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" id="newsletter">
                  <label class="custom-control-label" for="newsletter">Subscribe to newsletter</label>
                  <div class="text-muted form-text">
                    You will get new information about products, offers and promotions
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="card-footer text-right">
          <button class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection