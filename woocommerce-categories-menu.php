<?php
/*
Plugin Name: WooCommerce Categories Menu
Plugin URI: http://www.wpworking.com/
Description:Displays a three level product category menu(list or select input field) from WooCommerce Product categories. Use as multiples widget or shortcode.
Version: 1.2.0
Author: Alvaro Neto
Author URI: http://wpworking.com/
License: GPL2
*/
/*  Copyright 2014  Alvaro Neto  (email : wpworking@wpworking.com
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//
//
//add_action('plugins_loaded', 'goprocess_javascript');
//function goprocess_javascript() {
//}
function load_scripts_wcctm() {  
?> 
 
<?php  
} 
add_action( is_admin() ? 'admin_head' : 'wp_head', 'load_scripts_wcctm' );
//
add_shortcode('wcctm','wcctm_short');
//
function wcctm_short($atts, $content = null){
   extract(shortcode_atts(array(
        'tpset' => "m",
		'selprdtxt' => "Product Categories",
		'posmncpos' => "relative",
		'ortmncpos' => "horizontal",
		'dspseclev' => true,
		'dspthrlev' => true,
		'ulv1fts' => 16,
		'ulv1wid' => 120,
		'ulv2fts' => 14,
		'ulv2wid' => 120,
		'ulv3fts' => 12,
		'ulv3wid' => 120,
		'mngerst' => "",
		'sbgerst' => "border:1px #ff9933 solid;background:#f9f9f9"
    ), $atts));
	ob_start();		
	$wcctm=wooCategoriesList($tpset,$selprdtxt,$posmncpos,$ortmncpos,$dspseclev,$dspthrlev,$ulv1fts,$ulv1wid,$ulv2fts,$ulv2wid,$ulv3fts,$ulv3wid,$mngerst,$sbgerst);
	echo $wcctm;
	$wcctm_string = ob_get_contents();
	ob_end_clean();
	return $wcctm_string;
}
//
function csstrat($pcss){
	 if($pcss ==''){       
        $pcss = $def;
        //echo "teste:".$par;
    }
	else{
		if(strpos($pcss,"#")===false):
			$pcss = "#".$pcss;
		endif;
	}
	return $pcss;
}

//
/**
 * Add FAQ and support information
 */
add_filter('plugin_row_meta', 'wp_wcctm_plugin_links', 10, 2);
function wp_wcctm_plugin_links ($links, $file)
{
    if ($file == plugin_basename(__FILE__)) {
       $links[] = '<a href="http://www.wpworking.com/shop/" style="color:#ff6600;font-weight:bold;display:block;padding:2px;background-color:#FAEDA4;" target="_blank"><span style="color:blue">Get toggle menu, colors, categories thumbnails and excluding</span> <span style="color:green">and formating</span>, <u>Get <i style="color:#861686">WCCTM</i> PRO!</u></a>';
    }
    return $links;
}
//
function gtpartratw($par,$def)
{
  // echo "par:".$par;
	if($par =='false'){       
        $par = false;
        //echo "teste:".$par;
    }
	if($par =='true'){       
        $par = true;
        //echo "teste:".$par;
    }
    if($par =='' || $par < 0){       
        $par = $def;
        //echo "teste:".$par;
    }
    //echo "teste2:".$par;
    return $par;
}

