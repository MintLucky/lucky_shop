<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2016</p>
                <p class="pull-right">LUCKY SHOP</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->



<script src="/template/js/jquery.js"></script>
<script src="/template/js/jquery.cycle2.min.js"></script>
<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/vendor/owl_carousel/owl.carousel.min.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>

<!-- Ajax запрос для добавления товара в корзину -->
<script>
    $(document).ready(function(){
        // Функция которая
        function PopUpHide(){
            $(".pop-up").hide();
        }
        <!-- Ajax запрос на страницах каталога и категорий -->
        $(".add-to-cart").click(function(){
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function(data){
                $("#cart-count").html(data);
                // Всплывающее окно "Товар успешно добавлен в корзину"
                $('header').append("<div class='pop-up'><p>Товар успешно добавлен в корзину</p></div>");
                setTimeout(PopUpHide, 1200);
            });
            return false;
        });
        <!-- Ajax запрос на странице конкретного товара, учитывает установленное в input количество товаров -->
        $(".cart").click(function(){
            var id = $(this).attr("data-id");
            var params = {
                count: $("#count-product-input").val(),
            };
            $.post("/cart/addAjax/"+id, params, function(data){
                $("#cart-count").html(data);
                // Всплывающее окно "Товар успешно добавлен в корзину"
                $('header').append("<div class='pop-up'><p>Товар успешно добавлен в корзину</p></div>");
                setTimeout(PopUpHide, 1200);
            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#owl-carousel-bottom").owlCarousel({
            lazyLoad:true,
            loop:true,
            navigation : true,
            pagination : false,
            navigationText : ["prev","next"],
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items : 3,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [979,2]
        });
        
        $('#owl-carousel-top').owlCarousel({
            items:1,
//            itemsDesktop : [1199,1],
//            itemsDesktopSmall : [979,1],
            singleItem : true,
            margin:10,
            loop:true,
            autoPlay: 7000,
            navigation : true,
            pagination : false,
            autoHeight:true
        });
    });

</script>

</body>
</html>