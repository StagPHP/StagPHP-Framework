<?php

// Create new user session object
$user_session = new stag_ums('SU', true);

/** User verification failed */
if(false === $user_session->verify_session()) error_response();