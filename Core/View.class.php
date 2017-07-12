<?php 
	class View {

		protected $view;
		protected $template;
		protected $data = array();

		public function __construct($view = "index", $template = "frontend") {
			$this->setView($view);
			$this->setTemplate($template);
		}
		
		public function setView($view) {
			if ( file_exists(VIEWS_PATH.$view.".view.php")) {
				$this->view = VIEWS_PATH.$view.".view.php";
			} else {
				die("La vue n'existe pas.");
			}
		}

		public function setTemplate($template) {
			if ( file_exists(TEMPLATES_PATH.$template.".temp.php")) {
				$this->template = $template.".temp.php";
			} else {
				die("Le template n'existe pas.");
			}
		}

		public function assign($key, $value) {
			$this->data[$key] = $value;
		}

		/* Show the template when the objet is destruct */
		public function __destruct() {
			extract($this->data);
			if($this->template != null) {
			    include TEMPLATES_PATH.$this->template;
            }
		}
	}