

{* This is our basic template for the Category filter *}

<h3>Category Filter</h3>   
<label>Category</label>
<select name="category_val" id="category_val" class="category">
  <option value="Choose">Choose</option>
  {foreach from=$homecategories item=homecategory name=categoryLoop}
  {html_options values=$homecategory.id_category output=$homecategory.name}
  {/foreach} 
</select>

<script type="text/javascript">


</script>
<br>
<div id="subcatprodlist"></div> 
<div id="manufactlist" style="float:right;margin-top:-47px;"></div>
<div id="catprodlist"></div>

                
                