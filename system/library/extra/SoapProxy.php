<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 20.01.14
 * Time: 11:04
 * To change this template use File | Settings | File Templates.
 */

class SoapProxy extends SoapClient{

    private $extraNodes;

    public function __doRequest($request, $location, $action, $version, $one_way = 0) {



        $dom = new DomDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = true;
        $dom->loadXML($request);



        $nodes = $dom->getElementsByTagName('Item');

        $item = $nodes->item(0);


        foreach($this->extraNodes as $node)
        {



            $newNode = $dom->createElement($node['namespace'].':'.$node['name'],$node['value']);

            if($item)
            {
                $item->appendChild($newNode);
            }

        }

        // trzeba zmodyfikować request o ddatkowe nody a potem wyslac parentem
        //return $request;
        $re = $dom->saveXML();

        return parent::__doRequest($re, $location, $action, $version);

    }

    public function setExtraNodes($extraNodes)
    {
        $this->extraNodes = $extraNodes;
    }

}