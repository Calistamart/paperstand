<?php

class User {
		// 0/ constantes de classe: non relatif à l'objet mais à la CLASSE
	const REDACTOR = 0;
	const MODERATOR = 1;	
	const ADMINISTRATOR=2;
	
		// 1/ attributes
	private $username = "";		// in
	private $mail = "";   		// in
	private $password = 0;   			// in
	private $permission_rank = self::REDACTOR;		//out (le but de la classe!) avec val par défaut
    private $is_validated = false;

		// 2/ constructor & magic methods! les méthodes sont typées! 
		// par défaut je rentre des personnes de 40ans!!
	public function __construct(string $fName, string $lName, int $age=40) {	
		$this->username = $fName;
		$this->mail = $lName;
		$this->_age = $age;
	}	
	public function __toString() : string {	// le rendu	
		// utilisation template String {$...} évite les concaténations de String
		return "[{$this->_firstName}-{$this->_lastName}-{$this->_age} ans -> {$this->_categ}]";
	}

		// 3/ public methods	
	public function run() : void {
			// this : objet courant + ->, self est relatif à la class + ::
		if ($this->_age >= self::JUNIOR_MAX && $this->_age < self::ADULTE_MAX)
			$this->_categ = self::ADULT;
		else if ($this->_age >= self::ADULTE_MAX)
			$this->_categ = self::SENIOR;
	}

	/**
	 * Get the value of _categ
	 */ 
	public function get_categ(): string	// exemple de getter généré automatiquement!
	{
		return $this->_categ;
	}


}

?>