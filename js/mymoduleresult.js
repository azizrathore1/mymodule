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
})(window, document, jQuery);