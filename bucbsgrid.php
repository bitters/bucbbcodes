<?php

// no direct access
defined('_JEXEC') or die;

class plgContentBucbsgrid extends JPlugin {

	public function onContentPrepare($context, &$row, &$params, $page = 0) {
	
		$patterns = array(
			'~\[row\](.*?)\[/row\]~s',
			'~\[col-(.*?)\](.*?)\[/col\]~s',
			'~\[dl\](.*?)\[/dl\]~s',
			'~\[dt\](.*?)\[/dt\]~s',
			'~\[dd\](.*?)\[/dd\]~s',
			'~\[container\](.*?)\[/container\]~s',
			'~\[mix\](.*?)\[/mix\]~s'
		);
		
		$replacements = array(
			'<div class="row">$1</div>',
			'<div class="col-md-$1">$2</div>',
			'<dl>$1</dl>',
			'<dt>$1</dt>',
			'<dd>$1</dd>',
			'<div id="Controls">
				<p class="sortieren"><strong>Sortieren:</strong></p>
				<div class="sort" data-sort="myorder:asc">Aufsteigend</div>
				<div class="sort" data-sort="myorder:desc">Absteigend</div>
				<div class="sort" data-sort="random">Zufällig</div>
			 </div>
			 <div id="Container"><div class="row">$1</div></div>',
			'<div class="mix col-xs-12 col-sm-4 col-md-3" data-myorder="1">$1</div>'
		);
		
		$row->text = preg_replace($patterns, $replacements, $row->text);
		
		// Aufräumen (leere <p> aus Editor)
		$search = array(
			'~\<p><div class="row">~s',
			'~\<div class="col-md-(.*?)"></p>~s', 
			'~\<p></div>~s', 
			'~\</div></p>~s', 
			'~\&nbsp;~s', 
			'~\<p><dt>~s', 
			'~\<p><dd>~s', 
			'~\<p><dl>~s', 	
			'~\</dt></p>~s', 	
			'~\</dd></p>~s', 
			'~\</dl></p>~s', 
			'~\<dl></p>~s',
			'~\<p></dl>~s',
			'~\<p><div class="mix col-xs-12 col-sm-4 col-md-3" data-myorder="1">~s',
			'~\<p><div id="Controls">~s',
			'~\<div id="Container"></p>~s',
			'~\<p> </p>~s'
			
		);
		
		$replace = array(
			'<div class="row">',
			'<div class="col-md-$1">', 
			'</div>',
			'</div>',
			' ',
			'<dt>',
			'<dd>',
			'<dl>',
			'</dt>',
			'</dd>',
			'</dl>',
			'<dl>',
			'</dl>',
			'<div class="mix col-xs-12 col-sm-4 col-md-3" data-myorder="1">',
			'<div id="Controls">',
			'<div id="Container">',
			''
			
		);
		
		$row->text = preg_replace($search, $replace, $row->text);
		
		$row->text = str_replace('<p></p>', '', $row->text);
				
	}

}

?>
