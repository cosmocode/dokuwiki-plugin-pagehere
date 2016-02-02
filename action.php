<?php
/**
 * DokuWiki Plugin pagehere (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andreas Gohr <gohr@cosmocode.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'action.php';

class action_plugin_pagehere extends DokuWiki_Action_Plugin {

    public function register(Doku_Event_Handler $controller) {
       $controller->register_hook('DOKUWIKI_STARTED', 'AFTER', $this, 'handle_dokuwiki_started');
    }

    public function handle_dokuwiki_started(Doku_Event &$event, $param) {
        if(!$_REQUEST['pagehere']) return;

        global $ID;
        global $conf;

        $page = cleanID($_REQUEST['pagehere']);
        if(!$this->getConf('subns')){
            $page = str_replace(':', $conf['sepchar'], $page);

        }

        $ns = getNS($ID);
        $newpage = cleanID($ns.':'.$page);

        send_redirect(wl($newpage,array('do'=>'edit'),true,'&'));
    }

}

// vim:ts=4:sw=4:et:
