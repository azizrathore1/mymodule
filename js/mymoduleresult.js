<script type="text/javascript">

$(document).ready(function(){
  var valArray, val_cat;
  //HOME CATEGORY
  $("#category_val").change(function(){	
    valArray = $(this).val();
    $.ajax({
      url: '/modules/mymodule/ajaxPage.php?callFor=category&category_id='+valArray+"&langid="+{$langid},
      success: function(data){	
        $("#catprodlist").html(data);
      }
    });
    getsubcategory(valArray);
    getmanuafcturer(valArray);
  });


  //SUB CATEGORY
  /*$("#subcategory_val").change(function(){	
  val_cat = $(this).val();
  //alert(val_cat);
   $.ajax({
    url: '/presta/modules/mymodule/ajaxPage.php?callFor=category&category_id='+val_cat+"&langid="+{$langid},

    success: function(data){	
    $("#catprodlist").html(data);
    }
  });
  getmanuafcturer(val_cat);
});*/

});

function getsubcategory(catid){
  $.ajax({ 
          url: '/modules/mymodule/ajaxPage.php?callFor=subcategory&category_id='+catid+"&langid="+{$langid},
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

function getmanuafcturer(catid){
  $.ajax({ 
    url: '/modules/mymodule/ajaxPage.php?callFor=manufacturerlist&category_id='+catid+"&langid="+{$langid},
    success: function(data){
      $("#manufactlist").html(data);
      /*var options    = '';
      $.each(data.category, function(key, val) {
      options += '<option value="' + key + '">' + val + '</option>';
    });
  $("select#category").html(options);  */                        
}
});
</script>