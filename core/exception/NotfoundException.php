<?php 
namespace app\core\exception;

class NotfoundException extends \Exception {
  protected $code = 404;
  protected $message = 'Page not found';
}
?>