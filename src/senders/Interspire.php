<?php

namespace nuffic\subscribe\senders;

use GuzzleHttp\Client;
use nuffic\subscribe\SubscribableInterface;
use Yii;
use yii\base\Model;
use yii\base\Object;
use yii\web\Response;
use yii\web\XmlResponseFormatter;

class Interspire extends Object implements SubscribableInterface
{
    public $apiToken;

    public $apiUser;
    
    public $host;

    public $endPoint;

    public $list;

    public function subscribe(Model $model)
    {
        $payload = [
            'username' => $this->apiUser,
            'usertoken' => $this->apiToken,
            'requesttype' => 'subscribers',
            'requestmethod' => 'AddSubscriberToList',
            'details' => [
                'emailaddress' => $model->email,
                'mailinglist' => $this->list,
            ],
        ];

        $formatter = new XmlResponseFormatter([
            'rootTag' => 'xmlrequest'
        ]);
        $resp = new Response();
        $resp->format = Response::FORMAT_XML;
        $resp->data = Yii::createObject(['class' => 'yii\rest\Serializer', 'response' => $resp])->serialize($payload);
        $formatter->format($resp);

        $client = new Client();

        $response = $client->post($this->endPoint, [
            'headers' => [
                'Host' => $this->host,
            ],
            'body' => $resp->content,
        ]);

        $result = $this->xmlToObject($response->getBody()->getContents());

        if (strtoupper($result->status) == 'SUCCESS') {
            return $model;
        }

        if (strpos($result->errormessage, 'already exists in the given list') !== false) {
            $model->addError('email', Yii::t('app', 'This email is already subscribed'));
            return $model;
        }

        $model->addError('email', Yii::t('app', 'Something went wrong'));
        return $model;
    }

    private function xmlToObject($xml)
    {
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        return json_decode($json);
    }
}
