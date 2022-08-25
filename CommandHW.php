<?php

echo "Command: \n";
//Команда: вы — разработчик продукта Macrosoft World. Это текстовый редактор с
//возможностями копирования, вырезания и вставки текста (пока только это). Необходимо
//реализовать механизм по логированию этих операций и возможностью отмены и возврата
//действий. Т. е., в ходе работы программы вы открываете текстовый файл .txt, выделяете
//участок кода (два значения: начало и конец) и выбираете, что с этим кодом делать.

interface CommandInterface
{
    public function execute();

    public function undo();

    public function redo();
}

class MicroCommand implements CommandInterface

{
    protected $text= file('text.txt');
    protected $newText= file('text.txt.bak');

    public function __construct($text, $newText )
    {
        $this->text = $text;
        $this->newText = $newText;

    }

    public function execute()
    {
        copy($this->text, $this->newText);
        echo "Hello {$this->newText}";
    }




    protected function log()
    {

        print_r($this->newText);
    }

    public function undo()
    {
        copy($this->newText, $this->text);
        echo "World {$this->text }";
    }

    public function redo()
    {
        copy($this->text, $this->newText);
        echo "Hello {$this->newText}";
    }

}




class PrintManager
{
    public function submit(CommandInterface $command)
    {
        $command->execute();
        $command->undo();
        $command->redo();
    }
}

$inwoker = new PrintManager();
$inwoker->submit(new MicroCommand( "", ""));


