<section class="footnews section-bg">
  <center><h3 data-aos="fade-up" class="mb-5">Berita Terkini</h3></center>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="card mb-4" style="" data-aos="fade-up" data-aos-delay="100" id="berita0">
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mb-4" style="" data-aos="fade-up" data-aos-delay="100" id="berita1">
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mb-4" style="" data-aos="fade-up" data-aos-delay="100" id="berita2">
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mb-4" style="" data-aos="fade-up" data-aos-delay="100" id="berita3">
        </div>
      </div>

    </div>
    <center><button class="btn btn-light btn-sm float-right" data-aos="zoomin" data-aos-delay="300"><i class="fas fa-newspaper"></i>&nbsp;&nbsp;Lihat Semua Berita</button></center>
  </div>
  
  {{-- SCRIPT AJAX API --}}
  <script>
    $(document).ready( function () {
      $.ajax(
        {
          url: "/artikel/berita/api/show",
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            $("#berita").empty();
            console.log(res.berita.length);
            if(res.berita.length == 0){
              $("#berita").append(``);
            } else {
              for (let i = 0; i < res.berita.length; i++) {
                console.log(i);
                $("#berita"+i).empty();
                $("#berita"+i).append(`
                  <img src="/storage/${(res.berita[i].filename).substring(7,1000)}" class="card-img-top" style="height: 140px">
                  <div class="card-body d-flex flex-column">
                    <a>${res.berita[i].judul}</a><br>
                    <sub><i class="fas fa-feather"></i>&nbsp;&nbsp;${res.berita[i].nama} &nbsp;&nbsp;&nbsp;<i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;${res.berita[i].tgl}</sub>
                    <a style="margin-top: 10px" href="/artikel/berita/${res.berita[i].id}" class="btn btn-warning text-white btn-sm">Selengkapnya&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i></a>
                  </div>
                `);
              }
            }
          }
        }
      );
    });
  </script>
</section>