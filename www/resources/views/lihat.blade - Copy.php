@extends('layouts.mainlayout')

@section('content')
<style type="text/css">
  .headerpoli{
    text-align: center;
  }
  .headerpoli, .policaption{
    font-weight: bold;
    font-size: 24pt;
  }
  .antrianpoli {
    font-size: 56pt;
    text-align: center;
  }
  .policaption2{
    font-weight: bold;
    font-size: 18pt;
  }
  .antrianpoli2 {
    font-size: 36pt;
    text-align: center;
  }
  .gotodetail {
    position:absolute;
    bottom:0;
    right:0;
    margin-bottom: 5px;
    margin-right: 15px;
}
</style>

<div class="row">
  <!-- left column -->
  <div class="col-md-8">
    <!-- general form elements -->
    <div class="box box-primary" style="height: 625px;">
      <div class="box-body" >
        <video width="100%" id="myvideo" style="display: table-cell; vertical-align: middle;" controls muted onended="onVideoEnded();">
          <!-- <source src="{{asset('img/video.mp4')}}" type="video/mp4">
            <source src="{{asset('img/video2.mp4')}}" type="video/mp4"> -->
          <!-- <source src="mov_bbb.ogg" type="video/ogg"> -->
          Your browser does not support HTML5 video.
        </video>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!--/.col (left) -->
  <!-- right column -->
  <div class="col-md-4">
    <div id="listpoliutama"></div>
  </div>
  <!--/.col (right) -->
</div>
<div class="row">
  <div id="listpolilain"></div>
</div>
@endsection

@section('ajax')
  <script type="text/javascript">
    var idunitkerja = "{{$d['idunitkerja']}}";

    var videoSource = new Array();
    videoSource[0] = "{{asset('img/video.mp4')}}";
    videoSource[1] = "{{asset('img/video2.mp4')}}";
    var video_list      = ["Skydiving Video - Hotel Room Reservation while in FreeFall - Hotels.com.mp4",
                                "Experience Conrad Hotels & Resorts.mp4",
                                "Mount Airy Casino Resort- Summer TV Ad 2.mp4"
                            ];
    var video_index     = 0;
    var video_player    = null;

    

    function onVideoEnded(){
        console.log("video ended");
        if(video_index < videoSource.length - 1){
            video_index++;
        }
        else{
            video_index = 0;
        }
        video_player.setAttribute("src", videoSource[video_index]);
        video_player.play();
    }
    function onload(){
        console.log("body loaded");
        video_player = document.getElementById("myvideo");
        video_player.setAttribute("src", videoSource[video_index]);
        video_player.play();
    }

    $(document).ready(function(){
      onload();
    });
  </script>
  <script type="text/javascript" src="{{asset('js/lihat.js')}}"></script>
@stop