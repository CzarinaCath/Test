<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Archintel {
   public function __call($method, $arguments){
      if(!method_exists($this, $method)){
         throw new Exception('Undefined method Archintel::'. $method .'() called');
      }

      return call_user_func_array(array($this, $method), $arguments);
   }

   public function __construct(){
      $this->load->model('Archintel_model');
      $this->load->library('curl');
   }

   public function __get($var){
      return get_instance()->$var;
   }

   function AllCompanyHistoricalGraphData($start = null, $end = null){
      if($start == null){
         $start = date('Y-m-d', strtotime(date('Y-m-d', time()) . ' -1 month'));
      }

      if($end == null){
         $end = date('Y-m-d', time());
      }

      $total = $this->Archintel_model->GetCompanies(true)->num_rows();

      $data = $this->Archintel_model->AllCompanyHistoricalGraphData($start, $end);

      $data_array = array();
      foreach($data->result() as $dat){
         if(!array_key_exists($dat->date, $data_array)){
            $data_array[$dat->date] = 0;
         }

         $data_array[$dat->date] = $dat->close / $total;
      }

      return $data_array;
   }

   function AllCompanyHistoricalData($start = null, $end = null){
      if($start == null){
         $start = date('Y-m-d', strtotime(date('Y-m-d', time()) . ' -1 month'));
      }

      if($end == null){
         $end = date('Y-m-d', time());
      }

      $companies = $this->Archintel_model->GetCompanies(true);

      $company_array = array();
      foreach($companies->result() as $company){
         array_push($company_array, '"'. $company->symbol . '"');
      }

      $company_list = implode(",", $company_array);

      return $this->GetHistoricalData($company_list, $start, $end);
   }

   function AllCompanyQuoteData(){
      $companies = $this->Archintel_model->GetCompanies(true);

      $company_array = array();
      foreach($companies->result() as $company){
         array_push($company_array, $company->symbol);
      }

      $company_list = implode(",", $company_array);

      return $this->GetQuoteData($company_list);
   }

   function CalculateWalbroIndex($data){
      $price = 0;
      $change = 0;
      $prev_close = 0;
      //$percentage = 0;

      foreach($data as $quote){
         $price += $quote['price'];
         //$change = ($quote['price'] - $quote['prev_close']);
         $change += $quote['change'];
         //$percentage += $quote['percent_change'];
         $prev_close += $quote['prev_close'];
      }

      $percentage = (($price - $prev_close) / $prev_close) * 100;
      $price /= sizeof($data);
      $change /= sizeof($data);
      //$percentage /= sizeof($data);

      return array('price' => $price, 'change' => $change, 'percentage' => $percentage);
   }

   function CutParagraph($paragraph, $length, $end = null){
      return $paragraph;
   }

   function GetHistoricalData($symbol, $start = null, $end = null){
      $data = array();

      if($start == null){
         $start = date('Y-m-d', strtotime(date('Y-m-d', time()) . ' -1 month'));
      }

      if($end == null){
         $end = date('Y-m-d', time());
      }

      $url = 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20in%20('.$symbol.')%20and%20startDate%3D%22'.$start.'%22%20and%20endDate%3D%22'.$end.'%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';

      $csv = $this->curl->simple_get($url);

      if($csv != false){
         $lines = str_getcsv($csv, "\n");

         $decoded = json_decode($lines[0]);

         if($decoded->query->count > 0){
            $quotes = $decoded->query->results->quote;

            foreach($quotes as $quote){
               array_push($data,array(
                  'company_id'=>    $this->Archintel_model->CompanyDetails($quote->Symbol, 'symbol')->ID,
                  'date'      =>    date('Y-m-d', strtotime($quote->Date)),
                  'open'      =>    $quote->Open,
                  'high'      =>    $quote->High,
                  'low'       =>    $quote->Low,
                  'close'     =>    $quote->Close,
                  'volume'    =>    $quote->Volume,
                  'adj_close' =>    $quote->Adj_Close
               ));
            }
         }
      }else{
         return false;
      }

      return $data;
   }

   function GetQuoteData($symbol){
      $data = array();

      $url = 'http://finance.yahoo.com/d/quotes.csv?s='.$symbol.'&f=snl1c1p2p';

      //$csv = file_get_contents($url);
      $csv = $this->curl->simple_get($url);

      if($csv != false){
         $lines = str_getcsv($csv, "\n");

         foreach($lines as $line){
            $contents = str_getcsv($line);
            array_push($data, array('symbol' => $contents[0], 'name' => $this->Archintel_model->GetDefinedName($contents[0]), 'price' => $contents[2], 'change' => $contents[3], 'percent_change' => $contents[4], 'prev_close' => $contents[5]));
         }

         return $data;
      }

      return false;
   }

   function guidv4()
   {
       if (function_exists('com_create_guid') === true)
           return trim(com_create_guid(), '{}');

       $data = openssl_random_pseudo_bytes(16);
       $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
       $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
       return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
   }

   function HistoricalGraphData($start, $end){

      $companies = array();

      foreach($this->Archintel_model->GetCompanies(true)->result() as $company){
         array_push($companies, $company->symbol);
      }

      $data = $this->LocalHistoricalData($companies, $start, $end);

      $dates = array();

      foreach($data->result() as $dat){
         if(!array_key_exists($dat->date, $dates)){
            //array_push($dates, $dat->date);
            $dates[$dat->date] = 0;
         }

         $dates[$dat->date] += $dat->close;
      }

      $total_companies = $this->Archintel_model->GetCompanies(true)->num_rows();

      foreach($dates as $key => $value){
         $dates[$key] = number_format($value / $total_companies, 2);
      }

      return $dates;
   }

   function LocalHistoricalData($symbol, $start = null, $end = null){
      if($start == null){
         $start = date('Y-m-d', strtotime(date('Y-m-d', time()) . ' -1 month'));
      }

      if($end == null){
         $end = date('Y-m-d', time());
      }

      return $this->Archintel_model->LocalHistoricalData($symbol, $start, $end);
   }

   function Medias($page = 1, $account = null){
      return $this->Archintel_model->Medias($page, $account);
   }

   function SetWalbroTextColor($value){
      if($value === 'N/A')
         return '<em class="text-default">'. $value .'</em>';

      if(strpos($value, "-") !== false){
         $new_value = '<em class="text-danger">'. $value .'</em>';
      }else{
         $new_value = '<em class="text-success">'. $value .'</em>';
      }

      return $new_value;
   }

   function UploadHistoricalData($data){
      return $this->Archintel_model->UploadHistoricalData($data);
   }
}