// display a list of posts with custom size thumbnails, using the post first image
function wooCategoriesList($tpset="m",$selprdtxt="Product Categories",$posmncpos="relative",$ortmncpos="horizontal",$dspseclev=true,$dspthrlev=true,$ulv1fts=16,$ulv1wid=120,$ulv2fts=14,$ulv2wid=120,$ulv3fts=12,$ulv3wid=120,$mngerst="",$sbgerst="border:1px #ff9933 solid;background:#f9f9f9"){	
  //wooCategoriesList($instance['tpset'],$instance['selprdtxt'],$instance['posmncpos'],$instance['ortmncpos'],$instance['dspseclev'],$instance['dspthrlev'],$instance['ulv1fts'],$instance['ulv1wid'],$instance['ulv2fts'],$instance['ulv2wid'],$instance['ulv3fts'],$instance['ulv3wid'],$instance['mngerst'],$instance['sbgerst']);
    //echo "testando";
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
	$tpset = gtpartratw($tpset,'m');	
	$selprdtxt = gtpartratw($selprdtxt,'Product Categories');
	$posmncpos = gtpartratw($posmncpos,'relative');
	$ortmncpos = gtpartratw($ortmncpos,'horizontal');

    //$dspseclev = gtpartratw($dspseclev,true);
	//$dspthrlev = gtpartratw($dspthrlev,true);

	$ulv1fts = gtpartratw($ulv1fts,16);
	$ulv1wid = gtpartratw($ulv1wid,120);
	$ulv2fts = gtpartratw($ulv2fts,14);
	$ulv2wid = gtpartratw($ulv2wid,120);
	$ulv3fts = gtpartratw($ulv3fts,12);
	$ulv3wid = gtpartratw($ulv3wid,120);
	
	$sbgerst = gtpartratw($sbgerst,"border:1px #ff9933 solid;background:#f9f9f9");
	
	
	if($tpset=="m"):
		?>
	<style>
		<?php $lisid = uniqid();?>
		.menu-categs-box<?php echo $lisid;?> .fstimg{
			float:left;
		}
		.menu-categs-box<?php echo $lisid;?> .secimg{
			float:left;		
		}
		.menu-categs-box<?php echo $lisid;?>{			
			
		}
		.menu-categs-box<?php echo $lisid;?> ul{float:left;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}
		.menu-categs-box<?php echo $lisid;?> ul.mnul{margin-left:12px;}		
		.menu-categs-box<?php echo $lisid;?> .mainulmn li{		
			<?php if($ortmncpos=="vertical"):?>
			clear:both;			
			<?php endif;?>
		}
		.menu-categs-box<?php echo $lisid;?> .lilv2{
			<?php if($ortmncpos=="horizontal"):?>
			clear:both;			
			<?php endif;?>
			<?php echo $sbgerst;?>
		}		
		.menu-categs-box<?php echo $lisid;?> .wsubsubcategs .lilv3{
			<?php echo $sbgerst;?>
		}		
	.menu-categs-box<?php echo $lisid;?> .mainulmn li a{				
			font-size:<?php echo $ulv1fts;?>px !important;		
			width:<?php echo $ulv1wid?>px;
		}
		.menu-categs-box<?php echo $lisid;?> .lilv1{
			<?php echo $sbgerst;?>
		}
		.menu-categs-box<?php echo $lisid;?> .lilv1 a{
			font-size:<?php echo $ulv1fts;?>px !important;	
			width:<?php echo $ulv1wid?>px;			
		}
		.menu-categs-box<?php echo $lisid;?> .lilv1 a:hover{			
		}
		.menu-categs-box<?php echo $lisid;?> li{
			float:left;
			list-style:none;
		}			
		.menu-categs-box<?php echo $lisid;?> li a{float:left;}
		.menu-categs-box<?php echo $lisid;?> li.libreak{float:left;clear:left;}
		.menu-categs-box<?php echo $lisid;?> li.libreak a{float: left;}
		.menu-categs-box<?php echo $lisid;?> li.imgctn{display: table-cell;text-align: center;}	
		.menu-categs-box<?php echo $lisid;?> li a{
			padding:2px 4px;
		}
		.menu-categs-box<?php echo $lisid;?> li .wsubcategs{
			display:none;			
			position: absolute;
			<?php if($ortmncpos=="vertical"):?>
			margin-left:<?php echo round($ulv1wid+2);?>px;
			<?php endif;?>		
			<?php if($ortmncpos=="horizontal"):?>
			margin-top:<?php echo round($ulv1fts+$ulv1fts/2+$ulv1fts/4+1);?>px;
			<?php endif;?>
		}	
		.menu-categs-box<?php echo $lisid;?> .wsubcategs li{				
			height: 23px;	
		}		
		.menu-categs-box<?php echo $lisid;?> .wsubcategs li a{
			font-size:<?php echo $ulv2fts;?>px !important;	
			width:<?php echo $ulv2wid?>px;			
		}
		.menu-categs-box<?php echo $lisid;?> .wsubcategs li:hover{			
		}
		<?php if($dspseclev):?>
		.menu-categs-box<?php echo $lisid;?> .lilv1:hover .wsubcategs{display:block;}
		<?php endif;?>
		.menu-categs-box<?php echo $lisid;?> .wsubcategs li a{height: 23px;}
		.menu-categs-box<?php echo $lisid;?> li .wsubsubcategs{
			display:none;			
			position: absolute;			
			margin-left:<?php echo round($ulv2wid+9);?>px;				
		}
		.menu-categs-box<?php echo $lisid;?> .wsubsubcategs li:hover{			
		}			
		.menu-categs-box<?php echo $lisid;?> .wsubsubcategs li{	
			height: 23px;
			clear:both;		
		}		
		.menu-categs-box<?php echo $lisid;?> .wsubsubcategs li a{				
			font-size:<?php echo $ulv3fts;?>px !important;
			background-color:<?php echo $ulv3bcg;?> !important;				
			width:<?php echo $ulv3wid?>px;				
		}
		.menu-categs-box<?php echo $lisid;?> .wsubsubcategs li a:hover{			
		}	
		<?php if($dspthrlev):?>
		.menu-categs-box<?php echo $lisid;?> .wsubcategs .lilv2:hover .wsubsubcategs{display:block;}
		<?php endif;?>
	</style>
	<?php
	$wcatTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC',  'parent' =>0)); //, 'exclude' => '17,77'		
	?>
	<div class="menu-categs-box<?php echo $lisid;?>" style="<?php if($ortmncpos=="vertical"):?>height:<?php echo ($ulv1fts+$ulv1fts/2+$ulv1fts/4)*count($wcatTerms);?>px<?php endif?>;min-height:<?php echo $ulv1fts+$ulv1fts/2+$ulv1fts/4;?>px;position:<?php echo $posmncpos;?>;<?php echo $mngerst;?>">	
			<ul class="mainulmn">	
			<?php 
			foreach($wcatTerms as $wcatTerm): 					
			?>							
				<li class="lilv1">
					<a href="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ); ?>"><?php echo $wcatTerm->name; ?></a>
					<?php if($dspseclev):?>
					<ul class="wsubcategs">
					<?php
					$wsubargs = array(
					   'hierarchical' => 1,
					   'show_option_none' => '',
					   'hide_empty' => 0,
					   'parent' => $wcatTerm->term_id,
					   'taxonomy' => 'product_cat'
					);
					$wsubcats = get_categories($wsubargs);
					foreach ($wsubcats as $wsc):						
					?>
						<li class="lilv2">
							<a href="<?php echo get_term_link( $wsc->slug, $wsc->taxonomy );?>"><?php echo $wsc->name;?></a>
							<?php if($dspthrlev):?>
							<ul class="wsubsubcategs">
								<?php
								$wsubsubargs = array(
								   'hierarchical' => 1,
								   'show_option_none' => '',
								   'hide_empty' => 0,
								   'parent' => $wsc->term_id,
								   'taxonomy' => 'product_cat'
								);
								$wsubsubcats = get_categories($wsubsubargs);
								foreach ($wsubsubcats as $wscsub):
									if(is_array($excat) && sizeof($excat)){
										if(in_array($wscsub->term_id,$excat)){
											continue;
										}
									}
								?>
								<li class="lilv3">
									<a href="<?php echo get_term_link( $wscsub->slug, $wscsub->taxonomy );?>"><?php echo $wscsub->name;?></a>
								</li>
								<?php
								endforeach;
								?>  
							</ul>
							<?php endif;?>
						</li>
					<?php
					endforeach;
					?>  
					</ul>
					<?php endif;?>
				</li>	
		<?php 
			endforeach; 
		?>
		</ul>
	</div>
	<?php
	endif;	
	if($tpset=="s"):		
	?>
	<style>
		<?php $selid = uniqid();?>
		.menu-categs-box<?php echo $selid;?>{			
			<?php if($mngerst):echo $mngerst;endif;?>	
		}
		.menu-categs-box<?php echo $selid;?> #woocatsel{
			min-width:120px;	
			color:#666;			
		}
		.menu-categs-box<?php echo $selid;?> .oplevel1{}
		.menu-categs-box<?php echo $selid;?> .oplevel2{}
		.menu-categs-box<?php echo $selid;?> .oplevel3{}
	</style>
	<div class="menu-categs-box<?php echo $selid;?>" style="min-height:<?php echo $ulv1fts+$ulv1fts/2+$ulv1fts/4;?>px;position:<?php echo $posmncpos;?>;">	
			<select name="woocatsel" id="woocatsel" onchange="if(this.value!=''){window.location=this.value;}">
				<option value=""><?php echo $selprdtxt; ?></option>
				<?php $wcatTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC',  'parent' =>0)); //, 'exclude' => '17,77'
				foreach($wcatTerms as $wcatTerm): 						
					?>
					<option value="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ); ?>" class="oplevel1"><?php echo $wcatTerm->name; ?></option>
						<?php
						$wsubargs = array(
						   'hierarchical' => 1,
						   'show_option_none' => '',
						   'hide_empty' => 0,
						   'parent' => $wcatTerm->term_id,
						   'taxonomy' => 'product_cat'
						);
						$wsubcats = get_categories($wsubargs);
						foreach ($wsubcats as $wsc):
						?>
							<?php if($dspseclev):?>
							<option value="<?php echo get_term_link( $wsc->slug, $wsc->taxonomy ); ?>" class="oplevel2">&nbsp;&nbsp;<?php echo $wsc->name;?></option>
							<?php endif;?>		
									<?php
									$wsubsubargs = array(
									   'hierarchical' => 1,
									   'show_option_none' => '',
									   'hide_empty' => 0,
									   'parent' => $wsc->term_id,
									   'taxonomy' => 'product_cat'
									);
									$wsubsubcats = get_categories($wsubsubargs);
									foreach ($wsubsubcats as $wscsub):									
									?>
										<?php if($dspthrlev):?>
											<option value="<?php echo get_term_link( $wscsub->slug, $wscsub->taxonomy );?>" class="oplevel3">&nbsp;&nbsp;&nbsp;<?php echo $wscsub->name;?></option>									
										<?php endif;?>
									<?php
									endforeach;
									?>  								
						<?php
						endforeach;
						?>
			<?php 
				endforeach; 
			?>
		</select>
	</div>
	<?php
	endif;
}
function widget_wooCategoriesList($args) {
  extract($args);
  $options = get_option("widget_wooCategoriesList");
  if (!is_array( $options ))
	{
	$options = array(
			'tpset' => "m",
			'selprdtxt' => "Product Categories",
			'posmncpos' => "relative",
			'ortmncpos' => "horizontal",
			'dspseclev' => true,
			'dspthrlev' => true,
			'ulv1fts' => 16,
			'ulv1wid' => 120,
			'ulv2fts' => 14,
			'ulv2wid' => 120,
			'ulv3fts' => 12,
			'ulv3wid' => 120,
			'mngerst' => "",
			'sbgerst' => "border:1px #ff9933 solid;background:#f9f9f9",
			'mlibgclr' => "",
			'mlibrdclr'  => "",
			'flifntclr' => "",
			'flihvfntclr' => "",
			'flibrdclr' => "",
			'flibgclr'  => "",
			'flihvbgclr' => "",
			'flixtcss' => "",
			'slifntclr' => "",
			'slihvfntclr' => "",
			'slibrdclr' => "",
			'slibgclr'  => "",
			'slihvbgclr' => "",
			'slixtcss' => "",
			'tlifntclr' => "",
			'tlihvfntclr' => "",
			'tlibrdclr' => "",
			'tlibgclr' => "",
			'tlihvbgclr' => "",
			'tlixtcss' => "",
			'cbfntclr' => "",
			'cbbgclr' => "",
			'cbxtcss' => "width:230px;font-size:16px;border:1px #666 solid;border-radius:4px",
			'usest' => false,
			'excat' => "",
			'useimg1' => "",
			'widimg1' => "",
			'img1xtcss' => "",
			'useimg2' => "",
			'widimg2' => "",
			'img2xtcss' => "",
			'plifntclr' => "",
			'plihvfntclr' => "",
			'plibrdclr' => "",
			'plibgclr'  => "",
			'plihvbgclr' => "",
			'plixtcss' => "",
			'xtcss' => ""
		  );
  }
 //echo $before_widget;
    echo $before_title;
      echo $options['title'];
    echo $after_title;  
  echo $after_widget;
  //Our Widget Content
    wooCategoriesList($options['tpset'],$options['selprdtxt'],$options['posmncpos'],$options['ortmncpos'],$options['dspseclev'],$options['dspthrlev'],$options['ulv1fts'],$options['ulv1wid'],$options['ulv2fts'],$options['ulv2wid'],$options['ulv3fts'],$options['ulv3wid'],$options['mngerst'],$options['sbgerst']);
}
function wooCategoriesList_control()
{
  $options = get_option("widget_wooCategoriesList");
  if (!is_array( $options ))
	{
	$options = array(
			'tpset' => "m",
			'selprdtxt' => "Product Categories",
			'posmncpos' => "relative",
			'ortmncpos' => "horizontal",
			'dspseclev' => true,
			'dspthrlev' => true,
			'ulv1fts' => 16,
			'ulv1wid' => 120,
			'ulv2fts' => 14,
			'ulv2wid' => 120,
			'ulv3fts' => 12,
			'ulv3wid' => 120,
			'mngerst' => "",
			'sbgerst' => "border:1px #ff9933 solid;background:#f9f9f9"
		);
  }
  if ($_POST['wooCategoriesList-Submit'])
  {
    $options['tpset'] = $_POST['wooCategoriesList-WidgetTpset'];	
    $options['selprdtxt'] = $_POST['wooCategoriesList-WidgetSelprdtxt'];
	$options['posmncpos'] = $_POST['wooCategoriesList-WidgetPosmncpos'];
	$options['ortmncpos'] = $_POST['wooCategoriesList-WidgetOrtmncpos'];
	$options['dspseclev'] = $_POST['wooCategoriesList-WidgetDspseclev'];
	$options['dspthrlev'] = $_POST['wooCategoriesList-WidgetDspthrlev'];
	$options['ulv1fts'] = $_POST['wooCategoriesList-WidgetUlv1fts'];
	$options['ulv1wid'] = $_POST['wooCategoriesList-WidgetUlv1wid'];
	$options['ulv2fts'] = $_POST['wooCategoriesList-WidgetUlv2fts'];
	$options['ulv2wid'] = $_POST['wooCategoriesList-WidgetUlv2wid'];
	$options['ulv3fts'] = $_POST['wooCategoriesList-WidgetUlv3fts'];
	$options['ulv3wid'] = $_POST['wooCategoriesList-WidgetUlv3wid'];
	$options['mngerst'] = $_POST['wooCategoriesList-WidgetMngerst'];
	$options['sbgerst'] = $_POST['wooCategoriesList-WidgetSbgerst'];
    update_option("widget_wooCategoriesList", $options);
  }
?>
  <p>
    <?php
        //         
		if($options['tpset']=="m"){
			$tpsetm = "selected";
		}
		else{
			$tpsets = "selected";
		}
		if($options['dspseclev']==true){
			$dspseclevchk = "checked";
		}		
		if($options['dspthrlev']==true){
			$dspthrlevchk = "checked";
		}		
    ?>
    <label for="wooCategoriesList-WidgetTpset">Type: </label><br />
    <select id="wooCategoriesList-WidgetTpset" name="wooCategoriesList-WidgetTpset">
		<option value="m" <?php echo $tpsetm;?>>List Menu</option>
		<option value="s" <?php echo $tpsets;?>>Select Input Field</option>		
	</select>
   <br /><br />
	<label for="wooCategoriesList-WidgetSelprdtxt">Select Input Field First Option Text: </label><br />
    <input type="text" id="wooCategoriesList-WidgetSelprdtxt" name="wooCategoriesList-WidgetSelprdtxt" value="<?php echo $options['selprdtxt'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetPosmncpos">Menu CSS position(relative,absolute,static,fixed,inherit):</label><br />
    <input type="text" id="wooCategoriesList-WidgetPosmncpos" name="wooCategoriesList-WidgetPosmncpos" value="<?php echo $options['posmncpos'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetOrtmncpos">Menu Orientation(vertical or horizontal):</label><br />
    <input type="text" id="wooCategoriesList-WidgetOrtmncpos" name="wooCategoriesList-WidgetOrtmncpos" value="<?php echo $options['ortmncpos'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetDspseclev">Display Second Level Category(true or false):</label><br />
    <input type="checkbox" id="wooCategoriesList-WidgetDspseclev" name="wooCategoriesList-WidgetDspseclev" value="true" <?php echo $dspseclevchk;?>/>
    <br /><br />
	<label for="wooCategoriesList-WidgetDspthrlev">Display Third Level Category(true or false):</label><br />
    <input type="checkbox" id="wooCategoriesList-WidgetDspthrlev" name="wooCategoriesList-WidgetDspthrlev" value="true" <?php echo $dspthrlevchk;?>/>
    <br /><br />
	<label for="wooCategoriesList-WidgetUlv1fts">First level category font-size(any number works only for list menu):</label><br />
    <input type="text" id="wooCategoriesList-WidgetUlv1fts" name="wooCategoriesList-WidgetUlv1fts" value="<?php echo $options['ulv1fts'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetUlv1wid">First level category width(any number works only for list menu):</label><br />
    <input type="text" id="wooCategoriesList-WidgetUlv1wid" name="wooCategoriesList-WidgetUlv1wid" value="<?php echo $options['ulv1wid'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetUlv2fts">Second level category font-size(any number works only for list menu):</label><br />
    <input type="text" id="wooCategoriesList-WidgetUlv2fts" name="wooCategoriesList-WidgetUlv2fts" value="<?php echo $options['ulv2fts'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetUlv2wid">Second level category width(any number works only for list menu):</label><br />
    <input type="text" id="wooCategoriesList-WidgetUlv2wid" name="wooCategoriesList-WidgetUlv2wid" value="<?php echo $options['ulv2wid'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetUlv3fts">Third level category font-size(any number works only for list menu):</label><br />
    <input type="text" id="wooCategoriesList-WidgetUlv3fts" name="wooCategoriesList-WidgetUlv3fts" value="<?php echo $options['ulv3fts'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetUlv3wid">Third level category width(any number works only for list menu):</label><br />
    <input type="text" id="wooCategoriesList-WidgetUlv3wid" name="wooCategoriesList-WidgetUlv3wid" value="<?php echo $options['ulv3wid'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetMngerst">Menu container CSS properties(e.g. border:1px #666 solid;background:#f4f4f4):</label><br />
    <input type="text" id="wooCategoriesList-WidgetMngerst" name="wooCategoriesList-WidgetMngerst" value="<?php echo $options['mngerst'];?>" />
    <br /><br />
	<label for="wooCategoriesList-WidgetSbgerst">SubMenus lis CSS  properties(e.g. border:1px #ff9933 solid;background:#f9f9f9):</label><br />
    <input type="text" id="wooCategoriesList-WidgetSbgerst" name="wooCategoriesList-WidgetSbgerst" value="<?php echo $options['sbgerst'];?>" />
    <br /><br />
    <input type="hidden" id="wooCategoriesList-Submit" name="wooCategoriesList-Submit" value="1" />
  </p>
<?php
}
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
function wooCategoriesList_init()
{
 // register_sidebar_widget(__('Get Post List With Thumbnails'), 'widget_getPostListThumbs'); 
 // register_widget_control(   'Get Post List With Thumbnails', 'getPostListThumbs_control', 300, 240 );
 //register_widget('GPLWT_Widget');
}
//add_action("plugins_loaded", "getPostListThumbs_init");
add_action('widgets_init', 'wcctm_register_widgets');
function wcctm_register_widgets(){
	// curl need to be installed
	register_widget('WCCTM_Widget');
}
///////////////////////////////////
class WCCTM_Widget extends WP_Widget {
  
	function WCCTM_Widget() {    
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wcctm', 'description' => 'WooCommerce Categories Menu.' );
		/* Widget control settings. */
		$control_ops = array( 'width' => 700, 'height' => 500, 'id_base' => 'wcctm-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'wcctm-widget', 'WCCTM Widget', $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
    $options="";
		extract( $args );
		//$instance = get_option("widget_getPostListThumbs");
		if (!is_array( $options ))
		{
		$options = array(
			'tpset' => "m",
			'selprdtxt' => "Product Categories",
			'posmncpos' => "relative",
			'ortmncpos' => "horizontal",
			'dspseclev' => true,
			'dspthrlev' => true,
			'ulv1fts' => 16,
			'ulv1wid' => 120,
			'ulv2fts' => 14,
			'ulv2wid' => 120,
			'ulv3fts' => 12,
			'ulv3wid' => 120,
			'mngerst' => "",
			'sbgerst' => "border:1px #ff9933 solid;background:#f9f9f9"
			 );
		}
	 /*echo $before_widget;
		echo $before_title;
			  echo $options['title'];
			echo $after_title;  
		  echo $after_widget;*/
		  //Our Widget Content
			wooCategoriesList($instance['tpset'],$instance['selprdtxt'],$instance['posmncpos'],$instance['ortmncpos'],$instance['dspseclev'],$instance['dspthrlev'],$instance['ulv1fts'],$instance['ulv1wid'],$instance['ulv2fts'],$instance['ulv2wid'],$instance['ulv3fts'],$instance['ulv3wid'],$instance['mngerst'],$instance['sbgerst']);
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags (if needed) and update the widget settings. */
		$instance['ptype'] = $new_instance['ptype'];
		
		$instance['tpset'] = $new_instance['tpset'];
		$instance['selprdtxt'] = $new_instance['selprdtxt'];
		$instance['posmncpos'] = $new_instance['posmncpos'];
		$instance['ortmncpos'] = $new_instance['ortmncpos'];
		$instance['dspseclev'] = $new_instance['dspseclev'];
		$instance['dspthrlev'] = $new_instance['dspthrlev'];
		$instance['ulv1fts'] = $new_instance['ulv1fts'];
		$instance['ulv1wid'] = $new_instance['ulv1wid'];
		$instance['ulv2fts'] = $new_instance['ulv2fts'];
		$instance['ulv2wid'] = $new_instance['ulv2wid'];
		$instance['ulv3fts'] = $new_instance['ulv3fts'];
		$instance['ulv3wid'] = $new_instance['ulv3wid'];
		$instance['mngerst'] = $new_instance['mngerst'];		
    $instance['sbgerst'] = $new_instance['sbgerst'];
		
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 
		
		'tpset' => "m",
			'selprdtxt' => "Product Categories",
			'posmncpos' => "relative",
			'ortmncpos' => "horizontal",
			'dspseclev' => true,
			'dspthrlev' => true,
			'ulv1fts' => 16,
			'ulv1wid' => 120,
			'ulv2fts' => 14,
			'ulv2wid' => 120,
			'ulv3fts' => 12,
			'ulv3wid' => 120,
			'mngerst' => "",
			'sbgerst' => "border:1px #ff9933 solid;background:#f9f9f9"
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
        <p>
           <?php
             //          
                if($instance['tpset']=="m"){
					$tpsetm = "selected";
				}
				if($instance['tpset']=="s"){
					$tpsets = "selected";
				}				
				if($instance['dspseclev']==true){
					$dspseclevchk = "checked";
				}		
				if($instance['dspthrlev']==true){
					$dspthrlevchk = "checked";
				}				
        $ustchk = "";  
        $arrexcat = array();
      ?>			
			<div style='position:absolute;background-color: #ffffe0;right:50px;border-radius:9px;border:1px #e6db55 solid;padding:20px;font-size:11px;overflow-y: auto;height: 600px;width:270px;'>
				Toggle menu, plus amazing formating, coloring, positioning and configuring features available on <a href="http://www.wpworking.com/shop/" target="_blank">WCCTPRO for only US$ 3</a><br/><br/>
				<label for="<?php echo $this->get_field_id( 'usest' ); ?>">Use Custom Styles: <?php //var_dump($arrexcat);?></label>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'usest' ); ?>" name="<?php echo $this->get_field_name( 'usest' ); ?>"  <?php echo $ustchk?> disabled />
				<br /><br />
				<label for="<?php echo $this->get_field_id( 'excat' ); ?>">Exclude Categories(use ctrl key and the mouse to select multiple categories): </label>
				<br/>				
				<select multiple name="<?php echo $this->get_field_name( 'excat' ); ?>[]" id="<?php echo $this->get_field_name( 'excat' ); ?>" disabled>						
						<?php $bwcatTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC',  'parent' =>0)); //, 'exclude' => '17,77'
						foreach($bwcatTerms as $bwcatTerm): 
						?>							
							<option value="<?php echo $bwcatTerm->term_id; ?>" class="oplevel1" <?php if(in_array($bwcatTerm->term_id,$arrexcat)&&siceof($arrexcat)){echo "selected";}?>><?php echo $bwcatTerm->name; ?></option>
								<?php
								$bwsubargs = array(
								   'hierarchical' => 1,
								   'show_option_none' => '',
								   'hide_empty' => 0,
								   'parent' => $bwcatTerm->term_id,
								   'taxonomy' => 'product_cat'
								);
								$bwsubcats = get_categories($bwsubargs);								
								foreach ($bwsubcats as $bwsc):									
								?>
									<option value="<?php echo $bwsc->term_id; ?>" class="oplevel2" <?php if(in_array($bwsc->term_id,$arrexcat)){echo "selected";}?>>&nbsp;&nbsp;<?php echo $bwsc->name;?></option>
											<?php
											$bwsubsubargs = array(
											   'hierarchical' => 1,
											   'show_option_none' => '',
											   'hide_empty' => 0,
											   'parent' => $bwsc->term_id,
											   'taxonomy' => 'product_cat'
											);
											$bwsubsubcats = get_categories($bwsubsubargs);
											foreach ($bwsubsubcats as $bwscsub):												
											?>
												<option value="<?php echo $bwscsub->term_id;?>" class="oplevel3" <?php if(in_array($bwscsub->term_id,$arrexcat)){echo "selected";}?>>&nbsp;&nbsp;&nbsp;<?php echo $bwscsub->name;?></option>									
											<?php
											endforeach;
											?>  								
								<?php
								endforeach;
								?>  
					<?php 
						endforeach; 
					?>
				</select>
				<br />				
				<strong>Main Container </strong><br/>  				
				<label for="<?php echo $this->get_field_id( 'mlibgclr' ); ?>">Main Container Background Color: </label><br />
				<input type="text" id="" name="<?php echo $this->get_field_name( 'mlibgclr' ); ?>" value="<?php echo $instance['mlibgclr'];?>" class="color {required:false}"  disabled />(e.g. ff9933 or #ff9933)
				<br />				
				<label for="<?php echo $this->get_field_id( 'mlibrdclr' ); ?>">Main Container Border Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. 1px red solid)
				<br />  
				<strong>First  Level Category List Item</strong><br/>    
				<label for="<?php echo $this->get_field_id( 'flifntclr' ); ?>">First Level Category List Item Link Font Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />  
				<label for="<?php echo $this->get_field_id( 'flihvfntclr' ); ?>">First Level Category List Item Link Hover Font Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)				
				<br />				
				<label for="<?php echo $this->get_field_id( 'flibrdclr' ); ?>">First Level Category List Item Border Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. 1px red solid)				
				<br />  
				<label for="<?php echo $this->get_field_id( 'flibgclr' ); ?>">First Level Category List Item Background Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />  
				<label for="<?php echo $this->get_field_id( 'flihvbgclr' ); ?>">First Level Category List Item Hover Background Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />				
				<label for="<?php echo $this->get_field_id( 'flixtcss' ); ?>">First Level Category List Item Extra Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. padding:0px;line-height:23px)	
				<br />  
				<strong>Second Level Category List Item</strong><br/>   
				<label for="<?php echo $this->get_field_id( 'slifntclr' ); ?>">Second Level Category List Item Link Font Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />  
				<label for="<?php echo $this->get_field_id( 'slihvfntclr' ); ?>">Second Level Category List Item Link Hover Font Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)				
				<br />				
				<label for="<?php echo $this->get_field_id( 'slibrdclr' ); ?>">Second Level Category List Item Border Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. 1px red solid)				
				<br />  
				<label for="<?php echo $this->get_field_id( 'slibgclr' ); ?>">Second Level Category List Item Background Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />  
				<label for="<?php echo $this->get_field_id( 'slihvbgclr' ); ?>">Second Level Category List Item Hover Background Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />				
				<label for="<?php echo $this->get_field_id( 'slixtcss' ); ?>">Second Level Category List Item Extra Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. padding:0px;line-height:23px)		
				<br />  
				<strong>Third Level Category List Item</strong><br/>   
				<label for="<?php echo $this->get_field_id( 'tlifntclr' ); ?>">Third Level Category List Item Link Font Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />  
				<label for="<?php echo $this->get_field_id( 'tlihvfntclr' ); ?>">Third Level Category List Item Link Hover Font Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)				
				<br />				
				<label for="<?php echo $this->get_field_id( 'tlibrdclr' ); ?>">Third Level Category List Item Border Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. 1px red solid)				
				<br />  
				<label for="<?php echo $this->get_field_id( 'tlibgclr' ); ?>">Third Level Category List Item Background Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />  
				<label for="<?php echo $this->get_field_id( 'tlihvbgclr' ); ?>">Third Level Category List Item Hover Background Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />				
				<label for="<?php echo $this->get_field_id( 'tlixtcss' ); ?>">Third Level Category List Item Extra Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. padding:0px;line-height:23px)
				<br />  
				<strong>Select Form Field</strong><br/>  
				<label for="<?php echo $this->get_field_id( 'cbfntclr' ); ?>">Select Form Field Font Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)		
				<br />  
				<label for="<?php echo $this->get_field_id( 'cbbgclr' ); ?>">Select Form Field Background Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)		
				<br />				
				<label for="<?php echo $this->get_field_id( 'cbxtcss' ); ?>">Select Form Field Extra Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. padding:0px;line-height:23px)
				<br />  
				<strong>First Image Category</strong><br/>
				<label for="">Display First Image Category: <?php //var_dump($arrexcat);?></label>
				<input type="checkbox" id="" name=""  disabled />
				<br />
				<label for="<?php echo $this->get_field_id( 'widimg1' ); ?>">First level category image width(any number works only for list menu):</label><br />
				<input type="text" id="" name="" value="" disabled />
				<br />				
				<label for="<?php echo $this->get_field_id( 'img1xtcss' ); ?>">First Level Category Image Extra Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. border:1px blue solid;height:23px)
				<br />  
				<strong>Second Image Category</strong><br/>
				<label for="<?php echo $this->get_field_id( 'useimg2' ); ?>">Display Second Image Category: <?php //var_dump($arrexcat);?></label>
				<input type="text" id="" name="" value="" disabled />
				<br />
				<label for="<?php echo $this->get_field_id( 'widimg2' ); ?>">Second level category image width(any number works only for list menu):</label><br />
				<input type="text" id="" name="" value="" disabled />
				<br />				
				<label for="<?php echo $this->get_field_id( 'img2xtcss' ); ?>">Second Level Category Image Extra Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. border:1px blue solid;height:23px)
				<br />  				
				<strong>Toggle Menu</strong><br/>
				<label for="<?php echo $this->get_field_id( 'plifntclr' ); ?>">Toggle Menu Header Font Color: </label><br />
				<input type="text" id="<?php echo $this->get_field_id( 'plifntclr' ); ?>" name="<?php echo $this->get_field_name( 'plifntclr' ); ?>" value="<?php echo $instance['plifntclr'];?>" class="color {required:false}" disabled />(e.g. ff9933 or #ff9933)
				<br />  
				<label for="<?php echo $this->get_field_id( 'plihvfntclr' ); ?>">Toggle Menu Header Hover Font Color: </label><br />
				<input type="text" id="<?php echo $this->get_field_id( 'plihvfntclr' ); ?>" name="<?php echo $this->get_field_name( 'plihvfntclr' ); ?>" value="<?php echo $instance['plihvfntclr'];?>" class="color {required:false}" disabled />(e.g. ff9933 or #ff9933)				
				<br />				
				<label for="<?php echo $this->get_field_id( 'plibrdclr' ); ?>">Toggle Menu Header Border Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. 1px red solid)				
				<br />  
				<label for="<?php echo $this->get_field_id( 'plibgclr' ); ?>">Toggle Menu Header  Background Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />  
				<label for="<?php echo $this->get_field_id( 'plihvbgclr' ); ?>">Toggle Menu Header  Hover Background Color: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. ff9933 or #ff9933)
				<br />				
				<label for="<?php echo $this->get_field_id( 'plixtcss' ); ?>">Toggle Menu Header Extra Style: </label><br />
				<input type="text" id="" name="" value="" disabled />(e.g. padding:0px;line-height:23px)	
				<br />
				<strong>Global</strong><br/>				
				<label for="">Menu Extra Style: </label><br />
				<textarea id="" name="" rows="8" cols="45" disabled ></textarea>
			</div>	      
            <label for="<?php echo $this->get_field_id( 'tpset' ); ?>">Type: #Toggle Menu Available on <a href="http://www.wpworking.com/shop/" target="_blank">WCCTPRO for only US$ 3</a></label><br />
			<select id="<?php echo $this->get_field_id( 'tpset' ); ?>" name="<?php echo $this->get_field_name( 'tpset' ); ?>">
				<option value="m" <?php echo $tpsetm;?>>List Menu</option>
				<option value="s" <?php echo $tpsets;?>>Select Input Field</option>					
			</select>			
		   <br /><br />
			<label for="<?php echo $this->get_field_id( 'selprdtxt' ); ?>">Select Input Field First Option / Toggle Menu Title Text: </label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'selprdtxt' ); ?>" name="<?php echo $this->get_field_name( 'selprdtxt' ); ?>" value="<?php echo $instance['selprdtxt'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'posmncpos' ); ?>">Menu CSS position(relative,absolute,static,fixed,inherit):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'posmncpos' ); ?>" name="<?php echo $this->get_field_name( 'posmncpos' ); ?>" value="<?php echo $instance['posmncpos'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'ortmncpos' ); ?>">Menu Orientation(vertical or horizontal):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'ortmncpos' ); ?>" name="<?php echo $this->get_field_name( 'ortmncpos' ); ?>" value="<?php echo $instance['ortmncpos'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'dspseclev' ); ?>">Display Second Level Category(true or false):</label><br />
			<input type="checkbox" id="<?php echo $this->get_field_id( 'dspseclev' ); ?>" name="<?php echo $this->get_field_name( 'dspseclev' ); ?>" value="true" <?php echo $dspseclevchk;?>/>
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'dspthrlev' ); ?>">Display Third Level Category(true or false):</label><br />
			<input type="checkbox" id="<?php echo $this->get_field_id( 'dspthrlev' ); ?>" name="<?php echo $this->get_field_name( 'dspthrlev' ); ?>" value="true" <?php echo $dspthrlevchk;?>/>
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'ulv1fts' ); ?>">First level category font-size(any number works only for list menu):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'ulv1fts' ); ?>" name="<?php echo $this->get_field_name( 'ulv1fts' ); ?>" value="<?php echo $instance['ulv1fts'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'ulv1wid' ); ?>">First level category width(any number works only for list menu):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'ulv1wid' ); ?>" name="<?php echo $this->get_field_name( 'ulv1wid' ); ?>" value="<?php echo $instance['ulv1wid'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'ulv2fts' ); ?>">Second level category font-size(any number works only for list menu):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'ulv2fts' ); ?>" name="<?php echo $this->get_field_name( 'ulv2fts' ); ?>" value="<?php echo $instance['ulv2fts'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'ulv2wid' ); ?>">Second level category width(any number works only for list menu):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'ulv2wid' ); ?>" name="<?php echo $this->get_field_name( 'ulv2wid' ); ?>" value="<?php echo $instance['ulv2wid'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'ulv3fts' ); ?>">Third level category font-size(any number works only for list menu):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'ulv3fts' ); ?>" name="<?php echo $this->get_field_name( 'ulv3fts' ); ?>" value="<?php echo $instance['ulv3fts'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'ulv3wid' ); ?>">Third level category width(any number works only for list menu):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'ulv3wid' ); ?>" name="<?php echo $this->get_field_name( 'ulv3wid' ); ?>" value="<?php echo $instance['ulv3wid'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'mngerst' ); ?>">Menu container CSS properties(e.g. border:1px #666 solid;background:#f4f4f4):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'mngerst' ); ?>" name="<?php echo $this->get_field_name( 'mngerst' ); ?>" value="<?php echo $instance['mngerst'];?>" />
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'sbgerst' ); ?>">SubMenus lis CSS  properties(e.g. border:1px #ff9933 solid;background:#f9f9f9):</label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'sbgerst' ); ?>" name="<?php echo $this->get_field_name( 'sbgerst' ); ?>" value="<?php echo $instance['sbgerst'];?>" />
			<br /><br />
			<input type="hidden" id="wooCategoriesList-Submit" name="wooCategoriesList-Submit" value="1" />
		  </p>
        <?php
    }
}
?>