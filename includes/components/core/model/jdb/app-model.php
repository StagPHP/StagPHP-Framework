<?php

function stag_model_get_view_types(){
    /** Using Global JSON DB Object */
    GLOBAL $APP_JSON_DB;

    /** Set table name */
    $table_name = 'app_view_types';

    /** Initialize JSON DB Object For Application */
    $APP_JSON_DB->db_init('application');

    /** get and return app view data */
    return $APP_JSON_DB->get_table($table_name);
}

function stag_model_update_view_types($view_types){
    /** Using Global JSON DB Object */
    GLOBAL $APP_JSON_DB;

    /** Set table name */
    $table_name = 'app_view_types';

    /** Initialize JSON DB Object For Application */
    $APP_JSON_DB->db_init('application');

    /** Add table if not present */
    $APP_JSON_DB->add_table($table_name);

    /** get and return app view data */
    return $APP_JSON_DB->update_table($table_name, $view_types);
}

function stag_model_delete_view_types(){
    /** Using Global JSON DB Object */
    GLOBAL $APP_JSON_DB;

    /** Set table name */
    $table_name = 'app_view_types';

    /** Initialize JSON DB Object For Application */
    $APP_JSON_DB->db_init('application');

    /** get and return app view data */
    return $APP_JSON_DB->delete_table($table_name);
}

function stag_model_get_view_list_of_types($type){
    /** Using Global JSON DB Object */
    GLOBAL $APP_JSON_DB;

    /** Set table name */
    $table_name = 'app_view_'.$type;

    /** Initialize JSON DB Object For Application */
    $APP_JSON_DB->db_init('application');

    /** get and return app view data */
    return $APP_JSON_DB->get_table($table_name);
}

function stag_model_update_view_list_of_types($type, $view_list){
    /** Using Global JSON DB Object */
    GLOBAL $APP_JSON_DB;

    /** Set table name */
    $table_name = 'app_view_'.$type;

    /** Initialize JSON DB Object For Application */
    $APP_JSON_DB->db_init('application');

    /** Add table if not present */
    $APP_JSON_DB->add_table($table_name);

    /** get and return app view data */
    return $APP_JSON_DB->update_table($table_name, $view_list);
}