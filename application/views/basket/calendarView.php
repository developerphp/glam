<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<div class="container">    

    <div class="order_title"> SİPARİŞ PLANLAMA </div>
      <form id="orderplanForm" name="orderplanForm" onsubmit="submitform('orderplan','orderplanForm'); return false;">
        <div class="order_pickup"> <span class="title">Pick-Up</span> <span>
          <input class="check" type="checkbox" name="myself" value="myself">
          Ürünü ben gelip alacağım.(Pick-up zamanımız 18.00 - 18.30 arasıdır.) </span> </div>
        <div class="order_pickup"> <span class="title">Teslimat Günü</span> </div>
        <div id="calendar"></div>
        <div class="order_pickup"> <span class="today">Bugün</span> </div>
        <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
          <div class="login_box">
            <div class="row">
              <div class="col-md-6 col-sm-6"> <span class="title">Kaç Kişilik</span>
                <div class="select_box">
                  <select name="person">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6"> <span class="title">Kaç Günlük</span>
                <div class="select_box">
                  <select name="person">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6"> <span class="title">Teslimat Tarihi</span>
                <div class="select_box">
                  <select name="date">
                    <option>Teslimat Tarihi</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6"> <span class="title">Teslimat Zamanı</span>
                <div class="select_box">
                  <select name="time">
                    <option>Teslimat Zamanı</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6"> <span class="title">Teslimat Adresi</span>
                <div class="select_box">
                  <select name="address1">
                    <option>EV</option>
                  </select>
                  <a href="">+ Adres Ekle</a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6"> <span class="title">Fatura Adresi</span>
                <div class="select_box">
                  <select name="address2">
                    <option>EV</option>
                  </select>
                  <a href="">+ Adres Ekle</a>
                </div>
              </div>
            </div>
            <input class="login_button" type="submit" name="submit" value="DEVAM" />
            <div id="orderplanForm_back" class="alerts_box"></div>
          </div>
        </div>
      </form>
    </div>

</div>

<?php $this->load->view('includes/footer') ?>

<script>

    var month='<?php echo intval(date("m")); ?>';
    var doprev=0;
    var thismonth='<?php echo intval(date("m")); ?>';
    var year='<?php echo date("Y"); ?>';
    var ben_alicam=0;
    var aylar=['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'];
    var weekday=['Pazar','Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi'];
    var pid=<?php echo $basket->id ?>

    $(document).ready(function(){
        loadcalendar(pid,month,year,doprev);        
    });    

    function loadcalendar(pid,month,year,doprev) {
        var adresid=$('select[name=adres]').val();
        // alert(base_url+'basket/createcalendar/'+pid+'/'+month+'/'+year+'/'+ben_alicam);
        $('#calendar').load(base_url+'basket/createcalendar/'+pid+'/'+month+'/'+year+'/'+ben_alicam,function(){
            <?php 
            $bu_hafta = date("W");
            $bu_ayin_ilk_haftasi = date("W",strtotime(date("Y-m-01")));
            $kacinci_hafta = $bu_hafta - $bu_ayin_ilk_haftasi + 1;            
            ?>

            if (thismonth==month) {
                $('.item:eq(<?php echo $kacinci_hafta-1 ?>)').addClass('active');
            }
            else {
                if (doprev==1) {
                    $('.item:eq(4)').addClass('active');
                }
                else {
                    $('.item:eq(0)').addClass('active');
                }                
            }        

            $('.carousel').each(function(){
                $(this).carousel({
                    interval: false,
                    wrap : false
                });
            });

            $('#calendarCarousel').on('slid.bs.carousel', function (e) {
                if ($('.carousel-inner .item:last').hasClass('active')) {

                    $('.carousel-control.right').hide();
                    $('.calendar_next').show();

                    if (month==12) {
                        month=1;
                        year=year+1;                        
                    }
                }
                else {
                    $('.carousel-control.right').show();
                    $('.calendar_next').hide();
                }

                if ($('.carousel-inner .item:first').hasClass('active')) {

                    $('.carousel-control.left').hide();
                    $('.calendar_prev').show();

                    if (month==1) {
                        month=12;
                        year=year-1;
                    }                    
                }
                else {
                    $('.carousel-control.left').show();
                    $('.calendar_prev').hide();
                }
            });

        });
        $('#month').val(month);
        $('#year').val(year);
        $('#teslim_gun').html('&nbsp;');
        $('#cleanse_date').val('');
        $('#cleanse_date_view').val('');        
    }   
</script>

</body>
</html>
