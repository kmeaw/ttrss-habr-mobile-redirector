<?php

class Ttrss_Habr_Mobile_Redirector extends Plugin
{
  private $host;
  function about() {
    return array(
      0.2,
      'Replace links to habr to mobile if opened in mobile browser',
      'kmeaw',
      true
    );
  }

  function api_version() {
    return 2;
  }

  function init($host) {
    $this->host = $host;
    $host->add_hook($host::HOOK_QUERY_HEADLINES, $this);
  }

  function hook_query_headlines($headline, $b, $is_api) {
    if (!$is_api)
      return $headline;
    $headline['link'] = str_replace('http://habrahabr.ru', 'http://m.habrahabr.ru', $headline['link']);
    return $headline;
  }
}
