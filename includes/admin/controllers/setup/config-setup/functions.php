<?php

class config_creator{
    /** Content String */
    private $content_string = '';

    function get_stag_config_start(){
        /** Comments */
        $this->content_string = "<?php\r\n/**\r\n".
        " * StagPHP main configuration file\r\n".
        " *\r\n".
        " * @link https://stagphp.dev/docs/config-file/\r\n".
        " * @package StagPHP\r\n".
        " */\r\n";
    }

    /** SUP: Super user panel */
    function get_su_config($data){
        /** Super user panel slug */
        if(isset($data['su_panel_slug'])){
            /** Comments */
            $this->content_string .= "\r\n/**\r\n".
            " * StagPHP Superuser Panel slug\r\n".
            " *\r\n".
            " * Before changing the Superuser Panel slug\r\n".
            " * do check compatibility with any other third party\r\n".
            " * modules or apps.\r\n".
            " *\r\n".
            " * SU URL Slug */\r\n";

            /** Config Settings */
            $this->content_string .= "define('ADMIN_PANEL_SLUG', '".$data['su_panel_slug']."');\r\n";
        }

        /** Unique Session option for Superuser */
        else if(isset($data['unique_session']) && 'ENABLED' == $data['unique_session']){
            /** Comments */
            $this->content_string .= "\r\n/**\r\n".
            " * StagPHP Superuser Session Management\r\n".
            " *\r\n".
            " * Enable/disable one session at a time option\r\n".
            " * for Superusers.\r\n".
            " *\r\n".
            " * Enable unique session */\r\n";

            /** Config Settings */
            $this->content_string .= "define('SU_UNIQUE_ACTIVE_SESSION', TRUE);\r\n";
        }
        
        /** IP validation for Superuser */
        else if(isset($data['ip_validation']) && 'ENABLED' == $data['ip_validation']){
            /** Comments */
            $this->content_string .= "\r\n/**\r\n".
            " * StagPHP Superuser Enable IP Validation\r\n".
            " *\r\n".
            " * Enable/disable IP Validation option\r\n".
            " * for Superusers.\r\n".
            " *\r\n".
            " * Enable IP Validation */\r\n";

            /** Config Settings */
            $this->content_string .= "define('SU_IP_VALIDATION', TRUE);\r\n";
        }
    }

    function get_mysql_config($data){
        if(isset($data['DB_HOST'])){
            /** Comments */
            $this->content_string .= "\r\n/**\r\n".
            " * StagPHP primary database configuration\r\n".
            " *\r\n".
            " * MySQL settings - You can get this info from your\r\n".
            " * web host. Change the details below \r\n".
            " *\r\n".
            " * mySQL database host name */\r\n";

            /** Database Host */
            $this->content_string .= "define('DB_HOST', '".$data['DB_HOST']."');\r\n";
        }

        else if(isset($data['DB_NAME'])){
            /** Comment */
            $this->content_string .= "/** MySQL database name */\r\n";
            /** Database Username */
            $this->content_string .= "define('DB_NAME', '".$data['DB_NAME']."');\r\n";
        }
        
        else if(isset($data['DB_USERNAME'])){
            /** Comment */
            $this->content_string .= "/** MySQL database username */\r\n";
            /** Database Username */
            $this->content_string .= "define('DB_USERNAME', '".$data['DB_USERNAME']."');\r\n";
        }

        else if(isset($data['DB_PASSWORD'])){
            /** Comment */
            $this->content_string .= "/** MySQL database password */\r\n";
            /** Database Username */
            $this->content_string .= "define('DB_PASSWORD', '".$data['DB_PASSWORD']."');\r\n";
        }

        else if(isset($data['DB_CHARSET'])){
            /** Comment */
            $this->content_string .= "/** MySQL database Character set */\r\n";
            /** Database Username */
            $this->content_string .= "define('DB_CHARSET', '".$data['DB_CHARSET']."');\r\n";
        }
    }

    /** SUP: Super user panel */
    function get_stag_config($data){
        /** Super user panel slug */
        if(isset($data['stag_build'])){
            /** Comments */
            $this->content_string .= "\r\n/**\r\n".
            " * StagPHP Build\r\n".
            " *\r\n".
            " * Changing build type without knowing\r\n".
            " * he consequence and modifying the application\r\n".
            " * accordingly can result into unrecoverable\r\n".
            " * failure\r\n".
            " *\r\n".
            " * Build Code */\r\n";

            /** Config Settings */
            $this->content_string .= "define('STAGPHP_BUILD', '".$data['stag_build']."');\r\n";
        }

        /** Super user panel slug */
        else if(isset($data['stag_debug']) && 'ENABLED' == $data['stag_debug']){
            /** Comments */
            $this->content_string .= "\r\n/**\r\n".
            " * StagPHP Debug Option\r\n".
            " *\r\n".
            " * This option  should only be enabled in\r\n".
            " * development environment. Application will\r\n".
            " * require more computation power than normal to\r\n".
            " * monitor and generate logs and debugs\r\n".
            " *\r\n".
            " * Enable/Disable Debug */\r\n";

            /** Config Settings */
            $this->content_string .= "define('STAGPHP_DEBUG_ENABLED', 'TRUE');\r\n";
        }
    }

    /** Stag default email config */
    function setup_email_config($data){
      if(isset($data['sender-name'])){
        /** Comments */
        $this->content_string .= "\r\n/**\r\n".
        " * StagPHP Mail Configuration (SMC)\r\n".
        " *\r\n".
        " * You can change email settings here\r\n".
        " * changes will be reflected immediately\r\n".
        " *\r\n".
        " * Sender name (or) from name.*/\r\n";

        /** Config Settings */
        $this->content_string .= "define('SMC_FROM_NAME', '".$data['sender-name']."');\r\n";
      }

      else if(isset($data['sender-email'])){
        /** Comment */
        $this->content_string .= "/** Sender email (or) from email. */\r\n";
        /** Database Username */
        $this->content_string .= "define('SMC_FROM_EMAIL', '".$data['sender-email']."');\r\n";
      }

      else if(isset($data['reply-to-name'])){
        /** Comment */
        $this->content_string .= "/** Reply to name. */\r\n";
        /** Database Username */
        $this->content_string .= "define('SMC_REPLY_TO_NAME', '".$data['reply-to-name']."');\r\n";
      }

      else if(isset($data['reply-to-email'])){
        /** Comment */
        $this->content_string .= "/** Reply to email. */\r\n";
        /** Database Username */
        $this->content_string .= "define('SMC_REPLY_TO_EMAIL', '".$data['reply-to-email']."');\r\n";
      }
    }

    function compile_config(){
        if(!isset($_SESSION['stag_installation_memory']) || empty($_SESSION['stag_installation_memory']))
        return FALSE;

        $config_data = stag_session_cache::get_all_data();

        $this->get_stag_config_start();

        if(is_array($config_data)) foreach($config_data as $data_set => $data_set_value){
            if('su_config' == $data_set)
            foreach($data_set_value as $key => $value)
            $this->get_su_config($value);
            
            if('mysql_db_details' == $data_set)
            foreach($data_set_value as $key => $value)
            $this->get_mysql_config($value);

            if('stagphp_config' == $data_set)
            foreach($data_set_value as $key => $value)
            $this->get_stag_config($value);

            if('email_settings' == $data_set)
            foreach($data_set_value as $key => $value)
            $this->setup_email_config($value);
        }

        return $this->content_string;
    }
}