            <div class="footer">
                <p>&copy; 2014 - <?php print date('Y'); ?> Company Name Ltd.</p>
                <p>Inventory Manager v1.0.0</p>
            </div>
        </div><!-- end body -->
        <script type="text/javascript" src="<?php print DOMAIN; ?>/js/buttons.js"></script>
        <!--<script type="text/javascript" src="<?php print DOMAIN; ?>/js/modal.js"></script>-->
        <script type="text/javascript">
        var modal = document.getElementsByClassName('modal')[0];
        var navbar = document.getElementsByClassName('navbar')[0];
        
        $('#dark-mode').click(function() {
            if ($(this).is(':checked')) {
                darkMode();    
            }
            else {
                normalMode();    
            }
        });
        
        function darkMode() {
            $('body').addClass('dark');
        }
        
        function normalMode() {
            $('body').removeClass('dark');
        }

        $('#open-nav').click(function() {
            if (navbar.style.width == '0%') {
                $('.navbar:eq(0)').css('width', '12%');
                $('.body:eq(0)').css('marginLeft', '12%');
                $('.topbar:eq(0)').css('marginLeft', '12%');
            } else {
                $('.navbar:eq(0)').css('width', '0%');
                $('.body:eq(0)').css('marginLeft', '0%');
                $('.topbar:eq(0)').css('marginLeft', '0%');
            }
        });
        
        // Resize the navigation menu based on window size
        $(window).resize(function() {
            if ($('.navbar:eq(0)').is(':visible')) {
                $('.topbar:eq(0)').css('marginLeft', $('.navbar:eq(0)').width());
                $('.body:eq(0)').css('marginLeft', $('.navbar:eq(0)').width());
            }
            else if ($('.navbar:eq(0)').width() < 1300) {
                $('.topbar:eq(0)').css('marginLeft', 0);
                $('.body:eq(0)').css('marginLeft', 0);
            }
        });
        
        $('.profile-info:eq(0)').click(function() {
            $('.modal:eq(0)').css('display', 'block');
        });
        
        $('.close').click(function() {
            $('.modal:eq(0)').css('display', 'none');
        });
        
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
    </body>
</html>
<?php closeMySQL(); ?>
