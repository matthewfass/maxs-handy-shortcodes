<?php
/*
	Plugin Name: Max's Handy Shortcodes
	Plugin URI: http://matthewfass.com
	Description: Little shortcodes that go a long way including [myspacer], [mylink], [myurl]
	Version: 0.37
	Date: April 28, 2021
	Author: Max
	Author URI: http://matthewfass.com
	License: GPL2
*/

/*List of shortcodes
/* [currentyear] */
/* [expires date='2021-03-01'] */
/* [get_date] */
/* [get_permalink_url] */
/* [get_randomhex length=8] */
/* [get_timestamp] */
/* [get_url_param param="id"] */
/* [get_url] */
/* [important comment="Comment Here"] */
/* [isadmin]content to show to admins....[/isadmin] */
/* [isloggedin]content to show to logged in users....[/isloggedin] */
/* [isloggedout]content to show to logged out users.....[/isloggedout] */
/* [isnotadmin]content to show to non-admins....[/isnotadmin] */
/* [myanchor anchor="this-is-the-anchor"] */
/* [mybreak comment="Comment Here"] */
/* [mybutton id="999" OR url="http://...." class="mybuttonclass" anchor="anchorname"] */
/* [mycaption class="mycaptionname"] */
/* [mycol class="mycolname"] bootstrap 3, span=3, class, id */
/* [mycol2 class="mycol2name"] bootstrap 3, span=3, class, id */
/* [mycomment comment="Comment Here"] */
/* [myconsole_log] */
/* [mycopyright startyear="2003" organization="Max's Handy Shortcode, Inc." message="All Rights Reserved."] */
/* [mydiv class="mydivname"]content..../[/mydiv] */
/* [myhider]Content to be completely hidden[/myhider] */
/* [mylead class="myleadname"] */
/* [mylink id="999"] */
/* [mymailto]user@example.com[/mymailto] */
/* [myplaceholder size="400x400" text="text"] */
/* [myquote author="authorname"]quote text....[/myqote] */
/* [myrow class="myrowname"] bootstrap 3, supports class, id */
/* [myrow2 class="myrow2name"] bootstrap 3, supports class, id */
/* [myshortcodeexample]Content with [shortcodes][/myshortcodexample] */
/* [myshowuserinfo getinfo="username"] getinfo="email"  */
/* [myspacer h=10 class="optional-class" id="useful-for-anchor-tags"] */
/* [myspan class="myspanname"]content.....[/myspan] class, style */
/* [mytab title="Example 1" active="true"]Text.....[/mytab] */
/* [mytabs]Text.....[/mytabs] */
/* [mytel]917-497-7852[/mytel] */
/* [mytestimonial author="authorname" location="morestuff" class="frontpage" readmoretext="Read more testimonials..." readmoreid=""]Text.....[/mytestimonial] */
/* [myurl url="http://example.com"]Some text to be linked[/myurl] */
/* [mywindow_alert] Window Alert Shortcode */
/* [mywrapper class="mywrappername"]Content.....[/mywrapper] Supports class, id, style */
/* [post_content id=x] post_content [post_content id=x] returns the body of the post*/
/* [todays_date] */


/*-----------------------------------------------------------------------------------*/
/* [important comment="Comment Here"] */
/*-----------------------------------------------------------------------------------*/
function important( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'comment' => '---------',
			), $atts ) );

	/* return the comment */
	return '';
}
add_shortcode( 'important', 'important' );

/*-----------------------------------------------------------------------------------*/
/* [isadmin]content to show to admins....[/isadmin] */
/*-----------------------------------------------------------------------------------*/
function isadmin ($params, $content = null){
	//check tha the user is logged in
	if ( current_user_can( 'manage_options' ) ) {
		// A user with admin privileges
		$content = do_shortcode($content);
		return $content;
	} else {
		// A user without admin privileges
		return;
	}
}
add_shortcode('isadmin', 'isadmin' );

/*-----------------------------------------------------------------------------------*/
/* [isnotadmin]content to show to non-admins....[/isnotadmin] */
/*-----------------------------------------------------------------------------------*/
function isnotadmin ($params, $content = null){
	//check tha the user is logged in
	if ( current_user_can( 'manage_options' ) ) {
		// A user with admin privileges
		return;
	} else {
		// A user without admin privileges
		$content = do_shortcode($content);
		return $content;
	}
}
add_shortcode('isnotadmin', 'isnotadmin' );

