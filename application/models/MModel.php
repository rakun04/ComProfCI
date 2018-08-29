<?php
  class MModel extends CI_Model{
        var $table;
        var $column_order;
        var $column_search;
        var $order;
        var $where='';
        var $id;
        var $join_ref="";
        var $join="";

        public function set_data($var,$value){
            $this->$var = $value;
        }

      private function _get_datatables_query(){

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item)
        {
            if($_POST['search']['value'])
            {

                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

         if($this->join!==''){
             $this->db->join($this->join_ref,$this->join);
         }

        if($this->where!==''){
            $this->db->where($this->where);
        }
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function add($namatabel,$data=array())
  {
    $this->db->insert($namatabel, $data);
    $this->db->affected_rows();
  }

  function update($field,$id,$namatabel,$data=array())
  {
    $this->db->where($field,$id);
    $this->db->update($namatabel,$data);
  }

  function hapus($field,$id,$namatabel)
  {
    $this->db->where($field,$id);
    $this->db->delete($namatabel);
  }

  public function get($sql)
  {
    $query = $this->db->query($sql);
    return ($query->num_rows() > 0) ? $query->row() : FALSE ;
  }

   function getData($test)
  {
    $query=$this->db->query($test);
    return ($query->num_rows() > 0) ? $query->result_array() : FALSE ;
  }

  public function getLimit($page=0,$order,$limit,$table)
  {
     if($this->join!==''){
         $this->db->join($this->join_ref,$this->join);
     }

    if($this->where!==''){
        $this->db->where($this->where);
    }
    $this->db->order_by($order,'DESC')->limit($limit,$page);

    $query=$this->db->get($table);


    return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
  }

  public function getMax($field,$table)
    {
      $query = $this->db->select_max($field,'ID');
      $query = $this->db->get($table);
      $result = $query->result();
      return $result[0]->ID;
    }

  }
