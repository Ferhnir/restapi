<?php
  $app->get('/insect/countries', \insectCountries::class . ':getData');
  $app->post('/insect/countries', \insectCountries::class . ':setData');
  $app->put('/insect/countries', \insectCountries::class . ':updateData');
  $app->delete('/insect/countries', \insectCountries::class . ':deleteData');
?>
