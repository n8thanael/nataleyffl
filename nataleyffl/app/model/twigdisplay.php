<?php

class twigdisplay {

	public function hellotest(){
		return "hellotest.twig";
	}

	public function display($method){
		return method_exists($this, $method) ? $this->$method() : $this->fail();
	}

	public function fail(){
		return "twigfail.twig";
	}
}

  