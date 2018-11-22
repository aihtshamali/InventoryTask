$(document).ready(function () {

    $("#invDate").change(function(){

        var $this= $(this);

        $(".invoice-title .status span").attr("class",$(this).val()).html($(this).val());
    })

  
});