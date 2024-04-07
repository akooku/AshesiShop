$(document).ready(function(){
    $('.quantity-input').on('change', function(){
        var quantity = $(this).val();
        var productId = $(this).data('product-id');
        $.ajax({
            url: 'cart.php',
            type: 'post',
            data: {quantity: quantity, product_id: productId},
            success: function(response){
                var totalPrice = parseFloat(response);
                var $parentRow = $(this).closest('tr');
                $parentRow.find('.total-price').text('GHS ' + totalPrice.toFixed(2));
            }
        });
    });
});