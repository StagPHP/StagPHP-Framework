<?php
/**
 * @package:        m_framework
 * Name:            Head Template
 */

/** CYZ VR: View Resources */
$resource_dir = get_assets_dir_uri(NULL, TRUE); ?>

<!DOCTYPE HTML SYSTEM>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link rel="dns-prefetch" href="//google-analytics.com">
  <link rel="dns-prefetch" href="//www.google-analytics.com">
  <link rel="dns-prefetch" href="//ssl.google-analytics.com">
  <meta name="robots" content="noindex,nofollow">
  <meta name="msapplication-tap-highlight" content="no" />

  <style>
    ::-webkit-scrollbar, ::-webkit-scrollbar-track {
      display: none;
    }
  </style>

  <?php stag_head_backend(); ?>

  <?php stag_insert_template('/templates/general/favicon.php', 'admin'); ?>

</head>

<body class="blue-shade">
