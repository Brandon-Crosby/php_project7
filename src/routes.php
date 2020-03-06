<?php
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function ($request, $response, $args) {
    $endpoints = [
      'all tasks' => $this->api['api_url'].'/todos',
      'single tasks' => $this->api['api_url'].'/todos/{task_id}',
      'help' => $this->api['base_url'].'/',
    ];
    $result = [
      'endpoints' => $endpoints,
      'version' => $this->$api['version'],
      'timestamp' => time(),
    ];
    return $response->withJson($results, 200, JSON_PRETTY_PRINT);
    });
$app->group('/api/v1/tasks', function() use($app) {
    $app->get('', function (Request $request, Response $response, array $args) {
      $result = $this->task->getTasks();
      return $response->withJson($results, 200, JSON_PRETTY_PRINT);
    });
$app->get('/{task_id}', function (Request $request, Response $response, array $args) {
      $result = $this->task->getTasks($args['task_id']);
      return $response->withJson($results, 200, JSON_PRETTY_PRINT);
    });
$app->post('', function (Request $request, Response $response, array $args) {
      $result = $this->task->createTasks($args['task_id']);
      return $response->withJson($results, 200, JSON_PRETTY_PRINT);
    });
$app->put('/{task_id}', function (Request $request, Response $response, array $args) {
      $result = $this->task->createTasks($args['task_id']);
      $data = $request->getParsedBody();
      $data['task_id'] = $args['task_id'];
      $result = $this->task->updateTask($data);
      return $response->withJson($results, 200, JSON_PRETTY_PRINT);
    });
$app->delete('/{task_id}', function (Request $request, Response $response, array $args) {
      $result = $this->task->deleteTasks($args['task_id']);
      return $response->withJson($results, 200, JSON_PRETTY_PRINT);
    });
});
/*
$app->group('/{task_id}/reviews', function () use ($app) {
          $app->get('', function (Request $request, Response $response, array $args) {
              $result = $this->review->getReviewsBytaskId($args['task_id']);
              return $response->withJson($results, 200, JSON_PRETTY_PRINT);
    });
$app->get('/{review_id}', function (Request $request, Response $response, array $args) {
              $result = $this->review->getReview($args['review_id']);
              return $response->withJson($results, 200, JSON_PRETTY_PRINT);
      });
});
});
*/
