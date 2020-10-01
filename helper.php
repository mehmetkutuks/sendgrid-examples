<?php
function site_url($url = null)
{
  return 'http://localhost/uyelik/' . $url;
}

function post($name)
{
  if (isset($_POST[$name])) {
    return htmlspecialchars(trim($_POST[$name]));
  }
}

function get($name)
{
  if (isset($_GET[$name])) {
    return htmlspecialchars(trim($_GET[$name]));
  }
}
function session($name)
{
  if (isset($_SESSION[$name])) {
    return $_SESSION[$name];
  }
}
function questions($id = null)
{
  $question = [
    1 => 'İlk arabanızın markası neydi?',
    2 => 'İlk köpeğinizin adı neydi?',
    3 => 'İlokul öğretmeninizin adı neydi?',
    4 => 'İlk yazdığınız kod hangisiydi?'
  ];
  return $id ? $question[$id] : $question;
}
 ?>
