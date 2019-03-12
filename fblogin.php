<?php
// 페이스북에서 발급받은 앱아이디와 시크릿
define('FACEBOOK_APP_ID', 593301271039110);
define('FACEBOOK_APP_SECRET', a3ca1434b415d18ee42c1521b189b604);
// 페이스북 로그인 호출시 반드시 포함해야하는 랜덤값. CSRF 공격 방지용
define('STATE', md5(uniqid(rand(), true)));
// 페이스북 로그인 완료 혹은 거절 후 돌아올 우리 사이트 페이지 주소(fblogin.php)
define('FACEBOOK_REDIRECT_URI', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
// 페이스북 로그인 주소
define('FACEBOOK_LOGIN_URL','https://www.facebook.com/dialog/oauth?client_id=".FACEBOOK_APP_ID."&redirect_uri=".FACEBOOK_REDIRECT_URI."&state=".STATE."&response_type=code&scope=email,public_profile');

// curl을 이용합니다.
// 페이스북 oauth 페이지들을 호출하고 값을 받아봅니다.
// param: string $_u - 호출할 url
// return: 호출 결과 값 string
function simple_fetch($_u) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $_u);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

// 페이스북에서 oauth용 사용자 엑세스 토큰값을 받아오기 위한 호출 함수
// 리턴값을 json 형식이며 이를 배열로 변환 후 access_token을 리턴합니다.
// https://developers.facebook.com/docs/facebook-login/access-tokens
// param: string $_facebook_code - 페이스북 로그인 후 리턴되는 code값
// return: succ - 사용자 토큰 / fail - ''
function get_acc_token($_facebook_code) {
  $token_url = "https://graph.facebook.com/oauth/access_token?client_id=".FACEBOOK_APP_ID;
  $token_url.= "&redirect_uri=".FACEBOOK_REDIRECT_URI."&client_secret=".FACEBOOK_APP_SECRET."&code=".$_facebook_code;
  $response = simple_fetch($token_url);
  $a = json_decode($response,true);
  if($a['access_token']) {
    return $a['access_token'];
  }
  return '';
}

// 페이스북이 제공하는 회원정보를 받아옵니다.
// https://developers.facebook.com/docs/graph-api
// https://developers.facebook.com/tools/explorer/145634995501895/
// 위의 두 페이지를 찾고하시고 fields(요청할 사용자 정보) 값을 적절히 조정하시면 됩니다.
// fields: id, cover, name, first_name, last_name, age_range, link, gender, locale, picture, timezone, updated_time, verified ...
// param: string $_access_token - get_acc_token() 함수를 통해 얻어온 토큰값
// return: succ - 사용자 정보 array / fail - empty array
function get_user($_access_token) {
  $graph_url = "https://graph.facebook.com/me?access_token=".$_access_token."&fields=id,name,picture,email";
  $response = simple_fetch($graph_url);
  $a = json_decode($response,true);
  if($a['id']) {
    return $a;
  }
  return array();
}
?>
