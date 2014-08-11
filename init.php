<?php

class HabrMobileRedirector extends Plugin implements IHandler
{
  private $host;
  function about() {
    return array(
      0.1,
      'Replace links to habr to mobile if opened in mobile browser',
      'kmeaw',
      false // is_system
    );
  }

  function api_version() {
    return 2;
  }

  function init($host) {
    $this->host = $host;
    $host->add_hook($host::HOOK_RENDER_ARTICLE, $this);
  }

  function hook_render_article($article) {
    if (strpos($article['link'], "http://habrahabr.ru") === false)
      return $article;
    if (strpos($article['plugin_data'], "habrmobileredirectormod,$owner_uid:" . $article['plugin_data']) !== false)
      return $article;
    $article['content'] = str_replace('http://habrahabr.ru', 'http://m.habrahabr.ru', $article['content']);
    $article['content'] = print_r($_SERVER, true);
    $article['plugin_data'] = "habrmobileredirectormod,$owner_uid:" . $article['plugin_data'];
    return $article;
  }
}
