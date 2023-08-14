<?php
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
//require_once(DOKU_PLUGIN.'syntax.php');

class syntax_plugin_anchor extends DokuWiki_Syntax_Plugin
{
	function getType() {return 'substition';}
	function getPType() {return 'block';}
	function getSort() {return 167;}

	function getInfo() {
		return array(
			'base' => 'anchor',
			'author' => 'Eli Fenton',
			'name' => 'Anchor Plugin',
			'date' => '2023-08-14',
			'url' => 'http://dokuwiki.org/plugin:anchor',
			'desc' => 'Add HTML anchors to a page'
		);
	}

	function connectTo($mode){
		$this->Lexer->addSpecialPattern('\{\{anchor:[^}]*\}\}', $mode, 'plugin_anchor');
	}

	function handle($match, $state, $pos, Doku_Handler $handler) {
		return explode(':', substr($match, strlen('{{anchor:'), -2));
	}

	function render($mode, Doku_Renderer $renderer, $data) {
		$content = array_key_exists(1, $data) ? $data[1] : '';
		$renderer->doc .= '<a name="' . $data[0] . '">' . $content . '</a>';
	}
}
