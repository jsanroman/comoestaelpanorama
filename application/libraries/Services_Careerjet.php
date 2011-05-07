<?php

 /** 
 * Calls Careerjet's API services
 *
 * Remote access to Careerjet job database from php
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 *
 * @package     Services_Careerjet
 * @author      Jerome Eteve <api@careerjet.com>
 * @copyright   2007 Careerjet Ltd.
 * @licence     PHP http://www.php.net/license/3_01.txt
 * @version     1.1
 * @link        http://www.careerjet.co.uk/api.html
 */


 /**
 * Build a new Services_Careerjet interface
 * 
 * Usage:
 *  $cjapi = new Services_Careerjet(<locale>) ;
 * 
 *  Available locales:
 *      LOCALE     LANGUAGE         DEFAULT LOCATION     CAREERJET SITE

    cs_CZ      Czech            Czech Republic       http://www.careerjet.cz
    da_DK      Danish           Denmark              http://www.careerjet.dk
    de_AT      German           Austria              http://www.careerjet.at
    de_CH      German           Switzerland          http://www.careerjet.ch
    de_DE      German           Germany              http://www.careerjet.de
    en_AE      English          United Arab Emirates http://www.careerjet.ae
    en_AU      English          Australia            http://www.careerjet.com.au
    en_CA      English          Canada               http://www.careerjet.ca
    en_CN      English          China                http://en.careerjet.cn
    en_HK      English          Hong Kong            http://www.careerjet.hk
    en_IE      English          Ireland              http://www.careerjet.ie
    en_IN      English          India                http://www.careerjet.co.in
    en_MY      English          Malaysia             http://www.careerjet.com.my
    en_NZ      English          New Zealand          http://www.careerjet.co.nz
    en_OM      English          Oman                 http://www.careerjet.com.om
    en_PH      English          Philippines          http://www.careerjet.ph
    en_PK      English          Pakistan             http://www.careerjet.com.pk
    en_QA      English          Qatar                http://www.careerjet.com.qa
    en_SG      English          Singapore            http://www.careerjet.sg
    en_GB      English          United Kingdom       http://www.careerjet.co.uk
    en_US      English          United States        http://www.careerjet.com
    en_ZA      English          South Africa         http://www.careerjet.co.za
    en_TW      English          Taiwan               http://www.careerjet.com.tw 
    en_VN      English          Vietnam              http://www.careerjet.vn
    es_AR      Spanish          Argentina            http://www.opcionempleo.com.ar
    es_BO      Spanish          Bolivia              http://www.opcionempleo.com.bo
    es_CL      Spanish          Chile                http://www.opcionempleo.cl
    es_CR      Spanish          Costa Rica           http://www.opcionempleo.co.cr
    es_DO      Spanish          Dominican Republic   http://www.opcionempleo.com.do
    es_EC      Spanish          Ecuador              http://www.opcionempleo.ec
    es_ES      Spanish          Spain                http://www.opcionempleo.com
    es_GT      Spanish          Guatemala            http://www.opcionempleo.com.gt
    es_MX      Spanish          Mexico               http://www.opcionempleo.com.mx
    es_PA      Spanish          Panama               http://www.opcionempleo.com.pa
    es_PE      Spanish          Peru                 http://www.opcionempleo.com.pe
    es_PR      Spanish          Puerto Rico          http://www.opcionempleo.com.pr
    es_PY      Spanish          Paraguay             http://www.opcionempleo.com.py
    es_UY      Spanish          Uruguay              http://www.opcionempleo.com.uy
    es_VE      Spanish          Venezuela            http://www.opcionempleo.com.ve
    fi_FI      Finnish          Finland              http://www.careerjet.fi
    fr_CA      French           Canada               http://fr.careerjet.ca
    fr_BE      French           Belgium              http://www.optioncarriere.be
    fr_CH      French           Switzerland          http://www.optioncarriere.ch
    fr_FR      French           France               http://www.optioncarriere.com
    fr_LU      French           Luxembourg           http://www.optioncarriere.lu
    fr_MA      French           Morocco              http://www.optioncarriere.ma
    hu_HU      Hungarian        Hungary              http://www.careerjet.hu
    it_IT      Italian          Italy                http://www.careerjet.it
    ja_JP      Japanese         Japan                http://www.careerjet.jp
    ko_KR      Korean           Korea                http://www.careerjet.co.kr
    nl_BE      Dutch            Belgium              http://www.careerjet.be
    nl_NL      Dutch            Netherlands          http://www.careerjet.nl
    no_NO      Norwegian        Norway               http://www.careerjet.no
    pl_PL      Polish           Poland               http://www.careerjet.pl
    pt_PT      Portuguese       Portugal             http://www.careerjet.pt
    pt_BR      Portuguese       Brazil               http://www.careerjet.com.br
    ru_RU      Russian          Russia               http://www.careerjet.ru
    ru_UA      Russian          Ukraine              http://www.careerjet.com.ua
    sv_SE      Swedish          Sweden               http://www.careerjet.se
    sk_SK      Slovak           Slovakia             http://www.careerjet.sk
    tr_TR      Turkish          Turkey               http://www.careerjet.com.tr
    uk_UA      Ukrainian        Ukraine              http://www.careerjet.ua
    vi_VN      Vietnamese       Vietnam              http://www.careerjet.com.vn
    zh_CN      Chinese          China                http://www.careerjet.cn



 *
 *
 * <code>
 *
 *  require_once "Services_Careerjet.php" ;
 *  
 *  // Create a new instance of the interface for UK job offers
 *  $cjapi = new Services_Careerjet('en_UK') ;
 *  
 *  
 *
 *  // Then call api methods (see methods doc for details)
 *  $result = $cjapi->search( array ( 'keywords' => 'java manager',
 *                                    'location' => 'London' ) 
 *                           );
 *
 *  if ( $result->type == 'JOBS' ){
 *      echo "Got ".$result->hits." jobs: \n\n" ;
 *      $jobs = $result->jobs ;
 *
 *      foreach( $jobs as &$job ){
 *          echo " URL: ".$job->url."\n" ;
 *          echo " TITLE: ".$job->title."\n" ;
 *          echo " LOC:   ".$job->locations."\n";
 *          echo " COMPANY: ".$job->company."\n" ;
 *          echo " SALARY: ".$job->salary."\n" ;
 *          echo " DATE:   ".$job->date."\n" ;
 *          echo " DESC:   ".$job->description."\n" ;
 *          echo "\n" ;
 *       }
 *
 *   }
 *  
 *  </code>
 *     
 *
 * @package    Services_Careerjet
 * @author     Jerome Eteve <api@careerjet.com>
 * @copyright  2007 Careerjet Ltd.
 * @link       http://www.careerjet.co.uk/api.html
 */
