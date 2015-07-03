<form id="priceform" name="priceform" onsubmit="return false;">
<ul>
    <?php foreach($productssql->result() as $product) { ?>
    <li id="product<?php echo $product->id ?>">
        <div class="publish <?php if ($product->publish==1) { echo "blackpublish"; } else { echo "graypublish"; } ?>" id="publish<?php echo $product->id ?>" <?php if ($product->publish==1) { echo "class=\"blackpublish\""; } else { echo "class=\"graypublish\""; } ?> onclick="publish(<?php echo $product->id ?>)">=</div>
        <div class="title" onclick="location.href='<?php echo base_url() ?>busycms/editproduct/<?php echo $product->id ?>'" style="cursor:pointer;"><?php echo $product->title ?>
            <?php if ($product->volume>0) { ?> <span>[<?php echo $product->volume ?>ml]</span> <?php }?>
        </div>
        <div class="product-menus">
            <div class="menu">
                <a href="#" onclick="location.href='<?php echo base_url() ?>busycms/editproduct/<?php echo $product->id ?>'">8</a>
                <a href="javascript:void(0)" class="redbutton" onclick="deleteproduct(<?php echo $product->id ?>)">X</a>
            </div>
            <!-- <div class="stock">
                qty <b><?php echo $product->stock ?></b>
            </div> -->
            <?php if ($product->percentage>0) { echo "<div class=\"percentage\">";
                $indirim=($product->percentage*$product->price)/100;
                $son=$product->price-$indirim;
                echo "<label>[".$product->percentage."%]</label> <b>".$son."</b>TL";
                echo "</div>";
            } else { $son=0; } ?>
            <div class="price <?php if ($son>0) { echo "yesper"; } ?>" style="left:auto;right:20px;">
                <b><?php echo str_replace(".00","",$product->price) ?></b>TL
            </div>
            <div class="icons">
                <span class="">a</span>
                <span class="">.</span>
                <span class="">}</span>
            </div>
        </div>
        <div class="product-edits">
            <table>
                <tr>
                    <!-- <td>
                        Price:
                    </td> -->
                    <td align="right">
                        <input type="text" name="price<?php echo $product->id ?>" value="<?php echo $product->price ?>" style="width:100px;" />
                    </td>
                    <!--<td width="20">&nbsp;</td>
                     <td>
                        Percentage:
                    </td>
                    <td>
                        <input type="text" name="percentage<?php echo $product->id ?>" value="<?php echo $product->percentage ?>" style="width:50px;" />
                    </td>
                    <td width="20">&nbsp;</td>
                    <td>
                        Stock:
                    </td>
                    <td>
                        <input type="text" name="stock<?php echo $product->id ?>" value="<?php echo $product->stock ?>" style="width:50px;" />
                    </td> -->
                    <td width="20">&nbsp;</td>
                </tr>
            </table>
        </div>
    </li>
    <?php } ?>
</ul><br/>
    <div align="right" id="pricebuttons" style="display:none;">
        <input type="hidden" name="sql" value="<?php echo $listsql ?>" />
        <input type="hidden" name="catid" value="<?php echo $catid ?>" />
        <input type="hidden" name="sort" value="<?php echo $sort ?>" />
        <button style="margin-right:15px;" onClick="submitform('busycms/','priceform');">Save Prices</button>
    </div>
<div id="priceform_back"></div>
</form>