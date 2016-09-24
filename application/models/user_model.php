<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  Nguyen Viet Manh
 * @email   manhnv@binhhoang.com
 * @date    10.02.2011
 */
  
class User_model extends MY_Model {
    
	//private $_table = '';
	
    function __construct()
    {
        parent::__construct();
        $_table = $this->db->dbprefix('users');
        $this->load->helper('cookie');
        $this->_table = $_table;
        $this->primary_key	=	'id';
    }
    
    function login($username = '', $pass = '', $re_pass = 0, $is_admin = 0)
    {
    	//die('++++');
    	$pass	=	md5($pass);
    	if($is_admin == 1){
    		$this->db->where('g.admin',1);
    	}
    	$user	=	$this->db->select("u.*,g.name")->from("users u")->join("c_groups g","g.id=u.group_id")
    			->where('username', $username)
    			//->or_where(array('email',$user))
    			->where('password', $pass)
    			->where('active', 'yes')
    			//->where('g.admin', 1)
    			->get()->row_array();
    	
    	if(!$user)
    	{
    		$user	=	$this->db->select("u.*,g.name")->from("users u")->join("c_groups g","g.id=u.group_id")
    		->where('email', $username)
    		//->or_where(array('email',$user))
    		->where('password', $pass)
    		->where('active', 'yes')
    		//->where('g.admin', 1)
    		->get()->row_array();
    	}
        if(isset($user['id']) && $user['id'] > 0) {
            $_SESSION['user'] =	array('id' => $user['id'],'email' => $user['email'],'fullname' => $user['fullname'],'username' => $user['username'], 'group_id' => $user['group_id'], "time_login" => time());
            if($re_pass == 1)
            {
            	set_cookie('__user', $user["id"], time()+7200);//20*60*60
            }
            return true;
        }
        else return false;
    }
    
    function logout()
    {
        unset($_SESSION['user']);
        delete_cookie('__user');
        return true;
    }
    
    function get_by_id_to_array($mid = NULL)
    {
    	$member	=	$this->db->select()->from($this->_table)->where('id',$mid)->get()->row_array();
    	if($member)
    	{
    		return $member;
    	}
    	return NULL;
    }
    
    function check_permission($controller = '', $method = '')
    {
        $allow   = true;
        /*
        $user    = $_SESSION['_admin'];
        if($user['group_id'] == 1) $allow = true;
        $all_per = $this->db->from('modules as m')->join('permissions as p','m.id=p.module_id')->where('group_id', $user['group_id'])
                            ->where_in('m.name', array('*', $controller))
                            ->where_in('method', array('*', $method))
                            ->get()
                            ->result_array();

        if(count($all_per) < 1) {
            return false;
        }
        
        //print_r($all_per);
        
        foreach($all_per as $per) {
            if($per['status'] == 'active') $allow = true;
            else {$allow = false;break;}
        }*/

        return $allow;
    }
    
    function get_group_list()
    {
        return $this->db->order_by('group_name ASC')->get('user_groups')->result_array();
    }
    
    function check_exist($username = '')
    {
        $u = $this->get_by('username', $username);
        
        if(isset($u->id) && $u->id > 0) return true;
        else return false;
    }
    
    
}