class Services_Careerjet{
  var $base = '' ;

  //function Services_Careerjet($base = 'http://www.careerjet.co.uk' )
  function Services_Careerjet( $locale = 'en_UK' )
  {
    $base = $this->locale2base[$locale] ;
    if ( ! $base ){
      $base = $this->locale2base['en_UK'] ;
    }
    $this->base = $base ;
  }

  function call($fname , $args)
  {
    $url = $this->base.'/devel/'.$fname.'.api?' ;
    foreach ($args as $key => $value){
      $url .= $key.'='.urlencode($value).'&' ;
    }
    
    $response = file_get_contents($url);
    return json_decode($response) ;
  }
  
  
  /**
   * Do a search in Careerjet job database
   *
   * Call exemple:
   *
   * <code>
   * $result = $cjapi->search(array( 'keywords' => 'java',
   *                               'location' => 'London',
   *                               'pagesize' => 2 )
   *                        );
   * </code>
   * 
   * 
   * @param   array  $args   map of search options
   *                         exemple : array( 'keywords' => 'java manager',
   *                                          'location' => 'london' );
   *                         See OPTIONS for details about available options.
   *
   *                         Values of keys MUST be in ASCII or unicode (utf8)
   *                         If you use this API within a webpage, make sure:
   *                           - That your pages are served in utf-8 encoding OR
   *                           - Your job search form begins like that :
   *                              <form accept-charset="UTF-8"
   *
   *
   * @return object(stdClass)  An object containing results
   *                           If the given location is not ambiguous, you can use this
   *                           object like that:
   * <code>
   *                           if ( $result->type == 'JOBS' ){
   *                              echo "Got ".$result->hits." jobs: \n" ;
   *                              echo " On ".$result->pages." pages \n" ;
   *                              $jobs = $result->jobs ;
   *
   *                              foreach( $jobs as &$job ){
   *                                  echo " URL: ".$job->url."\n" ;
   *                                  echo " TITLE: ".$job->title."\n" ;
   *                                  echo " LOC:   ".$job->locations."\n";
   *                                  echo " COMPANY: ".$job->company."\n" ;
   *                                  echo " SALARY: ".$job->salary."\n" ;
   *                                  echo " DATE:   ".$job->date."\n" ;
   *                                  echo " DESC:   ".$job->description."\n" ;
   *                                  echo " SITE:   ".$job->site."\n" ;
   *                                  echo "\n" ;
   *                               }
   *
   *                             }
   * </code>
   *
   *                           If the given location is ambiguous, result contains
   *                           a list of suggested locations:
   *
   * <code>
   *                           if ( $result->type == 'LOCATIONS' ){
   *                               echo "Suggested locations:\n" ;
   *                               $locations = $result->locations ;
   *                               
   *                               foreach ( $locations as &$loc ){
   *                                   echo $loc."\n" ;
   *                               }
   *
   *                            }
   * </code>
   *
   *
   * OPTIONS
   *   All options have default values and are not mandatory
   *
   *     keywords     : Keywords to search in job offers. Example: 'java manager'
   *                    Default : none (All offers in the api country)
   *
   *     location     : Location to search job offers in. Examples: 'London' , 'Yorkshire' ..
   *                    Default: none ( All offers in the api country)
   *
   *     sort         : Type of sort. Can be:
   *                     'relevance' (default) - most relevant first 
   *                     'date'                - freshest offer first 
   *                     'salary'              - biggest salary first
   *
   *     start_num    : Num of first offer returned in entire result space
   *                    should be >= 1 and <= Number of hits
   *                    Default : 1 
   *
   *     pagesize     : Number of offers returned in one call
   *                    Default : 20
   *
   *     page         : Number of the asked page. 
   *                    should be >=1
   *                    The max number of page is given by $result->pages
   *                    If this value is set, the eventually given start_num is overrided
   *
   *     contracttype : Character code for contract type
   *                     'p'    - permanent job
   *                     'c'    - contract
   *                     't'    - temporary
   *                     'i'    - training
   *                     'v'    - voluntary
   *                    Default: none (all contract types)
   *     
   *     contractperiod : Character code for contract work period:
   *                       'f'     - Full time
   *                       'p'     - Part time
   *                      Default: none (all work period)
   *
   */
  function search($args)
  {
    $result =  $this->call('search' , $args);
    if ( $result->type == 'ERROR' ){
      trigger_error( $result->error );
    }
    return $result ;
  }
  
