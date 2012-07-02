<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usermodel extends CI_Model{

    /**
     * returns a list of articles
     * @return array
     */
 
public function user_exist($email)
    {

        $this->db->where('email', $email);
        $this->db->from('users');
        return $this->db->count_all_results();
    
    }
public function get_user_role($id)
    {
    
    }    
    
public function get_user_permissions($id)
    {
        $this->db->where('id', $id);
        $this->db->from('users');
        $query=$this->db->get();
        //echo "DEBUG SQL=".$this->db->last_query();  // debug
    if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }
 
        return $data[0]->permissions;
    }
    else
    {
        return FALSE;
    }
    
    }
    
      

    
public function create_linkedin_user($linkedin_id)
    {
        $check=$this->get_linkedin_scraperbaseid($linkedin_id);
        
        if (!$check){
        $data = array(
               'linkedin_id' => $linkedin_id,
               'account' => "linkedin"
            );

        $this->db->insert('`users`', $data); 
        return $this->db->insert_id();
        }
        else
        {
        return "EXISTS";
        }
    
    }
    
          public function get_linkedin_scraperbaseid($linkedin_id)
    {
        $this->db->where('linkedin_id', $linkedin_id);
        $this->db->from('`users`'); 
        $query=$this->db->get();
 
    if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }

        return $data[0]->id;
    }
    else
    {
        return FALSE;
    }
    
    }
    
             public function create_hotmail_user($id,$firstname,$lastname)
    {
        $check=$this->get_hotmail_scraperbaseid($id);
        
        if (!$check){
        $data = array(
               'hotmail_id' => $id,
               'email'=>$id,
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'account' => "hotmail"
            );

        $this->db->insert('`users`', $data); 
        return $this->db->insert_id();
        }
    
    }
    
      public function get_hotmail_scraperbaseid($id)
    {
        $this->db->where('hotmail_id', $id);
        $this->db->from('`users`'); 
        $query=$this->db->get();
 
    if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }

        return $data[0]->id;
    }
    else
    {
        return FALSE;
    }
    
    }
    
        
         public function create_google_user($id,$firstname,$lastname)
    {
        $check=$this->get_google_scraperbaseid($id);
        
        if (!$check){
        $data = array(
               'google_id' => $id,
               'email'=>$id,
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'account' => "google"
            );

        $this->db->insert('`users`', $data); 
       
       
         return $this->db->insert_id();
        }
    
    }
    
      public function get_google_scraperbaseid($id)
    {
        $this->db->where('google_id', $id);
        $this->db->from('`users`'); 
        $query=$this->db->get();
 
    if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }

        return $data[0]->id;
    }
    else
    {
        return FALSE;
    }
    
    }
    
        
    
    
    
     public function create_twitter_user($twitter_id)
    {
        $check=$this->get_twitter_scraperbaseid($twitter_id);
        
        if (!$check){
        $data = array(
            'twitter_id' => $twitter_id,
            'account' => "twitter"
            );

        $this->db->insert('`users`', $data); 
        return $this->db->insert_id();
        }
        else
        {
        return "EXISTS";
        }
    
    }
    
      public function get_twitter_scraperbaseid($twitter_id)
    {
        $this->db->where('twitter_id', $twitter_id);
        $this->db->from('`users`'); 
        $query=$this->db->get();
 
    if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }

        return $data[0]->id;
    }
    else
    {
        return FALSE;
    }
    
    }
    
    
    
        public function create_facebook_user($facebook_id,$email)
    {
        $check=$this->get_facebook_scraperbaseid($facebook_id);
        
        if (!$check){
        $data = array(
            'email' => $email,
               'facebook_id' => $facebook_id,
            'account' => "facebook"
            );

        $this->db->insert('`users`', $data); 
        return $this->db->insert_id();
        }
    
    }
    
      public function get_facebook_scraperbaseid($facebook_id)
    {
        $this->db->where('facebook_id', $facebook_id);
        $this->db->from('`users`'); 
        $query=$this->db->get();
 
    if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }

        return $data[0]->id;
    }
    else
    {
        return FALSE;
    }
    
    }
    
            public function get_users_count($type='candidate',$keyword='')
    {
            $sql="SELECT count(id) as total from users where description like '%$keyword%'";
               
            //echo $sql;
            
            $query=$this->db->query($sql);
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data[0]->total;
               }
                else
                {
                    return null;
                }
    }
    
    
        public function get_users($limit=5,$offset=0,$type='candidate',$keyword='')
        {
       $sql="select * from users where firstname<>'' and description like '%$keyword%' and permissions='$type' limit $limit offset $offset";
        $query=$this->db->query($sql);
    //  echo "DEBUG SQL=".$this->db->last_query();  // debug

            if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }

        return $data;
    }
    else
    {
        return FALSE;
    }
    }
    
           public function get_user($id)
        {
       $sql="select * from users where id=$id";
        $query=$this->db->query($sql);
      //echo "DEBUG SQL=".$this->db->last_query();  // debug
            if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }

        return $data;
    }
    else
    {
        return FALSE;
    }
    }
    
               public function get_user_firstname($id)
        {
       $sql="select firstname,lastname from users where id=$id";
        $query=$this->db->query($sql);
      //echo "DEBUG SQL=".$this->db->last_query();  // debug
            if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }
       
        $stuff=$data[0]->firstname.' '.$data[0]->lastname;
        return $stuff;
    }
    else
    {
        return FALSE;
    }
    }
    
    public function update_logintime($id)
    {
        $time=time();
       $sql="update users set login_date=now() where id='$id'";
        $query=$this->db->query($sql);
     // echo "DEBUG SQL=".$this->db->last_query();  // debug
    }
    
    
        public function update_photo_user($id,$filename)
    {
    
       $sql="update users set image_url='$filename' where id='$id'";
        $query=$this->db->query($sql);
      echo "DEBUG SQL=".$this->db->last_query();  // debug
    }
        public function update_user($id,$firstname,$lastname,$company,$description)
    {
            
       $firstname=$this->db->escape($firstname);
       $lastname=$this->db->escape($lastname);
       $company=$this->db->escape($company);
       $description=$this->db->escape($description);
    
            
       $sql="update users set firstname=$firstname,lastname=$lastname,description=$description,company=$company where id=$id";
       $query=$this->db->query($sql);
      //echo "DEBUG SQL=".$this->db->last_query();  // debug
    }
    
    public function update_skill_user($id,$skillname,$skillrating)
    {
       $id=$this->db->escape($id);   
       $skillname=$this->db->escape($skillname);
       $skillrating=$this->db->escape($skillrating);
 
       $sql="insert into skills (name,rating,user_id) values ($skillname,$skillrating,$id)";
       $query=$this->db->query($sql);
      //echo "DEBUG SQL=".$this->db->last_query();  // debug
    }
    
            public function add_wall($id,$post)
    {
            
       //$post=$this->db->escape($post);
       $post=urlencode($post);
  
       $sql="insert into wall (user_id,post) values ('$id','$post')";
       $query=$this->db->query($sql);
      //echo "DEBUG SQL=".$this->db->last_query();  // debug
    }
    
