<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
  return $this->response->withJson('Africanmoths Rest Api');
});
//Auth 
$app->post('/auth', \AuthCtrl::class . ':auth')->setName('auth.generate.token');

//Insect data
$app->group('/insect', function(){
  // $this->get('/{model}',\GetDataCtrl::class)->setName('api.data.index');
  //specific category
  $this->get('/families', \FamiliesCtrl::class)->setName('api.data.families.index');
  $this->get('/subfamilies', \SubfamiliesCtrl::class)->setName('api.data.subfamilies.index');
  $this->get('/tribes', \TribesCtrl::class)->setName('api.data.tribes.index');
  $this->get('/species', \SpeciesCtrl::class)->setName('api.data.species.index');
  $this->get('/genus', \GenusCtrl::class)->setName('api.data.genus.index');
 
  $this->post('/{model}',\StoreDataCtrl::class)->setName('api.data.store');
  $this->put('/{model}',\UpdateDataCtrl::class)->setName('api.data.update');
  $this->delete('/{model}', \DestroyDataCtrl::class)->setName('api.data.delete');
});

?>