/*-----------------------------------------------------------------------------------*/
/* [isloggedin]content to show to logged in users....[/isloggedin] */
/*-----------------------------------------------------------------------------------*/
function isloggedin ($params, $content = null){
	//check tha the user is logged in
	if ( is_user_logged_in() ){
		//user is logged in so show the content
		$content = do_shortcode($content);
		return $content;
	}
	else{
		//user is not logged in so hide the content
		return;
	}
}
add_shortcode('isloggedin', 'isloggedin' );

/*-----------------------------------------------------------------------------------*/
/* [isloggedout]content to show to logged out users.....[/isloggedout] */
/*-----------------------------------------------------------------------------------*/
function isloggedout ($params, $content = null){
	//check tha the user is logged in
	if ( is_user_logged_in() ){
		//user is logged in so show the content
		return;
	}
	else{
		//user is not logged in so hide the content
		$content = do_shortcode($content);
		return $content;
	}
}
add_shortcode('isloggedout', 'isloggedout' );



/*-----------------------------------------------------------------------------------*/
/* [myadmin]content.....[/myadmin] */ /* show enclosed content only to editors and administrators */
/* deprecated */
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'myadmin', 'isadmin' );

/*-----------------------------------------------------------------------------------*/
/* [myanchor anchor="this-is-the-anchor"] */
/*-----------------------------------------------------------------------------------*/
function myanchor( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'anchor' => ''
			), $atts ) );

	$anchor = ($anchor ? '<div id="'.$anchor.'" class="myanchor"> </div>' : '');

	return $anchor;
}
add_shortcode( 'myanchor', 'myanchor' );

/*-----------------------------------------------------------------------------------*/
/* [mybreak comment="Comment Here"] */
/*-----------------------------------------------------------------------------------*/
function mybreak( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'comment' => '---------',
			), $atts ) );

	/* return the comment */
	return '<br />';
}
add_shortcode( 'mybreak', 'mybreak' );

/*-----------------------------------------------------------------------------------*/
/* [mybutton id="999" OR url="http://...." class="mybuttonclass" anchor="anchorname"] */
/*-----------------------------------------------------------------------------------*/
function mybutton( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'id' => '#',
				'url' => '',
				'anchor' => '',
				'class' => '',
				'wrapperclass' => '',
				'buttonstyle' => '',
				'onclick' => ''
			), $atts ) );

	$page_id = get_the_ID();
	$class = 'btn ' . $class; //fix to allow classes to be passed - 09/08/15

	if ( current_user_can( 'manage_options' ) ) {
		/* $content = $content . ' <span class="id-display">(id: ' . $id . ')</span>'; */
	}

	$anchor = ($anchor ? '#'.$anchor : '');

	if ( $buttonstyle == 'button' ) {
		$button = '<button class="'.$class.'" onclick="'.$onclick.'">'.$content.'</button>';
// 		$button = '<button onclick="FWP.reset()">Reset</button>';
	}
	else {
		if ($url != '') {
				if ($id == $page_id) {
					$class .= ' current-page ';
				}
				if ($class != "") {
					$class = ' class="'.$class.' mybutton mybutton-id-'.$id.'"';
				}
				$button = '<div class="btn-wrapper '.$wrapperclass.'"><a href="'.$url.$anchor.'"'.$class.' target="_blank">'.$content.'</a></div>';
		}
		else {
			if ($id == "#" || $id=='0' ) {
				$button = '<span class="no-button">'.$content.'</span>';
			}
			else if ($content != '') {
				$url = get_permalink($id);
				if ($id == $page_id) {
					$class .= ' current-page ';
				}
				if ($class != "") {
					$class = ' class="'.$class.' mybutton mybutton-id-'.$id.'"';
				}
				$button = '<div class="btn-wrapper  '.$wrapperclass.'"><a href="'.$url.$anchor.'"'.$class.'>'.$content.'</a></div>';
			}
			else {
				$url = get_permalink($id);
				$button = $url;
			}
		}
	}




	
	/* return the wrapped content */
	return $button;
}
add_shortcode( 'mybutton', 'mybutton' );


