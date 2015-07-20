<div class="row">
    <nav class="order_menu">
        <a <?php if( $selectnav == "edit" ) {echo 'class="p_menu_active"';} ?> href="<?php echo base_url('profile/edit') ?>">Üyelik Bilgileri</a>|
        <a <?php if( $selectnav == "address" ) {echo 'class="p_menu_active"';} ?> href="<?php echo base_url('profile/address') ?>">Adres Defteri</a>|
        <a <?php if( $selectnav == "orders" ) {echo 'class="p_menu_active"';} ?> href="<?php echo base_url('profile/orders') ?>">Siparişlerim</a>|
        <a href="<?php echo base_url() ?>">Çıkış Yap</a>
    </nav>
</div>