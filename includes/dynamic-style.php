<?php

function arsene_dynamic_css(){
	global $arsene_data;
	$data = $arsene_data;

	header( 'Content-Type: text/css' );
    	/* Accent Color */
		$color = $data['arsene_accent_color'];

		/* Widget Style */
		$widget_style = $data['arsene_widget_style']; /*1: LAYERED PAPER, 2: PAPER FOLD, 3: STITCHED PAPER */
		$display_paper_tape = 0;

		/* Background pattern */
		$body_background = $data['arsene_background_pattern'];
		$footer_background = $data['arsene_footer_background_pattern'];
		$header_background = $data['arsene_header_background_pattern'];

		/* Body Font and Heading Font */
		$body_font = $data['arsene_body_font'];
		$heading_font = $data['arsene_heading_font'];

		if($body_font == "Arial"){
			$body_font = "Helvetica Neue, Helvetica, Arial, sans-serif";
		}else{
			$body_font .= ",Helvetica Neue, Helvetica, Arial, sans-serif";
		}

		if($heading_font == "Arial"){
			$heading_font = "Helvetica Neue, Helvetica, Arial, sans-serif";
		}else{
			$heading_font .= ",Helvetica Neue, Helvetica, Arial, sans-serif";
		}

		$custom_css = "a:hover,
						h2#description,
						.top-mobile-menu .show-menu:hover,
						a.headline-url:hover,
						.post-title a:hover,
						.post-list .post-title:hover,						
						.post-author-info .author-name a:hover,
						.comment-post .comment-author a:hover,
						#commentform a,
						.review-detail .score,
						.archive-2 .post-archive .post-title:hover,
						.all-archives .post-archive .post-title:hover,
						.breadcrumb a:hover,
						.widget-title .first-word,
						.widget-title .search-query,
						.widget-title .second-word,
						.social-count a:hover .count-info,
						.news-box.style-2 .post-title:hover,
						.related-post .post-title:hover,
						.archive-5 .post-title:hover,
						.archive-post .post-title:hover,
						.news-box.style-3 .post-mini .post-title:hover,
						.archive-7 .post-mini .post-title:hover,
						.recent-comments-list a.comment-author:hover,
						.category-list a:hover,
						.widget_categories li a:hover,
						.widget_nav_menu li a:hover,
						.footer-copyright a:hover,
						.footer-widget .widget a:hover,
						.footer-widget .post-list .post-title:hover,
						.widget_calendar td a,
						.widget_recent_entries li a:hover,
						.widget_pages li a:hover,
						.widget_recent_comments li a:hover,
						.widget_meta li a:hover,
						.widget_archive li a:hover,
						.bt-tab.style-2 .nav-tabs .active a,
						.bt-accordion .accordion-heading .accordion-toggle.active-accordion{
						color: $color;
						}

						.post-single-body a:not(.btn){
							color: $color;
						}

						#header{
							background: url($header_background);
						}

						.post-single-body a{
							color: $color \9;
						}

						.post-single-body a:hover{
							text-decoration: underline \9;
						}
						.post-single-body .btn{
							color: #333 \9;
						}
						.post-single-body .btn-primary, .post-single-body .btn-danger, .post-single-body .btn-inverse, .post-single-body .btn-info, .post-single-body .btn-success, .post-single-body .btn-warning{
							color: #fff \9;
						}
						.post-single-body .btn:hover{
							text-decoration: none \9;
						}

						.bt-tab.style-1 .nav-tabs li.active a,
						.main-menu .current > a,
						.main-menu .current-menu-item > a,
						.main-menu .current_page_item > a,
						.main-menu .current a:first-child:hover,
						.main-menu .current-menu-item a:first-child:hover,
						.main-menu .current_page_item a:first-child:hover,
						.main-mobile-menu .show-menu,						
						.post-404 .not-found-button:hover,
						.sitemap-block h2 [class^=\"icon-\"],
						.post-single .post-tags a:hover,
						.post-single .post-edit-link:hover,
						.comment-post .comment-reply-link:hover,
						.comment-post .comment-edit-link:hover,
						#cancel-comment-reply-link:hover,
						#comment-nav a:hover,
						#commentform #submit:hover,
						.review-item .progress .bar,
						.review-container .summary h3,
						.pagination ul li a:hover,
						.pagination ul li.current a,
						.pagination ul li .current,
						.social-count a:hover .social-icon,
						.tagcloud a:hover,
						.widget_flickr .flickr_badge_image img:hover,
						.widget_calendar thead th,
						.widget_calendar tfoot td,
						.widget_calendar td#today,
						.bt-tab.style-3 .nav-tabs .active a:hover,
						.bt-tab.style-3 .nav-tabs .active a,
						.gallery img:hover{
						background: $color;
						filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$color', endColorstr='$color', GradientType=0);
						}

						.post-category,
						.post-category-container a,
						.main-menu .sf-menu a:hover{
							background: $color;
						}

						.bt-tab.style-1 .nav-tabs li.active a,
						.bt-tab.style-3 .nav-tabs .active a{
						border-color: $color;
						}

						.tooltip.bottom .tooltip-inner,
						.tooltip.top .tooltip-arrow,
						.bt-tab.style-2 .nav-tabs .active a{
						border-top-color: $color;
						}

						.tooltip.bottom .tooltip-arrow,
						.tooltip.top .tooltip-inner,
						.main-menu,
						.footer-copyright,
						.bt-tab.style-3 .nav-tabs,
						#map-container{
						border-bottom-color: $color;
						}

						.qa .question,
						.bt-accordion .accordion-heading .accordion-toggle.active-accordion{
						border-left-color: $color;
						}

						.flexslider .flex-direction-nav a:hover,
						.image-overlay span:hover{
							background-color: $color;
						}

						.ticker-content a:hover{
							color: $color !important;
						}

						.flex-control-paging li a.flex-active,
						.main-menu .sf-menu .current a:first-child:hover,
						.main-menu .current-menu-item a:first-child:hover,
						.main-menu .current_page_item a:first-child:hover{ background: $color !important; }";

		/* Widget Style */
		$style = "
		.widget {
		    background: #fff;
		    box-shadow:
		        0 10px 0 -5px #fff, 
		        0 10px 1px -4px #ddd, 
		        0 20px 0 -10px #fff,
		        0 20px 1px -9px #ddd;
		    
		    margin-bottom: 40px;
		    padding: 20px;
		    border: 1px solid #ddd;
		    position: relative;
		} 
		";
		switch($widget_style){
			case "2":
				$style = '
				.widget{
					padding: 20px;	
					background: #fff;
					border: 1px solid #fff;
					margin-bottom: 40px;
					position: relative;
					box-shadow: 0 0 10px rgba(0,0,0,.1);

					border-radius: 0;
				}
				.widget:before, .widget:after 
				{
				  z-index: -1; 
				  position: absolute; 
				  content: "";
				  bottom: 15px;
				  left: 10px;
				  width: 50%; 
				  max-width:300px;
				  height: 10px;
				  background: rgba(0, 0, 0, 0.7); 
				  -webkit-box-shadow: 0 15px 10px rgba(0,0,0, 0.7);   
				  -moz-box-shadow: 0 15px 10px rgba(0, 0, 0, 0.7);
				  box-shadow: 0 15px 10px rgba(0, 0, 0, 0.7);
				  -webkit-transform: rotate(-3deg);    
				  -moz-transform: rotate(-3deg);   
				  -o-transform: rotate(-3deg);
				  -ms-transform: rotate(-3deg);
				  transform: rotate(-3deg);
				}
				.widget:after 
				{
				  -webkit-transform: rotate(3deg);
				  -moz-transform: rotate(3deg);
				  -o-transform: rotate(3deg);
				  -ms-transform: rotate(3deg);
				  transform: rotate(3deg);
				  right: 10px;
				  left: auto;
				}
				';
			break;
			case "3":
			$style = '
				.widget {
				    padding: 10px;
				    margin-bottom: 30px;
				    background: #fff;
				    border: 1px dashed #ddd;
				    -moz-border-radius: 3px;
				    -webkit-border-radius: 3px;
				    border-radius: 3px;
				    -moz-box-shadow: 0 0 0 4px #fff, 2px 1px 4px 4px rgba(10,10,0,.2);
				    -webkit-box-shadow: 0 0 0 4px #fff, 2px 1px 4px 4px rgba(10,10,0,.2);
				    box-shadow: 0 0 0 4px #fff, 2px 1px 6px 4px rgba(10,10,0,.2);
				    position: relative;
				}
				.widget:before, .widget:after 
				{
				  z-index: -1; 
				  position: absolute; 
				  content: "";
				  bottom: 12px;
				  left: 10px;
				  width: 50%; 
				  max-width:300px;
				  height: 10px;
				  background: rgba(0, 0, 0, 0.7); 
				  -webkit-box-shadow: 0 15px 10px rgba(0,0,0, 0.7);   
				  -moz-box-shadow: 0 15px 10px rgba(0, 0, 0, 0.7);
				  box-shadow: 0 15px 10px rgba(0, 0, 0, 0.7);
				  -webkit-transform: rotate(-3deg);    
				  -moz-transform: rotate(-3deg);   
				  -o-transform: rotate(-3deg);
				  -ms-transform: rotate(-3deg);
				  transform: rotate(-3deg);
				}
				.widget:after 
				{
				  -webkit-transform: rotate(3deg);
				  -moz-transform: rotate(3deg);
				  -o-transform: rotate(3deg);
				  -ms-transform: rotate(3deg);
				  transform: rotate(3deg);
				  right: 10px;
				  left: auto;
				}
			';
			break;
		}

		/* PAPER TAPE ACCENT */
		if($display_paper_tape){
			$style .= "
			.paper-tape{
				display: block;
			}
			";
		}else{
			$style .= "
			.paper-tape{
				display: none;
			}
			";
		}


		/* Apply background pattern and typography*/
		if(!empty($body_background)){
			$style .= "
			body{
				background: url($body_background);
				color: ".$data['arsene_body_text_color'].";
				font-family: ".$body_font.";
			}
			h1,h2,h3,h4,h5,h6,
			#s,
			.pagination ul li a,
			.post-title,
			.recent-comments-list .comment-author,
			.headline-url,
			.headline-date,
			.social-count .count-info,
			.widget_calendar caption,
			.breadcrumb,
			.post-404 .not-found-button,
			.bt-tab.style-3 .nav-tabs a,
			.main-menu,
			.main-mobile-menu{
				font-family: ".$heading_font.";
			}
			#footer{
				background: #141414 url($footer_background);
			}
			";
		}

		/* Add custom css */
		$style .= $data['arsene_custom_css'];

		$custom_css .= $style;

    echo $custom_css;
	die();

}

