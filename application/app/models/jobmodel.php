<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jobmodel extends CI_Model{
  
            public function get_job_cloud()
    {
            $sql="select category,subcategory,count(job_id) as total from job_categories 
                left join categories on job_categories.category_id=categories.id group by subcategory order by category,subcategory";
            
    
            $query=$this->db->query($sql);
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }
    
                public function get_job_cloud_categories()
    {
            $sql="select category,count(distinct job_id) as total from job_categories 
                left join categories on job_categories.category_id=categories.id group by category order by category";
            
    
            $query=$this->db->query($sql);
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }
    
        public function get_categories()
    {
            $sql="select distinct category from categories";
            
            
            $query=$this->db->query($sql);
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }
    
            public function get_subcategories($order='category',$category='')
    {
            $sql="select distinct id,category,subcategory from categories where category like '%$category%' order by $order";
    
            
            $query=$this->db->query($sql);
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }
    
    public function get_jobs($limit=10,$offset=0,$search='',$budgettype='',$subcategory='',$category='')
    {
            
            $sql="select job.*,group_concat(subcategory) as categories from job left join job_categories on job_categories.job_id=job.id left join categories on categories.id=job_categories.category_id 
                where (job.title like '%$search%' or job.description like '%$search%') and job.budgettype like '%$budgettype%' and categories.subcategory like '%$subcategory%' and categories.category like '%$category%' group by job.id order by job.id desc limit $limit offset $offset";
            
    

            $query=$this->db->query($sql);
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }
    
        public function get_jobs_count($search='',$budgettype='',$subcategory='',$category='')
    {
            $sql="SELECT count(distinct job.id) as total from job 
            left join job_categories on job_categories.job_id=job.id left join categories on categories.id=job_categories.category_id 
            where job.title like '%$search%' and job.budgettype like '%$budgettype%' and categories.subcategory like '%$subcategory%' and categories.category like '%$category%'";
               
         
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
                    return 0;
                }
    }
    
            public function get_client_jobs_count($search,$budgettype)
    {
            $sql="SELECT count(job.id) as total from job 
                left join users on users.id=job.client_id where client_id='$id'";
                       
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
                    return 0;
                }
    }
    
    public function get_client_jobs($id)
    {
            $sql="SELECT job.*,users.company,users.firstname,users.lastname,users.id as user_id from job left join users on users.id=job.client_id where client_id='$id' order by id desc";
            $query=$this->db->query($sql);
            //echo $sql;
            
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }
    
        public function get_job($id)
    {
            $sql="SELECT group_concat(subcategory) as categories,job.*,users.company,users.firstname,users.lastname,users.id as user_id FROM job 
            left join job_categories on job_categories.job_id=job.id left join categories on categories.id=job_categories.category_id left join users on users.id=job.client_id where job.id='$id'";

           // echo $sql;
            
            $query=$this->db->query($sql);
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }
    
            public function get_board($job_id)
    {
            $sql="SELECT board.*,users.firstname,users.lastname FROM board left join users on users.id=board.user_id where job_id='$job_id' order by board.id desc";

            $query=$this->db->query($sql);
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }
    
                public function get_bid($job_id)
    {
            $sql="SELECT users.*,job.*,bid.*,bid.dateposted as biddateposted,bid.id as bid_id,bid.status as bid_status FROM bid left join users on users.id=bid.candidate_id left join job on job.id=bid.job_id where job_id='$job_id' order by bid.id desc";
            $query=$this->db->query($sql);
    
               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }

    public function get_candidate_bid_count($candidate_id)
    {
            $sql="SELECT count(id) as total FROM bid where candidate_id='$candidate_id'";
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
    
    
public function get_candidate_bid($limit=10,$offset=0,$candidate_id)
    {
            $sql="SELECT job.*,users.*,bid.*,bid.dateposted as biddateposted FROM bid left join users on users.id=bid.candidate_id left join job on job.id=bid.job_id where candidate_id='$candidate_id' limit $limit offset $offset";
            $query=$this->db->query($sql);

               if($query->num_rows()>0)
               {
                   // success
                   foreach ($query->result() as $row)
                    {
                   $data[] = $row;
                    } 
                   return $data;
               }
                else
                {
                    return null;
                }
    }
    
    public function add_job($title,$description,$budget,$budgettype,$category,$currency,$bidperiod,$client_id){
        
        
        date_default_timezone_set('GMT');
        $dateposted=date('y-m-j H:i:s');
        
        $sql = " INSERT INTO job (title,description,budget,budgettype,currency,bidperiod,dateposted,status,client_id)
  VALUES(" . 
                $this->db->escape($title) . ",". 
                $this->db->escape($description) . ",".
                $this->db->escape($budget) . ",".
                $this->db->escape($budgettype) . ",".
                $this->db->escape($currency) . ",".
                $this->db->escape($bidperiod) . ",".
                $this->db->escape($dateposted) . ",".
                "'Bidding Stage',".
                $this->db->escape($client_id) .") ";
       
        
        $this->db->query($sql);        
        $job_id=$this->db->insert_id();
        
        foreach($category as $categoryitem) {
            $sql="insert into job_categories (category_id,job_id) values ('".$categoryitem."','".$job_id."')";
            $this->db->query($sql);
            
        }
        
        return $job_id;
    }
    
        
    public function add_board($user_id,$job_id,$description)
    {
        date_default_timezone_set('GMT');
        $dateposted=date('y-m-j H:i:s');
        
        $sql = " INSERT INTO board (user_id,job_id,dateposted,description)
  VALUES(" . 
                $this->db->escape($user_id) . ",". 
                $this->db->escape($job_id) . ",".
                $this->db->escape($dateposted) . ",".
                $this->db->escape($description) .") ";


        
        $this->db->query($sql);
    }
    
            
    public function add_bid($user_id,$job_id,$amount)
    {
        date_default_timezone_set('GMT');
        $dateposted=date('y-m-j H:i:s');
        
        $sql="delete from bid where candidate_id='$user_id' and job_id='$job_id'";
        $this->db->query($sql);
        
        $sql = " INSERT INTO bid (candidate_id,job_id,dateposted,status,amount)
  VALUES(" . 
                $this->db->escape($user_id) . ",". 
                $this->db->escape($job_id) . ",".
                $this->db->escape($dateposted) . ",".
                $this->db->escape("Pending") . ",".
                $this->db->escape($amount) .") ";

        
        $this->db->query($sql);
    }
    
        public function update_job_status($job_id,$status)
    {
        date_default_timezone_set('GMT');
        $dateposted=date('y-m-j H:i:s');
        
        $sql="update job set status='$status' where id='$job_id'";
       
        
        $this->db->query($sql);

    }
    
            public function update_bid_status($bid_id,$status)
    {
        date_default_timezone_set('GMT');
        $dateposted=date('y-m-j H:i:s');
        
        $sql="update bid set status='$status' where id='$bid_id'";
        
        echo $sql;
        
        $this->db->query($sql);

    }
    
}
?>
