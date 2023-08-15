<?php
class syntax_plugin_anchor extends DokuWiki_Syntax_Plugin
{
	function getType() {return 'substition';}
	function getPType() {return 'block';}
	function getSort() {return 167;}

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
