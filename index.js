$(document).ready(function(){

    $("#banner-area .owl-carousel").owlCarousel({
        dots: true,
        items: 1
    });

    $("#top-sale .owl-carousel").owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        responsive : {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000 : {
                items: 5
            }
        }
    });

    var $grid = $(".grid").isotope({
        itemSelector : '.grid-item',
        layoutMode : 'fitRows'
    });

    $(".button-group").on("click", "button", function(){
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue});
    })


    $("#new-phones .owl-carousel").owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive : {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000 : {
                items: 5
            }
        }
    });

    $("#blogs .owl-carousel").owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive : {
            0: {
                items: 1
            },
            600: {
                items: 3
            }
        }
    })

    let $qty_up = $(".qty .qty-up");
    let $qty_down = $(".qty .qty-down");
    let $deal_price = $("#deal-price");

    $qty_up.click(function(e){
        e.preventDefault();
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        let $price = $(`.product_price[data-id='${$(this).data("id")}']`);

        $.ajax({
            url: "template/ajax.php", 
            type : 'post', 
            data : { itemid : $(this).data("id")}, 
            success: function(result){
                let obj = JSON.parse(result);
                let item_price = parseFloat(obj[0]['item_price'].replace(/\./g, '').replace(',', '.'));

                if($input.val() >= 1 && $input.val() <= 9){
                    $input.val(function(i, oldval){
                        return ++oldval;
                    });

                    let total_price = item_price * $input.val();
                    $price.text(formatCurrency(total_price));

                    updateSubtotal();
                }
            }
        });
    });

    $qty_down.click(function(e){
        e.preventDefault();
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        let $price = $(`.product_price[data-id='${$(this).data("id")}']`);

        $.ajax({
            url: "template/ajax.php", 
            type : 'post', 
            data : { itemid : $(this).data("id")}, 
            success: function(result){
                let obj = JSON.parse(result);
                let item_price = parseFloat(obj[0]['item_price'].replace(/\./g, '').replace(',', '.'));

                if($input.val() > 1 && $input.val() <= 10){
                    $input.val(function(i, oldval){
                        return --oldval;
                    });

                    let total_price = item_price * $input.val();
                    $price.text(formatCurrency(total_price));

                    updateSubtotal();
                }
            }
        });
    });

    function updateSubtotal() {
        let subtotal = 0;
        $(".product_price").each(function() {
            subtotal += parseFloat($(this).text().replace(/\./g, '').replace(',', '.'));
        });
        $deal_price.text(formatCurrency(subtotal));
    }

    function formatCurrency(amount) {
        return amount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
});