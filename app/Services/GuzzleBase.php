<?php
namespace App\Services;

abstract class GuzzleBase {

	abstract function getUrl();

	abstract function getParams();

	public function funcGet() {
	    $client = new \GuzzleHttp\Client();
	    $response = $client->request('GET', $this->getUrl(), ['query' => $this->getParams()]); // params - ['param1' => 'one', 'param2' => 'two', ...]        

	    return $response->getBody()->getContents();
	}

}

?>
