@extends('layouts.app')

@section('title')
    <title>CheckRelayForm</title>
@endsection

@section('content')
<br><br><br><br><br>
<div class = "container test-form">
    <div class="alert alert-danger" role="alert">
    {{ $message }}
    </div>
    <div class="alert alert-info" role="alert">
    <span>Restaurant Id:</span> <b>{{ $res_id }}</b><br>
    <span>Restaurant Name:</span> <b>{{ $res_name }}</b><br>
    <span>Restaurant Phone:</span> <b>{{ $res_phone }}</b><br>
    <span>Restaurant Address:</span> <b>{{ $res_address }}</b>
    </div>
    <div class="form-group">
        <label for="relay_key">Relay Key:</label>
        <textarea type="text" class="form-control" id="relay_key" rows="4">{{ $relay_key }}</textarea>
    </div>
    <div class="form-group">
        <label for="producer_key">Producer Key:</label>
        <input type="text" class="form-control" id="producer_key" value="{{ $producer_key }}">
    </div>
    <div class="form-group">
        <label for="producer_key">Test Customer Address:</label>
        <input type="text" class="form-control" id="test_address" value="">
        <input type="hidden" class="form-control" id="address1" name="address1">
        <input type="hidden" class="form-control" id="city" name="city">
        <input type="hidden" class="form-control" id="state" name="state">
        <input type="hidden" class="form-control" id="zip" name="zip">
    </div>
    <br><br>

    <button class="form-control check-relay" style="width: 100%">Check</button>
</div>
<div class = "container test-result" style = "display:none">
    <div class="alert alert-danger" id="result-message" role="alert">
    {{ $message }}
    </div>
    <div class="alert alert-info" role="alert">
    <span>Restaurant Id:</span> <b>{{ $res_id }}</b><br>
    <span>Restaurant Name:</span> <b>{{ $res_name }}</b><br>
    <span>Restaurant Phone:</span> <b>{{ $res_phone }}</b><br>
    <span>Restaurant Address:</span> <b>{{ $res_address }}</b>
    </div>

    <button class="form-control re-check-relay" style="width: 100%">Check Again</button>
</div>
<br><br><br><br><br><br>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $(".check-relay").click(function(){
            $(".test-form").slideUp("slow");
            $(".test-result").slideDown("slow");
            var key = $('#relay_key').val();
            var producer_key = $('#producer_key').val();
            var address = {
                "address1": $('#address1').val(),
                "city": $('#city').val(),
                "state": $('#state').val(),
                "zip": $('#zip').val()
            };

            var data = {
                "producerLocationKey": producer_key,
                "address": address
            };

            console.log(data);

            $.ajax({
                url: 'https://dev-api.relay.delivery/v1/can-deliver',
                type: 'post',
                headers: {
                    "x-relay-auth": key
                },
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function (data) {
                    $('#result-message').removeClass('alert-danger');
                    $('#result-message').removeClass('alert-success');
                    if(data.canDeliver){
                        $('#result-message').addClass('alert-success');
                        $('#result-message').text('Successed');
                        return;
                    }
                    $('#result-message').addClass('alert-danger');
                    $('#result-message').html(JSON.stringify(data));
                },
                error: function (error) {
                    $('#result-message').removeClass('alert-danger');
                    $('#result-message').removeClass('alert-success');
                    $('#result-message').addClass('alert-danger');
                    $('#result-message').html(error.responseText);
                },
            });
        });
        $(".re-check-relay").click(function(){
            $(".test-form").slideDown("slow");
            $(".test-result").slideUp("slow");
        });


        var inputa = document.getElementById('test_address');
            var autocompletea = new google.maps.places.Autocomplete(inputa);
            autocompletea.addListener('place_changed', function() {
                var placea = autocompletea.getPlace();
                var valff = placea.formatted_address.split(',');
                console.log(placea.formatted_address);
                $("#test_address").val(placea.formatted_address.replaceAll(', USA', ''));
                var autoAddr = placea.formatted_address.replaceAll(', USA', '').toString();
                try{
                    var autoAddr_details = autoAddr.split(', ');
                    var autoAddr_line1 = autoAddr_details[0];
                    var autoAddr_city = autoAddr_details[1];
                    var autoAddr_state = autoAddr_details[2].split(' ')[0];
                    var autoAddr_zip = autoAddr_details[2].split(' ')[1];

                    $('#address1').val(autoAddr_line1);
                    $('#city').val(autoAddr_city);
                    $('#state').val(autoAddr_state);
                    $('#zip').val(autoAddr_zip);
                }catch(e){
                    $('#address1').val('');
                    $('#city').val('');
                    $('#state').val('');
                    $('#zip').val('');
                    $("#test_address").val('');
                }
                
            });
    });
</script>
@endpush