/*-----------------------------------------------------------------------------------*/
/* [mycaption class="mycaptionname"] */
/*-----------------------------------------------------------------------------------*/
function mycaption( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'class' => '',
				'id' => '',
				'style' => ''
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
	$content = trim($content);
	$content = wpautop(trim($content));

	/* return the wrapped content */
	if($style!==""){$style=' style="'.$style.'"';}
	if($id!==""){$id=' id="'.$id.'"';}
	return '<div class="my-caption-text '.$class.'"'.$style.$id.'>'.$content.'</div>';
}
add_shortcode( 'mycaption', 'mycaption' );

/*-----------------------------------------------------------------------------------*/
/* [mycol class="mycolname"] bootstrap 3, span=3, class, id */
/*-----------------------------------------------------------------------------------*/
function mycol( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'span' => '',
				'class' => '',
				'id' => ''
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
/* 	$content = trim($content); */
	$content = wpautop(trim($content), true);

	/* return the wrapped content */
	if($id!==""){$id=' id="'.$id.'"';}
	return '<div class="col-md-'.$span.' mycol '.$class.'"'.$id.'>'.$content.'</div>';
}
add_shortcode( 'mycol', 'mycol' );

/*-----------------------------------------------------------------------------------*/
/* [mycol2 class="mycol2name"] bootstrap 3, span=3, class, id */
/*-----------------------------------------------------------------------------------*/
function mycol2( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'span' => '',
				'class' => '',
				'id' => ''
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
/* 	$content = trim($content); */
	$content = wpautop(trim($content), true);

	/* return the wrapped content */
	if($id!==""){$id=' id="'.$id.'"';}
	return '<div class="col-md-'.$span.' mycol2 '.$class.'"'.$id.'>'.$content.'</div>';
}
add_shortcode( 'mycol2', 'mycol2' );

/*-----------------------------------------------------------------------------------*/
/* [mycomment comment="Comment Here"] */
/*-----------------------------------------------------------------------------------*/
function mycomment( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'comment' => '---------',
			), $atts ) );

	/* return the comment */
	return '<!-- '.$comment.' -->';
}
add_shortcode( 'mycomment', 'mycomment' );

/* --------------------------------------------------------------------- */
/* [mycopyright startyear="2003" organization="Max's Handy Shortcode, Inc." message="All Rights Reserved."] */
/* --------------------------------------------------------------------- */
/* [mycopyright] */
function mycopyright( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'startyear' => date("Y"),
				'organization' => '',
				'message' => ''
			), $atts ) );
	$currentyear = date("Y");
	$startyear = ($startyear == $currentyear ? $year = $currentyear : $year = $startyear.'&ndash;'.$currentyear );	
	$copyright = '&copy;'.$year.' '.$organization.' '.$message;
	return $copyright;
}
add_shortcode( 'mycopyright', 'mycopyright' );

/*-----------------------------------------------------------------------------------*/
/* [mydiv class="mydivname"]content..../[/mydiv] */
/*-----------------------------------------------------------------------------------*/
function mydiv( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'class' => '',
				'id' => '',
				'style' => ''
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
/* 	$content = trim($content); */
/* 	$content = wpautop(trim($content), false); */

	/* return the wrapped content */
	if($style!==""){$style=' style="'.$style.'"';}
	if($id!==""){$id=' id="'.$id.'"';}
	return '<div class="mydiv '.$class.'"'.$style.$id.'>'.$content.'</div>';
}
add_shortcode( 'mydiv', 'mydiv' );

/*-----------------------------------------------------------------------------------*/
/* [myhider]Content to be completely hidden[/myhider] */
/*-----------------------------------------------------------------------------------*/
function myhider( $atts, $content = null ) {
	extract( shortcode_atts( array(
			), $atts ) );

	/* return the spacer */
	return '';
}
add_shortcode( 'myhider', 'myhider' );

/*-----------------------------------------------------------------------------------*/
/* [mylead class="myleadname"] */
/*-----------------------------------------------------------------------------------*/
function mylead( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'class' => '',
				'style' => '',
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
	/* 	$content = wpautop(trim($content)); */

	/* return the wrapped content */
	if($style!==""){$style='style="'.$style.'"';}
	return '<div class="mylead '.$class.'" "'.$style.'">'.$content.'</div>';
}
add_shortcode( 'mylead', 'mylead' );