/* Add ajax dynamic style */
add_action('wp_ajax_arsene_dynamic_css', 'arsene_dynamic_css');
add_action('wp_ajax_nopriv_arsene_dynamic_css', 'arsene_dynamic_css');


function decode_google_webfonts(){

	$json = '{"ABeeZee":"ABeeZee:400italic,400","Abel":"Abel:400","Abril Fatface":"Abril+Fatface:400","Aclonica":"Aclonica:400","Acme":"Acme:400","Actor":"Actor:400","Adamina":"Adamina:400","Advent Pro":"Advent+Pro:100,200,300,400,500,600,700","Aguafina Script":"Aguafina+Script:400","Akronim":"Akronim:400","Aladin":"Aladin:400","Aldrich":"Aldrich:400","Alegreya":"Alegreya:400,400italic,700,700italic,900,900italic","Alegreya SC":"Alegreya+SC:400,400italic,700,700italic,900,900italic","Alex Brush":"Alex+Brush:400","Alfa Slab One":"Alfa+Slab+One:400","Alice":"Alice:400","Alike":"Alike:400","Alike Angular":"Alike+Angular:400","Allan":"Allan:700,400","Allerta":"Allerta:400","Allerta Stencil":"Allerta+Stencil:400","Allura":"Allura:400","Almendra":"Almendra:700,700italic,400italic,400","Almendra Display":"Almendra+Display:400","Almendra SC":"Almendra+SC:700,700italic,400italic,400","Amarante":"Amarante:400","Amaranth":"Amaranth:400,400italic,700,700italic","Amatic SC":"Amatic+SC:400,700","Amethysta":"Amethysta:400","Amiri":"Amiri:700,700italic,400,400italic","Anaheim":"Anaheim:400","Andada":"Andada:700,700italic,400italic,400","Andada SC":"Andada+SC:700,700italic,400italic,400","Andika":"Andika:400","Angkor":"Angkor:400","Annie Use Your Telescope":"Annie+Use+Your+Telescope:400","Anonymous Pro":"Anonymous+Pro:400,400italic,700,700italic","Antic":"Antic:400","Antic Didone":"Antic+Didone:400","Antic Slab":"Antic+Slab:400","Anton":"Anton:400","Arapey":"Arapey:400,400italic","Arbutus":"Arbutus:400","Arbutus Slab":"Arbutus+Slab:400","Architects Daughter":"Architects+Daughter:400","Archivo Black":"Archivo+Black:400","Archivo Narrow":"Archivo+Narrow:700,700italic,400italic,400","Arimo":"Arimo:400,400italic,700,700italic","Arizonia":"Arizonia:400","Armata":"Armata:400","Artifika":"Artifika:400","Arvo":"Arvo:400,400italic,700,700italic","Asap":"Asap:400,400italic,700,700italic","Asset":"Asset:400","Astloch":"Astloch:400,700","Asul":"Asul:400,700","Atomic Age":"Atomic+Age:400","Aubrey":"Aubrey:400","Audiowide":"Audiowide:400","Autour One":"Autour+One:400","Average":"Average:400","Average Sans":"Average+Sans:400","Averia Gruesa Libre":"Averia+Gruesa+Libre:400","Averia Libre":"Averia+Libre:300,300italic,400,400italic,700,700italic","Averia Sans Libre":"Averia+Sans+Libre:300,300italic,400,400italic,700,700italic","Averia Serif Libre":"Averia+Serif+Libre:300,300italic,400,400italic,700,700italic","Bad Script":"Bad+Script:400","Balthazar":"Balthazar:400","Bangers":"Bangers:400","Basic":"Basic:400","Battambang":"Battambang:400,700","Baumans":"Baumans:400","Bayon":"Bayon:400","Belgrano":"Belgrano:400","Belleza":"Belleza:400","BenchNine":"BenchNine:700,300,400","Bentham":"Bentham:400","Berkshire Swash":"Berkshire+Swash:400","Bevan":"Bevan:400","Bigelow Rules":"Bigelow+Rules:400","Bigshot One":"Bigshot+One:400","Bilbo":"Bilbo:400","Bilbo Swash Caps":"Bilbo+Swash+Caps:400","Bitter":"Bitter:400,400italic,700","Black Ops One":"Black+Ops+One:400","Bokor":"Bokor:400","Bonbon":"Bonbon:400","Boogaloo":"Boogaloo:400","Bowlby One":"Bowlby+One:400","Bowlby One SC":"Bowlby+One+SC:400","Brawler":"Brawler:400","Bree Serif":"Bree+Serif:400","Bruno Ace":"Bruno+Ace:400","Bruno Ace SC":"Bruno+Ace+SC:400","Bubblegum Sans":"Bubblegum+Sans:400","Bubbler One":"Bubbler+One:400","Buda":"Buda:300","Buenard":"Buenard:400,700","Butcherman":"Butcherman:400","Butcherman Caps":"Butcherman+Caps:400","Butterfly Kids":"Butterfly+Kids:400","Cabin":"Cabin:400,400italic,500,500italic,600,600italic,700,700italic","Cabin Condensed":"Cabin+Condensed:400,500,600,700","Cabin Sketch":"Cabin+Sketch:400,700","Caesar Dressing":"Caesar+Dressing:400","Cagliostro":"Cagliostro:400","Calligraffitti":"Calligraffitti:400","Cambo":"Cambo:400","Candal":"Candal:400","Cantarell":"Cantarell:400,400italic,700,700italic","Cantata One":"Cantata+One:400","Cantora One":"Cantora+One:400","Capriola":"Capriola:400","Cardo":"Cardo:400,400italic,700","Carme":"Carme:400","Carrois Gothic":"Carrois+Gothic:400","Carrois Gothic SC":"Carrois+Gothic+SC:400","Carter One":"Carter+One:400","Caudex":"Caudex:400,400italic,700,700italic","Cedarville Cursive":"Cedarville+Cursive:400","Ceviche One":"Ceviche+One:400","Changa":"Changa:400","Changa One":"Changa+One:400,400italic","Chango":"Chango:400","Chau Philomene One":"Chau+Philomene+One:400,400italic","Chela One":"Chela+One:400","Chelsea Market":"Chelsea+Market:400","Chenla":"Chenla:400","Cherry Cream Soda":"Cherry+Cream+Soda:400","Cherry Swash":"Cherry+Swash:700,400","Chewy":"Chewy:400","Chicle":"Chicle:400","Chivo":"Chivo:400,400italic,900,900italic","Cinzel":"Cinzel:900,700,400","Cinzel Decorative":"Cinzel+Decorative:900,700,400","Clara":"Clara:400","Clicker Script":"Clicker+Script:400","Coda":"Coda:400,800","Coda Caption":"Coda+Caption:800","Codystar":"Codystar:300,400","Combo":"Combo:400","Comfortaa":"Comfortaa:300,400,700","Coming Soon":"Coming+Soon:400","Concert One":"Concert+One:400","Condiment":"Condiment:400","Content":"Content:400,700","Contrail One":"Contrail+One:400","Convergence":"Convergence:400","Cookie":"Cookie:400","Copse":"Copse:400","Corben":"Corben:400,700","Courgette":"Courgette:400","Cousine":"Cousine:400,400italic,700,700italic","Coustard":"Coustard:400,900","Covered By Your Grace":"Covered+By+Your+Grace:400","Crafty Girls":"Crafty+Girls:400","Creepster":"Creepster:400","Creepster Caps":"Creepster+Caps:400","Crete Round":"Crete+Round:400,400italic","Crimson Text":"Crimson+Text:400,400italic,600,600italic,700,700italic","Croissant One":"Croissant+One:400","Crushed":"Crushed:400","Cuprum":"Cuprum:400,400italic,700,700italic","Cutive":"Cutive:400","Cutive Mono":"Cutive+Mono:400","Damion":"Damion:400","Dancing Script":"Dancing+Script:400,700","Dangrek":"Dangrek:400","Dawning of a New Day":"Dawning+of+a+New+Day:400","Days One":"Days+One:400","Delius":"Delius:400","Delius Swash Caps":"Delius+Swash+Caps:400","Delius Unicase":"Delius+Unicase:400,700","Della Respira":"Della+Respira:400","Denk One":"Denk+One:400","Devonshire":"Devonshire:400","Dhyana":"Dhyana:400,700","Didact Gothic":"Didact+Gothic:400","Diplomata":"Diplomata:400","Diplomata SC":"Diplomata+SC:400","Domine":"Domine:700,400","Donegal One":"Donegal+One:400","Doppio One":"Doppio+One:400","Dorsa":"Dorsa:400","Dosis":"Dosis:200,300,400,500,600,700,800","Dr Sugiyama":"Dr+Sugiyama:400","Droid Arabic Kufi":"Droid+Arabic+Kufi:400,700","Droid Arabic Naskh":"Droid+Arabic+Naskh:400,700","Droid Sans":"Droid+Sans:400,700","Droid Sans Ethiopic":"Droid+Sans+Ethiopic:400,700","Droid Sans Mono":"Droid+Sans+Mono:400","Droid Sans Thai":"Droid+Sans+Thai:400,700","Droid Serif":"Droid+Serif:400,400italic,700,700italic","Droid Serif Thai":"Droid+Serif+Thai:400,700","Duru Sans":"Duru+Sans:400","Dynalight":"Dynalight:400","EB Garamond":"EB+Garamond:400","Eagle Lake":"Eagle+Lake:400","Eater":"Eater:400","Eater Caps":"Eater+Caps:400","Economica":"Economica:400,400italic,700,700italic","Electrolize":"Electrolize:400","Elsie":"Elsie:900,400","Elsie Swash Caps":"Elsie+Swash+Caps:900,400","Emblema One":"Emblema+One:400","Emilys Candy":"Emilys+Candy:400","Engagement":"Engagement:400","Englebert":"Englebert:400","Enriqueta":"Enriqueta:400,700","Erica One":"Erica+One:400","Esteban":"Esteban:400","Euphoria Script":"Euphoria+Script:400","Ewert":"Ewert:400","Exo":"Exo:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","Expletus Sans":"Expletus+Sans:400,400italic,500,500italic,600,600italic,700,700italic","Fanwood Text":"Fanwood+Text:400,400italic","Fascinate":"Fascinate:400","Fascinate Inline":"Fascinate+Inline:400","Faster One":"Faster+One:400","Fasthand":"Fasthand:400","Federant":"Federant:400","Federo":"Federo:400","Felipa":"Felipa:400","Fenix":"Fenix:400","Finger Paint":"Finger+Paint:400","Fjalla One":"Fjalla+One:400","Fjord One":"Fjord+One:400","Flamenco":"Flamenco:300,400","Flavors":"Flavors:400","Fondamento":"Fondamento:400,400italic","Fontdiner Swanky":"Fontdiner+Swanky:400","Forum":"Forum:400","Francois One":"Francois+One:400","Freckle Face":"Freckle+Face:400","Fredericka the Great":"Fredericka+the+Great:400","Fredoka One":"Fredoka+One:400","Freehand":"Freehand:400","Fresca":"Fresca:400","Frijole":"Frijole:400","Fruktur":"Fruktur:400","Fugaz One":"Fugaz+One:400","GFS Didot":"GFS+Didot:400","GFS Neohellenic":"GFS+Neohellenic:400,400italic,700,700italic","Gafata":"Gafata:400","Galdeano":"Galdeano:400","Galindo":"Galindo:400","Gentium Basic":"Gentium+Basic:400,400italic,700,700italic","Gentium Book Basic":"Gentium+Book+Basic:400,400italic,700,700italic","Geo":"Geo:400,400italic","Geostar":"Geostar:400","Geostar Fill":"Geostar+Fill:400","Germania One":"Germania+One:400","Gilda Display":"Gilda+Display:400","Give You Glory":"Give+You+Glory:400","Glass Antiqua":"Glass+Antiqua:400","Glegoo":"Glegoo:400","Gloria Hallelujah":"Gloria+Hallelujah:400","Goblin One":"Goblin+One:400","Gochi Hand":"Gochi+Hand:400","Gorditas":"Gorditas:400,700","Goudy Bookletter 1911":"Goudy+Bookletter+1911:400","Graduate":"Graduate:400","Grand Hotel":"Grand+Hotel:400","Gravitas One":"Gravitas+One:400","Great Vibes":"Great+Vibes:400","Griffy":"Griffy:400","Gruppo":"Gruppo:400","Gudea":"Gudea:400,400italic,700","Habibi":"Habibi:400","Hammersmith One":"Hammersmith+One:400","Hanalei":"Hanalei:400","Hanalei Fill":"Hanalei+Fill:400","Handlee":"Handlee:400","Hanuman":"Hanuman:400,700","Happy Monkey":"Happy+Monkey:400","Headland One":"Headland+One:400","Henny Penny":"Henny+Penny:400","HermeneusOne":"HermeneusOne:400","Herr Von Muellerhoff":"Herr+Von+Muellerhoff:400","Holtwood One SC":"Holtwood+One+SC:400","Homemade Apple":"Homemade+Apple:400","Homenaje":"Homenaje:400","IM Fell DW Pica":"IM+Fell+DW+Pica:400,400italic","IM Fell DW Pica SC":"IM+Fell+DW+Pica+SC:400","IM Fell Double Pica":"IM+Fell+Double+Pica:400,400italic","IM Fell Double Pica SC":"IM+Fell+Double+Pica+SC:400","IM Fell English":"IM+Fell+English:400,400italic","IM Fell English SC":"IM+Fell+English+SC:400","IM Fell French Canon":"IM+Fell+French+Canon:400,400italic","IM Fell French Canon SC":"IM+Fell+French+Canon+SC:400","IM Fell Great Primer":"IM+Fell+Great+Primer:400,400italic","IM Fell Great Primer SC":"IM+Fell+Great+Primer+SC:400","Iceberg":"Iceberg:400","Iceland":"Iceland:400","Imprima":"Imprima:400","Inconsolata":"Inconsolata:400,700","Inder":"Inder:400","Indie Flower":"Indie+Flower:400","Inika":"Inika:400,700","Irish Grover":"Irish+Grover:400","Irish Growler":"Irish+Growler:400","Istok Web":"Istok+Web:400,400italic,700,700italic","Italiana":"Italiana:400","Italianno":"Italianno:400","Jacques Francois":"Jacques+Francois:400","Jacques Francois Shadow":"Jacques+Francois+Shadow:400","Jim Nightshade":"Jim+Nightshade:400","Jockey One":"Jockey+One:400","Jolly Lodger":"Jolly+Lodger:400","Josefin Sans":"Josefin+Sans:100,100italic,300,300italic,400,400italic,600,600italic,700,700italic","Josefin Sans Std Light":"Josefin+Sans+Std+Light:400","Josefin Slab":"Josefin+Slab:100,100italic,300,300italic,400,400italic,600,600italic,700,700italic","Joti One":"Joti+One:400","Judson":"Judson:400,400italic,700","Julee":"Julee:400","Julius Sans One":"Julius+Sans+One:400","Junge":"Junge:400","Jura":"Jura:300,400,500,600","Just Another Hand":"Just+Another+Hand:400","Just Me Again Down Here":"Just+Me+Again+Down+Here:400","Kameron":"Kameron:400,700","Karla":"Karla:400,400italic,700,700italic","Karla Tamil Inclined":"Karla+Tamil+Inclined:700,400","Karla Tamil Upright":"Karla+Tamil+Upright:700,400","Kaushan Script":"Kaushan+Script:400","Kavoon":"Kavoon:400","Keania One":"Keania+One:400","Kelly Slab":"Kelly+Slab:400","Kenia":"Kenia:400","Khmer":"Khmer:400","Kite One":"Kite+One:400","Knewave":"Knewave:400","Kotta One":"Kotta+One:400","Koulen":"Koulen:400","Kranky":"Kranky:400","Kreon":"Kreon:300,400,700","Kristi":"Kristi:400","Krona One":"Krona+One:400","La Belle Aurore":"La+Belle+Aurore:400","Lancelot":"Lancelot:400","Lateef":"Lateef:400","Lato":"Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic","League Script":"League+Script:400","Leckerli One":"Leckerli+One:400","Ledger":"Ledger:400","Lekton":"Lekton:400,400italic,700","Lemon":"Lemon:400","Lemon One":"Lemon+One:400","Libre Baskerville":"Libre+Baskerville:700,400italic,400","Life Savers":"Life+Savers:700,400","Lilita One":"Lilita+One:400","Limelight":"Limelight:400","Linden Hill":"Linden+Hill:400,400italic","Lobster":"Lobster:400","Lobster Two":"Lobster+Two:400,400italic,700,700italic","Lohit Bengali":"Lohit+Bengali:400","Lohit Devanagari":"Lohit+Devanagari:400","Lohit Tamil":"Lohit+Tamil:400","Londrina Outline":"Londrina+Outline:400","Londrina Shadow":"Londrina+Shadow:400","Londrina Sketch":"Londrina+Sketch:400","Londrina Solid":"Londrina+Solid:400","Lora":"Lora:400,400italic,700,700italic","Love Ya Like A Sister":"Love+Ya+Like+A+Sister:400","Loved by the King":"Loved+by+the+King:400","Lovers Quarrel":"Lovers+Quarrel:400","Luckiest Guy":"Luckiest+Guy:400","Lusitana":"Lusitana:400,700","Lustria":"Lustria:400","Macondo":"Macondo:400","Macondo Swash Caps":"Macondo+Swash+Caps:400","Magra":"Magra:400,700","Maiden Orange":"Maiden+Orange:400","Mako":"Mako:400","Marcellus":"Marcellus:400","Marcellus SC":"Marcellus+SC:400","Marck Script":"Marck+Script:400","Margarine":"Margarine:400","Marko One":"Marko+One:400","Marmelad":"Marmelad:400","Marvel":"Marvel:400,400italic,700,700italic","Mate":"Mate:400,400italic","Mate SC":"Mate+SC:400","Maven Pro":"Maven+Pro:400,500,700,900","McLaren":"McLaren:400","Meddon":"Meddon:400","MedievalSharp":"MedievalSharp:400","Medula One":"Medula+One:400","Megrim":"Megrim:400","Meie Script":"Meie+Script:400","Merge One":"Merge+One:400","Merienda":"Merienda:700,400","Merienda One":"Merienda+One:400","Merriweather":"Merriweather:300,400,700,900","Merriweather Sans":"Merriweather+Sans:700,300,800,400","Mervale Script":"Mervale+Script:400","Metal":"Metal:400","Metal Mania":"Metal+Mania:400","Metamorphous":"Metamorphous:400","Metrophobic":"Metrophobic:400","Miama":"Miama:400italic","Michroma":"Michroma:400","Milonga":"Milonga:400","Miltonian":"Miltonian:400","Miltonian Tattoo":"Miltonian+Tattoo:400","Miniver":"Miniver:400","Miss Fajardose":"Miss+Fajardose:400","Miss Saint Delafield":"Miss+Saint+Delafield:400","Modern Antiqua":"Modern+Antiqua:400","Molengo":"Molengo:400","Molle":"Molle:400italic","Monda":"Monda:700,400","Monofett":"Monofett:400","Monoton":"Monoton:400","Monsieur La Doulaise":"Monsieur+La+Doulaise:400","Montaga":"Montaga:400","Montez":"Montez:400","Montserrat":"Montserrat:700,400","Montserrat Alternates":"Montserrat+Alternates:700,400","Montserrat Subrayada":"Montserrat+Subrayada:700,400","Moul":"Moul:400","Moulpali":"Moulpali:400","Mountains of Christmas":"Mountains+of+Christmas:400,700","Mouse Memoirs":"Mouse+Memoirs:400","Mr Bedford":"Mr+Bedford:400","Mr Bedfort":"Mr+Bedfort:400","Mr Dafoe":"Mr+Dafoe:400","Mr De Haviland":"Mr+De+Haviland:400","Mrs Saint Delafield":"Mrs+Saint+Delafield:400","Mrs Sheppards":"Mrs+Sheppards:400","Muli":"Muli:300,300italic,400,400italic","Mystery Quest":"Mystery+Quest:400","Nanum Brush Script":"Nanum+Brush+Script:400","Nanum Gothic":"Nanum+Gothic:400,600,700","Nanum Gothic Coding":"Nanum+Gothic+Coding:400,700","Nanum Myeongjo":"Nanum+Myeongjo:400,600,700","Nanum Pen Script":"Nanum+Pen+Script:400","Neucha":"Neucha:400","Neuton":"Neuton:200,300,400,400italic,700,800","New Rocker":"New+Rocker:400","News Cycle":"News+Cycle:400,700","Niconne":"Niconne:400","Nixie One":"Nixie+One:400","Nobile":"Nobile:400,400italic,500,500italic,700,700italic","Nokora":"Nokora:400,700","Norican":"Norican:400","Nosifer":"Nosifer:400","Nosifer Caps":"Nosifer+Caps:400","Nothing You Could Do":"Nothing+You+Could+Do:400","Noticia Text":"Noticia+Text:400,400italic,700,700italic","Noto Sans":"Noto+Sans:700,700italic,400italic,400","Noto Sans UI":"Noto+Sans+UI:700,700italic,400italic,400","Noto Serif":"Noto+Serif:700,700italic,400italic,400","Nova Cut":"Nova+Cut:400","Nova Flat":"Nova+Flat:400","Nova Mono":"Nova+Mono:400","Nova Oval":"Nova+Oval:400","Nova Round":"Nova+Round:400","Nova Script":"Nova+Script:400","Nova Slim":"Nova+Slim:400","Nova Square":"Nova+Square:400","Numans":"Numans:400","Nunito":"Nunito:700,300,400","OFL Sorts Mill Goudy TT":"OFL+Sorts+Mill+Goudy+TT:400,400italic","Odor Mean Chey":"Odor+Mean+Chey:400","Offside":"Offside:400","Old Standard TT":"Old+Standard+TT:400,400italic,700","Oldenburg":"Oldenburg:400","Oleo Script":"Oleo+Script:700,400","Oleo Script Swash Caps":"Oleo+Script+Swash+Caps:700,400","Open Sans":"Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Open Sans Condensed":"Open+Sans+Condensed:300,300italic,700","Oranienbaum":"Oranienbaum:400","Orbitron":"Orbitron:400,500,700,900","Oregano":"Oregano:400italic,400","Orienta":"Orienta:400","Original Surfer":"Original+Surfer:400","Oswald":"Oswald:700,300,400","Over the Rainbow":"Over+the+Rainbow:400","Overlock":"Overlock:400,400italic,700,700italic,900,900italic","Overlock SC":"Overlock+SC:400","Ovo":"Ovo:400","Oxygen":"Oxygen:700,300,400","Oxygen Mono":"Oxygen+Mono:400","PT Mono":"PT+Mono:400","PT Sans":"PT+Sans:400,400italic,700,700italic","PT Sans Caption":"PT+Sans+Caption:400,700","PT Sans Narrow":"PT+Sans+Narrow:400,700","PT Serif":"PT+Serif:400,400italic,700,700italic","PT Serif Caption":"PT+Serif+Caption:400,400italic","Pacifico":"Pacifico:400","Paprika":"Paprika:400","Parisienne":"Parisienne:400","Passero One":"Passero+One:400","Passion One":"Passion+One:400,700,900","Patrick Hand":"Patrick+Hand:400","Patrick Hand SC":"Patrick+Hand+SC:400","Patua One":"Patua+One:400","Paytone One":"Paytone+One:400","Pecita":"Pecita:400","Peralta":"Peralta:400","Permanent Marker":"Permanent+Marker:400","Petit Formal Script":"Petit+Formal+Script:400","Petrona":"Petrona:400","Phetsarath":"Phetsarath:400,700","Philosopher":"Philosopher:400,400italic,700,700italic","Piedra":"Piedra:400","Pinyon Script":"Pinyon+Script:400","Pirata One":"Pirata+One:400","Plaster":"Plaster:400","Play":"Play:400,700","Playball":"Playball:400","Playfair Display":"Playfair+Display:900,900italic,700,700italic,400italic,400","Playfair Display SC":"Playfair+Display+SC:900,900italic,700,700italic,400italic,400","Podkova":"Podkova:400,700","Poetsen One":"Poetsen+One:400","Poiret One":"Poiret+One:400","Poller One":"Poller+One:400","Poly":"Poly:400,400italic","Pompiere":"Pompiere:400","Pontano Sans":"Pontano+Sans:400","Port Lligat Sans":"Port+Lligat+Sans:400","Port Lligat Slab":"Port+Lligat+Slab:400","Prata":"Prata:400","Preahvihear":"Preahvihear:400","Press Start 2P":"Press+Start+2P:400","Princess Sofia":"Princess+Sofia:400","Prociono":"Prociono:400","Prosto One":"Prosto+One:400","Puritan":"Puritan:400,400italic,700,700italic","Purple Purse":"Purple+Purse:400","Quando":"Quando:400","Quantico":"Quantico:400,400italic,700,700italic","Quattrocento":"Quattrocento:400,700","Quattrocento Sans":"Quattrocento+Sans:400,400italic,700,700italic","Questrial":"Questrial:400","Quicksand":"Quicksand:300,300italic,400,400italic,700,700italic","Quintessential":"Quintessential:400","Qwigley":"Qwigley:400","Racing Sans One":"Racing+Sans+One:400","Radley":"Radley:400,400italic","Raleway":"Raleway:700,800,200,900,300,500,400,600,100","Raleway Dots":"Raleway+Dots:400","Rambla":"Rambla:700,700italic,400italic,400","Rammetto One":"Rammetto+One:400","Ranchers":"Ranchers:400","Rancho":"Rancho:400","Rationale":"Rationale:400","Redressed":"Redressed:400","Reenie Beanie":"Reenie+Beanie:400","Revalia":"Revalia:400","Ribeye":"Ribeye:400","Ribeye Marrow":"Ribeye+Marrow:400","Righteous":"Righteous:400","Risque":"Risque:400","Roboto":"Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic","Roboto Condensed":"Roboto+Condensed:300,300italic,400,400italic,700,700italic","Rochester":"Rochester:400","Rock Salt":"Rock+Salt:400","Rokkitt":"Rokkitt:300,400,700","Romanesco":"Romanesco:400","Ropa Sans":"Ropa+Sans:400,400italic","Rosario":"Rosario:400,400italic,700,700italic","Rosarivo":"Rosarivo:400,400italic","Rouge Script":"Rouge+Script:400","Ruda":"Ruda:400,700,900","Rufina":"Rufina:700,400","Ruge Boogie":"Ruge+Boogie:400","Ruluko":"Ruluko:400","Rum Raisin":"Rum+Raisin:400","Ruslan Display":"Ruslan+Display:400","Russo One":"Russo+One:400","Ruthie":"Ruthie:400","Rye":"Rye:400","Sacramento":"Sacramento:400","Sail":"Sail:400","Salsa":"Salsa:400","Sanchez":"Sanchez:400italic,400","Sancreek":"Sancreek:400","Sansation":"Sansation:700,700,400,300,300,400","Sansita One":"Sansita+One:400","Sarina":"Sarina:400","Satisfy":"Satisfy:400","Scada":"Scada:700,700italic,400italic,400","Scheherazade":"Scheherazade:400","Schoolbell":"Schoolbell:400","Seaweed Script":"Seaweed+Script:400","Sedan":"Sedan:400italic,400","Sedan SC":"Sedan+SC:400","Sevillana":"Sevillana:400","Seymour One":"Seymour+One:400","Shadows Into Light":"Shadows+Into+Light:400","Shadows Into Light Two":"Shadows+Into+Light+Two:400","Shanti":"Shanti:400","Share":"Share:400,400italic,700,700italic","Share Tech":"Share+Tech:400","Share Tech Mono":"Share+Tech+Mono:400","Shojumaru":"Shojumaru:400","Short Stack":"Short+Stack:400","Siamreap":"Siamreap:400","Siemreap":"Siemreap:400","Sigmar One":"Sigmar+One:400","Signika":"Signika:300,400,600,700","Signika Negative":"Signika+Negative:300,400,600,700","Simonetta":"Simonetta:400,400italic,900,900italic","Sintony":"Sintony:700,400","Sirin Stencil":"Sirin+Stencil:400","Six Caps":"Six+Caps:400","Skranji":"Skranji:700,400","Slackey":"Slackey:400","Smokum":"Smokum:400","Smythe":"Smythe:400","Sniglet":"Sniglet:800","Snippet":"Snippet:400","Snowburst One":"Snowburst+One:400","Sofadi One":"Sofadi+One:400","Sofia":"Sofia:400","Sonsie One":"Sonsie+One:400","Sorts Mill Goudy":"Sorts+Mill+Goudy:400,400italic","Source Code Pro":"Source+Code+Pro:900,700,200,300,500,400,600","Source Sans Pro":"Source+Sans+Pro:900,900italic,700,700italic,200,200italic,400italic,300,300italic,400,600,600italic","Special Elite":"Special+Elite:400","Spicy Rice":"Spicy+Rice:400","Spinnaker":"Spinnaker:400","Spirax":"Spirax:400","Squada One":"Squada+One:400","Stalemate":"Stalemate:400","Stalin One":"Stalin+One:400","Stalinist One":"Stalinist+One:400","Stardos Stencil":"Stardos+Stencil:400,700","Stint Ultra Condensed":"Stint+Ultra+Condensed:400","Stint Ultra Expanded":"Stint+Ultra+Expanded:400","Stoke":"Stoke:300,400","Strait":"Strait:400","Strong":"Strong:400","Sue Ellen Francisco":"Sue+Ellen+Francisco:400","Sunshiney":"Sunshiney:400","Supermercado One":"Supermercado+One:400","Suwannaphum":"Suwannaphum:400","Swanky and Moo Moo":"Swanky+and+Moo+Moo:400","Syncopate":"Syncopate:400,700","Tangerine":"Tangerine:400,700","Taprom":"Taprom:400","Tauri":"Tauri:400","Telex":"Telex:400","Tenor Sans":"Tenor+Sans:400","Terminal Dosis":"Terminal+Dosis:200,300,400,500,600,700,800","Terminal Dosis Light":"Terminal+Dosis+Light:400","Text Me One":"Text+Me+One:400","Thabit":"Thabit:400,400italic,700,700italic","The Girl Next Door":"The+Girl+Next+Door:400","Tienne":"Tienne:400,700,900","Tinos":"Tinos:400,400italic,700,700italic","Titan One":"Titan+One:400","Titillium Web":"Titillium+Web:900,700,700italic,200,200italic,400italic,300,300italic,400,600,600italic","Trade Winds":"Trade+Winds:400","Trocchi":"Trocchi:400","Trochut":"Trochut:400,400italic,700","Trykker":"Trykker:400","Tuffy":"Tuffy:400,400italic,700,700italic","Tulpen One":"Tulpen+One:400","Ultra":"Ultra:400","Uncial Antiqua":"Uncial+Antiqua:400","Underdog":"Underdog:400","Unica One":"Unica+One:400","UnifrakturCook":"UnifrakturCook:700","UnifrakturMaguntia":"UnifrakturMaguntia:400","Unkempt":"Unkempt:400,700","Unlock":"Unlock:400","Unna":"Unna:400","VT323":"VT323:400","Vampiro One":"Vampiro+One:400","Varela":"Varela:400","Varela Round":"Varela+Round:400","Vast Shadow":"Vast+Shadow:400","Vibur":"Vibur:400","Vidaloka":"Vidaloka:400","Viga":"Viga:400","Voces":"Voces:400","Volkhov":"Volkhov:400,400italic,700,700italic","Vollkorn":"Vollkorn:400,400italic,700,700italic","Voltaire":"Voltaire:400","Waiting for the Sunrise":"Waiting+for+the+Sunrise:400","Wallpoet":"Wallpoet:400","Walter Turncoat":"Walter+Turncoat:400","Warnes":"Warnes:400","Wellfleet":"Wellfleet:400","Wendy One":"Wendy+One:400","Wire One":"Wire+One:400","Yanone Kaffeesatz":"Yanone+Kaffeesatz:200,300,400,700","Yellowtail":"Yellowtail:40","Yeseva One":"Yeseva+One:400","Yesteryear":"Yesteryear:400","Zeyada":"Zeyada:400","jsMath cmbx10":"jsMath+cmbx10:400","jsMath cmex10":"jsMath+cmex10:400","jsMath cmmi10":"jsMath+cmmi10:400","jsMath cmr10":"jsMath+cmr10:400","jsMath cmsy10":"jsMath+cmsy10:400","jsMath cmti10":"jsMath+cmti10:400"}';

	return(json_decode($json, true));
}