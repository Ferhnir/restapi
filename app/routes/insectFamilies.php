<?php
  $app->get('/insect/families', \insectFamilies::class . ':getData');
  $app->post('/insect/families', \insectFamilies::class . ':setData');
  $app->put('/insect/families', \insectFamilies::class . ':updateData');
  $app->delete('/insect/families', \insectFamilies::class . ':deleteData');
?>
