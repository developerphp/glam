function submitform(linki,form){                
        $.ajax({  
            type: 'POST',
            url: base_url+linki+'/'+form+'_do',
            data: $('#'+form).serialize(),
            error:function(){ $('#'+form+'_back').html("Hata Var."); }, 
            success: function(veri) { 
            $('#'+form+'_back').html(veri);
            }
        });
        return false;
}

$(document).ready(function(){
    $('.addressNav a').click(function(){
        $('.addressNav a').removeClass('active');
        $(this).addClass('active');
        var $class=$(this).attr('class');
        if ($class.search('company')==0) {
            $('.personalInput').hide();
            $('.companyInput').show();
            $('#address_type').val(1)
        } else {
            $('.companyInput').hide();
            $('.personalInput').show();
            $('#address_type').val(0);
        }
        return false;
    });


    $('.adress_remove').click(function(){
        if (confirm('Silmek istediğinizden emin misiniz?')) {
            $('#hidden_div').load($(this).attr('href'));
            return false;
        } else {
            return false;
        }
    });

})