<main class="main container">
    <!-- Swiper -->
    <section class="ui container" style="margin-top: 3em; margin-bottom: 3em;">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="swiper-container" style="height: 500px">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img class="ui huge centered rounded image" src="/img/1453776834832.jpeg" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img class="ui huge centered rounded image" src="/img/burger.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img class="ui huge centered rounded image" src="/img/Asian-Wraps_EXPS_EDSC17_196592_C03_10_4b-696x696.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img class="ui huge centered rounded image" src="/img/kaizen-japanese-food-sugestao-do-chef-9ad45.jpg" alt="">
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>

    </section>

    <!-- Search Box -->
    <section class="ui container" style="margin-top: 3em; margin-bottom: 3em;">
        <h3 class="ui center aligned header">Start Here by entering food or restaurant</h3>
        <br>
        <div class="ui centered grid">
            <div class="row">
                <div class="ui search">
                    <div class="ui icon input">
                        <input class="prompt" type="text" id="search" placeholder="Search food or restaurant..." size="64">
                        <i class="search icon"></i>
                        </button>
                    </div>
                    <div class="result"></div>
                </div>
            </div>
        </div>
        <div>
            <div class="ui centered grid">
                <div class="nine wide column">
                    <div class="ui big link relaxed selection celled list">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Display Cards -->
    <section class="ui centered grid" style="margin-top: 3em; margin-bottom: 3em; padding-bottom:2.5rem;">
        <div>
            <div class="ui medium rounded image">
                <svg width="300" height="200">
                    <image xlink:href="/img/dessert.jpg" x="0" y="0" width="100%" height="100%"></image>
                </svg>
            </div>
            <h3 class="header">Dessert</h3>
        </div>

        <div>
            <div class="ui medium rounded image">
                <svg width="300" height="200">
                    <image xlink:href="/img/drink.png" x="0" y="0" width="100%" height="100%"></image>
                </svg>
            </div>
            <h3 class="header">Drink</h3>

        </div>
        <div>
            <div class="ui medium rounded image">
                <svg width="300" height="200">
                    <image xlink:href="/img/fruits.jpg" x="0" y="0" width="100%" height="100%"></image>
                </svg>
            </div>
            <h3 class="header">Fruit</h3>
        </div>
    </section>
</main>
<script>
    $(document).ready(function() {
        var swiper = new Swiper('.swiper-container', {
            autoplay: {
                delay: 5500,
            },
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        $('#search').keyup(function() {
            var name = $(this).val();
            if (name.length > 1) {
                $.ajax({
                    url: '<?php echo base_url(); ?>Home/autocompleteData/?name=' + name,
                    method: 'GET',
                    data: {
                        name: name
                    },
                    success: function(data) {
                        $('.ui.link.relaxed.selection.celled.list').fadeIn();
                        $('.ui.link.relaxed.selection.celled.list').html(data);
                    },
                    dataType: 'text'
                });
            }
        });
        $('#search').focusout(function() {
            $('.ui.link.relaxed.selection.celled.list').fadeOut();
        })

        $(document).on('click', '.ui.link.relaxed.selection.celled.list a', function() {
            $('#search').val($(this).find('.content:last').text());
            $('.ui.link.relaxed.selection.celled.list').fadeOut();
        })
    });
</script>