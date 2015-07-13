<?php $this->load->view('includes/head') ?>
</head>
<body>
<?php $this->load->view('includes/header') ?>
<main>
    <section>
    
        <div class="container">
        
            <div class="row">
                <div class="col-md-12">
                    <div class="login_cover">
                        <div class="tint"></div>
                        <div class="l_cover_txt">ADRES DEFTERİ</div>
                        <img src="<?php echo base_url('assets/images/l_cover.png') ?>" alt="cover">
                    </div>
                </div> 
            </div> 
            
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
            
            <form id="editAddressForm" name="editAddressForm" onsubmit="submitform('profile','editAddressForm'); return false;">                
            <input type="hidden" name="id" value="<?php echo $address->id ?>" />
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="login_box">
                        <div class="row addressNav">
                            <a href="" class="personal<?php if ($address->company==0) { echo ' active'; } ?>">Bireysel</a>
                            <a href="" class="company<?php if ($address->company==1) { echo ' active'; } ?>">Kurumsal</a>
                        </div>
                    <input type="hidden" name="address_type" id="address_type" value="<?php echo $address->company ?>" />
                    <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <input class="input_box" type="text" name="title" placeholder="Başlık" value="<?php echo $address->address_title ?>" />
                            </div>
                            
                            <div class="col-md-6 col-sm-6 personalInput"<?php if ($address->company==1) { echo ' style="display:none;"'; } ?>>
                                <input class="input_box" type="text" name="addressName" placeholder="Adres İsmi" value="<?php echo $address->address_name ?>" /> 
                            </div>   
                            <div class="col-md-6 col-sm-6 companyInput"<?php if ($address->company==0) { echo ' style="display:none;"'; } ?>>
                                <input class="input_box" type="text" name="companyName" placeholder="Şirket İsmi" value="<?php echo $address->company_name ?>" /> 
                            </div>
                              
                      </div>

                        <div class="row companyInput"<?php if ($address->company==0) { echo ' style="display:none;"'; } ?>>
                            <div class="col-md-6 col-sm-6">    
                                <input class="input_box" type="text" name="tax_name" placeholder="Vergi Dairesi" value="<?php echo $address->tax_name ?>" />
                            </div>
                            
                            <div class="col-md-6 col-sm-6">   
                                <input class="input_box" type="tel" name="tax_number" placeholder="Vergi Numarası" value="<?php echo $address->tax_number ?>" />
                            </div>
                        </div>

                       
                        <div class="row">                         
                            <div class="col-md-6 col-sm-6 personalInput"<?php if ($address->company==1) { echo ' style="display:none;"'; } ?>>    
                                <input class="input_box" type="text" name="namesurname" placeholder="Adı Soyadı" value="<?php echo $address->name_surname ?>" />
                         </div>
                            
                            <div class="col-md-6 col-sm-6">   
                                <input class="input_box" type="tel" name="phone" placeholder="Telefon" value="<?php echo $address->phone ?>" />
                            </div>
                        </div>
                        
                        <div class="row"> 
                        
                            <div class="col-md-12">    
                                <input class="input_box" type="text" name="address" placeholder="Adres" value="<?php echo $address->address ?>" />
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
                                        <option<?php if ($county->county_name==$address->county) { echo ' selected'; } ?>><?php echo $county->county_name ?></option>
                                    <?php }?>
                                </select>
                                </div>
                            </div>
                            
                           <div class="col-md-6 col-sm-6">    
                                <input class="input_box" type="text" name="zipcode" placeholder="Posta Kodu" value="<?php echo $address->zip_code ?>"  />
                            </div>
                        </div>
                        <div id="editAddressForm_back"></div>
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