/*-----------------------------------------------------------------------------------*/
/* [mylink id="999"] */
/*-----------------------------------------------------------------------------------*/
function mylink( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'id' => '#',
				'anchor' => '',
				'class' => '',
				'tab' => '',
				'target' => ''
			), $atts ) );

	$page_id = get_the_ID();

	if ( current_user_can( 'manage_options' ) ) {
		/* $content = $content . ' <span class="id-display">(id: ' . $id . ')</span>'; */
	}

	$anchor = ($anchor ? '#'.$anchor : '');
	$anchor = ($tab ? '#'.$tab : $anchor); // tab overrides anchor 

	$target = ($target ? ' target="_blank"' : '');

	if ($id == "#" || $id=='0' ) {
		$link = '<span class="no-link">'.$content.'</span>';
	}
	else if ($content != '') {
		$url = get_permalink($id);
		if ($id == $page_id) {
			$class .= ' current-page ';
		}
		if ($class != "") {
			$class = ' class="'.$class.' mylink mylink-id-'.$id.'"';
		}
		$link = '<a href="'.$url.$anchor.'"'.$class.$target.'>'.$content.'</a>';
	}
	else {
		$url = get_permalink($id);
		$link = $url;
	}
	
	/* return the wrapped content */
	return $link;
}
add_shortcode( 'mylink', 'mylink' );

/*-----------------------------------------------------------------------------------*/
/* [mymailto]user@example.com[/mymailto] */
/*-----------------------------------------------------------------------------------*/
function mymailto( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'class' => ''
			), $atts ) );
	if ($content == '' ) {
		$link = '';
	}
	else {
		$link = '<a href="mailto:'.$content.'"'.$class.'>'.$content.'</a>';
	}
	/* return the wrapped content */
	return $link;
}
add_shortcode( 'mymailto', 'mymailto' );

/*-----------------------------------------------------------------------------------*/
/* [myplaceholder size="400x400" text="text"] */
/*-----------------------------------------------------------------------------------*/
function myplaceholder( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'size' => '1000x350',
				'background' => 'dddddd',
				'textcolor' => 'ffffff',
				'text' => 'myplaceholder Image',
				'class' => 'alignnone',
			), $atts ) );
	if ($text !=="") {$text = "&text=" . str_replace(" ", "+", $text) . "+" . $size;}
	return '<img src="http://www.placehold.it/'.esc_attr($size).'/'.esc_attr($background).'/'.esc_attr($textcolor).esc_attr($text).'" class="'.esc_attr($class).'"/>';
}
add_shortcode( 'myplaceholder', 'myplaceholder' );

/*-----------------------------------------------------------------------------------*/
/* [myquote author="authorname"]quote text....[/myqote] */
/*-----------------------------------------------------------------------------------*/
function myquote( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'author' => ''
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
	$content = (trim($content));

	$content_display = ($content ? '<div class="my-quote-text">'.$content.'</div>' : '');
	$author_display = ($author ? '<div class="my-quote-author">&mdash;'.$author.'</div>' : '');

	$myquote = '
		<div class="my-quote-wrapper">'
			.$content_display
			.$author_display
		.'</div>';

	return $myquote;
}
add_shortcode( 'myquote', 'myquote' );

/*-----------------------------------------------------------------------------------*/
/* [myrow class="myrowname"] bootstrap 3, supports class, id */
/*-----------------------------------------------------------------------------------*/
function myrow( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'class' => '',
				'id' => ''
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
/* 	$content = trim($content); */
	$content = wpautop(trim($content), false);

	/* return the wrapped content */
	if($id!==""){$id=' id="'.$id.'"';}
	return '<div class="row myrow '.$class.'"'.$id.'>'.$content.'</div>';
}
add_shortcode( 'myrow', 'myrow' );

