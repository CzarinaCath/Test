<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archintel_model extends CI_Model {


   function AddRecentSearch($id, $keyword, $category){
      $this->db->insert('searches', array('contact_id' => $id, 'keyword' => $keyword, 'category' => $category));

      return;
   }

   function AllDetails($table, $field, $value){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($field, $value);

      return $this->db->get()->row();
   }

   function AllCompanyHistoricalGraphData($start, $end){
      $this->db->select('ID');
      $this->db->select('company_id');
      $this->db->select('date');
      $this->db->select('SUM(high) as high');
      $this->db->select('SUM(open) as open');
      $this->db->select('SUM(close) as close');
      $this->db->select('SUM(low) as low');
      $this->db->select('SUM(adj_close) as adj_close');
      $this->db->select('SUM(volume) as volume');
      $this->db->from('historical_data');
      $this->db->group_by('date');
      $this->db->where('date >=', $start);
      $this->db->where('date <=', $end);

      return $this->db->get();
   }

   function CompanyDetails($value, $field = 'ID'){
      $this->db->select('ID');
      $this->db->select('symbol');
      $this->db->select('name');
      $this->db->select('sp');
      $this->db->select('status');
      $this->db->from('companies');
      $this->db->where($field, $value);

      return $this->db->get()->row();
   }

   function GetAccounts(){
      $this->db->select('ID');
      $this->db->select('Name');
      $this->db->select('SalesforceID');
      $this->db->select('ArchIntelId__c');
      $this->db->select('ArchIntel_Status__c');
      $this->db->select('BillingAddress');
      $this->db->select('BillingCity');
      $this->db->select('BillingCountry');
      $this->db->select('BillingPostalCode');
      $this->db->select('BillingState');
      $this->db->select('BillingStreet');
      $this->db->select('Fax');
      $this->db->select('Website');
      $this->db->select('Industry');
      $this->db->select('Active__c');
      $this->db->select('Expiration_Date__c');
      $this->db->select('NumberOfEmployees');
      $this->db->select('Phone');
      $this->db->select('PhotoUrl');
      $this->db->select('Subscription_Type__c');
      $this->db->from('accounts');

      return $this->db->get();
   }

   function GetCompanies($active_only = false){
      $this->db->select('ID');
      $this->db->select('symbol');
      $this->db->select('name');
      $this->db->select('sp');
      $this->db->select('status');
      $this->db->from('companies');
      $this->db->order_by('name','ASC');

      if($active_only)
         $this->db->where('status', 'Active');

      return $this->db->get();
   }

   function GetDefinedName($symbol){
      $this->db->select('name');
      $this->db->from('companies');
      $this->db->where('symbol', $symbol);

      return $this->db->get()->row()->name;
   }

   function GetSearches($id = null){
      $this->db->select('ID');
      $this->db->select('contact_id');
      $this->db->select('keyword');
      $this->db->select('category');
      $this->db->from('searches');

      if($id != null){
         $this->db->where('contact_id', $id);
      }

      return $this->db->get();
   }

   function LocalHistoricalData($symbol, $start, $end){
      $this->db->select('h.ID as hID');
      $this->db->select('company_id');
      $this->db->select('date');
      $this->db->select('high');
      $this->db->select('open');
      $this->db->select('close');
      $this->db->select('low');
      $this->db->select('adj_close');
      $this->db->select('volume');
      $this->db->from('historical_data h');
      $this->db->join('companies c', 'c.ID = h.company_id');
      $this->db->where_in('symbol', $symbol);
      $this->db->where('date >=', $start);
      $this->db->where('date <=', $end);

      return $this->db->get();
   }

   function Medias($page, $account = null){

      $page--;

      $page *= 3;

      $this->db->select('ID');
      $this->db->select('SalesforceID');
      $this->db->select('Name');
      $this->db->select('Date__c');
      $this->db->select('AccountID');
      $this->db->select('News_Category__c');
      $this->db->select('Media_Title__c');
      $this->db->select('Contenttags__c');
      $this->db->select('Media_Link__c');
      $this->db->select('Media_Summary__c');
      $this->db->select('Media_Image__c');
      $this->db->select('Top_Headline__c');
      $this->db->select('Publish__c');
      //$this->db->from('media');
      $this->db->order_by('Date__c', 'DESC');

      if($account != null){
         $this->db->where('AccountID', $account);
      }

      //return $this->db->get(); 
      return $this->db->get('media', 3, $page);
   }

   function MediaPages($account = null){
      $this->db->select('COUNT(ID) as total');
      $this->db->from('media');

      if($account != null)
         $this->db->where('AccountID', $account);

      return $this->db->get()->row()->total;
   }

   function SearchMedia($keyword, $by = 'keyword'){
      $keyword = htmlentities($keyword);

      if($keyword == null)
         return false;

      $this->db->select('ID');
      $this->db->select('SalesforceID');
      $this->db->select('Name');
      $this->db->select('Date__c');
      $this->db->select('AccountID');
      $this->db->select('News_Category__c');
      $this->db->select('Media_Title__c');
      $this->db->select('Contenttags__c');
      $this->db->select('Media_Link__c');
      $this->db->select('Media_Summary__c');
      $this->db->select('Media_Image__c');
      $this->db->select('Top_Headline__c');
      $this->db->select('Publish__c');
      $this->db->from('media');

      $keywords = explode(" ", $keyword);

      if($by == 'keyword'){
         $c = 1;
         foreach($keywords as $keyword){
            if($c > 1){
               $this->db->or_like('Media_Title__c', $keyword);
               $this->db->or_like('Media_Summary__c', $keyword);
            }else{
               $this->db->like('Media_Title__c', $keyword);
               $this->db->like('Media_Summary__c', $keyword);
            }
            $c++;
         }
      }else if($by == 'category'){
         $this->db->where('News_Category__c',$keyword);
      }else{
         $this->db->like('Contenttags__c', $keyword);
      }

      return $this->db->get();
   }

   function TopHeadlines(){
      $this->db->select('ID');
      $this->db->select('SalesforceID');
      $this->db->select('Name');
      $this->db->select('Date__c');
      $this->db->select('AccountID');
      $this->db->select('News_Category__c');
      $this->db->select('Media_Title__c');
      $this->db->select('Contenttags__c');
      $this->db->select('Media_Link__c');
      $this->db->select('Media_Summary__c');
      $this->db->select('Media_Image__c');
      $this->db->select('Top_Headline__c');
      $this->db->select('Publish__c');
      $this->db->from('media');
      $this->db->where('Top_Headline__c', true);

      return $this->db->get();
   }

   function UploadHistoricalData($data){
      $this->db->insert_batch('historical_data', $data);

      return $this->db->affected_rows() > 0 ? true : false;
   }

   function UploadMedia($data){
      $this->db->insert_batch('media', $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }
}
