<?php
/**
 * DokuWiki Plugin pagehere (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andreas Gohr <gohr@cosmocode.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_pagehere extends DokuWiki_Syntax_Plugin {
    public function getType() {
        return 'substition';
    }

    public function getPType() {
        return 'normal';
    }

    public function getSort() {
        return 133;
    }


    public function connectTo($mode) {
        $this->Lexer->addSpecialPattern('{{pagehere}}',$mode,'plugin_pagehere');
    }

    public function handle($match, $state, $pos, Doku_Handler $handler){
        $data = array();
        return $data;
    }

    public function render($mode, Doku_Renderer $R, $data) {
        $R->info['cache'] = false;
        if($mode != 'xhtml') return false;

        global $INFO;
        global $ID;
        $check = $INFO['namespace'].':pagehere';
        if(auth_quickaclcheck($check) < AUTH_EDIT) return;

        $R->doc .= '<form class="plugin_pagehere" action="'.script().'" method="GET">';
        $R->doc .= '<input name="id" type="hidden" value="'.hsc($ID).'" />';
        $R->doc .= '<input name="pagehere" class="edit" type="text" id="page__here" />';
        $R->doc .= '<input type="submit" value="'.$this->getLang('submit').'" class="btn" />';
        $R->doc .= '</form>';

        return true;
    }
}

// vim:ts=4:sw=4:et:
