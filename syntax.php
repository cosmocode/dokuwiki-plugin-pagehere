<?php
/**
 * DokuWiki Plugin pagehere (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andreas Gohr <gohr@cosmocode.de>
 */

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
        return [];
    }

    public function render($format, Doku_Renderer $renderer, $data) {
        $renderer->info['cache'] = false;
        if ($format != 'xhtml') return false;

        global $INFO;
        global $ID;
        $check = $INFO['namespace'].':pagehere';
        if (auth_quickaclcheck($check) < AUTH_EDIT) return;

        $renderer->doc .= '<form class="plugin_pagehere" action="' . script() . '" method="GET">';
        $renderer->doc .= '<input name="id" type="hidden" value="' . hsc($ID) . '" />';
        $renderer->doc .= '<input name="pagehere" class="edit" type="text" id="page__here" />';
        $renderer->doc .= '<input type="submit" value="' . $this->getLang('submit') . '" class="btn" />';
        $renderer->doc .= '</form>';

        return true;
    }
}
// vim:ts=4:sw=4:et:
