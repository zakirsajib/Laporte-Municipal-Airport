<?php global $data; ?>

<style>


body{
	background: <?php echo $data['body_background']?>;
	color: <?php echo $data['body_font_color']?>;
}

<?php $header_sticky = $data['header_sticky']; 

if($header_sticky == 0):?>
	.header-wrapper{
		position: absolute;
	}
<?php else:?>
	.header-wrapper{
		position: fixed;
	}
<?php endif;?>


.header-wrapper{
	background: <?php echo $data['header_background']?>;
}

a{
	color: <?php echo $data['link_color']?>;
}
a:hover{
	color: <?php echo $data['link_hover_color']?>;
}

p{
	font-size: <?php echo $data['body_font_size']?>;
	line-height: <?php echo $data['body_font_line']?>;
}


h1{
	color: <?php echo $data['h1_color']?>;
	font-size: <?php echo $data['h1_title_size']?>;
	line-height: <?php echo $data['h1_line_height']?>;
}
h2{
	color: <?php echo $data['h2_color']?>;
	font-size: <?php echo $data['h2_title_size']?>;
	line-height: <?php echo $data['h2_line_height']?>;
}
h3{
	color: <?php echo $data['h3_color']?>;
	font-size: <?php echo $data['h3_title_size']?>;
	line-height: <?php echo $data['h3_line_height']?>;
}
h4{
	color: <?php echo $data['h4_color']?>;
	font-size: <?php echo $data['h4_title_size']?>;
	line-height: <?php echo $data['h4_line_height']?>;
}
h5{
	color: <?php echo $data['h5_color']?>;
	font-size: <?php echo $data['h5_title_size']?>;
	line-height: <?php echo $data['h5_line_height']?>;
}

h6{
	color: <?php echo $data['h6_color']?>;
	font-size: <?php echo $data['h6_title_size']?>;
	line-height: <?php echo $data['h6_line_height']?>;
}

.navbar .nav > li{
	line-height: <?php echo $data['menu_font_line']?>;
}

.navbar .nav > li > a{
	font-size: <?php echo $data['menu_font_size']?>;
	color: <?php echo $data['menu_font_color']?>;
}

.navbar-inverse .nav > li > a:hover{
	color: <?php echo $data['menu_font_hover_color']?>;
}

.navbar .nav > li.current_page_item a{
	color: <?php echo $data['menu_active_color']?>;
}


.top-menu ul li ul{
	min-width: <?php echo $data['dropdown_menu_width']?>;
}

.menu-footer-menu-container ul li a, 
.widget-title{
	color: <?php echo $data['footer_title_color']?>;
	font-size: <?php echo $data['footer_title_size']?>;
}


.container{
	max-width: <?php echo $data['main_layout']?>;
}

.footer-home,
.footer{
	background: url(<?php echo $data['footerw_bg_image']?>);
	background-repeat: <?php echo $data['footerw_bg_repeat']?>;
}

.caption {
	background: <?php echo $data['caption_background']?>;
  	opacity: <?php echo $data['caption_background_trans']?>;
}


/*Custom CSS*/
<?php echo $data['custom_css']?>

</style>