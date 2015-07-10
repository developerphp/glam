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