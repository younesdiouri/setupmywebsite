	<header>
    </header>
	<section>
        <div class="back_glob">
            <div class="back_header">
                <h1>LOGIN</h1>
            </div>
            <form action="" method="post">
                <div class="trois-colonnes">
                    <div class="colonne2">
                        <input type="text" name="login" value="admin" class="form-group">
                    </div>

                    <div class="colonne2">
                         <input type="password" placeholder="password" name="password" value="admin" class="form-group">
                    </div>

                    <div class="colonne2">
                        <input type="submit" name="submit" value="Login" class="form-group">
                    </div>
                </div>
                <a href="<?php echo ABSOLUTE_PATH_FRONT."login/forget" ?>">Mot de passe oublié ?</a>
                <?php
                if( !empty($error) ) {
                    echo "<p>" .htmlspecialchars($error). "</p>";
                }
                ?>
            </form>
        </div>
	</section>
    <footer>
    </footer>
