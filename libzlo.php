<?php

/**
 * Naïf PHP implementation of Zamphyr Localization
 *
 * @package libzlo-php
 * @version 0.0.1~r12
 * @author Марко Кажић <marko.kazic@zamphyr.com>
 * @link http://zlo.zamphyr.com
 * @copyright Zamphyr
 * @license
 */

/**
 * Define namespace for Zamphyr
 */

namespace Zamphyr\ZLO;

/**
 * Library version
 */

define('LIBZLO_VER', '0.0.1~r12');

/**
 * Class
 */

class libzlo
{
    // Not really elegant, I get it.
    const ZLO_EXT = '.zl';
    // ZLID code for currently loaded translation.
    public $ZL_LANG;
    // Path to the translation folder.
    public $ZL_PATH;

    /**
     * Row count for currently loaded translation file,
     * subtracted for the number of empty lines in PHP implementation.
     */

    private $ZL_FILE_RED;

    /**
     * Keep initialized path of the file to use inside all methods.
     */

    private $ZL_FILE_PUT;

    /**
     * Keeps loaded file available for all methods.
     */

    private $ZL_FILE;

    function __construct($path)
    {

        $this->ZL_PATH = $path;

    }

    /**
     * Checks platform and returns proper line ending character.
     */

    private function zl2br()
    {

        return (stristr(PHP_OS, 'WIN') || stristr(PHP_OS, 'DAR')) ? "\r\n" : "\n";

    }

    /**
     * Plural check function. Takes the natural number and calculates the form
     * which needs to be printed out based on the artificial level number.
     */

    private function zlo_plural_check( &$n )
    {

        $ZL_LANG_PLURAL = substr($this->ZL_LANG, 0, 3);


        if ($ZL_LANG_PLURAL === 'ach' || $ZL_LANG_PLURAL === 'aka' || $ZL_LANG_PLURAL === 'amh' || $ZL_LANG_PLURAL === 'arn' || $ZL_LANG_PLURAL === 'bre' || $ZL_LANG_PLURAL === 'fil' || $ZL_LANG_PLURAL === 'fra' || $ZL_LANG_PLURAL === 'gun' || $ZL_LANG_PLURAL === 'lin' || $ZL_LANG_PLURAL === 'mfe' || $ZL_LANG_PLURAL === 'mlg' || $ZL_LANG_PLURAL === 'mri' || $ZL_LANG_PLURAL === 'oci' || $ZL_LANG_PLURAL === 'tgk' || $ZL_LANG_PLURAL === 'tir' || $ZL_LANG_PLURAL === 'tur' || $ZL_LANG_PLURAL === 'uzb' || $ZL_LANG_PLURAL === 'wln')

            return $nivo = ($n > 1) ? 2 : 1; // Should be fine

        elseif ($ZL_LANG_PLURAL === 'aym' || $ZL_LANG_PLURAL === 'bod' || $ZL_LANG_PLURAL === 'cgg' || $ZL_LANG_PLURAL === 'dzo' || $ZL_LANG_PLURAL === 'fas' || $ZL_LANG_PLURAL === 'ind' || $ZL_LANG_PLURAL === 'jpn' || $ZL_LANG_PLURAL === 'jbo' || $ZL_LANG_PLURAL === 'kat' || $ZL_LANG_PLURAL === 'kaz' || $ZL_LANG_PLURAL === 'kor' || $ZL_LANG_PLURAL === 'kir' || $ZL_LANG_PLURAL === 'lao' || $ZL_LANG_PLURAL === 'msa' || $ZL_LANG_PLURAL === 'mya' || $ZL_LANG_PLURAL === 'sah' || $ZL_LANG_PLURAL === 'sun' || $ZL_LANG_PLURAL === 'tha' || $ZL_LANG_PLURAL === 'tat' || $ZL_LANG_PLURAL === 'uig' || $ZL_LANG_PLURAL === 'vie' || $ZL_LANG_PLURAL === 'wol' || $ZL_LANG_PLURAL === 'zho')
        {

            return $nivo = 1;

        }
        elseif ($ZL_LANG_PLURAL === 'srp' || $ZL_LANG_PLURAL === 'bos' || $ZL_LANG_PLURAL === 'hrv' || $ZL_LANG_PLURAL === 'rus' || $ZL_LANG_PLURAL === 'ukr' || $ZL_LANG_PLURAL === 'bel' )
        {

            if ($n === 1 && $n % 100 !== 11 || $n % 10 == 1 && $n > 20)
                return $nivo = 1;
            elseif ($n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20))
                return $nivo = 2;
            else
                return $nivo = 3;

        }
        elseif ($ZL_LANG_PLURAL === 'ces' || $ZL_LANG_PLURAL === 'slk')
        {

            return $nivo = ($n==1) ? 1 : ($n>=2 && $n<=4) ? 2 : 3;

        }
        elseif ($ZL_LANG_PLURAL === 'ara')
        {

            if ($n===0)
                return $nivo = 6;
            elseif ($n===1)
                return $nivo = 1;
            elseif ($n===2)
                return $nivo = 2;
            elseif ($n%100>=3 && $n%100<=10)
                return $nivo = 3;
            elseif ($n%100>=11)
                return $nivo = 4;
            else
                return $nivo = 5;

            // $nivo = (($n==0) ? 6 : $n==1 ? 1 : $n==2 ? 2 : $n%100>=3 && $n%100<=10 ? 3 : $n%100>=11 ? 4 : 5);
        }

