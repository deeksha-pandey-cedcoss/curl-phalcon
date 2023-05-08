<?php

use Phalcon\Mvc\Controller;
// defalut controller view
class IndexController extends Controller
{
    public function indexAction()
    {
        // default action
    }
    public function searchAction()
    {
        $u = "https://openlibrary.org/search.json?q=+&mode=ebooks&has_fulltext=true";
        $book = $this->request->getPost('book');

        $new = str_replace("+", $book, $u);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $new);
        $result = json_decode(curl_exec($ch), true);
        $this->session->set('value', $result);
       
        curl_close($ch);
    }
    public function fullpageAction()
    {
        $isbn=$_GET['isbn'];
       $u="https://openlibrary.org/api/books?bibkeys=ISBN:".$isbn."&jscmd=details&format=json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $u);
        $result = json_decode(curl_exec($ch), true);
        $str="ISBN:$isbn";
        $new=$result[$str];
        $this->session->set('value', $new);

    }
    
}
