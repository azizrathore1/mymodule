(function(window, document, $, undefined){
  $.ajaxSetup({
    timeout: 10000
  });

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
    }
  });
}
})(window, document, jQuery);