/*-----------------------------------------------------------------------------------*/
/* [myrow2 class="myrow2name"] bootstrap 3, supports class, id */
/*-----------------------------------------------------------------------------------*/
function myrow2( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'class' => '',
				'id' => ''
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
/* 	$content = trim($content); */
	$content = wpautop(trim($content), false);

	/* return the wrapped content */
	if($id!==""){$id=' id="'.$id.'"';}
	return '<div class="row myrow2 '.$class.'"'.$id.'>'.$content.'</div>';
}
add_shortcode( 'myrow2', 'myrow2' );

/*-----------------------------------------------------------------------------------*/
/* [myspacer h=10 class="optional-class" id="useful-for-anchor-tags"] */
/*-----------------------------------------------------------------------------------*/
function myspacer( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'h' => '10',
				'w' => '100%',
				'class' => '',
				'id' => ''
			), $atts ) );

	$id = ($id ? ' id="'.$id.'" ' : '');
	$class = ($class ? ' class="myspacer '.$class.'" ' : ' class="myspacer"');


	/* return the spacer */
	return '<div '.$id.$class.'style="height:'.$h.'px; width:'.$w.'; clear:both;">&nbsp;</div>';
}
add_shortcode( 'myspacer', 'myspacer' );

/*-----------------------------------------------------------------------------------*/
/* [myspan class="myspanname"]content.....[/myspan] class, style */
/*-----------------------------------------------------------------------------------*/
function myspan( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'class' => '',
				'style' => '',
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
	/* 	$content = wpautop(trim($content)); */

	/* return the wrapped content */
	if($style!==""){$style='style="'.$style.'"';}
	return '<span class="myspan '.$class.'" "'.$style.'">'.$content.'</span>';
}
add_shortcode( 'myspan', 'myspan' );

/*-----------------------------------------------------------------------------------*/
/* [myurl url="http://example.com"]Some text to be linked[/myurl] */
/*-----------------------------------------------------------------------------------*/
function myurl( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'url' => '#',
				'class' => '',
				'anchor' => '',
				'target' => '_blank'

			), $atts ) );

	$anchor = ($anchor ? '#'.$anchor : '');

	if ($url == "#" ) {
		$link = $content;
	}
	else {
		if ($url != "") {
			$target = ' target="'.$target.'"';
			if ($class != "") {
				$class = ' class="'.$class.' myurl"';
			}
			$link = '<a href="'.$url.$anchor.'"'.$class.$target.'>'.$content.'</a>';
		}
	}
	/* return the wrapped content */
	return $link;
}
add_shortcode( 'myurl', 'myurl' );

/* --------------------------------------------------------------------- */
/* [myshortcodeexample]Content with [shortcodes][/myshortcodexample] */
/* --------------------------------------------------------------------- */
/* [shortcodexample][myshortcode]Conent....[/myshortcode][/shortcodexample] prevent rendering of shortcode on instruction pages and wraps in <pre> tags*/
function myshortcodeexample( $atts, $content = null ) {
	extract( shortcode_atts( array(
			), $atts ) );

	/* return the comment */
	$content = str_replace("[", '&#91;', $content);
	$content = str_replace("]", '&#93;', $content);
	return '<pre>'.$content.'</pre>';
}
add_shortcode( 'myshortcodeexample', 'myshortcodeexample' );

/* --------------------------------------------------------------------- */
/* [myshowuserinfo getinfo="username"] getinfo="email"  */
/* --------------------------------------------------------------------- */
// see https://codex.wordpress.org/Function_Reference/get_userdata
function myshowuserinfo( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'user_id' => get_current_user_id(),
				'getinfo' => 'username',
				'fallback' => ''
			), $atts ) );

	$user_info = get_userdata($user_id);
	if ($getinfo == 'username') {
		$showinfo = $user_info->user_login;
	}
	else if ($getinfo == 'email') {
		$showinfo = $user_info->user_email;
	}
	else if ($getinfo == 'firstname') {
		$showinfo = $user_info->first_name;
	}
	else if ($getinfo == 'lastname') {
		$showinfo = $user_info->last_name;
	}
	else if ($getinfo == 'displayname') {
		$showinfo = $user_info->display_name;
	}

	$showinfo = ($showinfo ? $showinfo : $fallback );

	return $showinfo;
}
add_shortcode( 'myshowuserinfo', 'myshowuserinfo' );

