<?php

class stag_phrase_comment{
    static function file_content($file_data, $fields){
      // Creating empty array
      $result = array();
  
      // Catching CR-only line endings
      $comment = str_replace("\r", "\n", $file_data);
  
      /**
       * Looping thorough fields
       * Matching and returning matched header comment fields */
      foreach($fields as $key => $regex){
        // Matching using regex
        if (preg_match('/^[ \t\/*#@]*'.preg_quote($regex, '/').':(.*)$/mi', $comment, $match) && $match[1])
        $fields[$key] = trim(preg_replace('/\s*(?:\*\/|\?>).*/', '', $match[1]));
        
        else $fields[$key] = '';
  
        // Storing the result to an array
        $result[$regex] = $fields[$key];
      }
  
      // Returning the results
      return $result;
    }
  
    static function file($file_loc, $fields){
        if(!isset($fields) && !is_array($fields)) return FALSE;

        if(!file_exists($file_loc)) return FALSE;

        // Open file for reading
        $fp = @fopen($file_loc, 'r');
    
        /**
         * Read only 100 KB of Data from the file
         * assuming header comments will be in top */
        $file_data = @fread($fp, 102400);
    
        // Closing file
        fclose($fp);
    
        // Returning the results
        return self::file_content($file_data, $fields);
    }
}