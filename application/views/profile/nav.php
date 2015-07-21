<div class="row">
    <nav class="order_menu">
<<<<<<< Updated upstream
        <a <?php if( $selectnav == "edit" ) {echo 'class="p_menu_active"';} ?> href="<?php echo base_url('profile/edit') ?>">Üyelik Bilgileri</a>|
        <a <?php if( $selectnav == "address" ) {echo 'class="p_menu_active"';} ?> href="<?php echo base_url('profile/address') ?>">Adres Defteri</a>|
        <a <?php if( $selectnav == "orders" ) {echo 'class="p_menu_active"';} ?> href="<?php echo base_url('profile/orders') ?>">Siparişlerim</a>|
        <a href="<?php echo base_url() ?>">Çıkış Yap</a>
=======

    <ul>
        <li><a href="<?php echo base_url('profile/edit') ?>">Üyelik Bilgileri</a></li>|
        <li><a href="<?php echo base_url('profile/address') ?>">Adres Defteri</a></li>|
        <li><a href="<?php echo base_url('profile/orders') ?>">Siparişlerim</a></li>|
        <li><a href="<?php echo base_url() ?>">Çıkış Yap</a></li>
    </ul>

>>>>>>> Stashed changes
    </nav>
</div>