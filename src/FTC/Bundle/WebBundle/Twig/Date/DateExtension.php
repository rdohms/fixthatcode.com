<?php
namespace FTC\Bundle\WebBundle\Twig\Date;

class DateExtension extends \Twig_Extension {

    public function getFilters()
    {
        return array(
            'daysAgo'    => new \Twig_Filter_Method($this, 'daysAgoFilter')
        );
    }

    public function getName()
    {
        return 'DateExtension';
    }

    public static function daysAgoFilter($date)
    {
        $display = array('year', 'month', 'day', 'hour', 'minute', 'second');
        $ago = 'ago';

        $date = getdate($date->getTimestamp());
        $current = getdate();
        $p = array('year', 'mon', 'mday', 'hours', 'minutes', 'seconds');
        $factor = array(0, 12, 30, 24, 60, 60);

        for ($i = 0; $i < 6; $i++) {
            if ($i > 0) {
                $current[$p[$i]] += $current[$p[$i - 1]] * $factor[$i];
                $date[$p[$i]] += $date[$p[$i - 1]] * $factor[$i];
            }
            if ($current[$p[$i]] - $date[$p[$i]] > 1) {
                $value = $current[$p[$i]] - $date[$p[$i]];
                return $value . ' ' . $display[$i] . (($value != 1) ? 's' : '') . ' ' . $ago;
            }
        }

        return '';
    }
}