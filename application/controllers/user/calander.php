<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* author : Moch Zawaruddin Abdullah
*  website: zawaruddin.blogspot.com
*  email  : frodo_baggins777@yahoo.com
*/

class Calander extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('util/calander_model', 'calander');
		$this->load->library('calendar', $this->_setting());
                
	}
	
	function index(){
		redirect('user/calander/notes');
	}
	
	// untuk konversi nama bulan
	function _month($mon){
		$mon = (int) $mon;
		switch($mon){
			case 1 : $mon = 'Januari'; Break;
			case 2 : $mon = 'Februari'; Break;
			case 3 : $mon = 'Maret'; Break;
			case 4 : $mon = 'April'; Break;
			case 5 : $mon = 'Mei'; Break;
			case 6 : $mon = 'Juni'; Break;
			case 7 : $mon = 'Juli'; Break;
			case 8 : $mon = 'Agustus'; Break;
			case 9 : $mon = 'September'; Break;
			case 10 : $mon = 'Oktober'; Break;
			case 11 : $mon = 'November'; Break;
			case 12 : $mon = 'Desember'; Break;
		}
		return $mon;
	}
	
	// untuk menambahkan catatan pada tanggal
	function add_note($date){
		$data = array(
					'day'   => $date,
					'mon'   => $this->input->post('mon'),
					'month' => $this->_month($this->input->post('mon')),
					'year'  => $this->input->post('year'),
				);
		$this->load->view('util/calander/add_note', $data);
	}
	
	// aksi insert catatan
	function do_add($year, $mon, $day){
		$this->calander->addNote($year, $mon, $day, $this->input->post('note', true));
		$this->notes($year, $mon);
	}
	
	// menampilkan opsi untuk menghapus atau edit catatan
	function updel_note($date){
		$data = array(
					'day'   => $date,
					'mon'   => $this->input->post('mon'),
					'month' => $this->_month($this->input->post('mon')),
					'year'  => $this->input->post('year'),
					'note'  => $this->calander->getNote($this->input->post('year'), $this->input->post('mon'), $date)
				);
		$this->load->view('util/calander/updel_note', $data);
	}
	
	// aksi untuk edit catatan
	function edit_note($year, $mon, $day){
		$this->calander->editNote($year, $mon, $day, $this->input->post('note', true));
		$this->notes($year, $mon);
	}
	
	// aksi untuk hapus catatan
	function delete_note($year, $mon, $day){
		$this->calander->deleteNote($year, $mon, $day);
		$this->notes($year, $mon);
	}
	
	// fungsi utama untuk menampilkan kalender catatan
	function notes($year = null, $mon = null){
		$year = (empty($year) || !is_numeric($year))?  date('Y') :  $year;
		$mon  = (empty($mon) || !is_numeric($mon))?  date('m') :  $mon;
		
		$date = $this->calander->getCalendar($year, $mon);
		$data = array(
					'notes' => $this->calendar->generate($year, $mon, $date),
					'year'  => $year,
					'mon'   => $mon
				);
		$this->load->view('util/calander/mynotes', $data);
	}
	
	// setting tampilan kalender
	function _setting(){
		return array(
			'start_day' 		=> 'sunday',
			'show_next_prev' 	=> true,
			'next_prev_url' 	=> site_url('user/calander/notes'),
			'month_type'   		=> 'long',
            'day_type'     		=> 'short',
			'template' 			=> '{table_open}<table class="date">{/table_open}
								   {heading_row_start}&nbsp;{/heading_row_start}
								   {heading_previous_cell}<caption><a href="{previous_url}" class="prev_date" title="Previous Month">&lt;&lt;</a>{/heading_previous_cell}
								   {heading_title_cell}{heading}{/heading_title_cell}
								   {heading_next_cell}<a href="{next_url}" class="next_date"  title="Next Month">&gt;&gt;</a></caption>{/heading_next_cell}
								   {heading_row_end}<col class="weekend_sun"><col class="weekday" span="5"><col class="weekend_sat">{/heading_row_end}
								   {week_row_start}<thead><tr>{/week_row_start}
								   {week_day_cell}<th>{week_day}</th>{/week_day_cell}
								   {week_row_end}</tr></thead><tbody>{/week_row_end}
								   {cal_row_start}<tr>{/cal_row_start}
								   {cal_cell_start}<td>{/cal_cell_start}
								   {cal_cell_content}<a href="'.site_url('user/calander/updel_note').'/{day}" class="act_note" title="Edit/hapus catatan untuk tanggal {day}"><div class="active act_note" val="{day}" title="Edit/Hapus catatan untuk tanggal {day}">{day}</div></a><div class="notes">{content}</div></div>{/cal_cell_content}
								   {cal_cell_content_today}<a href="'.site_url('user/calander/updel_note').'/{day}" class="act_note" title="Edit/hapus catatan untuk tanggal {day}"><div class="t_active" title="Edit/Hapus catatan untuk tanggal {day}">{day}</div></a><div class="t_notes">{content}</div>{/cal_cell_content_today}
								   {cal_cell_no_content}<a href="'.site_url('user/calander/add_note').'/{day}" class="act_note" title="Tambah catatan untuk tanggal {day}"><div class="day" title="Tambah catatan untuk tanggal {day}">{day}</div></a>{/cal_cell_no_content}
								   {cal_cell_no_content_today}<a href="'.site_url('user/calander/add_note').'/{day}" class="act_note" title="Tambah catatan untuk tanggal {day}"><div class="today" title="Tambah catatan untuk tanggal {day}">{day}</div></a>{/cal_cell_no_content_today}
								   {cal_cell_blank}&nbsp;{/cal_cell_blank}
								   {cal_cell_end}</td>{/cal_cell_end}
								   {cal_row_end}</tr>{/cal_row_end}
								   {table_close}</tbody></table>{/table_close}');
	}
}