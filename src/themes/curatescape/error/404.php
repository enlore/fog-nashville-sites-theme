<?php 
echo head(array('maptype'=>'focusarea','title'=>'404','bodyid'=>'error','bodyclass'=>'error_404')); ?>
<?php //mh_map_actions();?>


<?php
$msg = 'It looks like we’ve made a mistake! Please press your browser’s back'
    . ' button to return to the previous page, or go <a class="f-anchor" href="/">Home</a>.';
?>

<section class="hero">
    <div class="hero-body">
        <div class="container u-max800">
            <h1>404</h1>
            <h2> Page Not Found </h2>
            <p><?php echo __($msg);?></p>
        </div>
    </div>
<section>

<section class="section">
    <div class="container u-max800">
        <h2>Or try a different path.</h2>
        <?php echo mh_display_homepage_tours(2); ?>
    </div>
</section>

<?php echo foot(); ?>
