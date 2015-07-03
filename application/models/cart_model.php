<?php 

class Cart_model extends CI_Model {

        // sezgin
    
        function addbasket($id="",$adet="",$size="") {            
            $flag = TRUE;
            $dataTmp = $this->cart->contents();
            $sql=$this->db->query("select * from products where id=".$this->db->escape($id)."");
                if ($sql->num_rows()>0) {                    
                    foreach ($dataTmp as $item) {
                        if ($item['id'] == $id) 
                        {
                            foreach($sql->result() as $product) {
                                if ($product->stock<($item['qty']+$adet)) {
                                    ?>
                                    <script>alert_box('Stokta bu üründen <?php echo $product->stock ?> adet bulunmaktadır. ')</script>
                                    <?php
                                    exit();
                                }
                            }
                            $this->cart->update(array(
                                    'rowid' => $item['rowid'],
                                    'qty' => $item['qty']+$adet
                            ));
                            $flag = FALSE;
                            return true;
                            break;
                        }
                    }
                    if ($flag) {
                            foreach($sql->result() as $product) {
                                
                                $indirim="";
                                
                                if ($product->stock==0)
                                {?>
                                    <script>alert_box('Bu ürün şu anda stokta tükenmiştir. ')</script>
                                <?php exit(); }
                                elseif ($product->stock<$adet) {?>
                                    <script>alert_box('Stokta bu üründen <?php echo $product->stock ?> adet bulunmaktadır. ')</script>
                                <?php exit(); }
                                
                                if ($product->percentage>0) {
                                    $indirim=($product->percentage*$product->price)/100;
                                    $fiyat=$product->price-$indirim;
                                }
                                else {
                                    $fiyat=$product->price;
                                }
                                                                
                                $data = array(
                                'id'      => $product->id,
                                'qty'     => $adet,
                                'price'   => $fiyat,
                                'name'    => str_replace("-","",$product->title),
                                'options' => array('image'=>$product->image,'size'=>$size)
                                );
                                
                                $this->cart->insert($data);
                                return true;
                            }
                        }
                }
                else {
                    echo "Böyle bir ürün bulunamadı.";
                    return false;
                }
        }
        
        function basketcount() {
            $toplam="0";
            foreach ($this->cart->contents() as $basket) {
                $toplam=$toplam+$basket["qty"];
            }
            if ($toplam>0) { return $toplam; }
        }
        
        function update_qty($id,$rowid,$adet) {
            $flag = TRUE;
            $dataTmp = $this->cart->contents();
            $sql=$this->db->query("select * from products where id=".$this->db->escape($id)."");
                if ($sql->num_rows()>0) {
                    foreach ($dataTmp as $item) {
                        if ($item['id'] == $id) 
                        {
                            foreach($sql->result() as $product) {
                                if ($product->stock<($adet)) {
                                    ?>
                                    <script>alert_box('Stokta bu üründen <?php echo $product->stock ?> adet bulunmaktadır. ')</script>
                                    <?php
                                    exit();
                                }
                            }
                            $this->cart->update(array(
                                    'rowid' => $item['rowid'],
                                    'qty' => $adet
                            ));
                            $flag = FALSE;
                            return true;
                            break;
                        }
                    }
                }
        }
        
        function delete_basket($rowid='') {
            $this->cart->update(array(
                'rowid' => $rowid,
                'qty' => 0
            ));
            return true;
        }
        
        function pickuphesapla($table="basket",$userid="") {
            if (!is_numeric($userid)) {
                $userid=$this->session->userdata('userid');
            }
            $sql=$this->db->query("select * from $table where user_id=".$userid." and ben_alicam=1");
            if ($sql->num_rows()>0) {
                return $this->bicimlendir(5);
            }
            else {
                return $this->bicimlendir(0);
            }
        }
        
