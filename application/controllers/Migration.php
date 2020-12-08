<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends CI_Controller {
    public function index()
	{
		if ($this->migration->current() === FALSE)
                {
                        show_error($this->migration->error_string());
                }else{
                    echo "success data created";
                }
	}
}
