

<!-- Block categories module -->
<!-- render from the mymodule.php file -->
<br />
<div id="categories_block_left" class="block hidden-phone">
	<!-- l s='Filter' mod='mymodule call the prests shop method that enable you register the string in module transaltion panel s is string and mod parameter contains the identifier in present case mymodule-->
	<h3 class="">{l s='Filter' mod='mymodule'}</h3>
	
	<div class="categories_content">
		<ul>
			<li>
				<a href="{$my_module_category}" title="Click this link">By Category</a>
			</li>
        	<li>
        		<a href="{$my_module_newproducts}" title="Click this link">By New products</a>
        	</li>
        </ul>
	</div>
</div>
    
<!-- /Block categories module -->
