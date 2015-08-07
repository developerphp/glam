<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
<main>
    <section>
    <div class="container-fluid">
    	<div class="row">
            <div class="login_cover">
                <div class="tint"></div>
                <div class="wrapper">
                    <div class="l_cover_title">ADRES DEFTERİ</div>
                    <div class="l_cover_line"></div>
                    <div class="l_cover_txt">HESABIM</div>
                    <div class="l_cover_img"></div>
                </div>
            </div>
          </div> 
	</div>
            
        <div class="container">
        
            <?php $this->load->view('profile/nav') ?>
            
            <div class="row login_row">
               
             <div class="col-md-10 col-md-offset-1">
                
                    <div class="login_box"> 
                        <div class="login_txt">
                            ADRES DEFTERİ
                            <span>Lorem ipsum dolor sit amet</span>
                        </div>
                    </div>
                    
             </div>
             
            </div>
            
            <div class="row">
            
            <form id="addAddressForm" name="addAddressForm" onsubmit="submitform('profile','addAddressForm'); return false;">                
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="login_box">
                        <div class="row addressNav">
                            <a href="" class="personal active">Bireysel</a>
                            <a href="" class="company">Kurumsal</a>
                        </div>
                    <input type="hidden" name="address_type" id="address_type" value="0" />
                    <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <input class="input_box" type="text" name="title" placeholder="Başlık" />
                            </div>
                            
                            <div class="col-md-6 col-sm-6 personalInput">
                                <input class="input_box" type="text" name="addressName" placeholder="Adres İsmi" /> 
                            </div>   
                            <div class="col-md-6 col-sm-6 companyInput" style="display:none;">
                                <input class="input_box" type="text" name="companyName" placeholder="Şirket İsmi" /> 
                            </div>
                              
                      </div>

                        <div class="row companyInput" style="display:none;">
                            <div class="col-md-6 col-sm-6">    
                                <input class="input_box" type="text" name="tax_name" placeholder="Vergi Dairesi" />
                            </div>
                            
                            <div class="col-md-6 col-sm-6">   
                                <input class="input_box" type="tel" name="tax_number" placeholder="Vergi Numarası" />
                            </div>
                        </div>

                       
                        <div class="row">                         
                            <div class="col-md-6 col-sm-6 personalInput">    
                                <input class="input_box" type="text" name="namesurname" placeholder="Adı Soyadı" />
                         </div>
                            
                            <div class="col-md-6 col-sm-6">   
                                <input class="input_box" type="tel" name="phone" placeholder="Telefon" />
                            </div>
                        </div>
                        
                        <div class="row"> 
                        
                            <div class="col-md-12">    
                                <input class="input_box" type="text" name="address" placeholder="Adres" />
                            </div>
                        </div>
                        
                        <div class="row"> 
                            <div class="col-md-6 col-sm-6">    
                                <div class="select_box">
                                <select name="county">
                                    <option>İlçe Seçiniz</option>
                                    <?php 
                                    $sql=$this->db->query("select * from county where city_id=34 order by slug asc");
                                    foreach($sql->result() as $county) { ?>
                                        <option><?php echo $county->county_name ?></option>
                                    <?php }?>
                                </select>
                                </div>
                            </div>
                            
                           <div class="col-md-6 col-sm-6">    
                                <input class="input_box" type="text" name="zipcode" placeholder="Posta Kodu" />
                            </div>
                        </div>
                        <div id="addAddressForm_back" class="alerts_box"></div>
                        <input type='text' name='url' value="<?php echo $this->input->get('url') ?>" />
                        <input class="login_button" type="submit" name="submit" value="KAYDET">
                        
                    </div>     
                </div>                
            </form>
                
            </div>
            
        </div>
        
    </section>
</main>
<?php $this->load->view('includes/footer') ?>
</body>
</html>