/*-----------------------------------------------------------------------------------*/
/* [mytab title="Example 1" active="true"]Text.....[/mytab] */
/*-----------------------------------------------------------------------------------*/
function mytab( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'title' => '',
				'active' => ''
			), $atts ) );

	/* process the existing shortcodes */
/* 	$content = do_shortcode($content); */
/* 	$content = shortcode_unautop($content); */
/* 	$content = (trim($content)); */

	$title = (trim($title));
	$id = strtolower($title);
	$id = str_replace(' ', '-', $id);
	$id = str_replace('&amp;', 'and', $id);
	$id = str_replace('&', 'and', $id);
	$id = strip_tags($id);
	$active = ($active=='true' || $active=='active' ? $active='active' : '');

	/* strip leading br */
/* 	$findbr   = '<br />'; */
/* 	$pos = strpos($content, $findbr); */
/* 	if ($pos === false) { */
		/* echo "The string '$findme' was not found in the string '$content'"; */
/* 	} else if ($pos == 0) { */
		/* echo "The string '$findme' was found in the string '$$content'"; */
		/* echo " and exists at position $pos"; */
/* 		$content = substr($content, 7); */
/* 	} */


	/* create a global variable to pass tab info */
	global $tabdetails;
	$tabdetails[]=$title.'||'.$id.'||'.$active;
	$tab = '
        <div role="tabpanel" class="tab-pane '.$active.'" id="'.$id.'">
			'.$content.'
        </div>
	';
	return $tab;
}
add_shortcode( 'mytab', 'mytab' );

/*-----------------------------------------------------------------------------------*/
/* [mytabs]Text.....[/mytabs] */
/*-----------------------------------------------------------------------------------*/
function mytabs( $atts, $content = null ) {
	extract( shortcode_atts( array(

			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
// 	$content = shortcode_unautop($content);
	$content = (trim($content));
	/* strip excesss spaces */
	$content = preg_replace('/\s\s+/', ' ', $content);
	$content = str_replace('<div><br />', '<div>', $content);
	$content = str_replace('</div><br />', '</div>', $content);

	$string = $content;

	global $tabdetails;
	$arrlength = count($tabdetails);

	for($i = 0; $i <  $arrlength; $i++) {
		list($title[$i], $id[$i], $active[$i])=explode('||', $tabdetails[$i]);
		$tablist .= '<li role="presentation" class="mytabs '.$active[$i].'"><a href="#'.$id[$i].'" aria-controls="'.$id[$i].'" role="tab" data-toggle="tab">'.$title[$i].'</a></li>';
	}

	$tabpanel = '
		<div role="tabpanel">
		    <!-- Nav tabs -->
		    <ul class="nav nav-tabs" role="tablist">'
		.$tablist.
		'</ul>
			<!-- Tab panes -->
		    <div class="tab-content">
			'.$content.'
		    </div>
		</div>
	';

	/* strip excesss spaces */
/* 	$tabpanel = preg_replace('/\s\s+/', ' ', $tabpanel); */
/* 	$tabpanel = str_replace('<div><br />', '<div>', $tabpanel); */
/* 	$tabpanel = str_replace('</div><br />', '</div>', $tabpanel); */
	

	/* reset global variable $tabdetails */
	unset($tabdetails);
	return $tabpanel;
}
add_shortcode( 'mytabs', 'mytabs' );

/*-----------------------------------------------------------------------------------*/
/* [mytestimonial author="authorname" location="morestuff" class="frontpage" readmoretext="Read more testimonials..." readmoreid=""]Text.....[/mytestimonial] */
/*-----------------------------------------------------------------------------------*/
function mytestimonial( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'author' => 'Guest',
				'location' => '',
				'readmoretext' => '',
				'readmoreid' => get_the_ID(),
				'class' => '',
			), $atts ) );


	/* process the existing shortcodes */
	$content = do_shortcode($content);
	$content = (trim($content));

	$testimonial = '<div class="my-testimonial-wrapper '.$class.'">';
	$testimonial .= '<div class="my-testimonial-text my-testimonial-text-quotemark">'.$content.'</div>';
	$testimonial .= '<div class="my-testimonial-author">&mdash;'.$author.'</div>';
	if ($location != "") {
		$testimonial .= '<div class="my-testimonial-location">'.$location.'</div>';
	}
	if ($readmoretext != "") {
		$readmorelink = '<a href="'.get_permalink($readmoreid).'">'.$readmoretext.'</a>';
		$testimonial .= '<div class="my-testimonial-read-more">'.$readmorelink.'</div>';
	}
	$testimonial .= '</div>';
	return $testimonial;
}
add_shortcode( 'mytestimonial', 'mytestimonial' );

