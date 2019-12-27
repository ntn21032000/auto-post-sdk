<?php
require_once __DIR__ . '/vendor/autoload.php';
use Facebook\Authentication\AccessToken;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;
session_start();
$app_id = '830193117422941';
$app_secret = '7194fdbdc8904482d381f02d3cbcc79f';
$app = new FacebookApp($app_id, $app_secret);
$fb = new Facebook\Facebook(array(
    'app_id' => $app_id,
    'app_secret' => $app_secret,
    'default_graph_version' => 'v2.5',
));
//Page access token has been got from get_page_access_token.php
$access_token = 'EAALzDmXb5V0BAPDf11HWmX7JYXtbIZA60yKjZAKZAzP4R3r08wYesTD71poiH7qoMZBjc0zq2LebBp6wSRAIB6eEvearzIpsYFSR7LwZBsPLgt6j92mGuDqoIAjy1Wg64nwJktAkqvS7FBhKQQ9pQmwBZCCtJyRiTsO6boZAJs7q5a1jhLD0fNVNGNZCXEmE9ZCsZD';

$page_id = '109789497080090';
$img = array();

if (isset($_GET['url1']) && isset($_GET['url2'])) {
  function postImg1()
  {
    global $img;
    global $app;
    global $access_token;
    global $page_id;
    global $fb;
    $post_data1 = array(
      'url' => $_GET['url1'],
      'caption' => 'hinh 1',
      'published' => 'false'
    	);

    $request = new FacebookRequest($app, $access_token, 'POST', '/' . $page_id . '/photos', $post_data1);
    // Send the request to Graph
    try {
      $response = $fb->getClient()->sendRequest($request);
      $graphNode = $response->getGraphNode();
      echo 'Post ID: ' . $graphNode['id'];
      $img[0] = $graphNode['id'];
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
  }

  function postImg2()
  {
    global $img;
    global $app;
    global $access_token;
    global $page_id;
    global $fb;
    $post_data2 = array(
      'url' => $_GET['url2'],
      'caption' => 'hinh 2',
      'published' => 'false'
    	);

    $request = new FacebookRequest($app, $access_token, 'POST', '/' . $page_id . '/photos', $post_data2);
    // Send the request to Graph
    try {
      $response = $fb->getClient()->sendRequest($request);
      $graphNode = $response->getGraphNode();
      echo 'Post ID: ' . $graphNode['id'];
      $img[1] = $graphNode['id'];
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
  }

  function postAll()
  {
    global $img;
    global $app;
    global $access_token;
    global $page_id;
    global $fb;
    $post_data3 = array(
    	'message' => 'hello nghia',
      // 'attached_media[0]' => '{"media_fbid":"'.$img[0].'"}',
      // 'attached_media[1]' => '{"media_fbid":"'.$img[1].'"}'
    	);
    $request = new FacebookRequest($app, $access_token, 'POST', '/' . $page_id . '/feed', $post_data3);
    // Send the request to Graph
    try {
      $response = $fb->getClient()->sendRequest($request);
      $graphNode = $response->getGraphNode();
      echo 'Post ID: ' . $graphNode['id'];
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
  }

    // postImg1();
    // postImg2();
    postAll();
}
else {
  echo "Khong co anh";
}
?>
