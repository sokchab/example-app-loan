<?php

namespace App\Helpers;

use App\Trans\Cols\CollectionSheet;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Holiday;

class Helper
{
    public static function pmt($rate, $nper, $pv, $fv = 0, $type = 0)
    {
        if ($rate > 0 )
			return -(-$fv - $pv * pow(1 + $rate, $nper)) /
				(1 + $rate * $type) /
				((pow(1 + $rate, $nper) - 1) / $rate);
		
		else 
			return 0;
    }


    public static function rate($rate)
    {
        return floatval($rate / 100);
    }

    public static function collections($val){
        return CollectionSheet::byLoan($val)->hasCollection()->notReturn()->get();
    }

    public static function overdues($val){
        return CollectionSheet::byLoan($val)->hasOverdue()->notReturn()->get();
    }

    public static function getCurrentWeekOfMonth(){
        $now = Carbon::now();
        $monthStart = $now->startOfMonth();
        $monthEnd = $now->endOfMonth();

        return [
            'start' => $monthStart,
            'end' => $monthEnd
        ];
    }

    public static function getDaysOfWeekFromMonth(){
        $data = array();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->startOfMonth()->endOfWeek();

        $start = date($startOfMonth);
        $end = date($endOfMonth);

        for ($i = 1; $i <= Carbon::now()->endOfMonth()->weekOfMonth; $i++)
        {
            if($i == Carbon::now()->endOfMonth()->weekOfMonth)
                $end = date(Carbon::now()->endOfMonth());

            $data[] = [
                'start' =>  $start,
                'end'  => $end
            ];

            $d = Carbon::parse($end);
            $d->addDays(1);

            $start = date($d->startOfWeek());
            $end = date($d->endOfWeek());

        }

        return $data;
    }


    public static function shortNumeric($n, $precision = 1){
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }

