<?php

// Za sada necu koristiti nikakav templating engine posto cu ga imati u AngularJSu

Class Views{
	public function getView($view){
		// Nikakva provera, zato sto, zasto ne. Zar nesto moze da podje po zlu? 

		return file_get_contents(__DIR__."/templates/".$view);
	}
}

$views = new Views;

