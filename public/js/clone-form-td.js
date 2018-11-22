
$(function () {
    $('#btnAdd').click(function (e) {
        e.preventDefault();
        var num     = $('.invoice-detail .clonedInput').length;
        console.log(num);
            newNum  = new Number(num + 1);
            if(num==1)
              num='';
            newElem = $('#entry').clone().attr('id', 'entry' + newNum);

            newElem.find(".label_desc").attr('for', 'desc' + newNum).html();
            newElem.find("#input_desc").attr('name', 'description[]').attr('id', 'input_desc' + newNum).val("");

            newElem.find(".label_quantity").attr('for', 'quantity' + newNum).html();
            newElem.find("#input_quantity").attr('name', 'quantity[]').attr('id', 'input_quantity' + newNum).val("");

            newElem.find(".label_rate").attr('for', 'rate' + newNum).html();
            newElem.find("#input_rate").attr('name', 'rate[]').attr('id', 'input_rate' + newNum).val("");

            newElem.find(".label_amount").attr('for', 'amount' + newNum).html();
            newElem.find("#input_amount").attr('name', 'amount' + newNum).attr('id', 'input_amount' + newNum).val("");

            // Modifying your files
            // $('#entry' + num).after(newElem);
            $('#entry'+num).after(newElem).fadeIn("slow");


        $('#btnDel').attr('disabled', false);

        if (newNum == 4)
        $('#btnAdd').attr('disabled', true);
    });

    $('#btnDel').click(function () {
        if (confirm("Are you sure you wish to remove this section? This cannot be undone."))
            {
                var num = $('.clonedInput').length;

                $('#entry' + num).slideUp('slow', function () {$(this).remove();
                  // For Recalculating Total
                  calculateTotal();

                    if (num -1 === 1)
                $('#btnDel').attr('disabled', true);

                $('#btnAdd').attr('disabled', false).prop('value', "add section");});
            }
        return false;
    });

    $('#btnAdd').attr('disabled', false);

    $('#btnDel').attr('disabled', true);
});
