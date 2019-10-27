<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author    Amit Kumar <akamit21@gmail.com>
 * @copyright Copyright (c) 2019
 */

/**
 * Class Component_model
 */

class Component_model extends Base_Model
{
	function __construct()
	{
		// model constructor
		parent::__construct();
	}
	/**
	 * Define database table primary key
	 *
	 * @var string $primary_key [PRIMARY KEY]
	 */
	protected $_primary_key = 'component_id';
}

/* End of file Component_model.php */
/* Location: ./application/modules/component/models/Component_model.php */
