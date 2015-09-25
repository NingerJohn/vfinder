<?php
/**
* 
*/
class Page_m extends MY_Model
{
	protected $table_name = 'pages';
	protected $primary_key = 'id';
	protected $primary_filter = 'intval';
	protected $order_by = 'id ASC';
	protected $rules = array();
	protected $timestamps = FALSE;
	function __construct()
	{
		parent::__construct();
	}
}


