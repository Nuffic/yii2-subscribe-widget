<?php

namespace app\controllers;

use GuzzleHttp\Client;
use Yii;
use yii\rest\Controller;
use yii\web\Response;
use yii\web\XmlResponseFormatter;

class SubscribeController extends Controller
{

    public function createAction()
    {
        $formatter = new XmlResponseFormatter([
                'rootTag' => 'html'
        ]);
        $resp = new Response();
        $resp->format = Response::FORMAT_XML;
        $resp->data = Yii::createObject(['class' => 'yii\rest\Serializer', 'response' => $resp, 'rootTag' => 'xmlrequest'])->serialize(['hue' => '72']);

        $formatter->format($resp);

        $resp->content;


        $client = new Client();

        $client->post('http://swakke.com/xml.php', [
            'body' => ,
        ]);

    }


}
