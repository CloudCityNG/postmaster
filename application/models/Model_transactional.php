<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transactional extends CI_Model
{
  private $transactional_table = 'transactional';
  private $label_table = 'label';
  private $message_table = 'message';

  function create($message_id)
  {
    $this->db->set('message_id', $message_id);
    $this->db->insert($this->transactional_table);
  }

  function get($message_id)
  {
    $this->db->limit(1);

    $this->db->select($this->message_table.'.*');
    $this->db->select($this->label_table.'.label_id');
    $this->db->select($this->label_table.'.name AS label');

    $this->db->join($this->message_table, $this->message_table.'.message_id = '.$this->transactional_table.'.message_id');
    $this->db->join($this->label_table, $this->label_table.'.label_id = '.$this->transactional_table.'.label_id', 'LEFT');

    $this->db->where($this->transactional_table.'.message_id', $message_id);
    $query = $this->db->get($this->transactional_table);
    return $query->row_array();
  }

  function get_list()
  {
    $this->db->limit(50);

    $this->db->select($this->message_table.'.*');
    $this->db->select($this->label_table.'.name AS label');

    $this->db->order_by($this->message_table.'.message_id', 'DESC');

    $this->db->join($this->message_table, $this->message_table.'.message_id = '.$this->transactional_table.'.message_id');
    $this->db->join($this->label_table, $this->label_table.'.label_id = '.$this->transactional_table.'.label_id', 'LEFT');

    // $this->db->where('published >', '1000-01-01 00:00:00');
    
    $query = $this->db->get($this->transactional_table);
    return $query->result_array();
  }

  function update($message_id, $label_id)
  {
    $this->db->set('label_id', $label_id);

    $this->db->where('message_id', $message_id);

    $this->db->update($this->transactional_table);
  }
}