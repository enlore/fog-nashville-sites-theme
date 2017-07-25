<aside id="action-buttons">
	<?php echo random_item_link("View A Random ".mh_item_label('singular'),'big-button');?>
	<?php mh_appstore_downloads(); ?>
</aside> 

<div class="clearfix"></div>
</div><!--end wrap-->
<footer class="main">
	<div>
		<?php echo link_to_home_page(mh_the_logo(), array('class'=>'home-link')); ?>
	</div>
	<div>
		<nav id="footer-nav">
			<ul>
				<li><a href="#">Dicsover</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
		</nav>
	</div>
	<div>
		<p>The Metropolitan Historical Commission is a municipal
			historic preservation agency working to document history,
			save and reuse buildings, and make the public more aware of the 
			necessity and advantages of preservation in Nashville and 
			Davidson County, Tennessee. Created in 1966, the commision
			consists of fifteen citizens appointed by the mayor.
		</p>
	</div>
	<div id="address">
		<address>
			Sunnyside in Sevier Park<br/>
			3000 Granny White Pike<br/>
			Nashville, Tennesee 37204
		</address>
		<p>
			Phone: 615-862-7970<br/>
			Fax: 615-862-7974<br/>
		</p>
		<span>
			Copyright 2017. all rights reserved.
		</span>
		<span>
			Site built and designed by fog.haus
		</span>
	</div>

	<!--<nav id="footer-nav">    
	    <?php echo mh_global_nav(); ?>      	
    	 <div id="search-wrap">
	    	<?php echo mh_simple_search($formProperties=array('id'=>'footer-search')); ?>
	    </div>   
    </nav>	
	<p class="default">
		  <span id="app-store-links"><?php mh_appstore_footer(); ?></span>  
		<?php echo mh_footer_find_us();?>
		<span id="copyright"><?php echo mh_license();?></span> 
		<span id="powered-by"><?php echo __('Powered by <a href="http://omeka.org/">Omeka</a> + <a href="http://curatescape.org">Curatescape</a>');?></span>
	</p>
	<div class="custom">
		<?php echo get_theme_option('custom_footer_html');?>
	</div> -->

	<?php 		
		echo mh_footer_scripts_init(); 
	?>
	
	
	<!-- Plugin Stuff -->
	<?php echo fire_plugin_hook('public_footer', array('view'=>$this)); ?>	
		
<!-- <div class="clearfix"></div> -->
</footer>
</body>

</html>