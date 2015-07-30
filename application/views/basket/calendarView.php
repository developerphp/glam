<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<div class="container">    

    <div class="order_title"> SİPARİŞ PLANLAMA </div>
      <form id="orderplanForm" name="orderplanForm" onsubmit="submitform('basket','orderplanForm'); return false;">
        <div class="order_pickup"> <span class="title">Pick-Up</span> <span>
          <input class="check" type="checkbox" name="ben_alicam" id="ben_alicam" />
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
                  <select name="count_person">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6"> <span class="title">Kaç Günlük</span>
                <div class="select_box">
                  <select name="count_day">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6"> <span class="title">Teslimat Tarihi</span>
              	<input class="input_box" type="text" name="cleanse_date_view" id="cleanse_date_view" disabled="disabled" />
              	<input type="hidden" name="cleanse_date" id="cleanse_date" />
              </div>
              <div class="col-md-6 col-sm-6" id="saatsec"> <span class="title">Teslimat Zamanı</span>
                <div class="select_box">
                  <select name="teslimat_saati">
                    <option value="">Seçiniz</option>
                    <option>09:30 - 10:30</option>
                    <option>13:00 - 15:00</option>
                    <option>18:00 - 20:00</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6"> <span class="title">Teslimat Adresi</span>
                <div class="select_box">
                  <select name="address1">
                    <option value="">Adres Seçiniz</option>
                    <?php 
                    $sql=$this->db->query("select * from address where user_id=".$this->db->escape($basket->member_id)." order by id asc");
                    foreach($sql->result() as $adres) {
                    ?>
                    <option value="<?php echo $adres->id ?>"><?php echo $adres->address_title ?></option>                    
                    <?php }?>
                  </select>
                  <?php 
                  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                  ?>
                  <a href="<?php echo base_url('profile/addAddress/?url='.$actual_link) ?>">+ Adres Ekle</a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6"> <span class="title">Fatura Adresi</span>
                <div class="select_box">
                  <select name="address2">
                    <option value="<?php echo $adres->id ?>">Adres Seçiniz</option>
                    <?php 
                    $sql=$this->db->query("select * from address where user_id=".$this->db->escape($basket->member_id)." order by id asc");
                    foreach($sql->result() as $adres) { ?>
                    <option value="<?php echo $adres->id ?>"><?php echo $adres->address_title ?></option>                    
                    <?php }?>
                  </select>
                  <a href="<?php echo base_url('profile/addAddress/?url='.$actual_link) ?>">+ Adres Ekle</a>
                </div>
              </div>
            </div>
            <input class="login_button" type="submit" name="submit" value="DEVAM" />
            <div id="orderplanForm_back" class="alerts_box"></div>
          </div>
        </div>
        <input id="month" type="hidden" />
        <input id="year" type="hidden" />
        <input type="hidden" name="basket_id" value="<?php echo $basket->id ?>" />
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

        $('#ben_alicam').click(function () {
            if (this.checked==true) {
                $("#saatsec").slideUp(500);
                $('#saatsec select').val('');
                ben_alicam=1;
            }            
            else {
                $("#saatsec").slideDown(500);
                ben_alicam=0;
            }
        });

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

    function tarihsec(tarih,gun,sectigigun) { 
        
        //if ((sectigigun==3)||(sectigigun==6)) {
            if (ben_alicam==0) {
                $('#pickup_div').slideUp(250);
                $('#ben_alicam').attr('checked',false);
                $("#saatsec").slideDown(500);
            }
            else {
                alert('Seçmiş olduğunuz günde pick up yapamazsınız');
                return false;
            }
        // }
        // else {
        //     $('#pickup_div').slideDown(250);            
        // }
        
        var tarihayir=tarih.split("-");
        var gunu=tarihayir[2];            
        
        $('#month').val(parseInt(tarihayir[1],10));
        $('#year').val(tarihayir[0]);
        var t= new Date(tarihayir[1]+'/'+tarihayir[2]+'/'+tarihayir[0]);
        //                if (gun<=3) {
        $('.day').removeClass('selected');
        $('#day'+tarihayir[2]).addClass('selected');
        for (i=1;i<=gun;i++) {
            saygun=parseInt(gunu)+parseInt(i-1,10);                                    
//            $('#day'+saygun).addClass('selected');
            $('#teslim_gun').html(tarihayir[2]+' '+aylar[parseInt(tarihayir[1],10)-1]+' '+tarihayir[0]+' '+weekday[parseInt(t.getDay(),10)]);
            $('#cleanse_date_view').val(tarihayir[2]+' '+aylar[parseInt(tarihayir[1],10)-1]+' '+tarihayir[0]+' '+weekday[parseInt(t.getDay(),10)]);
        }
        $('#cleanse_date').val(tarih);
    }
            
    function no_day() {
        alert('Bu tarihte teslimat yapamıyoruz.');
    }    
</script>

</body>
</html>
