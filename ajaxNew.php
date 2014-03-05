<?php
include_once('../../config/config.inc.php');
include_once('../../init.php');

$html = '';
/*$html.= '<script type="text/javascript" src="/presta/modules/mymodule/js/ajax-cart.js">';
$html.= '</script>';*/

if(isset($_GET['category_id'])){
    $categoryid = $_GET['category_id'];
}

if(isset($_GET['manufact_id'])){
    $manuid     = $_GET['manufact_id'];
}
$action     = $_GET['callFor'];
$langid     = $_GET['langid'];
$static_token = Tools::getToken(false);


function getImagesTest($id_lang, $id_product){
	 $sql = 'SELECT *
		FROM `'._DB_PREFIX_.'image` i
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image`)
		WHERE i.`id_product` = '.(int)$id_product.' AND il.`id_lang` = '.(int)$id_lang.'
		ORDER BY i.`position` ASC';
        $result = Db::getInstance()->getValue($sql);
                //echo "<br>".$result;
        if (isset($result))
            return $result;
        return false;
}
 
if($action == 'category'){
    $productres = ProductCore::getProducts($langid, $start = 1 ,$limit = 12, $order_by = 'id_product', $order_way = 'DESC', $categoryid);
    /* echo "<pre>";
    print_r($productres);
    echo "</pre>";*/
    if($productres){
    //$html.= '<h4>Results</h4>';
        $html.= '<ul class="clear" id="product_list">';
        foreach($productres as $val){
        // $link->getImageLink($val['link_rewrite'],$val['id_image']);
        $imagesarr = getImagesTest($langid, $val['id_product']);
        //$html.='<h1 class="special">Lamper &amp; Lys</h1>';
        $html.= '<li class="ajax_block_product row-fluid">';
        $html.= '<!--div class="left_block"></div-->';
        $html.= '<div class="thumbnail span12">';
        $html.= '<a title="Princess - Loftslampe" class="product_img_link" href="'.$link->getProductLink($val['id_product']).'">';
        // $html.= '<img width="200" height="300" alt="" src="">';
        $html.= '<img width="200" height="300" alt="" src="'.$link->getImageLink($val['link_rewrite'],$imagesarr ).'">';
        if($val['condition'] == "new"){
            $html.= '<span class="new">New</span>';
        }
        //$html.= '<span class="discount">Reduced price!</span>';                           
        //$html.='<span class="availability available">Available</span>';				
        $html.='</a>';
        $html.= '<div class=" productname">';
        $html.='<h3><a title="'.$val['name'].'" href="'.$link->getProductLink($val['id_product']).'">'.$val['name'].'</a></h3>';
        $html.='<!--p><a href="http://old.eurostores.dk/en/lamper-og-lys/Disney-Princess-Nedhaengslampe.html" title="Smart Disney Princess nedh&aelig;nges lampe med et flot billede p&aring;. Lampen giver et flot lys fra sig...." >Smart Disney Princess nedh&aelig;nges lampe med et flot billede p&aring;. Lampen giver et flot lys fra sig....</a></p-->';
        $html.='</div>';
        $html.='</div> ';
        $html.='<div class="span12">';
        $html.='<div class="content_price">';
        $html.='<span style="display: inline;" class="price">';
        $tax = $val['price'] * ($val['rate'] / 100);
        $old_price = $tax + $val['price'];
        $html.=' <span class="oldPrice">'.$old_price.' kr</span>'.$val['price'].'</span><br>';
        $html.='</div>';
        $html.='</div>';
        $html.='<div class="span12  product_list_btns">';
        $html.='<div class="row-fluid">';
        $html.='<div class="span6">';
        $html.='<a title="View" href="'.$link->getProductLink($val['id_product']).'" class="btn  btn-view-product">View</a>';
        $html.='</div>';
        $html.='<div class="span6">';
        if ($val['quantity'] > 0){
            if(isset($static_token)){
                $html.='<a title="Add to cart" href="'.$link->getPageLink('cart',false, NULL, "add=1&amp;id_product=".$val['id_product']."&amp;token=".$static_token."", false).'" rel="ajax_id_product_'.$val['id_product'].'" class="btn btn-warning ajax_add_to_cart_button btn-add-cart-product">Add to cart</a>';
            }else{
                $html.= '<a class="btn ajax_add_to_cart_button " rel="ajax_id_product_'.$val['id_product'].'" href="'.$link->getPageLink('cart',false, NULL, "add=1&amp;id_product=".$val['id_product']."&amp;token=".$static_token."", false).'" title="Add to cart">Add to cart</a>';
            }
        }else{
            $html.='<span class="btn disabled btn-add-cart-product-dissabled">Add to cart</span>';
        }
        $html.='</div>';
        $html.='</div>';
        $html.='</div>';
        $html.='<div class="span12  text-center"><span class="gratis-feature">Gratis levering i Danmark</span></div>';
        $html.='</li>';
    }
    $html.= '</ul>';
   }
}
else if($action == 'subcategory'){
    $subproductres = CategoryCore::getSubCategoriestest($langid, $categoryid);
    if($subproductres){
        $html.= 'Subcategory:';
        $html.= '<br>';
        $html.= '<select name="subcategory_val" id="subcategory_val" class="subcategory">';
        $html.= '<option value="Choose">Choose</option>';
        foreach($subproductres as $value){
            $html.= '<option value="'.$value['id_category'].'">'.$value['name'].'</option>';
        }
        $html.= '</select>';
    }
    $html.= '<script type="text/javascript">';
    $html.= '$(document).ready(function(){';
        $html.= '$("#subcategory_val").change(function(){';
            $html.= 'var val_cat = $(this).val();';
            //$html.= 'alert(val_cat);';
            $html.= '$.ajax({';
                $html.= 'url: "/modules/mymodule/ajaxNew.php?callFor=category&category_id="+val_cat+"&langid="+'.$langid.',';
                $html.= 'success: function(data){	';
                $html.= '$("#catprodlist").html(data);';
                $html.= '}';
                $html.= '});';
                $html.= 'getmanuafcturer(val_cat);';
                $html.= '});';
                $html.= '});';
                $html.= '</script>';
            }
            else if($action == 'manufacturerlist'){
                $productres = ProductCore::getProductsTest($langid, $start = 1 ,$limit = 12, $order_by = 'id_product', $order_way = 'DESC', $categoryid);
                $html.= 'Manufacturer: ';
                $html.= '<select name="manufacturer_val" id="manufacturer_val" class="manufacturer">';
                $html.= '<option value="Choose">Choose</option>';
                foreach($productres as $productresult){
                    $manures = ManufacturerCore::getNameByIdTest($productresult['id_manufacturer']);
                    if($manures){
                        $html.= '<option value="'.$productresult['id_manufacturer'].'">'.$manures.'</option>';
                    }
                    
                    $html.= '</select>';
                    $html.= '<script type="text/javascript">';
                    $html.= '$(document).ready(function(){';

                    //REMOVE DUPLICATE VALUES
                        $html.= 'var present = {};';
                        $html.= '$("#manufacturer_val option").each(function(){';
                        // Get the text of the current option
                            $html.= 'var text = $(this).text();';
                            //$html.='alert(text)';
                            // Test if the text is already present in the object
                            $html.= 'if(present[text]){';
                            // If it is then remove it
                            $html.= '$(this).remove();';
                            $html.= '}else{';
                            // Otherwise, place it in the object
                            $html.= 'present[text] = true;';
                            $html.= '}';
                            $html.= '});';

                            //GET MANUFACTURER PRODUCTS
                            $html.= '$("#manufacturer_val").change(function(){';
                                $html.= 'var val_manu = $(this).val();';
                                //$html.= 'alert(val_cat);';
                                $html.= '$.ajax({';
                                $html.= 'url: "/modules/mymodule/ajaxNew.php?callFor=getmanufacturerproducts&manufact_id="+val_manu+"&langid="+'.$langid.',';
                                $html.= 'success: function(data){	';
                                $html.= '$("#catprodlist").html(data);';
                                $html.= '}';
                                $html.= '});';
                                //$html.= 'getmanuafcturer(val_cat);';
                                $html.= '});';
                                $html.= '});';
                                $html.= '</script>';   
                            }
                            else if($action == 'getmanufacturerproducts' && $manuid != 'Choose' ){
                                $manuresult = ManufacturerCore::getProducts($manuid, $langid, $p = 1, $n = 12, $order_by = 'id_product', $order_way = 'DESC',$get_total = false, $active = true);    //ho $manuid;
                                /*echo "<pre>";
                                print_r($manuresult);
                                echo "</pre>";*/
                                    if($manuresult){
                                    //$html.= '<h4>Results</h4>';
                                        $html.= '<ul class="clear" id="product_list">';
                                        foreach($manuresult as $val){
                                        //$html.='<h1 class="special">Lamper &amp; Lys</h1>';
                                            $html.= '<li class="ajax_block_product row-fluid">';
                                            $html.= '<!--div class="left_block"></div-->';
                                            $html.= '<div class="thumbnail span12">';
                                            $html.= '<a title="Princess - Loftslampe" class="product_img_link" href="'.$val['link'].'">';
                                            $imagesarre = getImagesTest($langid, $val['id_product']);
                                            $html.= '<img width="200" height="300" alt="" src="'.$link->getImageLink($val['link_rewrite'], $imagesarre).'">';
                                            //$html.= '<img width="200" height="300" alt="" src="">';
                                            if($val['condition'] == "new"){
                                                $html.= '<span class="new">New</span>';
                                            }
                                            //$html.= '<span class="new">New</span>';
                                            //$html.= '<span class="discount">Reduced price!</span>';                           
                                            //$html.='<span class="availability available">Available</span>';				
                                            $html.='</a>';
                                            $html.= '<div class=" productname">';
                                            $html.='<h3><a title="'.$val['name'].'" href="'.$val['link'].'">'.$val['name'].'</a></h3>';
                                            $html.='<!--p><a href="http://old.eurostores.dk/en/lamper-og-lys/Disney-Princess-Nedhaengslampe.html" title="Smart Disney Princess nedh&aelig;nges lampe med et flot billede p&aring;. Lampen giver et flot lys fra sig...." >Smart Disney Princess nedh&aelig;nges lampe med et flot billede p&aring;. Lampen giver et flot lys fra sig....</a></p-->';
                                            $html.='</div>';
                                            $html.='</div> ';
                                            $html.='<div class="span12">';
                                            $html.='<div class="content_price">';
                                            $html.='<span style="display: inline;" class="price">';
                                            $tax = $val['price'] * ($val['rate'] / 100);
                                            $old_price = $tax + $val['price'];
                                            $html.=' <span class="oldPrice">'.$old_price.' kr</span>'.$val['price'].'</span><br>';
                                            $html.='</div>';
                                            $html.='</div>';
                                            $html.='<div class="span12  product_list_btns">';
                                            $html.='<div class="row-fluid">';
                                            $html.='<div class="span6">';
                                            $html.='<a title="View" href="'.$val['link'].'" class="btn  btn-view-product">View</a>';
                                            $html.='</div>';
                                            $html.='<div class="span6">';
                                            if ($val['quantity'] > 0){
                                                if(isset($static_token)){
                                                    $html.='<a title="Add to cart" href="'.$link->getPageLink('cart',false, NULL, "add=1&amp;id_product=".$val['id_product']."&amp;token=".$static_token."", false).'" rel="ajax_id_product_'.$val['id_product'].'" class="btn btn-warning ajax_add_to_cart_button btn-add-cart-product">Add to cart</a>';
                                                }else{
                                                    $html.= '<a class="btn ajax_add_to_cart_button " rel="ajax_id_product_'.$val['id_product'].'" href="'.$link->getPageLink('cart',false, NULL, "add=1&amp;id_product=".$val['id_product']."&amp;token=".$static_token."", false).'" title="Add to cart">Add to cart</a>';
                                                }
                                            }else{
                                                $html.='<span class="btn disabled btn-add-cart-product-dissabled">Add to cart</span>';
                                            }
                                            // $html.='<a title="Add to cart" href="'.$link->getPageLink('cart',false, NULL, "add=1&amp;id_product=".$val['id_product']."&amp;token=".$static_token."", false).'" rel="ajax_id_product_'.$val['id_product'].'" class="btn btn-warning ajax_add_to_cart_button btn-add-cart-product">Add to cart</a>';
                                            $html.='</div>';
                                            $html.='</div>';
                                            $html.='</div>';
                                            $html.='<div class="span12  text-center"><span class="gratis-feature">Gratis levering i Danmark</span></div>';
                                            $html.='</li>';
                                        }
                                        $html.= '</ul>';
                                    }
                                }
                                echo $html;
                                ?>