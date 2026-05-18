<?php
/**
 * Template Name: Cancel Booking Page
 * Template for the booking cancellation page
 */
get_header();
?>

<style>
/* Hide theme page title and breadcrumbs */
.page-heading, .page-header, .breadcrumbs, .entry-title,
.osetin-page-heading, .page-title-cont, #page-title,
.ljestate-page-title { display: none !important; }

.cancel-page-wrap {
    background: linear-gradient(135deg, #0d1b3e 0%, #1a2f5a 100%);
    min-height: 100vh;
    padding: 60px 20px 80px;
}
.cancel-page-inner {
    max-width: 640px;
    margin: 0 auto;
}
</style>

<div class="cancel-page-wrap">
    <div class="cancel-page-inner">
        <?php echo do_shortcode('[osl_cancel]'); ?>
    </div>
</div>

<?php get_footer(); ?>
