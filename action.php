<?php
/**
 * DokuWiki Plugin pagehere (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andreas Gohr <gohr@cosmocode.de>
 */

class action_plugin_pagehere extends DokuWiki_Action_Plugin {

    public function register(Doku_Event_Handler $controller) {
       $controller->register_hook('DOKUWIKI_STARTED', 'AFTER', $this, 'handleDokuwikiStarted');
    }

    public function handleDokuwikiStarted(Doku_Event $event, $param) {
        if (empty($_REQUEST['pagehere'])) return;

        global $ID;
        global $conf;

        $page = cleanID($_REQUEST['pagehere']);
        if (!$this->getConf('subns')){
            $page = str_replace(':', $conf['sepchar'], $page);
        }

        $ns = getNS($ID);
        $newpage = cleanID($ns.':'.$page);

        send_redirect(wl($newpage, ['do'=>'edit'], true, '&'));
    }
}
// vim:ts=4:sw=4:et:
