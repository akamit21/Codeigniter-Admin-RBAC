<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author    Amit Kumar <akamit21@gmail.com>
 * @copyright Copyright (c) 2019
 */

/**
 * Class Role_model
 */

class Role_model extends Base_Model
{
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * Define database table primary key
	 *
	 * @var string $primary_key [PRIMARY KEY]
	 */
	protected $_primary_key = 'role_id';

	/**
	 * Insert role into the table and role permission.
	 *
	 * @param  array $data [form input data]
	 * @param  array $permission [form input data]
	 * @return boolean
	 */
	public function insert_role($data, $permissions)
	{
		if ($data != null) {
			$this->db->trans_begin();
			$this->db->insert('roles', $data);
			if($this->db->affected_rows() == 1) {
				$lastID = $this->db->insert_id();
			}

			foreach ($permissions as $permission) {
				$this->db->insert('role_permission', array('role_ID' => $lastID, 'permission_ID' => $permission));
			}

			$this->db->trans_complete();
			if ($this->db->trans_status() == false) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
				return true;
			}
		} else {
			error_log('Error, Undefined variabled: $data');
			return false;
		}
	}

	/**
	 * Get all components assigned to a role.
	 * @param  int $id [primary key]
	 * @return array|boolean
	 */
	public function get_components_by_role($id)
	{
		if ($id != null) {
			return $this->db->select('component_ids')->where('fk_role_id', $id)->get('role_component')->row();
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}

	/**
	 * Get all permissions assigned to a role.
	 * @param  int $id [primary key]
	 * @return array|boolean
	 */
	public function get_permissions_by_role($id)
	{
		if ($id != null) {
			return $this->db->select('permission_ids')->where('fk_role_id', $id)->get('role_permission')->row();
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}

	/**
	 * Update role into the table and role permission.
	 * @param  array $data [form input data]
	 * @param  array $permission [form input data]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function update_role($data, $components_arr, $permissions_arr, $id)
	{
		if ($id != null) {
			$this->db->trans_begin();

			$components = implode(',', $components_arr);
			$permissions = implode(',', $permissions_arr);
			$this->db->where('role_id', $id)->set($data)->update('roles');
			$this->db->where('fk_role_id', $id)->delete('role_component');
			$this->db->where('fk_role_id', $id)->delete('role_permission');
			
			$this->db->insert('role_component', array('fk_role_id' => $id, 'component_ids' => $components));
			$this->db->insert('role_permission', array('fk_role_id' => $id, 'permission_ids' => $permissions));
			

			$this->db->trans_complete();
			if ($this->db->trans_status() == false) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
				return true;
			}
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}
}

/* End of file Role.php */
/* Location: ./application/modules/roles/models/Role.php */
