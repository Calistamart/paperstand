<?php

class Article {
    private $title = "";
    private $content = "";
    private $image = "";
    private $author;

    public function __construct($title, $content, User $author)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
    }
}

?>