public function get_wall($id)
        {
       $sql="select * from wall where user_id=$id";
        $query=$this->db->query($sql);
      //echo "DEBUG SQL=".$this->db->last_query();  // debug
            if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }
       
        return $data;
    }
    else
    {
        return FALSE;
    }
    }

    public function get_skills($id)
        {
       $sql="select * from skills where user_id=$id";
        $query=$this->db->query($sql);
      //echo "DEBUG SQL=".$this->db->last_query();  // debug
            if($query->num_rows()>0)
    {
        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }
       
        return $data;
    }
    else
    {
        return FALSE;
    }
    }
     
        public function delete_skills($id)
        {
       $sql="delete from skills where user_id=$id";
        $query=$this->db->query($sql);
      //echo "DEBUG SQL=".$this->db->last_query();  // debug
    }

        public function create_user($email,$password,$key,$accounttype)
    {
        $data = array(
               'email' => $email,
               'password' => $password,
               'description' => '',
               'permissions' => $accounttype,
               'verify' => $key,
            'account' => "local"
            );

        $this->db->insert('users', $data); 
        
        
    
    }
    
    public function check_email_exists($email)
    {

            $sql="SELECT * FROM `users` WHERE (email = '{$email}')";

            echo $sql;
            
            $query=$this->db->query($sql);
               if($query->num_rows()>0)
               {

                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                   return $data;
                    } 
               }
                else
                {
                    return null;
                }
    }
    
     public function authenticate($email,$password)
    {
         $email=$this->db->escape($email);
         $password=$this->db->escape($password);
         
            $sql="SELECT * FROM `users` WHERE (email = $email) and (password = $password)";
            
            $query=$this->db->query($sql);
             
               if($query->num_rows()>0)
               {

                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                   echo "ID=".$data[0]->id;
                   return $data[0]->id;
                    } 
               }
                else
                {
                    return null;
                }
    }
    
    
    public function verify($email,$key)
    {
        $this->db->where('email', $email);
        $this->db->where('verify', $key);
        $this->db->from('users');
        $result=$this->db->count_all_results(); 
        
        if ($result==1){
            $data = array(
               'email' => $email,
               'verified' => 'true',
            );
            
            $this->db->where('email', $email);
            $this->db->update('users', $data); 
            
        
        }
        return $result;
    }
    

}
?>