/*-----------------------------------------------------------------------------------*/
/* [mywrapper class="mywrappername"]Content.....[/mywrapper] Supports class, id, style */
/*-----------------------------------------------------------------------------------*/
function mywrapper( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'class' => '',
				'id' => '',
				'style' => ''
			), $atts ) );

	/* process the existing shortcodes */
	$content = do_shortcode($content);
	$content = trim($content);
	$content = wpautop(trim($content));

	/* return the wrapped content */
	if($style!==""){$style=' style="'.$style.'"';}
	if($id!==""){$id=' id="'.$id.'"';}
	return '<div class="mywrapper '.$class.'"'.$style.$id.'>'.$content.'</div>';
}
add_shortcode( 'mywrapper', 'mywrapper' );

/* --------------------------------------------------------------------- */
/* ! post_content [post_content id=x] returns the body of the post*/
/* --------------------------------------------------------------------- */
function post_content( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'id' => get_the_id()
			), $atts ) );

	$post_object = get_post( $id );
	$edit_link = '';

	if ( current_user_can( 'manage_options' ) ) {
		// A user with admin privileges
		$edit_link = get_site_url() . '/wp-admin/post.php?post='.$id.'&action=edit'; 
		$edit_link = ' <a href="'.$edit_link.'" target="_blank">Edit This</a>';
	} else {
		// A user without admin privileges
	}

	$post_content = $post_object->post_content . $edit_link;
	return $post_content;
}
add_shortcode( 'post_content', 'post_content' );

/* Will eventually extend to grab some to the arguments below
WP_Post Object
(
    [ID] =>
    [post_author] =>
    [post_date] => 
    [post_date_gmt] => 
    [post_content] => 
    [post_title] => 
    [post_excerpt] => 
    [post_status] =>
    [comment_status] =>
    [ping_status] => 
    [post_password] => 
    [post_name] =>
    [to_ping] => 
    [pinged] => 
    [post_modified] => 
    [post_modified_gmt] =>
    [post_content_filtered] => 
    [post_parent] => 
    [guid] => 
    [menu_order] =>
    [post_type] =>
    [post_mime_type] => 
    [comment_count] =>
    [filter] =>
)
*/


/* --------------------------------------------------------------------- */
/* ! Console Log */
/* --------------------------------------------------------------------- */
function console_log( $value ) {
	$value = ($value ? $value : 'Value from console_log shortcode');
	$console_log = '
		<script>
			console.log("'.$value.'");
		</script>
	';
	return $console_log;
}

/* --------------------------------------------------------------------- */
/* ! Console Log Shortcode */
/* --------------------------------------------------------------------- */
function myconsole_log( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'id' => '',
				'value' => 'myconsole_log'				
			), $atts ) );
	$myconsole_log = console_log( $value );
	return $myconsole_log;
}
add_shortcode( 'myconsole_log', 'myconsole_log' );

/* --------------------------------------------------------------------- */
/* ! Window Alert */
/* --------------------------------------------------------------------- */
function window_alert( $value ) {
	$value = ($value ? $value : 'Value from window_alert shortcode');
	$window_alert = '
		<script>
			window.alert("'.$value.'");
		</script>
	';
	return $window_alert;
}

/* --------------------------------------------------------------------- */
/* ! Window Alert Shortcode */
/* --------------------------------------------------------------------- */
function mywindow_alert( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'id' => '',
				'value' => 'mywindow_alert'				
			), $atts ) );
	$mywindow_alert = window_alert( $value );
	return $mywindow_alert;
}
add_shortcode( 'mywindow_alert', 'mywindow_alert' );



/* --------------------------------------------------------------------- */
/* ! Get URL */
/* --------------------------------------------------------------------- */
/* [get_url] */
function get_url( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'id' => ''
			), $atts ) );
	$get_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	return $get_url;
}
add_shortcode( 'get_url', 'get_url' );

