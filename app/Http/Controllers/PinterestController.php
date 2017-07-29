<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use seregazhuk\PinterestBot\Factories\PinterestBot;

class PinterestController extends Controller
{


    public function index()
    {
        $pinterest = PinterestBot::create();
        $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));
//        $pins = $pinterest->pins->search('food')->toArray();
//        $searchInPins = $pinterest->pins->searchInMyPins('islam')->toArray();
//        $searchInPeople = $pinterest->pinners->search('food')->toArray();
//        $boards = $pinterest->boards->search('marketing stuff')->toArray();
//        $myBoards = $pinterest->boards->forUser('uncrate');
//        $me = $pinterest->boards->forMe();
//        print_r($me);


        // Get lists of your boards
        $boards = $pinterest->boards->forMe();
        print_r($boards);

// Create a pin
//        $pinterest->pins->create('https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png', $boards[0]['id'], 'Pin description');

// Wait 5 seconds
//        $pinterest->wait(5);


    }

    public function scraperIndex()
    {
        if (!Data::myPackage('pinterest')) {
            return view('errors.404');
        }

        return view('pinScraper');
    }


    public function home()
    {
        if (!Data::myPackage('pinterest')) {
            return view('errors.404');
        }

        $pinterest = PinterestBot::create();
        $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));
        $pins = $pinterest->pins->feed()->toArray();
        print_r($pins);


    }

    public function write(Request $request)
    {
        try {
            $pinterest = PinterestBot::create();
            $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));
//            $pinterest->pins->create(public_path('/uploads') . '/' . $request->image, $request->boardId, $request->message, $request->siteUrl);
            $boards = $pinterest->boards->forMe();

// Create a pin
            $pinterest->pins->create(public_path('/uploads') . '/' . $request->image, $request->boardId, $request->message);

// Wait 5 seconds
            $pinterest->wait(5);
            return "success";

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function scraper(Request $request)
    {
        $pinterest = PinterestBot::create();
        $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));

        // show pins


        if ($request->type == "pins") {
            $pins = $pinterest->pins->search($request->data)->toArray();
            foreach ($pins as $pin) {

                echo '
                <div class="row">
                <div class="col-md-6">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="' . $pin['pinner']['image_xlarge_url'] . '" alt="User Image">
                <span class="username"><a target="_blank" href="https://www.pinterest.com/' . $pin['pinner']['username'] . '">' . $pin['pinner']['full_name'] . '</a></span>
                <span class="description">' . Carbon::parse($pin['created_at'])->diffForHumans() . ' ( ' . Carbon::parse($pin['created_at'])->toDateTimeString() . ' ) </span>
              </div>
              <!-- /.user-block -->
              
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <a href="https://www.pinterest.com/pin/' . $pin['id'] . '" target="_blank" class="username">' . $pin['rich_summary']['display_name'] . '</a>
              <img class="img-responsive pad" src="' . $pin['images']['736x']['url'] . '" alt="Photo">

              <p>' . $pin['description_html'] . '</p>
              <hr>
              <button class="btn btn-default btn-xs"><i class="fa fa-thumb-tack"></i> ' . $pin['aggregated_pin_data']['aggregated_stats']['saves'] . '</button>
              <button class="btn btn-default btn-xs"><i class="fa fa-check"></i> ' . $pin['aggregated_pin_data']['aggregated_stats']['done'] . '</button>
              <button class="btn btn-default btn-xs"><i class="fa fa-heart"></i> ' . $pin['like_count'] . '</button>
              <button class="btn btn-default btn-xs"><i class="fa fa-comment"></i> ' . $pin['comment_count'] . '</button>
              <button class="btn btn-default btn-xs"><i class="fa fa-star"></i> ' . $pin['aggregated_pin_data']['did_it_data']['rating'] . '</button>
              <button class="btn btn-default btn-xs"><i class="fa fa-users"></i> ' . $pin['aggregated_pin_data']['did_it_data']['user_count'] . '</button>
              <button class="btn btn-default btn-xs"><i class="fa fa-image"></i> ' . $pin['aggregated_pin_data']['did_it_data']['images_count'] . '</button>
              <div class="box-body">
              
              </div>
            </div>
            
              <!-- /.box-comment -->
            </div>
            
          </div>
          <!-- /.box -->
        </div></div>
                ';


            }
        } elseif ($request->type == "peoples") {
            $pins = $pinterest->pinners->search($request->data)->toArray();
            foreach ($pins as $pin) {
                echo '
                    <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-red-active">
              <h3 class="widget-user-username">' . $pin['full_name'] . '</h3>
              <h5 class="widget-user-desc">' . $pin['username'] . '</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="' . $pin['image_medium_url'] . '" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">' . $pin['pin_count'] . '</h5>
                    <span class="description-text">Pins</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">' . $pin['follower_count'] . '</h5>
                    <span class="description-text">FOLLOWERS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div align="center" class="box-footer">
              <img src="' . $pin['pin_thumbnail_urls']['1'] . '">
              <img src="' . $pin['pin_thumbnail_urls']['2'] . '">
              <img src="' . $pin['pin_thumbnail_urls']['3'] . '">
              <img src="' . $pin['pin_thumbnail_urls']['4'] . '">
              </div>
              <div align="center" class="box-footer">
              <a class="btn btn-xs btn-primary" target="_blank" href="https://www.pinterest.com/' . $pin['username'] . '"><i class="fa fa-user"></i> View Profile</a>
              </div>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <div class="col-md-3"></div>
        </div>
                ';

            }
        } elseif ($request->type == "boards") {
            $boards = $pinterest->boards->search($request->data)->toArray();
            foreach ($boards as $board) {
                echo "<div class='row'>";
                echo '
                <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-red">
              <div class="widget-user-image">
                <img class="img-circle" src="' . $board['owner']['image_medium_url'] . '" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">' . $board['owner']['full_name'] . '</h3>
              <h5 class="widget-user-desc">@' . $board['owner']['username'] . '</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a target="_blank" href="https://www.pinterest.com' . $board['url'] . '">URL <span class="pull-right badge bg-blue">https://www.pinterest.com' . $board['url'] . '</span></a></li>
                <li>
                ' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][0] . '">' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][1] . '">' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][2] . '">' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][3] . '">' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][4] . '">' .


                    '</li>
                
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
                
                ';
                echo "</div>";
            }
        } elseif ($request->type == "inMyPin") {

        }

    }


    public function autoFollow()
    {

    }


}