        elseif ($ZL_LANG_PLURAL === 'csb') {

            return $nivo = $n==1 ? 1 : $n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ? 2 : 3;

        }

        elseif ($ZL_LANG_PLURAL === 'cym') {

            return $nivo = ($n==1) ? 1 : ($n==2) ? 2 : ($n != 8 && $n != 11) ? 3 : 4;

        }

        elseif ($ZL_LANG_PLURAL === 'gle') {

            return $nivo = $n==1 ? 1 : $n==2 ? 2 : $n<7 ? 3 : $n<11 ? 4 : 5;

        }

        elseif ($ZL_LANG_PLURAL === 'gla') {

            return $nivo = ($n==1 || $n==11) ? 1 : ($n==2 || $n==12) ? 2 : ($n > 2 && $n < 20) ? 3 : 4;

        }

        elseif ($ZL_LANG_PLURAL === 'isl') {

            return $nivo = ($n%10!=1 || $n%100==11) ? 1: 2;

        }

        elseif ($ZL_LANG_PLURAL === 'cor') {

            return $nivo = ($n==1) ? 1 : ($n==2) ? 2 : ($n == 3) ? 3 : 4;

        }

        elseif ($ZL_LANG_PLURAL === 'lit') {

            return $nivo = ($n%10==1 && $n%100!=11 ? 1 : $n%10>=2 && ($n%100<10 or $n%100>=20) ? 2 : 3);

        }

        elseif ($ZL_LANG_PLURAL === 'lav') {

            return $nivo = ($n%10==1 && $n%100!=11 ? 1 : $n != 0 ? 2 : 3);

        }

        elseif ($ZL_LANG_PLURAL === 'mnk') {

            return $nivo = ($n==0 ? 1 : $n==1 ? 2 : 3);

        }

        elseif ($ZL_LANG_PLURAL === 'mlt') {

            return $nivo = ($n==1 ? 1 : $n==0 || ( $n%100>1 && $n%100<11) ? 2 : ($n%100>10 && $n%100<20 ) ? 3 : 4);

        }

        elseif ($ZL_LANG_PLURAL === 'pol') {

            return $nivo = ($n==1 ? 1 : $n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ? 2 : 3);

        }

        elseif ($ZL_LANG_PLURAL === 'ron') {

            return $nivo = ($n==1 ? 1 : ($n==0 || ($n%100 > 0 && $n%100 < 20)) ? 2 : 3);

        }

