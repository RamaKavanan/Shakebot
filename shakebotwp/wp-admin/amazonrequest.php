<?php 
        $urlPassRp = $seckeyPassRp = $ulRp = $asnRp = ''; 
        $asn = $_REQUEST['id'];
        $asnRp = trim($asn);
        $urlPassRp = "http://webservices.amazon.com/onca/xml?AWSAccessKeyId=AKIAIWY4V7MWOBW4VWGA&AssociateTag=shak08-20&IdType=ASIN&ItemId=".$asnRp."&Operation=ItemLookup&ResponseGroup=Images&Service=AWSECommerceService";
        $seckeyPassRp = "DwyOiA1Ul8x98Lt7sHMwR3j662ynT9fO3zpV3hsM";
        $ulRp = AmazonUrl($urlPassRp,$seckeyPassRp);
        $priceArrRp = getXmlForImg($ulRp);
        $amazonImage = $priceArrRp->Items->Item->MediumImage->URL;
        header('Content-type: image');
        header('Content-Disposition: inline; filename="'.$amazonImage.'"');
        if(isset($amazonImage)){
            $img = '<div><img src="'.$amazonImage.'" width="123" height="120" style="float:left;margin-left:4px; margin-bottom:10px;"></img></div><div><a style="display: inline-block;float:left;margin-top: 52px;" class="page-title-action" href="downloadimg.php?amazonimg='.$amazonImage.'" >Download Image</a></div>';
            echo $img;
        }else{
            $img = '<img src="nopicture.gif" height=123 width=120></img>';
            echo $img;
        }        

        function AmazonUrl($url, $secret_key)
            { 
                $original_url = $url;

                // Decode anything already encoded
                $url = urldecode($url);

                // Parse the URL into $urlparts
                $urlparts       = parse_url($url);

                // Build $params with each name/value pair
                foreach (split('&', $urlparts['query']) as $part) {
                    if (strpos($part, '=')) {
                        list($name, $value) = split('=', $part, 2);
                    } else {
                        $name = $part;
                        $value = '';
                    }
                    $params[$name] = $value;
                }

                // Include a timestamp if none was provided
                if (empty($params['Timestamp'])) {
                    $params['Timestamp'] = gmdate('Y-m-d\TH:i:s\Z');
                }

                // Sort the array by key
                ksort($params);

                // Build the canonical query string
                $canonical       = '';    
                foreach ($params as $key => $val) {
                    $canonical  .= "$key=".rawurlencode(utf8_encode($val))."&";
                }    
                // Remove the trailing ampersand
                $canonical       = preg_replace("/&$/", '', $canonical);

                // Some common replacements and ones that Amazon specifically mentions
                $canonical       = str_replace(array(' ', '+', ',', ';'), array('%20', '%20', urlencode(','), urlencode(':')), $canonical);

                // Build the sign
                $string_to_sign             = "GET\n{$urlparts['host']}\n{$urlparts['path']}\n$canonical";
                // Calculate our actual signature and base64 encode it
                $signature            = base64_encode(hash_hmac('sha256', $string_to_sign, $secret_key, true));

                // Finally re-build the URL with the proper string and include the Signature
                $url = "{$urlparts['scheme']}://{$urlparts['host']}{$urlparts['path']}?$canonical&Signature=".rawurlencode($signature);
                return $url;
            }
        function getXmlForImg($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $result = curl_exec($ch);
            curl_close($ch);

            return simplexml_load_string($result);
        }
?>
<script>
    @media screen and (max-width: 700px) {	
	.aimg {width:143px;}	
}
  
</script>
