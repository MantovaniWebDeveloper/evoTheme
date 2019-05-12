jQuery(document).ready(function() {
//alert("sono vivo");

  jQuery(".wrapElementoFiltro").on("click", function(e){
    var id = jQuery(e.target).attr("id");
    console.log(id);

    jQuery.ajax({
      url: my_vars.ajaxurl,
      type: "POST",
      data: {
        action: 'trovaPilota',
        _nonce: my_vars.nonce,
        idCategoria: id
      },
      success: function(res) {
        console.log("da ajax", res);
      }
    })
  });
});
