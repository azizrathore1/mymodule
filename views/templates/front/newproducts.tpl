<h3>New products Filter</h3>  
<label>Category</label>
<select name="category_val" id="category_val" class="category">
<option value="Choose">Choose</option>
{foreach from=$homecategories item=homecategory name=categoryLoop}

{html_options values=$homecategory.id_category output=$homecategory.name}

{/foreach} 
</select>

<script type="text/javascript">
$(document).ready(function(){
  var valArray, val_cat;
  //HOME CATEGORY
  $("#category_val").change(function(){	
    valArray = $(this).val();
    $.ajax({
      url: '/modules/mymodule/ajaxNew.php?callFor=category&category_id='+valArray+"&langid="+{$langid},
      success: function(data){	
        $("#catprodlist").html(data);
      }
    });
    getsubcategory(valArray);
  });


//SUB CATEGORY
$("#subcategory_val").change(function(){	
  val_cat = $(this).val();
  alert(val_cat);
  $.ajax({
    url: '/modules/mymodule/ajaxNew.php?callFor=category&category_id='+val_cat+"&langid="+{$langid},
    success: function(data){	
      $("#catprodlist").html(data);
    }
  });
});
});

function getsubcategory(catid){
  $.ajax({ 
    url: '/modules/mymodule/ajaxNew.php?callFor=subcategory&category_id='+catid+"&langid="+{$langid},
    success: function(data){
      $("#subcatprodlist").html(data);
      /*var options    = '';
      $.each(data.category, function(key, val) {
      options += '<option value="' + key + '">' + val + '</option>';
    });
  $("select#category").html(options);  */                        
}
});
}
</script>
<br>
<div id="subcatprodlist"></div>
<div id="catprodlist"></div>
