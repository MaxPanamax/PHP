<?php
class Picture{
    private $id;
    private $name;
    private $size;
    private $imagepath;

    public function __construct($id, $name, $size, $imagepath){
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
        $this->imagepath = $imagepath;
    }

    public function __toString(){
        return "<h1>Характеристики картинки:</h1>"."\n".
                "<b>Id картинки: </b>".$this->id."<br>".
                "<b>Наименование картинки: </b>".$this->name."<br>".
                "<b>Размер (в мегабайтах): </b>".$this->size."<br>".
                "<b>Путь к картинке: </b>".$this->imagepath;
    }

}

?>