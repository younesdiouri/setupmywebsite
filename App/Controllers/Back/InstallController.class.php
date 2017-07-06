<?php
class InstallController{
    public function indexAction($params){
        if(file_exists(CONFIG_PERSO_FILE)) {
            header("Location: http://".$_SERVER['HTTP_HOST'].BASE_ABSOLUTE_PATTERN);
        } else {
            require VIEWS_PATH . "install/index.view.php";
        }
    }

    public function databaseConfigurationAction($params){
        if(file_exists(CONFIG_PERSO_FILE)) {
            header("Location: http://".$_SERVER['HTTP_HOST'].BASE_ABSOLUTE_PATTERN);
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['host']) && !empty($_POST['port']) && !empty($_POST['user'])
                && isset($_POST['password']) && !empty($_POST['database_name'])
            ) {

                if (isset($_SESSION["error_form"])) {
                    unset($_SESSION["error_form"]);
                }

                // On récupère les données dans des variables
                $host = $_POST['host'];
                $port = $_POST['port'];
                $user = $_POST['user'];
                $password = $_POST['password'];
                $databaseName = $_POST['database_name'];

                $error = false;
                $listOfErrors = [];

                // Vérification de l'hôte
                if (strlen($host) > 255) {
                    array_push($listOfErrors, "L'hôte saisie n'est pas valide.");
                    $error = true;
                }

                // Vérification du port
                if ($port < 0 || $port > 65535) {
                    array_push($listOfErrors, "Le port saisie n'est pas valide.");
                    $error = true;
                }

                // Vérification du user
                if (strlen($user) > 32) {
                    array_push($listOfErrors, "Le user saisie n'est pas valide.");
                    $error = true;
                }

                // Vérification du mot de passe
                if (strlen($password) > 32) {
                    array_push($listOfErrors, "Le mot de passe saisie n'est pas valide.");
                    $error = true;
                }

                // Vérification du nom de la base de données
                /*if($databaseName) {
                    array_push($listOfErrors, "Le nom de la base de données n'est pas valide.");
                    $error = true;
                }*/

                // On essaye de se connecter à la base de données avec les données reçues
                if ($error == false) {
                    try {
                        $pdo = new PDO("mysql:host=" . $host . ";dbname=" . $databaseName . ";port=" . $port, $user, $password);
                    } catch (Exception $e) {
                        array_push($listOfErrors, "Erreur de connexion à la base de données. Veuillez vérifier vos paramètres de connexion.");
                        $error = true;
                    }
                }
                if ($error == true) {
                    $_SESSION["error_form"] = $listOfErrors;
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    die();
                }

                // Si la connexion à fonctionné, on charge le fichier SQL et on éxécute le contenu
                $sqlFile = INSTALL_DATABASE_FILE;
                $req = "";
                $req = file_get_contents($sqlFile);
                $pdo->query($req);

                // On vérifie si les données ont bien été créé
                $is_table = $pdo->query("SHOW TABLES");
                echo "Row:" . $is_table->rowCount();

                // Si la création a bien fonctionné, on continue à la page suivante
                if ($is_table->rowCount() > 0) {
                    $_SESSION["host"] = $host;
                    $_SESSION["port"] = $port;
                    $_SESSION["user"] = $user;
                    $_SESSION["password"] = $password;
                    $_SESSION["database_name"] = $databaseName;
                    header("Location: administratorConfiguration");
                    die();
                } else {
                    array_push($listOfErrors, "La création des données dans la base de données n'a pas fonctionné.");
                    $_SESSION["error_form"] = $listOfErrors;
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    die();
                }
            } else {
                require VIEWS_PATH . "install/databaseConfiguration.view.php";
            }
        }
    }

    public function administratorConfigurationAction($params){
        if(file_exists(CONFIG_PERSO_FILE)) {
            header("Location: http://".$_SERVER['HTTP_HOST'].BASE_ABSOLUTE_PATTERN);
        } else {
            // On charge les classes
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['user'])
                && !empty($_POST['password']) && !empty($_POST['email'])
            ) {

                $error = false;
                $listOfErrors = [];

                session_start();
                if (isset($_SESSION["error_form"])) {
                    unset($_SESSION["error_form"]);
                }

                // On vérifie que les informations de connexion à la base de données sont bien présentent
                if (!isset($_SESSION["user"]) || !isset($_SESSION["password"]) || !isset($_SESSION["port"])
                    || !isset($_SESSION["port"]) || !isset($_SESSION["port"])
                ) {
                    array_push($listOfErrors, "Des informations de connexion sont manquantes");
                } else {
                    $host = $_SESSION["host"];
                    $port = $_SESSION["port"];
                    $user = $_SESSION["user"];
                    $password = $_SESSION["password"];
                    $databaseName = $_SESSION["database_name"];
                }

                // On récupère les données dans des variables
                $adminLogin = $_POST['user'];
                $adminPassword = $_POST['password'];
                $adminEmail = $_POST['email'];

                // Vérification du user
                if (strlen($adminLogin) > 32) {
                    array_push($listOfErrors, "Le user saisie n'est pas valide.");
                    $error = true;
                }

                // Vérification du mot de passe
                if (strlen($adminPassword) > 64) {
                    array_push($listOfErrors, "Le mot de passe saisie n'est pas valide.");
                    $error = true;
                }

                // Vérification de l'email
                if (filter_var($adminEmail, FILTER_VALIDATE_EMAIL) == false) {
                    array_push($listOfErrors, "L'email saisie n'est pas valide.");
                    $error = true;
                }

                // On essaye de se connecter à la base de données avec les données reçues
                if ($error == false) {
                    try {
                        $pdo = new PDO("mysql:host=" . $host . ";dbname=" . $databaseName . ";port=" . $port, $user, $password);
                    } catch (Exception $e) {
                        array_push($listOfErrors, "Erreur de connexion à la base de données. Veuillez vérifier vos paramètres de connexion.");
                        $error = true;
                    }
                }
                if ($error == true) {
                    $_SESSION["error_form"] = $listOfErrors;
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    die();
                }

                define("DB_HOST", $host);
                define("DB_NAME", $databaseName);
                define("DB_PORT", $port);
                define("DB_USER", $user);
                define("DB_PWD", $password);
                $user = new Users();
                $user->setLogin($adminLogin);
                $user->setPassword($adminPassword);
                $user->setEmail($adminEmail);
                $user->setFirstName("Name");
                $user->setLastName("Name");
                $user->setActivationKey("");
                $user->Save();

                header("Location: installConfiguration");
                die();
            } else {
                require VIEWS_PATH . "install/administratorConfiguration.view.php";
            }
        }
    }

    public function installConfigurationAction($params){
        if(file_exists(CONFIG_PERSO_FILE)) {
            header("Location: http://".$_SERVER['HTTP_HOST'].BASE_ABSOLUTE_PATTERN);
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['start'])) {
                // On vérifie que les informations de connexion à la base de données sont bien présentent
                if (!isset($_SESSION["user"]) || !isset($_SESSION["password"]) || !isset($_SESSION["port"])
                    || !isset($_SESSION["port"]) || !isset($_SESSION["port"])
                ) {
                    array_push($listOfErrors, "Des informations de connexion sont manquantes");
                } else {
                    $host = $_SESSION["host"];
                    $port = $_SESSION["port"];
                    $user = $_SESSION["user"];
                    $password = $_SESSION["password"];
                    $databaseName = $_SESSION["database_name"];
                }

                // On créé un fichier de configuration personnalisé
                /* ".." . DS . ".." . DS . "Config" . DS . */
                $file = "Config" . DS . "config_perso_inc.php";
                $configuration = "<?php \n\n";
                $configuration .= "/* Base de données */\n";
                $configuration .= "define(\"DB_USER\", \"" . $user . "\");\n";
                $configuration .= "define(\"DB_PWD\", \"" . $password . "\");\n";
                $configuration .= "define(\"DB_HOST\", \"" . $host . "\");\n";
                $configuration .= "define(\"DB_NAME\", \"" . $databaseName . "\");\n";
                $configuration .= "define(\"DB_PORT\", \"" . $port . "\");\n";
                file_put_contents($file, $configuration, FILE_APPEND | LOCK_EX);
                header("Location: http://" . $_SERVER['HTTP_HOST'] . BASE_ABSOLUTE_PATTERN);
            } else {
                require VIEWS_PATH . "install/installConfiguration.view.php";
            }
        }
    }
}