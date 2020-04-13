<?php

	function  is_logged_in()
	{
		$ci = get_instance();
		if(!$ci->session->userdata('NIP_APK')){
			redirect('auth');
		}else{
			$role=$ci->session->userdata('ROLES_APK');
			$menu=$ci->uri->segment(1);
			//redirect($ci->session->userdata('PAGE_APK'));	
			//$q_menu=$ci->db->get_where('m_menu')->row_array();
			//$menu_id=$q_menu['id'];
			
			
			
			//if($userAccess->num_rows() < 1){
				//redirect('auth/block');
			//}
		}
		
	}