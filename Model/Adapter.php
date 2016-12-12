<?php
// Structural Patterns
// Adapter(适配器模式)
// 这种模式允许使用不同的接口重构某个类，可以允许使用不同的调用方式进行调用：

class SimpleBook {

    private $author;
    private $title;

    function __construct($author_in, $title_in) {
        $this->author = $author_in;
        $this->title  = $title_in;
    }

    function getAuthor() {
        return $this->author;
    }

    function getTitle() {
        return $this->title;
    }
}

class BookAdapter {

    private $book;

    function __construct(SimpleBook $book_in) {
        $this->book = $book_in;
    }
    function getAuthorAndTitle() {
        return $this->book->getTitle().' by '.$this->book->getAuthor();
    }
}

// Usage
$book = new SimpleBook("Gamma, Helm, Johnson, and Vlissides", "Design Patterns");
$bookAdapter = new BookAdapter($book);
echo 'Author and Title: '.$bookAdapter->getAuthorAndTitle();

function echos ($line_in) {
  echo $line_in."<br/>";
}