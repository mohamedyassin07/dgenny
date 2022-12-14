<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Dgenny_Plugin_Update
 *
 * This class update the plugin files
 * 
 *
 * @package		DGENNY
 * @subpackage	Classes/Dgenny_Plugin_Update
 * @author		Mohamed Yassin
 * @since		1.0.0
 */
class Dgenny_Plugin_Update {

    private $slug;
    private $pluginData;
    private $username; // GitHub username
    private $repo; // GitHub repo name
    private $pluginFile;
    private $githubAPIResult; // holds data from GitHub
    private $accessToken; // GitHub private repo token

    function __construct( $pluginFile, $gitHubUsername, $gitHubProjectName, $accessToken = '' ) {
        add_filter( "pre_set_site_transient_update_plugins", array( $this, "setTransitent" ) );
        add_filter( "plugins_api", array( $this, "setPluginInfo" ), 10, 3 );
        add_filter( "upgrader_post_install", array( $this, "postInstall" ), 10, 3 );

        $this->pluginFile = $pluginFile;
        $this->username = $gitHubUsername;
        $this->repo = $gitHubProjectName;
        $this->accessToken = $accessToken;
    }

	// Get information regarding our plugin from WordPress
    private function initPluginData() {
        // code here
    }

	// Get information regarding our plugin from GitHub
    private function getRepoReleaseInfo() {
        // code here
    }

	// Push in plugin version information to get the update notification
    public function setTransitent( $transient ) {
        // code here
        return $transient;
    }

	// Push in plugin version information to display in the details lightbox
    public function setPluginInfo( $false, $action, $response ) {
        // code ehre
        return $response;
    }

	// Perform additional actions to successfully install our plugin
    public function postInstall( $true, $hook_extra, $result ) {
        // code here
        return $result;
    }
}
