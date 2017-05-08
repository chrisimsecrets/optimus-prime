<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Youtube extends Controller
{
    public function downloadIndex()
    {
        return view('Youtube');
    }

    public function download(Request $request)
    {
        $youtube = new \YouTubeDownloader();
        $video = $youtube->getDownloadLinks($request->link);
//        print_r($video);
        foreach ($video as $no => $data) {
//            echo $data['url']."<br>";
//            echo $data['format']."<br>";

            echo "<div class=\"info-box bg-red\">
            <span class=\"info-box-icon\"><i class=\"fa fa-download\"></i></span>

            <div class=\"info-box-content\">
              <span class=\"info-box-text\">" . $data['format'] . "</span>
              


                  <span class=\"progress-description\">
                    <a target='_blank' href='" . $data['url'] . "' class='btn btn-xs btn-success'>Download</a>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>";
        }


    }
}