  var $locale2base = array( 
                           'cs_CZ'  => "http://www.careerjet.cz",
                           'da_DK'  => "http://www.careerjet.dk",
                           'de_AT'  => "http://www.careerjet.at",
                           'de_CH'  => "http://www.careerjet.ch",
                           'de_DE'  => "http://www.careerjet.de",
                           'en_AE'  => "http://www.careerjet.ae",
                           'en_AU'  => "http://www.careerjet.com.au",
                           'en_CA'  => "http://www.careerjet.ca",
                           'en_CN'  => "http://en.careerjet.cn",
                           'en_HK'  => "http://www.careerjet.hk",
                           'en_IE'  => "http://www.careerjet.ie",
                           'en_IN'  => "http://www.careerjet.co.in",
                           'en_MY'  => "http://www.careerjet.com.my",
                           'en_NZ'  => "http://www.careerjet.co.nz",
                           'en_OM'  => "http://www.careerjet.com.om",
                           'en_PH'  => "http://www.careerjet.ph",
                           'en_PK'  => "http://www.careerjet.com.pk",
                           'en_QA'  => "http://www.careerjet.com.qa",
                           'en_SG'  => "http://www.careerjet.sg",
                           'en_GB'  => "http://www.careerjet.co.uk",
                           'en_UK'  => "http://www.careerjet.co.uk",
                           'en_US'  => "http://www.careerjet.com",
                           'en_ZA'  => "http://www.careerjet.co.za",
                           'en_TW'  => "http://www.careerjet.com.tw",
                           'en_VN'  => "http://www.careerjet.vn",
                           'es_AR'  => "http://www.opcionempleo.com.ar",
                           'es_BO'  => "http://www.opcionempleo.com.bo",
                           'es_CL'  => "http://www.opcionempleo.cl",
                           'es_CR'  => "http://www.opcionempleo.co.cr",
                           'es_DO'  => "http://www.opcionempleo.com.do",
                           'es_EC'  => "http://www.opcionempleo.ec",
                           'es_ES'  => "http://www.opcionempleo.com",
                           'es_GT'  => "http://www.opcionempleo.com.gt" ,
                           'es_MX'  => "http://www.opcionempleo.com.mx",
                           'es_PA'  => "http://www.opcionempleo.com.pa",
                           'es_PE'  => "http://www.opcionempleo.com.pe",
                           'es_PR'  => "http://www.opcionempleo.com.pr",
                           'es_PY'  => "http://www.opcionempleo.com.py",
                           'es_UY'  => "http://www.opcionempleo.com.uy",
                           'es_VE'  => "http://www.opcionempleo.com.ve",
                           'fi_FI'  => "http://www.careerjet.fi",
                           'fr_BE'  => "http://www.optioncarriere.be",
                           'fr_CA'  => "http://fr.careerjet.ca" ,
                           'fr_CH'  => "http://www.optioncarriere.ch",
                           'fr_FR'  => "http://www.optioncarriere.com",
                           'fr_LU'  => "http://www.optioncarriere.lu",
                           'fr_MA'  => "http://www.optioncarriere.ma",
                           'hu_HU'  => "http://www.careerjet.hu",
                           'it_IT'  => "http://www.careerjet.it",
                           'ja_JP'  => "http://www.careerjet.jp",
                           'ko_KR'  => "http://www.careerjet.co.kr",
                           'nl_BE'  => "http://www.careerjet.be",
                           'nl_NL'  => "http://www.careerjet.nl",
                           'no_NO'  => "http://www.careerjet.no",
                           'pl_PL'  => "http://www.careerjet.pl",
                           'pt_PT'  => "http://www.careerjet.pt",
                           'pt_BR'  => "http://www.careerjet.com.br",
                           'ru_RU'  => "http://www.careerjet.ru",
                           'ru_UA'  => "http://www.careerjet.com.ua",
                           'sv_SE'  => "http://www.careerjet.se",
                           'sk_SK'  => "http://www.careerjet.sk",
                           'tr_TR'  => "http://www.careerjet.com.tr",
                           'uk_UA'  => "http://www.careerjet.ua",
                           'vi_VN'  => "http://www.careerjet.com.vn",
                           'zh_CN'  => "http://www.careerjet.cn"
		   
    );
}

?>