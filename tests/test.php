<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */
require_once __DIR__ . '/../vendor/autoload.php';

use SnapScan\Handlers\SnapScan;
use SnapScan\Models\QRCode;
use SnapScan\Config;

$config = new Config();
$config->setMerchantId('zandodemo');
$config->setApiToken('9b395f61-2157-48b4-aa3c-9c6a95c54c7b');

$model = new SnapScan($config);

$qrCodeModel = new QRCode();
$qrCodeModel->setAmount(300);
$qrCodeModel->setId(6123122);
$qrCodeModel->setSnapCode($config->getMerchantId());
$qrCodeModel->setSnapCodeSize($model->getSize());
$qrCodeModel->setStrict(true);
$qrCodeModel->setReturnImageUriOnly(true);

$qrCode = $model->generateQRCodeImage($qrCodeModel);

echo $qrCode;

$payments = $model->getAllPayments();
_d($payments->toArray());