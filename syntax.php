<?php
class syntax_plugin_anchor extends DokuWiki_Syntax_Plugin
{
	function getType() {return 'substition';}
	function getPType() {return 'normal';}
	function getSort() {return 167;}

	function connectTo($mode){
		$this->Lexer->addSpecialPattern('\{\{anchor:[^}]*\}\}', $mode, 'plugin_anchor');
	}

	function handle($match, $state, $pos, Doku_Handler $handler) {
		preg_match('/^\{\{anchor:([^:]*):?([^}]*)?}}$/ui', $match, $result);
		return $result;
	}

	function render($mode, Doku_Renderer $renderer, $data) {
		$id = $data[1] ?? '';
		$content = $data[2] ?? '';
		if ($id == '') {
			$renderer->doc .= '<div style="color:red; padding:8px; margin: 8px; border: 1px solid red">';
			$renderer->doc .= 'Anchor plugin: Invalid syntax.<br>';
			$renderer->doc .= 'Usage: {{anchor:tag:content}}';
			$renderer->doc .= '</div>';
			return;
		}
		$renderer->doc .= '<a id="' . $id. '">' . $content . '</a>';
	}
}
