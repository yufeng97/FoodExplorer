<footer class="ui inverted segment" id="footer" style="">
    <div class="ui inverted divided centered grid">
        <div class="three wide column">
            <h4 class="ui inverted header">FOOD EXPLORER</h4>
            <div class="ui inverted link list">
                <a class="item" href="<?php echo base_url(); ?>Home">Home</a>
                <a class="item" href="<?php echo base_url(); ?>Menu">Menu</a>
                <a class="item" href="<?php echo base_url(); ?>Shop">Shop</a>
                <div class="item">About</div>
            </div>
        </div>
        <div class="three wide column">
            <h4 class="ui inverted header">HELP & CONTACT</h4>
            <div class="ui inverted link list">
                <div class="item">Contact Us</div>
                <div class="item">News</div>
                <div class="item">Help</div>
            </div>
        </div>
        <div class="three wide column">
            <h4 class="ui inverted header">FIND US ON</h4>
            <div class="ui inverted link list">
                <div class="item">Facebook</div>
                <div class="item">Twitter</div>
                <div class="item">Instagram</div>
            </div>
        </div>
        <div class="three wide column">
            <h4 class="ui inverted header"><i class="copyright icon"></i>2019 INFS3200</h4>
            <div class="ui inverted link list">
                <div class="item">Privacy Terms</div>
                <div class="item">Terms</div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    window.onbeforeunload = function() {
        var scrollPos;
        if (typeof window.pageYOffset != 'undefined') {
            scrollPos = window.pageYOffset;
        } else if (typeof document.compatMode != 'undefined' &&
            document.compatMode != 'BackCompat') {
            scrollPos = document.documentElement.scrollTop;
        } else if (typeof document.body != 'undefined') {
            scrollPos = document.body.scrollTop;
        }
        // stores the scroll position into cookie
        document.cookie = "scrollTop=" + scrollPos;
    }

    window.onload = function() {
        if (document.cookie.match(/scrollTop=([^;]+)(;|$)/) != null) {
            // cookies is not empty, reads scroll position
            var arr = document.cookie.match(/scrollTop=([^;]+)(;|$)/);
            document.documentElement.scrollTop = parseInt(arr[1]);
            document.body.scrollTop = parseInt(arr[1]);
        }
    }
</script>

</body>

</html>