/* --------------------------------------------------------------------- */
/* ! Get Permalink */
/* --------------------------------------------------------------------- */
/* [get_permalink_url] */
function get_permalink_url( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'id' => get_the_id()
			), $atts ) );
	$get_permalink_url = get_the_permalink($id);
	return $get_permalink_url;
}
add_shortcode( 'get_permalink_url', 'get_permalink_url' );


/* --------------------------------------------------------------------- */
/* ! Get Date */
/* --------------------------------------------------------------------- */
/* [get_date] */
function get_date( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'id' => ''
			), $atts ) );

	$get_date = date('m/d/Y');
	return $get_date;
}
add_shortcode( 'get_date', 'get_date' );

/* --------------------------------------------------------------------- */
/* ! [todays_date] */
/* --------------------------------------------------------------------- */
// [todays_date]
function todays_date( $atts = null, $content = null ) {
	extract( shortcode_atts( array(
				'id' => '',
				'timezone' => 'America/New_York',
// 				'format' => 'Y-m-d H:i:s',
				'format' => 'l, F j, Y \a\t g:i a',
				
			), $atts ) );
	date_default_timezone_set($timezone);
	$todays_date = date($format);
	return $todays_date;
}
add_shortcode( 'todays_date', 'todays_date' );


/* --------------------------------------------------------------------- */
/* ! [expires date='2021-03-01'] */
/* --------------------------------------------------------------------- */
// [expires]
function expires( $atts = null, $content = null ) {
	extract( shortcode_atts( array(
		'id' => '',
		'date' => '',
		'timezone' => 'America/New_York',
		'format' => 'Y-m-d',
		
	), $atts ) );
	date_default_timezone_set($timezone);
	$todays_date = date($format);
	$expires = date($date);
	if ( $todays_date < $expires ) {
		return $content;
	}
	else {
		return;
	}
}
add_shortcode( 'expires', 'expires' );


/* --------------------------------------------------------------------- */
/* ! Get Timestamp */
/* --------------------------------------------------------------------- */
/* [get_timestamp] */
function get_timestamp( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'id' => ''
			), $atts ) );

	$get_timestamp = date ( 'c', $timestamp = time() );
	return $get_timestamp;
}
add_shortcode( 'get_timestamp', 'get_timestamp' );

/* --------------------------------------------------------------------- */
/* ! Get Random Hex */
/* --------------------------------------------------------------------- */
/* [get_randomhex length=8] */
function get_randomhex( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'length' => '8'
			), $atts ) );
	$bytes = random_bytes($length);
	$randomhex = bin2hex($bytes);
	return $randomhex;
}
add_shortcode( 'get_randomhex', 'get_randomhex' );

/* --------------------------------------------------------------------- */
/* ! get_url_param */
/* --------------------------------------------------------------------- */
/* [get_url_param param="id"] */
function get_url_param( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'param' => ''
			), $atts ) );

	// absolute current URI (on single site):
	$url = home_url( add_query_arg( NULL, NULL ) );

	// parse URI into an array
	parse_str( parse_url( $url, PHP_URL_QUERY ), $url_variables_array );

	// show parameter
	if ( $url_variables_array[$param] ) {
		$get_url_param = $url_variables_array[$param];
	}
	else {
		$get_url_param = '';
	}

	return $get_url_param;
}
add_shortcode( 'get_url_param', 'get_url_param' );

/* --------------------------------------------------------------------- */
/* [currentyear] */
/* --------------------------------------------------------------------- */
/* [currentyear] */
function currentyear( $atts, $content = null ) {
	$currentyear = date("Y");
	return $currentyear;
}
add_shortcode( 'currentyear', 'currentyear' );


/*-----------------------------------------------------------------------------------*/
/* [mytel]917-497-7852[/mytel] */
/*-----------------------------------------------------------------------------------*/
function mytel( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'class' => ''
			), $atts ) );
	if ($content == '' ) {
		$link = '';
	}
	else {
		$link = '<a href="tel:'.$content.'"'.$class.'>'.$content.'</a>';
	}
	/* return the wrapped content */
	return $link;
}
add_shortcode( 'mytel', 'mytel' );
