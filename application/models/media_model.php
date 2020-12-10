<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Media_model extends CI_Model
{
	public $file_types = array(
		'pdf' => 'text',
		'docx' => 'text',
		'doc' => 'text',
		'txt' => 'text',
		'mp4' => 'audio',
		'mp3' => 'audio',
		'jpg' => 'image',
		'jpeg' => 'image',
		'png' => 'image',
		'gif' => 'image',
	);
	function get_type($ext = "")
	{
		if ($ext != null) {
			if (key_exists($ext, $this->file_types)) {
				return $this->file_types[$ext];
			} else {
				return 'others';
			}
		}
	}

	function get_media($ext = null)
	{
		if ($ext != null) {
			$this->db->where('media_type', $ext);
		}

		$this->db->order_by('media_id', 'DESC');
		return json_encode($this->db->get('media')->result_array());
	}
}
