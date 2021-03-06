<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description ?>">
    <!--   Need to change the document root ($server) to a public folder -->
    <link rel="stylesheet" href="<?php echo BASE_ABSOLUTE_PATTERN;?>Public/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_ABSOLUTE_PATTERN;?>Public/css/grid.css">
    <link rel="stylesheet" href="<?php echo BASE_ABSOLUTE_PATTERN;?>Public/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="<?php echo BASE_ABSOLUTE_PATTERN;?>Public/img/favicon.ico" />
    <?php // Chargement de TinyMCE avec CDN en mode Production
        if(PRODUCTION_MODE === true) {
            echo '<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>';
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>';
        } else {
            echo '<script src="'.ABSOLUTE_PATH_FRONT.PUBLIC_PATH.'/js/tinymce/tinymce.min.js"></script>';
            echo '<script src="'.ABSOLUTE_PATH_FRONT.PUBLIC_PATH.'/js/Chart.min.js"></script>';
        }
    ?>
    
    <script>tinymce.init({
    	  selector: "textarea",  // change this value according to your HTML
    	  relative_urls: false,
    	  remove_script_host: true,
    	  plugins: [
    		    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    		    'searchreplace wordcount visualblocks visualchars code ',
    		    'insertdatetime media nonbreaking save table contextmenu directionality',
    		    'emoticons paste textcolor colorpicker textpattern imagetools codesample toc importImageSMW fullscreen'
    		  ],
    		  toolbar1: 'undo redo | insert | styleselect | bold underline italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link importImageSMW',
    		  toolbar2: 'forecolor backcolor emoticons | preview code fullscreen',
    		  image_advtab: true,
    	});
	</script>
	<script>$urlImageAction = "<?php echo ABSOLUTE_PATH_BACK."multimedia/pluginTiny"; ?>";</script>
    <script src="<?php echo ABSOLUTE_PATH_FRONT.PUBLIC_PATH."/js/tinymce/plugins/customimport/"; ?>plugin.js"></script>
</head>
<body>
    <nav>
        <!-- Retirer la mise en forme du <a> -->
        <div class="left-menu">
            <div class="logo"><a href="<?php echo ABSOLUTE_PATH_BACK . "dashboard";?>"><i class="fa fa-cog"></i></a>
                <p>Setup My Website</p>
            </div>
            <div class="accordion">
                <div class="section">
                    <input type="radio" name="accordion-1" id="section-1" />
                    <label for="section-1"><i class="fa fa-eye respons_hidden"></i><span class="respons_hidden"><a href="<?php echo ABSOLUTE_PATH_BACK . "dashboard";?>">Dashboard</a></span></label>
                </div>
                <div class="section">
                    <input type="radio" name="accordion-1" id="section-2" value="toggle" <?php (ABSOLUTE_PATH_BACK . "articles/add")? "checked = \"checked\"":"";?>/>
                    <label for="section-2"><i class="fa fa-pencil"></i> <span class="respons_hidden">Articles</span></label>
                    <div class="content">
                        <ul>
                            <li><a id="art_add" href="<?php echo ABSOLUTE_PATH_BACK . "articles/add";?>"><i class="fa fa-plus"></i><span class="respons_hidden">Ajouter</span></a></li>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "articles/view";?>"><i class="fa fa-bars"></i><span class="respons_hidden">Liste des articles</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="section">
                    <input type="radio" name="accordion-1" id="section-3" value="toggle"/>
                    <label for="section-3"><i class="fa fa-file-o"></i> <span class="respons_hidden">Pages</span></label>
                    <div class="content">
                        <ul>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "pages/add";?>"><i class="fa fa-plus"></i><span class="respons_hidden">Ajouter</span></a></li>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "pages/view";?>"><i class="fa fa-bars"></i><span class="respons_hidden">Toutes les pages</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="section">
                    <input type="radio" name="accordion-1" id="section-4" value="toggle" />
                    <label for="section-4"><i class="fa fa-camera"></i> <span>Bibliothéque</span></label>
                    <div class="content">
                        <ul>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "multimedia/add";?>"><i class="fa fa-plus"></i><span class="respons_hidden">Ajouter un média</span></a></li>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "multimedia/view";?>"><i class="fa fa-th"></i><span class="respons_hidden">Bibliothéque des médias</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="section">
                    <input type="radio" name="accordion-1" id="section-5" value="toggle"/>
                    <label for="section-5"><i class="fa fa-font"></i> <span class="respons_hidden">Apparence</span></label>
                    <div class="content">
                        <ul>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "themes/view";?>"><i class="fa fa-desktop"></i><span class="respons_hidden">Thémes</span></a></li>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "themes/view";?>"><i class="fa fa-eyedropper"></i><span class="respons_hidden">Personnaliser</span></a></li>
                            <li><a href="#"><i class="fa fa-level-up"></i><span class="respons_hidden">Widget</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="section">
                    <input type="radio" name="accordion-1" id="section-6" value="toggle"/>
                    <label for="section-6"><i class="fa fa-user-circle"></i> <span class="respons_hidden">Utilisateurs</span></label>
                    <div class="content">
                        <ul>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "users/add";?>"><i class="fa fa-user-plus"></i><span class="respons_hidden">Ajouter</span></a></li>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "users/view";?>"><i class="fa fa-users"></i><span class="respons_hidden">Tous les utilisateurs</span></a></li>
                            <li><a href="<?php echo ABSOLUTE_PATH_BACK . "users/profile";?>"><i class="fa fa-user-o"></i><span class="respons_hidden">Votre profil</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="section">
                    <input type="radio" name="accordion-1" id="section-7" value="toggle"/>
                    <label for="section-7"><i class="fa fa-wrench"></i> <span class="respons_hidden"><a href="">Outils</a></span></label>
                    <!--<div class="content">
                    </div>-->
                </div>
                <div class="section">
                    <input type="radio" name="accordion-1" id="section-8" value="toggle"/>
                    <a href="<?php echo ABSOLUTE_PATH_BACK . "settings/view";?>">
                    	<label for=""><i class="fa fa-gears"></i> <span class="respons_hidden">Réglages</span></label>
                    </a>
                    <!--  <div class="content">
                      </div> -->
                </div>
                <div class="section">
                    <a href="<?php echo ABSOLUTE_PATH_FRONT . "index";?>">
                    	<label for=""><i class="fa  fa-paper-plane-o"></i> <span class="respons_hidden">Visionner le site</span></label>
                    </a>
                </div>
                <div class="section">
                	<a onclick="<?php ?>" href="<?php echo ABSOLUTE_PATH_FRONT . "logout";?>">
                    	<label for=""><i class="fa fa-sign-out"></i> <span class="respons_hidden">Logout</span></label>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <?php include $this->view; ?>

    <?php // Chargement de JQuery et Charts.JS avec CDN en mode Production
        if(PRODUCTION_MODE === true) {
            echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
        } else {
            echo '<script src="'.ABSOLUTE_PATH_FRONT.PUBLIC_PATH.'/js/jquery-3.2.1.min.js"></script>';
        }
    ?>
    
    
    <script src="<?php echo BASE_ABSOLUTE_PATTERN;?>Public/js/index.js"></script>
</body>
</html>
