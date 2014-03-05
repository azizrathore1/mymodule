// this file is used fot mymodulersult.js file 

// which should need to include in front controller later

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
});

function getsubcategory(catid){
//Basic point is here we should need to make these used need to make in your controller
  $.ajax({ 
          url: '/modules/mymodule/ajaxPage.php?callFor=subcategory&category_id='+catid+"&langid="+{$langid},
          success: function(data){
            $("#subcatprodlist").html(data);
          }
        });
}
function getmanuafcturer(catid){
  $.ajax({ 
    url: '/modules/mymodule/ajaxPage.php?callFor=manufacturerlist&category_id='+catid+"&langid="+{$langid},
    success: function(data){
      $("#manufactlist").html(data);
    }
});
</script>