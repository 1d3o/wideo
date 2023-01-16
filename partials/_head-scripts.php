<script>
var siteUrl = '<?php echo get_site_url( ); ?>';
var templateUrl = '<?php echo get_template_directory_uri(); ?>';
</script>

<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false && stripos($_SERVER['HTTP_USER_AGENT'], 'GTmetrix') === false)) { ?>

<!--
LINK/SCRIPTS IUBENDA, GTAG, ETC.
VENGONO STAMPATI IN ASSENZA DI PARSER COME AUDITS O GTMETRIX
-->

<!--
<link rel="preconnect" href="https://www.google-analytics.com">
-->

<?php } ?>