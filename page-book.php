<?php
/**
 * Template Name: Booking Page
 * Template for the booking consultation page
 */
get_header();
?>

<style>
/* Hide theme page title and breadcrumbs */
.page-heading, .page-header, .breadcrumbs, .entry-title,
.osetin-page-heading, .page-title-cont, #page-title,
.ljestate-page-title { display: none !important; }

.booking-page-wrap {
    background: linear-gradient(135deg, #0d1b3e 0%, #1a2f5a 100%);
    min-height: 100vh;
    padding: 60px 20px 80px;
}
.booking-page-inner {
    max-width: 720px;
    margin: 0 auto;
}
.booking-page-top {
    text-align: center;
    margin-bottom: 40px;
}
.booking-page-top h1 {
    color: #C5A267;
    font-size: 36px;
    font-weight: 700;
    margin: 0 0 10px;
    font-family: 'League Spartan', sans-serif;
}
.booking-page-top p {
    color: rgba(255,255,255,.7);
    font-size: 16px;
    margin: 0;
}
.booking-page-badges {
    display: flex;
    justify-content: center;
    gap: 24px;
    margin-top: 20px;
    flex-wrap: wrap;
}
.booking-page-badge {
    color: rgba(255,255,255,.6);
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
}
</style>

<div class="booking-page-wrap">
    <div class="booking-page-inner">
        <div class="booking-page-top">
            <h1>Book a Consultation</h1>
            <p>Schedule a time with our experienced legal team</p>
            <div class="booking-page-badges">
                <span class="booking-page-badge">✓ First 15 mins free</span>
                <span class="booking-page-badge">✓ No obligation</span>
                <span class="booking-page-badge">✓ Licensed solicitors</span>
            </div>
        </div>
        <?php echo do_shortcode('[osl_booking heading=""]'); ?>
    </div>
</div>

<?php get_footer(); ?>
