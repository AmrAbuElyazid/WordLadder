<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Word Ladder</title>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="/css/styles.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
    </head>
    <body ng-app="wordLadderApp" ng-controller="wordLadderCtrl">
        <div class="flex-center position-ref full-height" style="padding-top: 100px !important" ng-show="!loading">
            <div class="content">
                <div class="title m-b-md" style="font-size: 84px">
                    Word Ladder
                </div>
{{--                 <svg ng-show="started" class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                   <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                </svg>
 --}}                <div class="row">
                  <span>
                    <input class="swing" ng-model="start" type="text" placeholder="Enter the starting word" /><label>Start</label>
                  </span>
                  <span>
                    <input class="swing" ng-model="finish" type="text" placeholder="Enter the ending word" /><label>End</label>
                  </span>
                </div>

                  <div class="buttons">
                    <div id="one" class="button" ng-click="calc($event)"><b>Calculate</b></div>
                  </div>
            </div>
        </div>
    </body>
</html>
<div id="modal-container">
  <div class="modal-background">
    <div class="modal">
      <h2>Here's the solution from '@{{start}}' to '@{{finish}}'</h2>
      <div ng-repeat="word in words">
          <p><b>@{{word}}</b></p>
      </div>
      <p><b>@{{error}}</b></p>
      <svg class="modal-svg" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none">
                                <rect x="0" y="0" fill="none" width="226" height="162" rx="3" ry="3"></rect>
                            </svg>
    </div>
  </div>
</div>

<script type="text/javascript">
    var app = angular.module('wordLadderApp', []);
    app.controller('wordLadderCtrl', function ($scope, $http) {

        $('.button').click(function(){
          var buttonId = $(this).attr('id');
          $('#modal-container').removeAttr('class').addClass(buttonId);
          $('body').addClass('modal-active');
        })

        $('#modal-container').click(function(){
          $(this).addClass('out');
          $('body').removeClass('modal-active');
        });

        $scope.calc = function (event) {
            event.preventDefault();
            // $scope.started = true;
            $http.post('/calculate', {
                start: $scope.start,
                finish: $scope.finish
            }).then(function (res) {
                console.log(res.data)
                if(res.data.includes('Error')) {
                    $scope.words = {};
                    $scope.error = res.data;
                }else{
                    $scope.words = res.data;
                    $scope.error = '';
                }
                // $scope.started = false;
            })
        }
    })
</script>