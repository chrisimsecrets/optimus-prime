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
    $boards = $pinterest->boards->search('food')->toArray();

        print_r($boards);
    }

    public function scraperIndex()
    {
        if (!Data::myPackage('pinterest')) {
            return view('errors.404');
        }

        return view('pinScraper');
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
              <h3 class="widget-user-username">'.$pin['full_name'].'</h3>
              <h5 class="widget-user-desc">'.$pin['username'].'</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="'.$pin['image_medium_url'].'" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">'.$pin['pin_count'].'</h5>
                    <span class="description-text">Pins</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">'.$pin['follower_count'].'</h5>
                    <span class="description-text">FOLLOWERS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div align="center" class="box-footer">
              <img src="'.$pin['pin_thumbnail_urls']['1'].'">
              <img src="'.$pin['pin_thumbnail_urls']['2'].'">
              <img src="'.$pin['pin_thumbnail_urls']['3'].'">
              <img src="'.$pin['pin_thumbnail_urls']['4'].'">
              </div>
              <div align="center" class="box-footer">
              <a class="btn btn-xs btn-primary" target="_blank" href="https://www.pinterest.com/'.$pin['username'].'"><i class="fa fa-user"></i> View Profile</a>
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

        } elseif ($request->type == "inMyPin") {

        }

    }


    public function write(Request $request)
    {

    }

    public function autoFollow()
    {

    }


}
