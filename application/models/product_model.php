<?php 
class Product_model extends CI_Model {   
    function products_list($product,$i,$favorite=0) 
    {
        ?>
                <article class="product<?php if ($i%3==0) { echo " last"; } ?>" id="product<?php echo $product->id ?>">
                    <a href="<?php echo base_url().$this->lang->line('lang') ?>product/detail/<?php echo $product->id ?>">
                    <div class="image">
                        <?php if (strlen($product->image)>0) { ?>
                        <img src="<?php echo base_url() ?>uploads/<?php echo $product->image ?>" /> 
                        <?php }?>
                        &nbsp;
                    </div>
                    <div class="title">
                        <?php echo $product->title ?>
                        <span><?php echo $product->price ?> <?php echo $this->lang->line('parabirimi') ?></span>
                    </div>
                        </a>
                    <?php if ($favorite==1) { ?>
                    <a href="javascript:void(0)" class="delete_favorite" onclick="favorite(<?php echo $product->id ?>)">
                        delete favorite
                    </a>
                    <?php } ?>
                </article>
        <?php
    }
    
    function product_price($product) {
        echo $product["price"]." ".$this->lang->line('parabirimi');
    }
}
?>
