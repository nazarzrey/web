<?php
Class User_activity extends CI_Model{
#function activity(){

   # debug($this->session->userdata());
  #die("x");
  if($this->session->userdata('uid')){
    echo "xxx";
    //  $data['username'] = $session_data['username'];
    /*$data = array(
          'session_id'=>"",
          'ip_address'=>$session_data['ip_address'],
          'user_agent'=>$session_data['user_agent'],
          'username'=>$session_data['username'],
          'time_stmp'=>Now(),
          'user_data'=>$session_data['username']."Logged in Account"
        );
    $this->db->insert('user_activity',$data); */
        return array(
          'uid' => $this->session->userdata["uid"],
          'uname' => $this->session->userdata["uname"],
          'utype' => $this->session->userdata["utype"],
          'uem' => $this->session->userdata["uem"]
        );
    }else{
      redirect('login');
    }// Function to get the client ip address
  }
// }
?>