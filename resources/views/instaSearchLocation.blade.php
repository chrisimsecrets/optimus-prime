<table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Title</th>
        <th>Location ID</th>
        <th>Location</th>
        <th>City</th>
        <th>Feeds</th>
        <th>Map</th>


    </tr>
    </thead>
    <tbody>
    @foreach($datas->items as $data)
        <tr>
            <td>{{$data->title}}</td>
            <td>{{$data->location->pk}}</td>
            <td>{{$data->location->name}}</td>
            <td>{{$data->location->city}}</td>
            <td><a target="_blank" class="btn btn-xs btn-success" href="https://www.instagram.com/explore/locations/{{$data->location->pk}}"><i class="fa fa-feed"> Feeds of this location</i> </a></td>

            <td><a target="_blank" class="btn btn-primary btn-xs" href="https://www.google.com/maps/place/{{$data->location->lat}},{{$data->location->lng}}"><i class="fa fa-map-marker">View on Map</i> </a></td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Title</th>
        <th>Location ID</th>
        <th>Location</th>
        <th>City</th>
        <th>Feeds</th>
        <th>Map</th>

    </tr>
    </tfoot>
</table>