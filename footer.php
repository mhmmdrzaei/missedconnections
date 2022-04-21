<footer>
    <section class="footerContainer">
        <section class="savacLogo" aria-lable="SAVAC Organizational logo">
            <img src="<?php bloginfo('template_directory'); ?>/images/Savac_logo.png" alt="SAVAC Organizational logo">
        </section>
        <section class="savacAddress" aria-label="SAVAC Organizational contact information">
            <h4>SAVAC</h4>
           <?php the_field('savac_address','option'); ?> 
           <a href="tel:<?php the_field('savac_telephone','option'); ?> "><?php the_field('savac_telephone','option'); ?></a>
        </section>
        <section class="colophon" aria-label="Site Design Credits and Copyright">
            <h4>Colophon</h4>
            <?php the_field('colophone', 'option'); ?>
             <p>&copy; <?php echo date('Y'); ?> SAVAC <br>All Rights Reserved</p>

        </section>
        <section class="landAck" aria-label="Organization Provided Land Acknowledgement">
            <h4>Land Acknowledgement</h4>
            <section class="text-area" data-controller="#readMore1">
                <?php the_field('land_acknowledgemtn', 'option'); ?>
            </section>
            
            <button id="readMore1" class="btn btn-info">+ Read more</button>
        </section>

    </section>  

</footer>

<script>
// scripts.js, plugins.js and jquery are enqueued in functions.php
/* Google Analytics! */
 var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]]; // Change UA-XXXXX-X to be your site's ID
 (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
 g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
 s.parentNode.insertBefore(g,s)}(document,"script"));
</script>

<?php wp_footer(); ?>
</body>
</html>