        elseif ($ZL_LANG_PLURAL === 'slv') {

            return $nivo = ($n%100==1 ? 1 : $n%100==2 ? 2 : $n%100==3 || $n%100==4 ? 3 : 0);

        }
        else
        {
        /*
            afr, arg, ast, aze, bul, ben, brx, cat, dan, deu, doi, ell, eng, epo, spa, est, eus, ful, fin, fao, fur, fry, frr, frs, glg, guj, hau, heb, hin, hne, hye, hun, ina, ita, kan, kur, ltz, mai, mal, mon, mni, mar, mkd, nah, nap, nob, nno, nor, nep, nld, sme, nso, ori, pus, pan, pap, pms, por, roh, kin, sat, sco, snd, sin, som, son, sqi, swa, swe, tam, tel, tuk, urd, yor
        */
            return $nivo = ($n != 1) ? 2 : 1;
        }

    }

    /**
     * Returns information for a translation file from header.
     * When file is not loaded returns fallback header info.
     */

    public function zlo_header($ZL_HEADER_LANG, $ZL_DM = NULL)
    {
        /**
         * Header fallback. Anti-apocalyptic measure. UTF-8 is enforced.
         * "Enforced"... such a nice word.
         */

        $ZL_HEADER_FALLBACK = array
        (
            'VAR' => 'zlo',
            'VER' => NULL,
            'REV' => NULL,
            'PRV' => NULL,
            'PRE' => NULL,
            'PRU' => NULL,
            'CHR' => 'utf-8',
            'BDO' => NULL,
            'JEZ' => $this->ZL_LANG
        );

        $trans_file = $this->ZL_PATH . $ZL_HEADER_LANG . ((is_null($ZL_DM)) ? '' : '-' . $ZL_DM) . self::ZLO_EXT;

        if ( !( $trans_file === $this->ZL_FILE_PUT ) )
        {
            if (file_exists($trans_file) && filesize($trans_file) !== 0)
            {

                $this->ZL_FILE = file($trans_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

                $this->ZL_FILE_RED = count($this->ZL_FILE);

                $this->ZL_FILE_PUT = $trans_file;

            }
            else
            {
                return $ZL_HEADER_FALLBACK;
            }
        }

        for ($i=0; $i < 16; $i++) {
            $hvalue[$i]= substr($this->ZL_FILE[$i+1], 4);
            $hname[$i] = substr($this->ZL_FILE[$i+1], 0, 3);
        }

        return $ZL_HEADER = array
        (
            $hname[0] => $hvalue[0],
            $hname[1] => $hvalue[1],
            $hname[2] => $hvalue[2],
            $hname[3] => $hvalue[3],
            $hname[4] => $hvalue[4],
            $hname[5] => $hvalue[5],
            $hname[6] => $hvalue[6],
            $hname[7] => $hvalue[7],
            'JEZ' => substr($hvalue[0],0,3)
        );
    }

        /**
     * Lists all available translation files
     * in the initialized folder for libzlo.
     */

    public function zlo_lang_list()
    {
        for ($i=0; $i < count(array_slice(scandir($this->ZL_PATH),2)); $i++)
        {
            if (stripos(array_slice(scandir($this->ZL_PATH),2)[$i], self::ZLO_EXT))
            {
                $ZL_LIST_TRANSLATIONS[$i] = array_slice(scandir($this->ZL_PATH),2)[$i];
            }
        }

        return array_values($ZL_LIST_TRANSLATIONS);
    }

    /**
     * Returns stats for a specific translation. Uses state pattern in the object
     * even though it probably doesn't need it. Loves ice cream and long walks on the beach.
     */


    public function zlo_stat( $ZL_LANG, $ZL_DM = NULL )
    {

        $stat_oznaka = $stat_izvora = $stat_prevoda = 0;

        $trans_file = $this->ZL_PATH . $ZL_LANG . ((is_null($ZL_DM)) ? '' : '-' . $ZL_DM) . self::ZLO_EXT;

        if ( !( $trans_file === $this->ZL_FILE_PUT ) )
        {
            if (file_exists($trans_file) && filesize($trans_file) !== 0)
            {

                $this->ZL_FILE = file($trans_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

                $this->ZL_FILE_RED = count($this->ZL_FILE);

                $this->ZL_FILE_PUT = $trans_file;

            }
        }

        for ($i = 0; $i < $this->ZL_FILE_RED; $i++)
        {
            if ($this->ZL_FILE[$i][0] === '!' && $this->ZL_FILE[$i][1] === 'i')

                $stat_izvora++;

            elseif ($this->ZL_FILE[$i][0] === '!' && $this->ZL_FILE[$i][1] === 'm' && isset($this->ZL_FILE[$i][3]))

                $stat_prevoda++;

            elseif ($this->ZL_FILE[$i][0] === '#' && $this->ZL_FILE[$i][1] == ',' && strpos($this->ZL_FILE[$i], 'f'))

                $stat_oznaka++;

        }

        /**
         * Calculates % of translated strings
         */

        $proc_prev = ($stat_prevoda !== 0) ? round(1 / ($stat_izvora / $stat_prevoda) * 100, 2) : 0;

        /**
         * Calculates % of fuzzy strings
         */

        $proc_sumnjivih = ($stat_oznaka !== 0) ? round(1 / ($stat_izvora / $stat_oznaka) * 100, 2) : 0;

    return array(
        'ZL_STAT_IZV' => $stat_izvora,
        'ZL_STAT_PRV' => $stat_prevoda,
        'ZL_STAT_OZN' => $stat_oznaka,
        'ZL_STAT_PCP' => $proc_prev,
        'ZL_STAT_PCS' => $proc_sumnjivih,
        'ZL_STAT_SIZE' => filesize($trans_file));
    }

    /**
     * Evil in the flesh
     */

    public function zlo( $izvor, $ZL_DM = NULL, $n = 'i' )
    {

        /**
         * Faux function overloading or something like that.
         * If second parameter is integer, sets domain as empty.
         */

        if( is_int( $ZL_DM ) ){

            $n = $ZL_DM;
            $ZL_DM = '';

        }

        /**
         * Open file
         */

        $trans_file = $this->ZL_PATH . $this->ZL_LANG . ((is_null($ZL_DM)) ? '' : '-' . $ZL_DM) . self::ZLO_EXT;

        if (!($trans_file === $this->ZL_FILE_PUT)) {
            if (file_exists($trans_file) && filesize($trans_file) !== 0)
            {
                $this->ZL_FILE = file($trans_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
                $this->ZL_FILE_RED = count($this->ZL_FILE);

                $this->ZL_FILE_PUT = $trans_file;

            }
        }

        $nivo = $this->zlo_plural_check( $n );

        /**
         * Evil deeds
         */

        // If singular or first level
        if ( ( $n === 'i' || $n === 1 ) || ( $nivo === 1 && $n > 1 ) ){
            // Start after the header
            for ($i=16; $i < $this->ZL_FILE_RED; $i++) {
                // Check if the current line is the source for translation
                if($this->ZL_FILE[$i] === '!i ' . $izvor ) {
                    // Check that translation is there
                    if ($this->ZL_FILE[$i+1] !== '!m ' && $this->ZL_FILE[$i+1][0] === '!') {
                        // Check if there is a new line character
                        if (strpos($this->ZL_FILE[$i+1], "\\n")) {
                            // Return the translation with valid new line character
                            return str_replace("\\n", nl2br($this->zl2br()), htmlspecialchars(substr($this->ZL_FILE[$i+1],3)));

                        }
                        else
                        {
                            // Return the translation
                            return htmlspecialchars(substr($this->ZL_FILE[$i+1],3));
                        }

                    }
                    else
                    {
                        // Translation is not found, returning the source
                        return $izvor;
                    }
                }

            }

            /**
             * No strings attached! If translation is not found return the source value.
             */

            return $izvor;

        }
        // Houston, we have a non-singular form
        elseif ($n !== 'i' || $n === 0) {
            // Start after the header
            for ($i=16; $i < $this->ZL_FILE_RED; $i++) {
                // FInd the source
                if($this->ZL_FILE[$i] === '!i ' . $izvor) {
                    /**
                     * Checks to see if translation for the required level exists
                     */
                    if ($this->ZL_FILE[$i+$nivo+1] !== "!$nivo " && $this->ZL_FILE[$i+$nivo+1][0] === '!') {
                        // Is there a new lie character in the translation?
                        if (strpos($this->ZL_FILE[$i+$nivo+1], "\\n")){
                            // Return the translation with valid new line character
                            return str_replace("\\n", nl2br($this->zl2br()), htmlspecialchars(substr($this->ZL_FILE[$i+$nivo+1], 3)));

                        }
                        else
                            // Just return the translation
                            return htmlspecialchars(substr($this->ZL_FILE[$i+$nivo+1], 3));
                    }
                    else
                        // No translation found, falling back
                        return $izvor;
                }

            }

            /**
             * No strings attached! If translation is not found return the source value
             */

            return $izvor;
        }

    }
}

?>