<?php
namespace Common\Util;

class Feed
{
    public $title       = ""; // channel的title
    public $link        = ""; //channel的link
    public $description = ""; //channel的description
    public $items       = array();

    public $template = SITE_URL . '/Public/rss.xml';
    protected $dom   = null;
    protected $rss   = null;

    public function __construct()
    {
        $this->dom = new \DOMDocument('1.0', 'utf-8');
        $this->dom->load($this->template);
        $this->rss = $this->dom->getElementsByTagname('rss')->item(0);
    }

    public function display()
    {
        $this->createChannel();
        $this->addItem($this->items);
        header("content-type:text/xml;charset=utf-8");
        echo $this->dom->savexml();
    }

    protected function createChannel()
    {
        $channel = $this->dom->createElement('channel');
        $channel->appendChild($this->createEle('title', $this->title));
        $channel->appendChild($this->createEle('link', $this->link));
        $channel->appendChild($this->createEle('description', $this->description));

        $this->rss->appendChild($channel);
    }

    /**
     * [addItem description]
     * @param [type] $list 二维数组
     */
    protected function addItem($list)
    {
        foreach ($list as $i) {
            $this->rss->appendChild($this->createItem($i));
        }
    }

    /**
     * [createItem description]
     * @param  [type] $arr 一维数组
     * @return [type]      [description]
     */
    protected function createItem($arr)
    {
        $item = $this->dom->createElement('item');
        foreach ($arr as $k => $v) {
            $item->appendChild($this->createEle($k, $v));
        }
        return $item;
    }

    /**
     * 生成<ele>text</ele>
     * @param  str $name  标签名
     * @param  str $value 标签的文本值
     * @return str        生成的标签
     */
    protected function createEle($name, $value)
    {
        $ele  = $this->dom->createElement($name);
        $text = $this->dom->createTextNode($value);
        $ele->appendChild($text);

        return $ele;
    }
}
