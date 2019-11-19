<?php
include ('../../vendor/autoload.php');
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class BookEvent extends Event
{
    public $name = self::class;
}
class BookSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            "chinese.name" => "chineseNameShow",
            "english.name" => [
                ["englishNameShow", -10],
                ["englishNameAFter", 10],
            ],
            "math.name" => ["mathNameShow", 100]
        ];
    }
    public function chineseNameShow(Event $event)
    {
        echo "我是汉语书籍\n";
    }
    public function englishNameShow(Event $event)
    {
        echo "我是英文书籍\n";
    }
    public function englishNameAFter(Event $event)
    {
        echo "我是展示之后的英文书籍[来自于Event实例{$event->name}]\n";
    }
    public function mathNameShow(Event $event)
    {
        echo "我是展示的数学书籍\n";
    }
}
$dispatcher = new EventDispatcher();
$subscriber = new BookSubscriber();
$dispatcher->addSubscriber($subscriber);
$dispatcher->dispatch("english.name", new BookEvent());
$dispatcher->dispatch("chinese.name");
$dispatcher->removeSubscriber($subscriber);
$dispatcher->dispatch("math.name");
