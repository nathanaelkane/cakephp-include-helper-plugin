<?php
/**
 * A simple helper for automagically including css & javascript assets
 *
 * TODO:
 * - add some instructions to this file, explaining how to use it
 *
 * @author Nathanael kane
 */
class IncludeHelper extends Helper {
	/**
	 * Other helpers used by this helper
	 *
	 * @var array
	 * @access public
	 */
	public $helpers = array('Html', 'Javascript');

	/**
	 * The name of the shared files to look for
	 *
	 * @example
	 * - /css/posts/shared.css
	 * - /js/posts/shared.js
	 *
	 * @var string
	 * @access private
	 */
	private $sharedFileName = 'shared';

	/**
	 * The current action, will be modified if the current controller is pages
	 *
	 * @example
	 * Example 1 (normal controller/action use):
	 * - when URL is '/posts/index' will return 'index'
	 *
	 * Example 2 (when using built-in pages controller):
	 * - when URL is '/pages/home' will return 'display_home'
	 *
	 * @var string
	 * @access private
	 */
	private $currentAction;

	/**
	 * Automagically include css & javascript for the current controller &
	 * action
	 *
	 * Will include the following js/css files if they exist:
	 * - /css/<controller>/<sharedFileName>.css
	 * - /css/<controller>/<currentAction>.css
	 * - /js/<controller>/<sharedFileName>.js
	 * - /js/<controller>/<currentAction>.css
	 *
	 * @return string Generated css & javascript includes
	 * @access public
	 */
	public function includeAssets() {
		$this->currentAction = $this->getCurrentAction();
		$includes = $this->includeCss();
		$includes .= $this->includeJavascript();
		return $this->output($includes);
	}

	/**
	 * Automagically include css for the current controller & action
	 *
	 * Will include the following css files if they exist:
	 * - /css/<controller>/<sharedFileName>.css
	 * - /css/<controller>/<currentAction>.css
	 *
	 * @return string Generated css includes
	 * @access private
	 */
	private function includeCss() {
		$includes = $this->checkAndIncludeCss($this->sharedFileName);
		$includes .= $this->checkAndIncludeCss($this->currentAction);
		return $includes;
	}

	/**
	 * Automagically include javascript for the current controller & action
	 *
	 * Will include the following js files if they exist:
	 * - /js/<controller>/<sharedFileName>.js
	 * - /js/<controller>/<currentAction>.js
	 *
	 * @return string Generated javascript includes
	 * @access private
	 */
	private function includeJavascript() {
		$includes = $this->checkAndIncludeJavascript($this->sharedFileName);
		$includes .= $this->checkAndIncludeJavascript($this->currentAction);
		return $includes;
	}

	/**
	 * Check if a css file exists, include it if it does
	 *
	 * @param string $filePath The absolute path of the file to check/include
	 * @return string Generated css include
	 * @access private
	 */
	private function checkAndIncludeCss($file) {
		$cssPath = APP . DS . 'webroot' . DS . 'css' . DS . $this->params['controller'] . DS;
		if (is_file($cssPath . $file . '.css')) {
			return $this->Html->css($this->params['controller'] . '/' . $file, null, array('media' => 'screen, projection'));
		}
	}

	/**
	 * Check if a css file exists, include it if it does
	 *
	 * @param string $filePath The absolute path of the file to check/include
	 * @return string Generated javascript include
	 * @access private
	 */
	private function checkAndIncludeJavascript($file) {
		$jsPath = APP . DS . 'webroot' . DS . 'js' . DS . $this->params['controller'] . DS;
		if (is_file($jsPath . $file . '.js')) {
			return $this->Javascript->link($this->params['controller'] . '/'. $file);
		}
	}

	/**
	 * Gets the current action
	 *
	 * Will append the first param if using the built-in pages controller
	 *
	 * @return string The current action
	 * @access private
	 */
	private function getCurrentAction() {
		$action = $this->params['action'];
		if ($this->params['controller'] == 'pages' && !empty($this->params['pass'][0])) {
			$action = $action . '_' . $this->params['pass'][0];
		}
		return $action;
	}
}
