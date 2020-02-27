<?php
function req_meta_wpse_96762($data){
  $allow_pending = false;
  if (isset($_POST['meta'])) {
    foreach ($_POST['meta'] as $v) {
      if ('your_required_key' === $v['key'] && !empty($v['value'])) {
        $allow_pending = true;
      }
    }
  }
  if (false === $allow_pending) {
    $data['post_status'] = 'draft';
  }
  return $data;
}
add_action('wp_insert_post_data','req_meta_wpse_96762');