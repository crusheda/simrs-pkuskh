@extends('layouts.newAdmin')

@section('content')
<h2 class="section-title">Hai, {{ Auth::user()->name }}</h2>
<p class="section-lead">
  Ubah informasi profil anda.
</p>

<div class="row mt-sm-4">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card profile-widget">
      <div class="profile-widget-header">
        @if (!empty($list['foto']->filename))
          <img alt="image" src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" class="rounded-circle profile-widget-picture">
        @else
          <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
        @endif
        <div class="profile-widget-items">
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Total Login</div>
            <div class="profile-widget-item-value">-</div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Terakhir Ubah Profil</div>
            <div class="profile-widget-item-value">-</div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Status Kepegawaian</div>
            <div class="profile-widget-item-value">
              <button class="btn btn-primary"><i class="fas fa-file-contract"></i> Lihat</button>
            </div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Foto Profil</div>
            <div class="profile-widget-item-value">
              <div class="btn-group">
                <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                <button class="btn btn-info"><i class="fas fa-download"></i></button>
                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-widget-description">
        <div class="profile-widget-name">{{ Auth::user()->nama }} <div class="text-muted d-inline font-weight-normal">&mdash; @foreach($list['user']->roles()->pluck('name') as $role) <span class="badge badge-light">{{ $role }}</span> @endforeach</div></div>
        {{-- {{ $list['user']->bio }} --}}
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum placeat voluptas aliquam rerum, laudantium voluptatem vel optio dolor consectetur quaerat! Deleniti aperiam labore eos quisquam ipsam pariatur repudiandae molestiae tenetur.
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque quis, consequuntur hic veritatis corporis est expedita aliquam veniam? Neque consequuntur minus impedit. Iure itaque eligendi, excepturi nisi reprehenderit accusantium quasi.
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
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <form class="form-auth-small" action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="number" name="id" value="{{ $list['user']->id }}" hidden>
        <div class="card-header">
          <h4>Ubah Profil</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-5 col-12">
              <label>Nama Akun</label>
              <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group col-md-7 col-12">
              <label>NIK</label>
              <input type="text" id="nik" name="nik" class="form-control" value="ujang@maman.com" required="" autofocus>
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-8 col-12">
              <label>Nama Lengkap, Gelar</label>
              <input type="text" id="nama" name="nama" class="form-control" value="{{ $list['user']->nama }}">
              <div class="invalid-feedback">
                Tuliskan Nama Lengkap Anda.
              </div>
            </div>
            <div class="form-group col-md-4 col-12">
              <label>Nama Panggilan</label>
              <input type="text" id="nick" name="nick" class="form-control" value="{{ Auth::user()->nick }}">
              <div class="invalid-feedback">
                Tuliskan Nama Panggilan Anda.
              </div>
            </div>
            <div class="form-group col-md-3 col-12">
              <label>Tempat Lahir</label>
              <select class="form-control select2" id="temp_lahir" name="temp_lahir">
                <option selected="selected" value="">Pilih Kota</option>
                @foreach($list['nama_kabkota'] as $item)
                    <option value="{{ $item->nama_kabkota }}" @if ($list['showuser']->temp_lahir == $item->nama_kabkota) echo selected @endif>{{ $item->nama_kabkota }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-3 col-12">
              <label>Tanggal Lahir</label>
              <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($list['showuser']->tgl_lahir)); ?>" required="">
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-3 col-12">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control selectric" id="jns_kelamin" name="jns_kelamin">
                  <option value="LAKI-LAKI" @if ($list['showuser']->jns_kelamin == 'LAKI-LAKI') echo selected @endif>Laki-laki</option>
                  <option value="PEREMPUAN" @if ($list['showuser']->jns_kelamin == 'PEREMPUAN') echo selected @endif>Perempuan</option>
                </select>
              </div>
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-3 col-12">
              <div class="form-group">
                <label>Status Kawin</label>
                <select class="form-control selectric" id="status_kawin" name="status_kawin">
                  <option value="">Pilih</option>
                  <option value="BELUM" @if ($list['showuser']->status_kawin == 'BELUM') echo selected @endif>Belum</option>
                  <option value="SUDAH" @if ($list['showuser']->status_kawin == 'SUDAH') echo selected @endif>Sudah</option>
                  <option value="CERAI" @if ($list['showuser']->status_kawin == 'CERAI') echo selected @endif>Cerai</option>
                  <option value="RAHASIA" @if ($list['showuser']->status_kawin == 'RAHASIA') echo selected @endif>Tidak ingin memberi tahu</option>
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
              <input type="email" id="email" name="email" class="form-control" value="{{ $list['user']->email }}">
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <label>No. HP / Whatsapp</label>
              <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ $list['showuser']->no_hp }}" required="">
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <label>Instagram</label>
              <input type="text" id="ig" name="ig" class="form-control" value="{{ $list['showuser']->ig }}" required="">
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <label>Facebook</label>
              <input type="text" id="fb" name="fb" class="form-control" value="{{ $list['showuser']->fb }}" required="">
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-12">
              <label>Bio</label>
              <textarea class="form-control summernote-simple" readonly>Mohon Maaf, Fitur ini belum tersedia</textarea>
            </div>
          </div>
          <hr style="margin-top: -5px">
          <center><div class="font-weight-bold mb-3">Alamat sesuai KTP</div></center>
          <div class="row">
            <div class="form-group col-md-6 col-12">
              <div class="form-group">
                <label>Provinsi</label>
                <select class="form-control" id="apiprovinsi" name="ktp_provinsi">
                  <option value="" hidden>Pilih Provinsi</option>
                  @foreach($list['provinsi'] as $item)
                    <option value="{{ $item->provinsi }}" @if ($item->provinsi == $list['showuser']->ktp_provinsi) echo selected @endif>{{ $item->provinsi }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <div class="form-group">
                <label>Kabupaten</label>
                <select class="form-control" id="apikota" name="ktp_kabupaten" disabled required>
                  @if (!empty($list['showuser']->ktp_kabupaten))
                    <option value="{{ $list['showuser']->ktp_kabupaten }}">{{ $list['showuser']->ktp_kabupaten }}</option>
                  @endif
                </select>
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <div class="form-group">
                <label>Kecamatan</label>
                <select class="form-control" id="apikecamatan" name="ktp_kecamatan" disabled required>
                  @if (!empty($list['showuser']->ktp_kecamatan))
                    <option value="{{ $list['showuser']->ktp_kecamatan }}">{{ $list['showuser']->ktp_kecamatan }}</option>
                  @endif
                </select>
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <div class="form-group">
                <label>Kelurahan</label>
                <select class="form-control" id="apidesa" name="ktp_kelurahan" disabled required>
                  @if (!empty($list['showuser']->ktp_kelurahan))
                    <option value="{{ $list['showuser']->ktp_kelurahan }}">{{ $list['showuser']->ktp_kelurahan }}</option>
                  @endif
                </select>
              </div>
            </div>
            <div class="form-group col-md-12 col-12">
              <label for="alamat_ktp" class="control-label">Alamat Lengkap :</label>
              <textarea class="form-control" name="alamat_ktp" id="alamat_ktp" placeholder="" maxlength="190" rows="8" required><?php echo htmlspecialchars($list['showuser']->alamat_ktp); ?></textarea>
            </div>
            <div class="form-group col-md-12 col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" @if (!empty($list['user']->alamat_dom)) value="1" @else value="0" checked @endif name="cek_dom" id="checkbox_alamat">
                <label class="custom-control-label" for="checkbox_alamat">Alamat Domisili sesuai dengan KTP</label>
                <div class="text-muted form-text">
                  Centang apabila alamat Domisili sekarang sama dengan alamat di KTP anda.
                </div>
              </div>
            </div>
          </div>
          <div class="collapse <?php if(!empty($list['user']->alamat_dom)) { echo 'show'; } ?>" id="dom_collapse">
            <center><div class="font-weight-bold mb-3">Alamat Domisili</div></center>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Provinsi</label>
                  <select class="form-control" id="apiprovinsidom" name="dom_proinsi">
                    <option id="pilih" value="" hidden>Pilih Provinsi</option>
                    @foreach($list['provinsi'] as $item)
                        <option value="{{ $item->provinsi }}" @if ($item->provinsi == $list['showuser']->dom_provinsi) echo selected @endif>{{ $item->provinsi }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kabupaten</label>
                  <select class="form-control" id="apikotadom" name="dom_kabupaten" disabled required>
                    @if (!empty($list['showuser']->dom_kabupaten))
                        <option value="{{ $list['showuser']->dom_kabupaten }}">{{ $list['showuser']->dom_kabupaten }}</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kecamatan</label>
                  <select class="form-control" id="apikecamatandom" name="dom_kecamatan" disabled required>
                    @if (!empty($list['showuser']->dom_kecamatan))
                        <option value="{{ $list['showuser']->dom_kecamatan }}">{{ $list['showuser']->dom_kecamatan }}</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kelurahan</label>
                  <select class="form-control" id="apidesadom" name="dom_kelurahan" disabled required>
                    @if (!empty($list['showuser']->dom_kelurahan))
                    <option value="{{ $list['showuser']->dom_kelurahan }}">{{ $list['showuser']->dom_kelurahan }}</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <label>Alamat Lengkap :</label>
                <textarea class="form-control" name="alamat_dom" id="alamat_dom" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($list['showuser']->alamat_dom); ?></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="assets/modules/jquery.min.js"></script>
<script>
  $(document).ready( function () {

      // VALIDASI INPUT NUMBER
      $('input[type=number][max]:not([max=""])').on('input', function(ev) {
          var $this = $(this);
          var maxlength = $this.attr('max').length;
          var value = $this.val();
          if (value && value.length >= maxlength) {
          $this.val(value.substr(0, maxlength));
          }
      });
      
      // ALAMAT KTP
          $('#apiprovinsi').change(function() { 
          // console.log(this.value);
          
              $.ajax({
                  url: "./api/provinsi/"+this.value,
                  type: 'GET',
                  dataType: 'json', // added data type
                  success: function(res) {
                    // console.log(this.value);
                      // var valprovinsi = $("#apiprovinsi").val();
                      $("#apikota").val("").find('option').remove();
                      $("#apikecamatan").val("").find('option').remove();
                      $("#apidesa").val("").find('option').remove();
                      $("#apikota").attr('disabled', false);
                      $("#apikecamatan").attr('disabled', true);
                      $("#apidesa").attr('disabled', true);
                      $("#apikota").append('<option value="" hidden>Pilih Kabupaten</option>');
                      // res.forEach(item => {
                      //     $("#apikota").val(item.nama_kabkota);
                      // });
                      // var ary = res.;  
                      var len = res.length;   
                      var sel = document.getElementById('apikota');
                      for(var i = 0; i < len; i++) {
                          var opt = document.createElement('option');
                          opt.innerHTML = res[i]['nama_kabkota'];
                          opt.value = res[i]['nama_kabkota'];
                          sel.appendChild(opt);
                          // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                      }
                  }
              });
          });
      
          $('#apikota').change(function() { 
          // console.log(this.value);
              
              $.ajax({
                  url: "./api/kota/"+this.value,
                  type: 'GET',
                  dataType: 'json', // added data type
                  success: function(res) {
                      $("#apikecamatan").val("").find('option').remove();
                      $("#apidesa").val("").find('option').remove();
                      $("#apikecamatan").attr('disabled', false);
                      $("#apidesa").attr('disabled', true);
                      $("#apikecamatan").append('<option value="" hidden>Pilih Kecamatan</option>');
                      // res.forEach(item => {
                      //     $("#apikota").val(item.nama_kabkota);
                      // });
                      // var ary = res.;  
                      var len = res.length;   
                      var sel = document.getElementById('apikecamatan');
                      for(var i = 0; i < len; i++) {
                          var opt = document.createElement('option');
                          opt.innerHTML = res[i]['kecamatan'];
                          opt.value = res[i]['kecamatan'];
                          sel.appendChild(opt);
                          // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                      }
                  }
              });
          });
      
          $('#apikecamatan').change(function() { 
          // console.log(this.value);
              
              $.ajax({
                  url: "./api/kecamatan/"+this.value,
                  type: 'GET',
                  dataType: 'json', // added data type
                  success: function(res) {
                      $("#apidesa").val("").find('option').remove();
                      $("#apidesa").attr('disabled', false);
                      $("#apidesa").append('<option value="" hidden>Pilih Desa</option>');
                      // res.forEach(item => {
                      //     $("#apikota").val(item.nama_kabkota);
                      // });
                      // var ary = res.;  
                      var len = res.length;   
                      var sel = document.getElementById('apidesa');
                      for(var i = 0; i < len; i++) {
                          var opt = document.createElement('option');
                          opt.innerHTML = res[i]['desa'];
                          opt.value = res[i]['desa'];
                          sel.appendChild(opt);
                          // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                      }
                  }
              });
          });

      // ALAMAT DOMISILI
          $('#apiprovinsidom').change(function() { 
          // console.log(this.value);
          
              $.ajax({
                  url: "./api/provinsi/"+this.value,
                  type: 'GET',
                  dataType: 'json', // added data type
                  success: function(res) {
                      // var valprovinsi = $("#apiprovinsi").val();
                      $("#apikotadom").val("").find('option').remove();
                      $("#apikecamatandom").val("").find('option').remove();
                      $("#apidesadom").val("").find('option').remove();
                      $("#apikotadom").attr('disabled', false);
                      $("#apikecamatandom").attr('disabled', true);
                      $("#apidesadom").attr('disabled', true);
                      $("#apikotadom").append('<option value="" hidden>Pilih Kabupaten</option>');
                      // res.forEach(item => {
                      //     $("#apikota").val(item.nama_kabkota);
                      // });
                      // var ary = res.;  
                      var len = res.length;   
                      var sel = document.getElementById('apikotadom');
                      for(var i = 0; i < len; i++) {
                          var opt = document.createElement('option');
                          opt.innerHTML = res[i]['nama_kabkota'];
                          opt.value = res[i]['nama_kabkota'];
                          sel.appendChild(opt);
                          // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                      }
                  }
              });
          });
      
          $('#apikotadom').change(function() { 
          // console.log(this.value);
              
              $.ajax({
                  url: "./api/kota/"+this.value,
                  type: 'GET',
                  dataType: 'json', // added data type
                  success: function(res) {
                      $("#apikecamatandom").val("").find('option').remove();
                      $("#apidesadom").val("").find('option').remove();
                      $("#apikecamatandom").attr('disabled', false);
                      $("#apidesadom").attr('disabled', true);
                      $("#apikecamatandom").append('<option value="" hidden>Pilih Kecamatan</option>');
                      // res.forEach(item => {
                      //     $("#apikota").val(item.nama_kabkota);
                      // });
                      // var ary = res.;  
                      var len = res.length;   
                      var sel = document.getElementById('apikecamatandom');
                      for(var i = 0; i < len; i++) {
                          var opt = document.createElement('option');
                          opt.innerHTML = res[i]['kecamatan'];
                          opt.value = res[i]['kecamatan'];
                          sel.appendChild(opt);
                          // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                      }
                  }
              });
          });
      
          $('#apikecamatandom').change(function() { 
          // console.log(this.value);
              
              $.ajax({
                  url: "./api/kecamatan/"+this.value,
                  type: 'GET',
                  dataType: 'json', // added data type
                  success: function(res) {
                      $("#apidesadom").val("").find('option').remove();
                      $("#apidesadom").attr('disabled', false);
                      $("#apidesadom").append('<option value="" hidden>Pilih Desa</option>');
                      // res.forEach(item => {
                      //     $("#apikota").val(item.nama_kabkota);
                      // });
                      // var ary = res.;  
                      var len = res.length;   
                      var sel = document.getElementById('apidesadom');
                      for(var i = 0; i < len; i++) {
                          var opt = document.createElement('option');
                          opt.innerHTML = res[i]['desa'];
                          opt.value = res[i]['desa'];
                          sel.appendChild(opt);
                          // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                      }
                  }
              });
          });
      
        // VALIDASI INPUT FORMULIR BIODATA
        $('#nik').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#nik').removeClass('is-invalid');          
            } 
            else {
                $('#nik').addClass('is-invalid');     
            }
        });
        $('#nama').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#nama').removeClass('is-invalid');          
            } 
            else {
                $('#nama').addClass('is-invalid');     
            }
        });
        $('#temp_lahir').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#temp_lahir').removeClass('is-invalid');          
            } 
            else {
                $('#temp_lahir').addClass('is-invalid');     
            }
        });
        $('#nick').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#nick').removeClass('is-invalid');          
            } 
            else {
                $('#nick').addClass('is-invalid');     
            }
        });
        $('#email').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#email').removeClass('is-invalid');          
            } 
            else {
                $('#email').addClass('is-invalid');     
            }
        });
        $('#no_hp').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#no_hp').removeClass('is-invalid');          
            } 
            else {
                $('#no_hp').addClass('is-invalid');     
            }
        });
        $('#ig').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#ig').removeClass('is-invalid');          
            } 
            else {
                $('#ig').addClass('is-invalid');     
            }
        });
        $('#fb').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#fb').removeClass('is-invalid');          
            } 
            else {
                $('#fb').addClass('is-invalid');     
            }
        });

        // VALIDASI PENDIDIKAN FORMAL
        $('#sd').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_sd').prop('disabled', false);         
            }
            else {
                $('#th_sd').prop('disabled', true);    
            }
        });
        $('#smp').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_smp').prop('disabled', false);         
            }
            else {
                $('#th_smp').prop('disabled', true);    
            }
        });
        $('#sma').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_sma').prop('disabled', false);         
            }
            else {
                $('#th_sma').prop('disabled', true);    
            }
        });
        $('#d1').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_d1').prop('disabled', false);         
            }
            else {
                $('#th_d1').prop('disabled', true);    
            }
        });
        $('#d3').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_d3').prop('disabled', false);         
            }
            else {
                $('#th_d3').prop('disabled', true);    
            }
        });
        $('#d4').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_d4').prop('disabled', false);         
            }
            else {
                $('#th_d4').prop('disabled', true);    
            }
        });
        $('#s1').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_s1').prop('disabled', false);         
            }
            else {
                $('#th_s1').prop('disabled', true);    
            }
        });
        $('#s2').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_s2').prop('disabled', false);         
            }
            else {
                $('#th_s2').prop('disabled', true);    
            }
        });
        $('#s3').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_s3').prop('disabled', false);         
            }
            else {
                $('#th_s3').prop('disabled', true);    
            }
        });

        // VALIDASI DOKUMEN KEPEGAWAIAN
        $('#nip').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#nip').removeClass('is-invalid');          
            } 
            else {
                $('#nip').addClass('is-invalid');     
            }
        });
        $('#jabatan').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#jabatan').removeClass('is-invalid');          
            } 
            else {
                $('#jabatan').addClass('is-invalid');     
            }
        });
        $('#no_str').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#no_str').removeClass('is-invalid');          
            } 
            else {
                $('#no_str').addClass('is-invalid');     
            }
        });

        // VALIDASI CHECKBOX ALAMAT
        $("#checkbox_alamat").on('change', function() {
            if ($(this).is(':checked')) {
              $("#apiprovinsidom").val("").find('selected').remove();
              $("#apikotadom").val("").find('selected').remove();
              $("#apikecamatandom").val("").find('selected').remove();
              $("#apidesadom").val("").find('selected').remove();
              // $('#apiprovinsidom').prop('disabled', true); 
              // $('#apikotadom').prop('disabled', true); 
              // $('#apikecamatandom').prop('disabled', true); 
              // $('#apidesadom').prop('disabled', true); 
              // $('#alamat_dom').prop('disabled', true); 
              $("#dom_collapse").removeClass('show');
              $(this).val("0");
            } else {
                // $('#alamatdomisili').prop('hidden', false);
              $('#apiprovinsidom').prop('disabled', false); 
              $('#apikotadom').prop('disabled', true); 
              $('#apikecamatandom').prop('disabled', true); 
              $('#apidesadom').prop('disabled', true); 
              $("#dom_collapse").addClass('show');
              $(this).val("1");
            }
        });

        $('#max_alamat_ktp').text('190 Limit Text');
        $('#alamat_ktp').keydown(function () {
            var max = 190;
            var len = $(this).val().length;
            if (len >= max) {
                $('#max_alamat_ktp').text('Anda telah mencapai Limit Maksimal.');          
            } 
            else {
                var ch = max - len;
                $('#max_alamat_ktp').text(ch + ' Limit Text');     
            }
        });

        $('#max_alamat_dom').text('190 Limit Text');
        $('#alamat_dom').keydown(function () {
            var max = 190;
            var len = $(this).val().length;
            if (len >= max) {
                $('#max_alamat_dom').text('Anda telah mencapai Limit Maksimal.');          
            } 
            else {
                var ch = max - len;
                $('#max_alamat_dom').text(ch + ' Limit Text');     
            }
        });
    });
</script>
@endsection