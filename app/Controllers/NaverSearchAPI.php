<?php
namespace App\Controllers;
use CodeIgniter\HTTP\Request;

class NaverSearchAPI extends BaseController
{
    public function SearchTrand()
    {
        // 네이버 데이터랩 통합검색어 트렌드 Open API 예제
        $client_id = "jDBHq2CxbGRno8xZCiJu";
        $client_secret = "PVEeQzouOp";
        $url = "https://openapi.naver.com/v1/datalab/search";
        $body = "{\"startDate\":\"2023-01-01\",\"endDate\":\"2023-11-11\",\"timeUnit\":\"month\",\"keywordGroups\":[{\"groupName\":\"광고\",\"keywords\":[\"넷플릭스\",\"디즈니플러스\"]},{\"groupName\":\"AI\",\"keywords\":[\"챗GPT\",\"LLM\"]}]}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = "X-Naver-Client-Id: ".$client_id;
        $headers[] = "X-Naver-Client-Secret: ".$client_secret;
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // SSL 이슈가 있을 경우, 아래 코드 주석 해제
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo "status_code:".$status_code." ";
        curl_close ($ch);
        if($status_code == 200) {
            var_dump($response);
        } else {
            echo "Error 내용:".$response;
        }
    }
}
