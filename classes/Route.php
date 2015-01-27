<?php
/**
 * @author		Jesse Boyer <contact@jream.com>
 * @copyright	Copyright (C), 2011-12 Jesse Boyer
 * @license		GNU General Public License 3 (http://www.gnu.org/licenses/)
 *				Refer to the LICENSE file distributed within the package.
 *
 * @link		http://jream.com
 *
 * @internal	Inspired by Klein @ https://github.com/chriso/klein.php
 */

class Route
{
	/**
	* @var array $_listUri List of URI's to match against
	*/
	private $Uri = array();
	
	/**
	* @var array $_listCall List of closures to call 
	*/
	private $files = array();
	
	/**
	* @var string $_trim Class-wide items to clean
	*/
	private $_trim = '/\^$';
		
	/**
	* add - Adds a URI and Function to the two lists
	*
	* @param string $uri A path such as about/system
	* @param object $function An anonymous function
	*/
	public function add($uri, $file)
	{
		$uri = trim($uri, $this->_trim);
		$this->_listUri[] = $uri;
		$this->files[] = $file;
	}
	
	/**
	* submit - Looks for a match for the URI and runs the related function
	*/
	public function submit()
	{	
		$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		$uri = trim($uri, $this->_trim);

		$replacementValues = array();

		/**
		* List through the stored URI's
		*/
		for($i = 0; $i < count($this->_listUri); $i++)
		{
			 $cUri = $this->_listUri[$i];
			 if(stripos($cUri,$uri) !== false)
			 {
				include $this->files[$i];
				exit();
			 }
		}
		include "home.php";
		
	}
	
}











