<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
        
<div class="container">
    <div id="calendar"></div>
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
