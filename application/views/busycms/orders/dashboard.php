<?php $this->load->view('busycms/includes/head') ?>
<script>
    var base_url='<?php echo base_url() ?>';
    
    function havalecomplete(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/havalecomplete/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function iptalet(id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/siparisiptal/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
    
    function kuryecomplete(id) {
        $('#kurye'+id).fadeIn(250);
    }
    
    function teslimcomplete(id) {
        $.ajax({
            url: '<?php echo base_url() ?>busycms/teslimcomplete/'+id,
            success: function(data) { $('#sezgin').html(data); }
        });
    }
</script>

<script>
    function takipformsubmit(linki,form){
        $.ajax({
            type: 'POST',
            url: base_url+'/'+linki+'kuryecompleteform_do',
            data: $('#'+form).serialize(),
            error:function(){ $('#'+form+'_back').html("Hata Var."); }, 
            success: function(veri) { 
                $('#'+form+'_back').html(veri);
            }
        });
        return false;
    } 
</script>

</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con eventslist" style="background:none;">
            <div class="editevent-left">
                <div class="top-title">
                    <h2><span>Siparişler</span></h2>                        
                </div>
                <div class="product-category-list">
                    <div id="productcategory">
                        <div class="title">Siparişler
                        </div>
                        <ul>
                            <li>
                                <a<?php if ($sipdurum == 1) { ?> class="selected"<?php } ?> href="javascript:void(0);" onClick="location.href='<?php echo base_url() ?>busycms/orders/1'">Havale Onayı Bekleyenler (<?php echo $havalesay ?>)</a>
                            </li>
                            <li>
                                <a<?php if ($sipdurum == 5) { ?> class="selected"<?php } ?> href="javascript:void(0);" onClick="location.href='<?php echo base_url() ?>busycms/orders/5'">Kapıda Ödeme (<?php echo $kapidaodemesay ?>)</a>
                            </li>
                            <li>
                                <a<?php if ($sipdurum == 2) { ?> class="selected"<?php } ?> href="javascript:void(0);" onClick="location.href='<?php echo base_url() ?>busycms/orders/2'">Kuryeye Verilecekler (<?php echo $kuryesay ?>)</a>
                            </li>
                            <li>
                                <a<?php if ($sipdurum == 3) { ?> class="selected"<?php } ?> href="javascript:void(0);" onClick="location.href='<?php echo base_url() ?>busycms/orders/3'">Kuryeye Verilenler (<?php echo $gonderilensay ?>)</a>
                            </li>
                            <li>
                                <a<?php if ($sipdurum == 4) { ?> class="selected"<?php } ?> href="javascript:void(0);" onClick="location.href='<?php echo base_url() ?>busycms/orders/4'">Teslim Edilenler (<?php echo $teslimedilensay ?>)</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="editevent-right" style="padding:4px 0px;width:789px;">
                <div class="product-section" style="display:block;" id="list">
                    <div class="top-title" style="height:35px;text-align: right;padding-top:15px;">
                        <form id="download_excel" name="download_excel" method="GET" action="<?php echo base_url() ?>busycms/download_excel_do">
                            <span id="download_excel_back"></span>
                            <input type="text" name="start_date" value="<?php echo date('Y-m-d') ?>" style="width:100px;display: inline-block;" />
                            <input type="text" name="end_date" value="<?php echo date('Y-m-d') ?>" style="width:100px;display: inline-block;margin-right:150px;margin-left:10px;" />
                            <button>Download Excel</button>
                        </form>
                    </div>
                    <div id="productslist">
                        <ul>
                            <?php
                            $where = "";
                            if ($sipdurum == 1) {
                                $where = "and user_orders.tur=1  and user_orders.durum=1";
                            } elseif ($sipdurum == 5) {
                                $where = "and user_orders.tur=3 and user_orders.durum=1 and user_orders.admin_action=0";
                            } elseif ($sipdurum == 2) {
                                $where = "and user_orders.durum=5 and user_orders.admin_action=0";
                            } elseif ($sipdurum == 3) {
                                $where = "and user_orders.durum=5 and user_orders.admin_action=5";
                            } elseif ($sipdurum == 4) {
                                $where = "and user_orders.durum=5 and user_orders.admin_action=6";
                            }

                            $sql = $this->db->query("
                            select
                            users.id as uid,users.name_surname,users.email
                            ,user_orders.id
                            ,user_orders.user_id
                            ,user_orders.fatura_ayni
                            ,user_orders.hediyemi
                            ,user_orders.hediyetext
                            ,user_orders.siparis_notu
                            ,user_orders.urunsayisi
                            ,user_orders.toplamfiyat
                            ,user_orders.tur
                            ,user_orders.durum
                            ,user_orders.order_code
                            ,user_orders.update_date
                            ,user_orders.admin_action 
                            ,user_orders.kapidaodemetutar
                            ,user_orders.kargo
                            from user_orders,users
                            where
                           user_orders.user_id=users.id $where order by user_orders.id desc 
                        ");
                            foreach ($sql->result() as $order) {
                                ?>                        
                                <li style="padding:0px;cursor:pointer;">
                                    <div class="order_preview" style="height:70px;">
                                        <div onClick="$('#order<?php echo $order->id ?>').slideToggle(0)">
                                            <div style="width:300px;float:left;">
    <?php echo $order->email ?><br/>
    <?php ?>
                                                <b><?php echo $order->name_surname ?></b> ( <?php echo strftime("%d", strtotime($order->update_date)) . "." . strftime("%m", strtotime($order->update_date)) . "." . strftime("%Y", strtotime($order->update_date)) . " " . strftime("%H", strtotime($order->update_date)) . ":" . strftime("%M", strtotime($order->update_date)); ?> )<br/>
                                                Sipariş kodu : <b><?php echo $order->order_code ?></b>
                                            </div>
                                            <div style="width:200px;float:left;">
    <?php echo $order->update_date ?>
                                            </div>
                                            <div style="width:200px;float:left;margin-left:30px;">
                                                <b>Ödeme Tipi</b><br/>
    <?php
    if ($order->tur == 1) {
        echo "Havale";
    } elseif ($order->tur == 2) {
        echo "Kredi Kartı";
    } elseif ($order->tur == 3) {
        echo "Kapıda Ödeme";
    }
    ?>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <a title="Mail Gonder" class="sendmail" href="mailto:<?php echo $order->email ?>?subject=<?php echo $order->order_code ?> nolu siparişinizle ilgili"><img src="<?php echo base_url() ?>busycms/images/sendmessage.jpg" /></a>
                                        <a href="javascript:void(0)" class="havale_alindi" style="top:45px;" onClick="iptalet(<?php echo $order->id ?>)">iptal et</a>
                                        <?php if ($sipdurum == 1) { ?>
                                            <a href="javascript:void(0)" class="havale_alindi" onClick="havalecomplete(<?php echo $order->id ?>)">havaleyi aldım</a>
    <?php } elseif (($sipdurum == 2) || ($sipdurum == 5)) { ?>

                                            <a href="javascript:void(0)" class="havale_alindi" onClick="takipformsubmit('busycms/','kuryecompleteform<?php echo $order->id ?>')">teslim edildi</a>
                                            <div id="kurye<?php echo $order->id ?>" style="display:none;background:#dee9e9;padding:20px;position:absolute;width:127px;position:absolute;right:0;top:0px;">
                                                <form id="kuryecompleteform<?php echo $order->id ?>" name="kuryecompleteform<?php echo $order->id ?>" onSubmit="return false">
                                                    <input type="hidden" name="id" value="<?php echo $order->id ?>" />
                                                    <button onClick="takipformsubmit('busycms/','kuryecompleteform<?php echo $order->id ?>')" style="margin-top:5px;padding:5px 20px;">Mail Gönder</button>
                                                    <div id="kuryecompleteform<?php echo $order->id ?>_back"></div>
                                                </form>
                                            </div>
                                        <?php } elseif ($sipdurum == 3) { ?>
                                            <a href="javascript:void(0)" class="havale_alindi" onClick="teslimcomplete(<?php echo $order->id ?>)">teslim edildi</a>
    <?php } ?>
                                    </div>
                                    <div class="box" id="order<?php echo $order->id ?>">
                                        <h1>SİPARİŞLER</h1>
                                        <?php
                                        $toplamfiyat = 0;
                                        $juicos = "";
                                        $juico_adet = 0;
                                        $juico_total = 0;
                                        $juico_image = "";
                                        $cleanse_total = 0;
                                        $cleanse_adres = "";
                                        $toplam_indirim = 0;
                                        $juico_adres = "";
                                        $sql = $this->db->query("
                                select order_products.id as id , order_products.user_id , order_products.product_id , order_products.qty , order_products.product_catid , 
                                order_products.cleanse_date , order_products.cleanse_date_view , order_products.day , order_products.address , order_products.person ,
                                order_products.indirim_orani,order_products.teslim_saati,
                                products.id as pid , products.title , products.price , products.image,products.percentage
                                from 
                                order_products , products
                                where products.id=order_products.product_id and order_products.order_id=" . $order->id . " order by product_catid desc
                                ");
                                        foreach ($sql->result_array() as $basket) {
                                             if ($basket["product_catid"] == 3) { ?>
                                                <div class="basket_product">
                                                    <div class="basket_image">
                                                        <img src="<?php echo base_url() ?>uploads/<?php echo $basket["image"] ?>" width="50" />
                                                    </div>
                                                    <div class="basket_name">
                                                        <b><?php echo $basket["title"] ?></b><br/>
                                                        <span style="font-size:12px;font-style:italic;"><?php echo $basket["cleanse_date_view"] . "<br/>" . $basket['teslim_saati'] ?></span>                                        
                                                        <div style="font-size:12px;line-height:16px;">
                                                        <?php echo $basket["address"] ?>
                                                        </div>
                                                    </div>
                                                    <div class="basket_price">
            <?php echo $this->juico_model->fiyat_hesapla($basket) ?> TL
                                                    </div>
                                                    <div class="basket_qty">
            <?php echo $basket["person"] . " kişi<br/>" . $basket["day"] . " gün" ?>
                                                    </div>                                    
                                                    <div class="basket_total">
                                                        <?php echo $this->juico_model->fiyat_bicim(($basket["person"] * $basket["price"]) * $basket["day"]) ?> TL
                                                        <?php
                                                        $oran = $basket["indirim_orani"];
                                                        if ($oran > 0) {
                                                            $p_fiyat = ($basket["person"] * $basket["price"]) * $basket["day"];
                                                            $i_fiyat = $p_fiyat * $oran;
                                                            $toplam_indirim = $toplam_indirim + $i_fiyat;
                                                            echo "<br/>-" . $this->cart_model->bicimlendir($i_fiyat) . " TL";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="clear"></div>                                    
                                                </div>                                    
                                                <?php
                                                $cleanse_total = ($basket["person"] * $basket["price"]) * $basket["day"];
                                            } else {
                                                if ($basket["qty"] > 0) {
                                                    $juico_image = $basket["image"];
                                                    $juicos = $juicos . "<div>" . $basket["title"] . " (" . $basket["qty"] . " adet)</div>";
                                                    $juico_adet = $juico_adet + $basket["qty"];
                                                    $juico_total = $juico_total + ($this->juico_model->fiyat_hesapla($basket) * $basket["qty"]);
                                                    $juico_tarih = $basket["cleanse_date_view"];
                                                    $juico_saat = $basket["teslim_saati"];
                                                    $juico_adres = $basket["address"];
                                                }
                                            }
                                            ?>
                                        <?php
                                        }
                                        if ($juico_adet > 0) {
                                            ?>
                                            <div class="basket_product">
                                                <div class="basket_image" style="display: none;">
                                                    <img src="<?php echo base_url() ?>uploads/<?php echo $juico_image ?>" width="50" />
                                                </div>
                                                <div class="basket_name" style="margin-left:100px;">
                                                    <b><?php echo $juicos ?></b><br/>
                                                    <span style="font-size:12px;font-style:italic;"><?php echo $juico_tarih . "<br/>" . $juico_saat ?></span>                                        
                                                    <div style="font-size:12px;line-height:16px;">
        <?php echo $basket["address"] ?>
                                                    </div>

                                                </div>
                                                <div class="basket_price">
                                                    <?php echo $this->juico_model->fiyat_bicim($juico_total) ?> TL
                                                </div>
                                                <div class="basket_qty">
                                                    <?php echo $juico_adet ?>
                                                </div>
                                                <div class="basket_total">
        <?php echo $this->cart_model->bicimlendir($juico_total) ?> TL
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                                <?php }
                                            ?>
                                        <?php if (strlen($order->siparis_notu)>0) { ?>
                                        <div style="padding:30px 0;">
                                            <b>Sipariş Notu: </b> <?php echo $order->siparis_notu ?>
                                        </div>
                                        <?php }?>
                                        <div class="totalprice">                                    
                                            <?php
                                            $pickup = $this->cart_model->pickuphesapla('order_products',$order->user_id);
                                            ?>
                                            <div class="basket_product" align="right" style="font-size:14px;margin-bottom:0;">
                                                KARGO <b style="display: inline-block;margin-left:10px;width:150px;"><?php echo $order->kargo ?> TL</b><br/>                                                        
                                                <?php if ($toplam_indirim > 0) { ?>
                                                    İNDİRİM <b style="display: inline-block;margin-left:10px;width:150px;">-<?php echo $this->cart_model->bicimlendir($toplam_indirim) ?> TL</b><br/>                                                        
    <?php } ?>
                                                <?php if ($pickup > 0) { ?>
                                                    PICK-UP <b style="display: inline-block;margin-left:10px;width:150px;"> -<?php echo $pickup ?> TL</b><br/>                            
                                                    TOPLAM <b style="display: inline-block;margin-left:10px;width:150px;"><?php echo $this->cart_model->bicimlendir(($order->toplamfiyat - $pickup) - $toplam_indirim) ?> TL</b>
                                                <?php } else { ?>
                                                    TOPLAM <b style="display: inline-block;margin-left:10px;width:150px;"><?php echo $this->cart_model->bicimlendir($order->toplamfiyat - $toplam_indirim) ?> TL</b>
    <?php } ?>                                    
                                            </div>                                    
                                        </div>
                                </li>
<?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div id="sezgin"></div>
            <input type="hidden" name="orderkatid" value="" id="orderkatid" />
        </div>
    </div>
<?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>