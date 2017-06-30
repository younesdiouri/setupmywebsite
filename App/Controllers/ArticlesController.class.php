<?php
class ArticlesController{
	public function addAction($params){
	    /* Basic add to database */
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['title']) && isset($_POST['content'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];

            $post = new Posts();
            $post->setTitle($title);
            $post->setContent($content);
            $post->setName("");
            $post->setDescription("");
            $post->Save();
        }
        require VIEWS_PATH.BASE_BACK_OFFICE."article/add.view.php";
	}

    public function viewAction($params){
        require VIEWS_PATH.BASE_BACK_OFFICE."article/index.view.php";
    }

    public function editAction($params){
        require VIEWS_PATH.BASE_BACK_OFFICE."article/edit.view.php";
    }

    public function deleteAction($params){
        require VIEWS_PATH.BASE_BACK_OFFICE."article/delete.view.php";
    }
}