        function kargohesapla($table="basket") {
            $zone="";
            $z_kargo="";
            $sql=$this->db->query("select * from $table where user_id=".$this->session->userdata('userid')."");
            foreach($sql->result_array() as $b) {
                $sql=$this->db->query("select * from adresler where id=".$b["address"]." and (zone=5 or zone=9 or zone=10)");
                foreach($sql->result() as $z) {
                    $zone=1;
                }                
            }
            
            if ($zone==1) {
                return $this->bicimlendir($z_kargo);
            }
            else 
            {
                $sql=$this->db->query("select * from $table where user_id=".$this->session->userdata('userid')." and cleanse_date_view like '%Pazartesi%' and teslimat_saati like '%Sabah%'");
                if ($sql->num_rows()>0) {
                    return $this->bicimlendir($z_kargo+15);
                }
                else {
                    return $this->bicimlendir(0);
                }            
            }                        
        }
        
        function indirimhesapla() {
            return money_format('%.2n', 0);
        }
        
        function urun_indirim($tablo,$id) {
            $sql=$this->db->query("select * from $tablo where id=".$id."");
            foreach($sql->result() as $urun) {
                echo "<br/>";
                if ($urun->product_catid==3) {
                    if ($urun->day>1) {
                        if (($urun->person>2) && ($urun->person<8)) {
                            return 0.10;
                        }
                        if ($urun->person>7) {
                            return 0.15;
                        }
                        else {
                            return 0;
                        }
                    }
                    else { return 0; }
                }
            }
        }
        
        function bicimlendir($fiyat) {
            return money_format('%.2n', $fiyat);
        }        
        