        return $n_format . $suffix;
    }

    public static function paymentCalculator($loan, $term, $rate, $ratePer = 1)
    {
        $resultLoan = floatval($loan/$term);
        $resultInterest =  floatval($loan*($rate/100)*$ratePer);
        return ceil($resultLoan) + ceil($resultInterest);
    }

    private static function mb_str_split( $string ) { 
        //Split at all position not after the start: ^ 
        //and not before the end: $ 
        return preg_split('/(?<!^)(?!$)/u', $string ); 
    }

    public static function num2khtext($complete_char,$enableThousand){
        
        $cat = explode( ".", $complete_char);
        if(floatval($cat[0]) == 0) { 
            return "សូន្យ";
        }

        // echo ‘Read In Thousand: ’.num2khtext(“11989”,true);
        // echo ‘Not Read In Thousand: ’.num2khtext(“11989”,false);
        //function for split uft8 character		
        //remove left zeros
        $cleanStr = ltrim($complete_char, '0');	
        //split number/string to array
        $num_arr = self::mb_str_split($cleanStr);	
        $translated=''; $addThousand=false;
        //string array
        $khNUMTxt = array('','មួយ','ពីរ','បី','បួន','ប្រាំ');
        $twoLetter = array('','ដប់','ម្ភៃ','សាមសិប','សែសិប','ហាសិប','ហុកសិប','ចិតសិប','ប៉ែតសិប','កៅសិប');
        $khNUMLev = array('','','','រយ','ពាន់','មឿន','សែន','លាន');
        $khnum = array('០','១','២','៣','៤','៥','៦','៧','៨','៩');
        //loop to check each number character
        foreach($num_arr as $key=>$value){
        //convert khmer number to latin number if found
        if(in_array($value,$khnum)){$value = array_search($value,$khnum);}
        //allow only number
        if(!is_numeric($value)){return '';}
        //check what pos the charactor in
        $pos = count($num_arr) - ($key);
        if($pos>count($khNUMLev)-1){$pos=($pos % count($khNUMLev))+2;}
        //enable or diable read in thousand
        if($enableThousand and ($pos == 5 or $pos == 6)){$pos = $pos-3;}
        //concatenate number as text
        if($pos==2){
        $translated .= $twoLetter[$value];
        }else{
        if($value>5){$translated .=  $khNUMTxt[5].$khNUMTxt[$value - 5];}else{$translated .= $khNUMTxt[$value];}
        }
        //work for thousand
        if($pos==2 or $pos == 3 or $pos == 4){
        if($value>0){$addThousand=true;}
        }
        //concatenate number level
        if($value>0 or ($pos==4 and $addThousand and $enableThousand) or $pos==7){
        $translated .= $khNUMLev[$pos];			
        }
        //make addthousand to default value (false)
        if($pos==4){$addThousand=false;}		
        }
        //return the complete number in text
        return $translated;
    }

    public static function float2khtext($char,$enable, $enablePre=false)
    {

        // $valu = self::str2num($char);
        // $valu = (float)$char;
        

        // $str = explode( ".", $valu);
        $str = explode( ".", $char);
        //
        if(sizeof($str) == 1)
            return self::num2khtext($char, $enable);
        
        $pre = "";
        $cleanStr1 = rtrim($str[1], '0');
        //
        if(floatval($cleanStr1) > 0) {

            $pre = "ចុច";

            $arrs = str_split($cleanStr1);
            foreach($arrs as $p){  
                if($p == "0")
                    $pre .= "សូន្យ";
                //else 
                  //  $pre .= self::num2khtext($p, $enable);
            }

            return self::num2khtext($str[0], $enable) . $pre . self::num2khtext($cleanStr1, $enablePre);
        }

        // return self::num2khtext($str[0], $enable) . $pre . self::num2khtext($str[1], $enablePre);
        
        // return $str = explode( ".", $valu );
        // return $str;
        return self::num2khtext($str[0], $enable);// . $pre . self::num2khtext($cleanStr1, $enablePre);
    }

    public static function str2num($str)
    {
        if (strpos($str, '.') !== FALSE && strpos($str,    ',') !== FALSE && strpos($str, '.') < strpos($str,','))
            {
                $str = str_replace('.','',$str);
                $str = strtr($str,',','.');           
            }
            else
            {
                $str = str_replace(',','',$str);           
            }
        
            return (float)$str;
    }

    public static function convertNumberToWord($num = false)
    {
        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
            } else {
                $tens = (int)($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }


    public static function holiday($start)
    {
        //$start = \Carbon\Carbon::now()->startOfMonth();
        $day = 0;
        for($x=$start; $x<= \Carbon\Carbon::now(); $x->addDays(1)){
            if($x->format('l') == 'Sunday' || 
               $x->format('l') == 'Saturday') 
                continue;
            $day += 1;
        }
        return $day;
    }

    public static function baseHoliday($start)
    {
        // Holiday::isHoliday($dd)->count();
        return Holiday::whereBetween('holiday', [
            $start, \Carbon\Carbon::now()
        ])->count();
    }


    public static function getWeekendDays($startDate, $endDate) : int
    {
        $count = 0;
        $period = CarbonPeriod::create()->setDates($startDate, $endDate);
        foreach ($period as $d){
            if ($d->isSunday() || $d->isSaturday())
                $count += 1;
        }
        return $count;
    }

    public static function phoneVerify($str) : string
    {
        $str = preg_replace('/\s+/', '', $str);
        $str = explode( "_", $str);
        return $str[0];
    }

    public static function phoneDisplay($from) : string
    {
        // $from = "+11234567890";
        return sprintf("%s %s %s",
            substr($from, 0, 3),
            substr($from, 3, 3),
            substr($from, 6));
        // $matches = array();
        // if(  preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $from,  $matches ) )
        // {
        //     $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
        //     return $result;
        // }
        // return null;
    }

    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

//isoFormat('Do')
