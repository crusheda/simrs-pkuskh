@extends('layouts.newAdmin')

@section('content')
<h2 class="section-title">Hai, Admin Kepegawaian</h2>

<div class="row mt-sm-4">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card profile-widget">
      <div class="profile-widget-header">
        @if (!empty($list['foto']->filename))
          <img alt="image" src="{{ url('storage/'.substr($list['show']->filename,7,1000)) }}" class="rounded-circle profile-widget-picture">
        @else
          <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
        @endif
        <div class="profile-widget-items">
          <div class="profile-widget-item">
            <div class="profile-widget-item-label mb-2">Total Login</div>
            <div class="profile-widget-item-value mb-2">-</div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label mb-2">Terakhir Ubah Profil</div>
            <div class="profile-widget-item-value mb-2">-</div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label mb-2">Status Kepegawaian</div>
            <div class="profile-widget-item-value mb-2">
              <button class="btn btn-primary disabled"><i class="fas fa-file-contract"></i> Lihat</button>
            </div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label mb-2">Foto Profil</div>
            <div class="profile-widget-item-value mb-2">
              <div class="btn-group">
                <button class="btn btn-secondary disabled" disabled><i class="fas fa-edit"></i></button>
                @if (empty($list['foto']->filename))
                  <button class="btn btn-secondary disabled"><i class="fas fa-download"></i></button>
                @else
                  <button class="btn btn-info" onclick="window.location.href='{{ url('./profil/'.$list['foto']->id) }}'"><i class="fas fa-download"></i></button>
                @endif
                <button class="btn btn-secondary disabled" disabled><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-widget-description">
        <div class="profile-widget-name">{{ $list['show']->nama }}</div>
        {{-- {{ $list['show']->bio }} --}}
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
      <input type="number" name="id" value="{{ $list['show']->id }}" hidden>
        <div class="card-header">
          <h4>Detail Profil</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-5 col-12">
              <label>Nama Akun</label>
              <input type="text" class="form-control" name="name" value="{{ $list['show']->name }}" readonly>
            </div>
            <div class="form-group col-md-7 col-12">
              <label>NIK</label>
              <input type="text" id="nik" name="nik" class="form-control" value="{{ $list['show']->nik }}" readonly>
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-8 col-12">
              <label>Nama Lengkap, Gelar</label>
              <input type="text" id="nama" name="nama" class="form-control" value="{{ $list['show']->nama }}" readonly>
              <div class="invalid-feedback">
                Tuliskan Nama Lengkap Anda.
              </div>
            </div>
            <div class="form-group col-md-4 col-12">
              <label>Nama Panggilan</label>
              <input type="text" id="nick" name="nick" class="form-control" value="{{ $list['show']->nick }}" readonly>
              <div class="invalid-feedback">
                Tuliskan Nama Panggilan Anda.
              </div>
            </div>
            <div class="form-group col-md-3 col-12">
              <label>Tempat Lahir</label>
              <input type="text" class="form-control" value="{{ $list['show']->temp_lahir }}" readonly>
            </div>
            <div class="form-group col-md-3 col-12">
              <label>Tanggal Lahir</label>
              <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($list['show']->tgl_lahir)); ?>" readonly>
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-3 col-12">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control selectric" id="jns_kelamin" name="jns_kelamin" readonly>
                  <option value="LAKI-LAKI" @if ($list['show']->jns_kelamin == 'LAKI-LAKI') echo selected @endif>Laki-laki</option>
                  <option value="PEREMPUAN" @if ($list['show']->jns_kelamin == 'PEREMPUAN') echo selected @endif>Perempuan</option>
                </select>
              </div>
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-3 col-12">
              <div class="form-group">
                <label>Status Kawin</label>
                <select class="form-control selectric" id="status_kawin" name="status_kawin" readonly>
                  <option value="">Pilih</option>
                  <option value="BELUM" @if ($list['show']->status_kawin == 'BELUM') echo selected @endif>Belum</option>
                  <option value="SUDAH" @if ($list['show']->status_kawin == 'SUDAH') echo selected @endif>Sudah</option>
                  <option value="CERAI" @if ($list['show']->status_kawin == 'CERAI') echo selected @endif>Cerai</option>
                  <option value="RAHASIA" @if ($list['show']->status_kawin == 'RAHASIA') echo selected @endif>Tidak ingin memberi tahu</option>
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
              <input type="email" id="email" name="email" class="form-control" value="{{ $list['show']->email }}" readonly>
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <label>No. HP / Whatsapp</label>
              <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ $list['show']->no_hp }}" readonly>
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <label>Instagram</label>
              <input type="text" id="ig" name="ig" class="form-control" value="{{ $list['show']->ig }}" readonly>
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <label>Facebook</label>
              <input type="text" id="fb" name="fb" class="form-control" value="{{ $list['show']->fb }}" readonly>
              <div class="invalid-feedback">
                Please fill in the email
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-12">
              <label>Bio</label>
              <textarea class="form-control summernote-simple" readonly></textarea>
            </div>
          </div>
          <hr style="margin-top: -5px">
          <center><div class="font-weight-bold mb-3">Alamat sesuai KTP</div></center>
          <div class="row">
            <div class="form-group col-md-6 col-12">
              <div class="form-group">
                <label>Provinsi</label>
                <input type="text" class="form-control" value="{{ $list['show']->ktp_provinsi }}"  readonly>
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <div class="form-group">
                <label>Kabupaten</label>
                <input type="text" class="form-control" value="{{ $list['show']->ktp_kabupaten }}"  readonly>
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" class="form-control" value="{{ $list['show']->ktp_kecamatan }}"  readonly>
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <div class="form-group">
                <label>Kelurahan</label>
                <input type="text" class="form-control" value="{{ $list['show']->ktp_kelurahan }}"  readonly>
              </div>
            </div>
            <div class="form-group col-md-12 col-12">
              <label for="alamat_ktp" class="control-label">Alamat Lengkap :</label>
              <textarea class="form-control" name="alamat_ktp" id="alamat_ktp" placeholder="" maxlength="190" rows="8" readonly><?php echo htmlspecialchars($list['show']->alamat_ktp); ?></textarea>
            </div>
            <div class="form-group col-md-12 col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" @if (!empty($list['show']->alamat_dom)) value="1" @else value="0" checked @endif name="cek_dom" id="checkbox_alamat">
                <label class="custom-control-label" for="checkbox_alamat">Alamat Domisili sesuai dengan KTP</label>
                <div class="text-muted form-text">
                  Centang apabila alamat Domisili sekarang sama dengan alamat di KTP anda.
                </div>
              </div>
            </div>
          </div>
          <div class="collapse <?php if(!empty($list['show']->alamat_dom)) { echo 'show'; } ?>" id="dom_collapse">
            <center><div class="font-weight-bold mb-3">Alamat Domisili</div></center>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Provinsi</label>
                  <input type="text" class="form-control" value="{{ $list['show']->dom_provinsi }}"  readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kabupaten</label>
                  <input type="text" class="form-control" value="{{ $list['show']->dom_kabupaten }}"  readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input type="text" class="form-control" value="{{ $list['show']->dom_kecamatan }}"  readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kelurahan</label>
                  <input type="text" class="form-control" value="{{ $list['show']->dom_kelurahan }}"  readonly>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Alamat Lengkap :</label>
                  <textarea class="form-control" name="alamat_dom" id="alamat_dom" placeholder="" maxlength="190" rows="8" readonly><?php echo htmlspecialchars($list['show']->alamat_dom); ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <hr style="margin-top: -5px">
          <center><div class="font-weight-bold mb-3">Pendidikan Formal</div></center>
          <div class="row">
            <div class="col-md-1">
              <label style="margin-top: 5px">SD</label><br><br>
            </div>
            <div class="col-md-8">
              <input type="text" id="sd" name="sd" value="{{ $list['show']->sd }}" class="form-control" placeholder="Nama Sekolah Dasar" readonly>
            </div>
            <div class="col-md-3">
              <input type="number" id="th_sd" name="th_sd" value="{{ $list['show']->th_sd }}" class="form-control" max="9999" placeholder="Tahun Lulus" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <label style="margin-top: 5px">SMP</label><br><br>
            </div>
            <div class="col-md-8">
              <input type="text" id="smp" name="smp" value="{{ $list['show']->smp }}" class="form-control" placeholder="Nama Sekolah Menengah Pertama" readonly>
            </div>
            <div class="col-md-3">
              <input type="number" id="th_smp" name="th_smp" value="{{ $list['show']->th_smp }}" class="form-control" max="9999" placeholder="Tahun Lulus" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <label style="margin-top: 5px">SMA</label><br><br>
            </div>
            <div class="col-md-8">
              <input type="text" id="sma" name="sma" value="{{ $list['show']->sma }}" class="form-control" placeholder="Nama Sekolah Menengah Atas" readonly>
            </div>
            <div class="col-md-3">
              <input type="number" id="th_sma" name="th_sma" value="{{ $list['show']->th_sma }}" class="form-control" max="9999" placeholder="Tahun Lulus" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <label style="margin-top: 5px">D1</label><br><br>
            </div>
            <div class="col-md-8">
              <input type="text" id="d1" name="d1" value="{{ $list['show']->d1 }}" class="form-control" placeholder="Nama Universitas" readonly>
            </div>
            <div class="col-md-3">
              <input type="number" id="th_d1" name="th_d1" value="{{ $list['show']->th_d1 }}" class="form-control" max="9999" placeholder="Tahun Lulus" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <label style="margin-top: 5px">D3</label><br><br>
            </div>
            <div class="col-md-8">
              <input type="text" id="d3" name="s3" value="{{ $list['show']->d3 }}" class="form-control" placeholder="Nama Universitas" readonly>
            </div>
            <div class="col-md-3">
              <input type="number" id="th_d3" name="th_d3" value="{{ $list['show']->th_d3 }}" class="form-control" max="9999" placeholder="Tahun Lulus" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <label style="margin-top: 5px">S1/D4</label><br><br>
            </div>
            <div class="col-md-8">
              <input type="text" id="s1" name="s1" value="{{ $list['show']->s1 }}" class="form-control" placeholder="Nama Universitas" readonly>
            </div>
            <div class="col-md-3">
              <input type="number" id="th_s1" name="th_s1" value="{{ $list['show']->th_s1 }}" class="form-control" max="9999" placeholder="Tahun Lulus" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <label style="margin-top: 5px">S2</label><br><br>
            </div>
            <div class="col-md-8">
              <input type="text" id="s2" name="s2" value="{{ $list['show']->s2 }}" class="form-control" placeholder="Nama Universitas" readonly>
            </div>
            <div class="col-md-3">
              <input type="number" id="th_s2" name="th_s2" value="{{ $list['show']->th_s2 }}" class="form-control" max="9999" placeholder="Tahun Lulus" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <label style="margin-top: 5px">S3</label><br><br>
            </div>
            <div class="col-md-8">
              <input type="text" id="s3" name="s3" value="{{ $list['show']->s3 }}" class="form-control" placeholder="Nama Universitas" readonly>
            </div>
            <div class="col-md-3">
              <input type="number" id="th_s3" name="th_s3" value="{{ $list['show']->th_s3 }}" class="form-control" max="9999" placeholder="Tahun Lulus" readonly>
            </div>
          </div>
          <hr style="margin-top: 5px">
          <center><div class="font-weight-bold mb-3">Dokumen Kepegawaian</div></center>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Pengalaman Kerja</label>
                <textarea class="form-control" name="pengalaman_kerja" id="pengalaman_kerja" placeholder="" readonly><?php echo htmlspecialchars($list['show']->pengalaman_kerja); ?></textarea>
              </div>
            </div>
          </div>
          <hr style="margin-top: -3px">
          <center><div class="font-weight-bold mb-3">Dokumen Medis</div></center>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Riwayat Penyakit</label>
                <textarea class="form-control" name="riwayat_penyakit_keluarga" id="riwayat_penyakit_keluarga" placeholder="" readonly><?php echo htmlspecialchars($list['show']->riwayat_penyakit_keluarga); ?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Riwayat Penyakit Keluarga</label>
                <textarea class="form-control" name="riwayat_penyakit" id="riwayat_penyakit" placeholder="" readonly><?php echo htmlspecialchars($list['show']->riwayat_penyakit); ?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Riwayat Operasi</label>
                <textarea class="form-control" name="riwayat_operasi" id="riwayat_operasi" placeholder="" readonly><?php echo htmlspecialchars($list['show']->riwayat_operasi); ?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Riwayat Penggunaan Obat</label>
                <textarea class="form-control" name="riwayat_penggunaan_obat" id="riwayat_penggunaan_obat" placeholder="" readonly><?php echo htmlspecialchars($list['show']->riwayat_penggunaan_obat); ?></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-right" style="margin-top: -10px">
          <a>
            <b>Terakhir Update Profil : </b>{{ \Carbon\Carbon::parse($list['show']->updated_at)->diffForHumans() }}
          </a>
        </div>
    </div>
  </div>
</div>
<script>
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
</script>
@endsection