        function toplamhesapla() {
            $kargo=$this->kargohesapla();
            $indirim=$this->indirimhesapla();
            $sql=$this->db->query("
            select basket.id as id , basket.user_id , basket.product_id , basket.qty , basket.product_catid , 
            basket.cleanse_date , basket.cleanse_date_view , basket.day , basket.address , basket.person , basket.teslimat_saati,
            products.id as pid , products.title , products.price , products.image,products.percentage
            from 
            basket , products
            where products.id=basket.product_id and basket.user_id=".$this->session->userdata('userid')." order by product_catid desc
            ");
            $juico_total=0;
            $cleanse_total=0;
            foreach($sql->result_array() as $basket) {
                if ($basket["product_catid"]==3) {
                    $cleanse_total=$cleanse_total+($basket["person"]*$basket["price"])*$basket["day"];
                }
                else {
                    $juico_total=$juico_total+($this->juico_model->fiyat_hesapla($basket)*$basket["qty"]);
                }
            } 
            $total=$cleanse_total+$juico_total;
            return money_format('%.2n',($total+$kargo)-$indirim);
        }
        
        function banka_toplamhesapla() {
            $kargo=$this->kargohesapla();
            $indirim=$this->indirimhesapla();
            $sql=$this->db->query("
            select basket.id as id , basket.user_id , basket.product_id , basket.qty , basket.product_catid , 
            basket.cleanse_date , basket.cleanse_date_view , basket.day , basket.address , basket.person , basket.teslimat_saati,
            products.id as pid , products.title , products.price , products.image,products.percentage,basket.indirim_orani
            from 
            basket , products
            where products.id=basket.product_id and basket.user_id=".$this->session->userdata('userid')." order by product_catid desc
            ");
            $juico_total=0;
            $cleanse_total=0;
            $toplam_indirim=0;
            foreach($sql->result_array() as $basket) {
                if ($basket["product_catid"]==3) {
                    $cleanse_total=$cleanse_total+($basket["person"]*$basket["price"])*$basket["day"];
                }
                else {
                    $juico_total=$juico_total+($this->juico_model->fiyat_hesapla($basket)*$basket["qty"]);
                }
                
                $oran=$basket["indirim_orani"];
                if ($oran>0) {
                    $p_fiyat=($basket["person"]*$basket["price"])*$basket["day"];
                    $i_fiyat=$p_fiyat*$oran;
                    $toplam_indirim=$toplam_indirim+$i_fiyat;
                }
            } 
            $total=($cleanse_total+$juico_total)-$toplam_indirim;
            $pickup=$this->cart_model->pickuphesapla();
            return money_format('%.2n',(($total+$kargo)-$indirim)-$pickup);
        }
        
        function sonuclandir($xidsi="",$tur="",$durum="",$kapidaodemetutar="",$authcode="",$hostrefnum="") 
        {
            $userid=$this->session->userdata('userid');
            $hediyevar=$this->session->userdata('BASKETHEDIYEVAR');
            $hediyetext=$this->session->userdata('BASKETHEDIYETEXT');
            $faturaayni=$this->session->userdata('BASKETFATURAYNI');            
            $siparisnotu=$this->session->userdata('BASKETNOTU');
            $siparisnotuvar=$this->session->userdata('BASKETNOTVAR');  
            $mailcontent='';            
            
            $kargo=$this->kargohesapla();            
            $sql=$this->db->query("
                select basket.id as id , basket.user_id , basket.product_id , basket.qty , basket.product_catid , 
                basket.cleanse_date , basket.cleanse_date_view , basket.day , basket.address , basket.person , basket.teslimat_saati,
                basket.indirim_orani,basket.ben_alicam,
                products.id as pid , products.title , products.price , products.image,products.percentage,
                users.id as uid , users.name_surname , users.email
                from 
                basket , products , users
                where products.id=basket.product_id and users.id=basket.user_id and basket.user_id=".$this->session->userdata('userid')." order by product_catid desc
                ");
                $toplamsayi=0;
                foreach($sql->result_array() as $basket) {
                    $toplamsayi=$toplamsayi+$basket["qty"];
                }                
                
                $toplamhesapla=$this->toplamhesapla();
                
                $data=array(
                    'user_id'=>$userid,                    
                    'fatura_ayni'=>$faturaayni,                    
                    'hediyemi'=>$hediyevar,
                    'hediyetext'=>$hediyetext,
                    'siparis_notu'=>$siparisnotu,
                    'urunsayisi'=>$toplamsayi,
                    'toplamfiyat'=>$toplamhesapla,
                    'tur'=>$tur,
                    'durum'=>$durum,
                    'update_date'=>date('Y-m-d H:i:s'),
                    'kapidaodemetutar'=>$kapidaodemetutar,
                    'indirilmisfiyat'=>$this->indirimhesapla(),
                    'kargo'=>$kargo,
                    'authcode'=>$authcode,
                    'hostrefnum'=>$hostrefnum
                    );                                          
                    $this->db->insert('user_orders',$data);
                    $insertid=$this->db->insert_id();
                
                $this->db->where('id',$insertid);
                $this->db->update('user_orders',array('order_code'=>$xidsi));
                
                foreach($sql->result_array() as $basket) {
                    
                    $sql=$this->db->query("select * from adresler where id=".$basket["address"]."");
                    foreach($sql->result() as $adres) {
                        $adresi=$adres->name_surname."<br/>".$adres->adres."<br>".$adres->semt."<br/>".$adres->telefon."<br/>".$adres->mobile."<br/>Tc:".$adres->tckimlik."<br/>";
                        $adresid=$adres->id;
                    }
                     
                    $data=array(
                        'order_id'=>$insertid,
                        'user_id'=>$userid,
                        'product_id'=>$basket["product_id"],
                        'product_title'=>$basket["title"],
                        'product_price'=>$basket["price"],
                        'qty'=>$basket["qty"],
                        'product_catid'=>$basket["product_catid"],
                        'cleanse_date'=>$basket["cleanse_date"],
                        'cleanse_date_view'=>$basket["cleanse_date_view"],
                        'day'=>$basket["day"],
                        'address'=>$adresi,
                        'address_id'=>$adresid,
                        'person'=>$basket["person"],
                        'teslim_saati'=>$basket["teslimat_saati"],
                        'ben_alicam'=>$basket["ben_alicam"],
                        'indirim_orani'=>$basket["indirim_orani"]
                    );
                    $this->db->insert('order_products',$data);
                    
                    if ($basket["product_catid"]==3) {
                        $not="";
                        if (strstr($basket["cleanse_date_view"],'Pazartesi')) { 
                            if (strstr($basket["teslimat_saati"],"Sabah")) {
                                $not='<b style="display:block;font-size:12px;margin-top:5px;">not: pazartesi sabahı gelen siparişler o gün içinde tüketilmelidir. 2 veya daha fazla günlük cleanse sipariş ediyorsanız, birden fazla teslimat yapılacaktır. </b><br/>';
                            }
                        }
                        
                        $mailcontent=$mailcontent.'
                        <div style="background:#efefef;padding:10px">
                            <b>'.$basket["name_surname"].'</b> ('.$basket["email"].')<br/>
                            <b>'.$basket["title"].'</b> ('.$basket["day"].' gün - '.$basket["person"].' kişi)<br/>
                            '.$basket["cleanse_date_view"].' '.$basket["teslimat_saati"].'<br/>
                            '.$not.'
                            '.$adresi.'
                        </div>';
                        
                        $not="";
                    }
                    else {
                        if ($basket["qty"]>0) {
                            $not="";
                            if (strstr($basket["cleanse_date_view"],'Pazartesi')) { 
                                if (strstr($basket["teslimat_saati"],"Sabah")) {
                                    $not='<b style="display:block;font-size:12px;margin-top:5px;">not: pazartesi sabahı gelen siparişler o gün içinde tüketilmelidir. 2 veya daha fazla günlük cleanse sipariş ediyorsanız, birden fazla teslimat yapılacaktır. </b><br/>';
                                }
                            }
                            $mailcontent=$mailcontent.'
                            <div style="background:#efefef;padding:10px;margin-bottom:1px;">
                                <b>'.$basket["name_surname"].'</b> ('.$basket["email"].')<br/>
                                <b>'.$basket["title"].'</b> ('.$basket["qty"].' adet)<br/>
                                '.$basket["cleanse_date_view"].' '.$basket["teslimat_saati"].'<br/>
                                '.$not.'
                                '.$adresi.'
                            </div>';
                            $not="";
                        }
                    }
                }
                
                if ($tur == 1) {
                    $odeme_tipi="Havale";
                } elseif ($tur == 2) {
                    $odeme_tipi="Kredi Kartı";
                } elseif ($tur == 3) {
                    $odeme_tipi="Kapıda Ödeme";
                }
                
                $this->db->where('user_id',$userid);
                $this->db->delete('basket');
                $this->load->model('sez_email');                
            
                $this->sez_email->send('hey@juico.com.tr','Sipariş Var','www.juico.com.tr den sipariş geldi<br/><br/>
                Sipariş detaylarını yönetim panelinden görebilirsiniz.<br/></br>
                <br/><br/>
                <b>Sipariş Numarası: '.$xidsi.'</b><br/>
                Ödeme Tipi : '.$odeme_tipi.' <br/><br/><br/>
                Toplam Fiyat : '.$toplamhesapla.'<br/><br/>
                <b>Not :</b>'.$siparisnotu.'</br></br>
                '.$mailcontent.'<br/>
                Yönetim paneline gitmek için <a href="'.base_url().'busycms/login">tıklayın</a>');
                
                $usercontent='<br/><br/><b>Juico</b>’ya hoş geldin.
 <br/><br/>
 <b>Sipariş Numarası: '.$xidsi.'</b><br/><br/>
 <br/><br/>
Eğer Juico Cleanse yapıyorsan, aşağıdaki bilgilere bir göz at! <br/><br/>

<b>Başlamadan önce...</b><br/>
İster 1 gün ister 5 günlük programda ol, vücudunun bu değişikliğe hazırlanması şart! Ne kadar ön hazırlık yaparsan, program sırasında o kadar rahat edeceğine söz veriyoruz J Başlamadan önce en az 2-3 gün biraz daha dikkatli beslenmek yardımcı olacaktır. Mümkün olduğunca işlenmiş yiyeceklerden, kırmızı et, yağ, şeker, sofra tuzu, süt ürünleri ve beyaz ekmek, un, makarnadan uzak durmaya çalış. “Geriye ne kaldı ki!” dersen eğer... Bol taze meyve, sebze, kepekli pirinç ve kepekli makarna, balık gibi yiyeceklere ağırlık verebilirsin. Emin ol, daha programa başlamadan kendini iyi hissedeceksin. Kafein ve alkole gelince, ne kadar az o kadar iyi. Bol bol su iç lütfen! 
<br/><br/>
<b>Juico’larım geldi, simdi ne yapıyorum?</b><br/>
Öncelikle, kendine böyle bir iyilik yaptığın için seni tebrik ediyoruz! İşin en zor kısmını atlattın. Programa başlamadan önce, hem hayatını biraz kolaylaştırmak, hem de programdan maksimum fayda elde etmeni sağlayabilmek için birkaç küçük tavsiyemiz olacak. 
<br/><br/>
Juico’ları gelir gelmez <b>kutusundan çıkarıp buzdolabına yerleştir!</b> Çünkü hepsi sana ulaşmadan birkaç saat önce sıkıldı ve çok tazeler. Hiçbir pastörizasyondan geçmedikleri için maksimum enzim, vitamin ve mineral değerlerine sahipler. Özel hidrolik pres cihazımız sayesinde 3 gün bu tazeliklerini koruyacaklar, yeter ki hep soğuk ve kapakları kapalı olsunlar. 
<br/><br/>
<b>Önemli not: Pazartesi sabahı teslim edilen Juico`ların aynı gün içerisinde tüketilmesi gerekiyor.</b>
<br/><br/>
Juico’ları, şişelerin üzerindeki 1’den 6’ya veya 1’den 8’e kadar olan numara sırasına göre içmen gerekiyor. Vücudun en zahmetsiz sindirimi bu sıraya göre yapacaktır. İlk Juico’nu içmeden önce güne bir bardak -içine bir kaç dilim limon atılmış- ılık suyla başla. Diğer Juico’ları sırasıyla, acıktıkça ya da 2 saat arayla iç. 6 veya 8 numaralı kaju sütünü ise yatmadan en az 2 saat önce bitirmeye çalış. 
<br/><br/>
Gün boyunca her Juico arasında bol bol su içmek detoks sürecine ve detoksla ortaya çıkabilecek yan etkileri azaltmaya yardımcı olacaktır. İstediğin kadar yeşil çay, ıhlamur ve diğer bitki çaylarından içebilirsin. Çay ve kahve konusunda sanırım ne söyleyeceğimizi tahmin ediyorsun. Sigara mı? Hmmm. Sadece tavsiye etmiyoruz diyelim. Onun yerine masaj veya saunaya ne dersin? Toksinlerin vücuttan çıkmasını hızlandıracaktır. 
<br/><br/><br/>
Bu kadar kural yeter dediğini duyar gibiyiz. Önemli olan yapabildiğinin en iyisini yapmak, vücudun birazına bile teşekkür edecektir. Bu yüzden, her ne kadar bu süreçte hiçbir şey yememek gerekse de, mutlaka birşeyler çiğnemem lazım diyorsan ya da ufak bir esneklik istiyorsan, aşağıdakilerden birini seçebilirsin: 
<br/><br/>
o Bir-iki salatalık, havuç ve çok tatlı olmayan çiğ meyve-sebzeler<br/>
o Yarım avokado <br/>
o Sebze çorbası (Yağsız ve tuzsuz tabi ki)<br/>
o Küçük bir fincan sütsüz, şekersiz kahve<br/>
o Birkaç günlük programdaysan ve çok acıkıyorsan kaju sütünün yarısını sabaha saklayabilirsin<br/>
o Biraz enerji için Juico’lara bir tutam deniz tuzu atabilirsin <br/>
<br/>
<b>Peki spor yapabiliyor muyum? </b><br/><br/>
Tabii ki! Program sırasında hafif bir spor yapmak iyi bile gelecektir. Yürüme, yüzme, pilates, yoga gibi aktiviteler ideal olmakla beraber, düşük bir tempoda koşu da olabilir. Ama öncesinde ve sonrasında bol su içmeyi unutma lütfen! 
<br/><br/><br/>
Program öncesinde veya sırasında her türlü soru için bizi arayabilirsin veya e-mail atabilirsin. İlk iki gün, detoks işaretleri olan baş ağrısı, hafif baş dönmesi veya halsizlik gibi yan etkiler hissedebilirsin, bunlar çok normal. Bol su içip, dinlenmeye çalış. Herhangi bir rahatsızlığın, alerjin veya hastalığın varsa lütfen başlamadan önce bizi bilgilendir ve mutlaka doktoruna danış. 
<br/><br/>
Unutma ki program boyunca yanında olacağız!<br/>
Juico’ların keyfini çıkar!<br/>
<a href="mailto:hey@juico.com.tr">hey@juico.com.tr</a>';
                
                $this->sez_email->send($basket["email"],'Siparişin','
                '.$mailcontent.'<br/>
                '.$usercontent.'
                ');
                
                return true;
        }    
        // sezgin
}