<?php

function e($html) {
    return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', true);
}

// DATE CHECK CREATE

function createDateDifference($date){

    $date1 = new DateTime($date); 
    $date2 = new DateTime('now'); 
  
    $interval = $date1->diff($date2);
  
    $years = $interval->y;
    $months = $interval->m;
    $days = $interval->d;
    $hours = $interval->h;
    $minutes = $interval->i;
  
    $output = [];
  
    if ($years > 0) {
        $output[] = $years . ' Jahr' . ($years > 1 ? 'e' : '');
    }
  
    if ($months > 0 && $years == 0) {
        $output[] = $months . ' Monat' . ($months > 1 ? 'e' : '');
    } elseif ($months > 0) {
        $output[] = $months . ' Monate';
    }
  
    if ($days > 0 && $years == 0 && $months == 0) {
        $output[] = $days . ' Tag' . ($days > 1 ? 'e' : '');
    }
  
    if (count($output) == 0) {
        if ($hours > 0) {
            $output[] = $hours . 'h';
            if ($minutes > 0) {
                $output[] = $minutes . 'min';
            }
        } elseif ($minutes > 0) {
            $output[] = $minutes . 'min';
        }
    }
  
    $result = implode(' ', $output);
    return $result;
  }