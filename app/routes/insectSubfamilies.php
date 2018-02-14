<?php
  $app->get('/insect/subfamilies', \insectSubfamilies::class . ':getData');
  $app->get('/insect/subfamilies/all', \insectSubfamilies::class . ':getAllData');
  $app->post('/insect/subfamilies', \insectSubfamilies::class . ':setData');
  $app->put('/insect/subfamilies', \insectSubfamilies::class . ':updateData');
  $app->delete('/insect/subfamilies', \insectSubfamilies::class . ':deleteData');
?>
