<?php
class Calendar {

  private $active_year, $active_month, $active_day;
  private $events = [];

  public function __construct($date = null) {
      $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
      $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
      $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
  }

  public function add_event($txt, $date, $days = 1, $color = '') {
      $color = $color ? ' ' . $color : $color;
      $this->events[] = [$txt, $date, $days, $color];
  }

  public function __toString() {
      $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
      $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
      $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
      $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
      $html = '<div class="calendar container">';
      $html .= '<div class="header row">';
      $html .= '<div class="month-year col-md-12">';
      $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
      $html .= '</div>';
      $html .= '</div>';
      $html .= '<div class="days row">';
      
 
      foreach ($days as $day) {
          $html .= '<div class="day_name col-md-1">'.$day.'</div>';
      }

      for ($i = $first_day_of_week; $i > 0; $i--) {
          $html .= '<div class="day_num ignore col-md-1">'.($num_days_last_month - $i + 1).'</div>';
      }

      for ($i = 1; $i <= $num_days; $i++) {
          $is_event_date = false;  
          foreach ($this->events as $event) {
              
              if (date('Y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i)) == date('Y-m-d', strtotime($event[1]))) {
                  $is_event_date = true; 
                  break;
              }
          }
          $selected = ($i == $this->active_day) ? ' selected' : '';
          $highlight = $is_event_date ? ' highlight' : ''; 

          $html .= '<div class="day_num' . $selected . $highlight . ' col-md-1">';
          $html .= '<span>' . $i . '</span>';
          foreach ($this->events as $event) {
              for ($d = 0; $d <= ($event[2]-1); $d++) {
                  if (date('Y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('Y-m-d', strtotime($event[1]))) {
                      $html .= '<div class="event' . $event[3] . '">';
                      $html .= $event[0];
                      $html .= '</div>';
                  }
              }
          }
          $html .= '</div>';
      }

      
      for ($i = 1; $i <= (42 - $num_days - max($first_day_of_week, 0)); $i++) {
          $html .= '<div class="day_num ignore col-md-1">'.$i.'</div>';
      }
      $html .= '</div>'; 
      $html .= '</div>'; 
      return $html;
  }

}
?>

<style>
 .calendar {
  display: flex;
  flex-flow: column;
}
.calendar .header .month-year {
  font-size: 20px;
  font-weight: bold;
  color: #636e73;
  padding: 20px 0;
}
.calendar .days {
  display: flex;
  flex-flow: wrap;
}
.calendar .days .day_name {
  width: calc(100% / 7);
  border-right: 1px solid #2c7aca;
  padding: 20px;
  text-transform: uppercase;
  font-size: 12px;
  font-weight: bold;
  color: rgb(226,255,223);
  color: #fff;
  background-color: #448cd6;
}
.calendar .days .day_name:nth-child(7) {
  border: none;
}
.calendar .days .day_num {
  display: flex;
  flex-flow: column;
  width: calc(100% / 7);
  border-right: 1px solid #e6e9ea;
  border-bottom: 1px solid #e6e9ea;
  padding: 15px;
  font-weight: bold;
  color: #000000;
  cursor: pointer;
  min-height: 100px;
}
.calendar .days .day_num span {
  display: inline-flex;
  width: 30px;
  font-size: 14px;
}
.calendar .days .day_num .event {
  margin-top: 10px;
  font-weight: 500;
  font-size: 14px;
  padding: 3px 6px;
  border-radius: 4px;
  background-color: #f7c30d;
  color: #fff;
  word-wrap: break-word;
}
.calendar .days .day_num .event.green {
  background-color: #51ce57;
}
.calendar .days .day_num .event.blue {
  background-color: #518fce;
}
.calendar .days .day_num .event.red {
  background-color: #ce5151;
}
.calendar .days .day_num:nth-child(7n+1) {
  border-left: 1px solid #e6e9ea;
}
.calendar .days .day_num:hover {
  background-color: #fdfdfd;
}
.calendar .days .day_num.ignore {
  background-color: #fdfdfd;
  color: #ced2d4;
  cursor: inherit;
}
.calendar .days .day_num.selected {
  background-color: #f1f2f3;
  cursor: inherit;
}


</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">