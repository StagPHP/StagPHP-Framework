<?php

function we_safe_submit($form_token, $form_action, $button_name, $button_class){
  echo '<input name="token" type="hidden" value="'.$form_token.'" />'.PHP_EOL;
  echo '<input name="action" type="hidden" value="'.$form_action.'" />'.PHP_EOL;
  echo '<input type="submit" id="'.$form_action.'-button" class="'.$button_class.'" value="'.$button_name.'" />'.PHP_EOL;
}

function we_safe_submit_button($form_token, $form_action, $button_name, $button_class){
  echo '<input name="token" type="hidden" value="'.$form_token.'" />'.PHP_EOL;
  echo '<input name="action" type="hidden" value="'.$form_action.'" />'.PHP_EOL;
  echo '<button type="submit" id="'.$form_action.'-button" class="'.$button_class.'" >'.$button_name.'</button>'.PHP_EOL;
}
