<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Utils;


class Constants
{
    /**
     * HTTP Methods
     */
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';

    /**
     * Endpoints
     */
    const SNAPSCAN_API_ENDPOINT =  'https://pos.snapscan.io';

    /**
     * Fields
     */
    const QUERY_FIELD_MERCHANT_REFERENCE= 'merchantReference';
    const QUERY_FIELD_START_DATE = 'startDate';
    const QUERY_FIELD_END_DATE = 'endDate';
    const QUERY_FIELD_STATUS = 'status';
    const QUERY_FIELD_SNAP_CODE = 'snapCode';
    const QUERY_FIELD_AUTH_CODE = 'authCode';
    const QUERY_FIELD_SNAP_CODE_REFERENCE = 'snapCodeReference';
    const QUERY_FIELD_USER_REFERENCE = 'userReference';
    const QUERY_FIELD_STATEMENT_REFERENCE = 'statementReference';

    /**
     * Layout
     */
    const QRCODE_DEFAULT_SIZE = 300;
    const QRCODE_DEFAULT_MARGIN = 0;
}