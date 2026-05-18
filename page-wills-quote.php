<?php
/**
 * Template Name: Wills Quote Calculator
 *
 * Clean full-width page for the wills & estate planning quote calculator
 */

get_header();
?>

<style>
.wq-page { background: #f5f3ee; padding: 60px 0 80px; min-height: 60vh; }
.wq-page .os-container { max-width: 900px; margin: 0 auto; padding: 0 20px; }
</style>

<div class="wq-page">
    <div class="os-container">
        <?php echo do_shortcode('[osl_wills_quote]'); ?>
    </div>
</div>

<?php get_footer(); ?>
