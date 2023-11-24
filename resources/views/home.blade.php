<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>

<!--================Start Newsletter Area=================-->


<div class="container py-5">
    <div id="response" class="text-success mt-5 text-center"></div>

    <form class="mt-3 submit-form w-50 m-auto mt-5" id="form-data">
        <div class="form-group mt-4">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control mt-2">
            <div id="name-error" class="error-message text-danger"></div>
        </div>

        <div class="form-group mt-4">
            <label for="name">email</label>
            <input type="text" name="email" id="email" class="form-control mt-2">
            <div id="email-error" class="error-message text-danger"></div>
        </div>

        <button type="submit" class="btn btn-success submit-form mt-5" id="create_new">Create
            Employee</button>
    </form>
</div>


<!--================ End Newsletter Area =================-->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#create_new").click(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = $('#form-data').serialize();

            $.ajax({
                type: 'post',
                url: "{{ route('store') }}",
                data: data,

                beforeSend: function() {
                    $('#create_new').html('....Please wait');
                },
                success: function(response) {



                    if (response.error) {

                        $('.error-message').text('');
                        $("#response").text('');
                        // Display validation errors under each field
                        $.each(response.error, function(field, errorMessage) {
                            // Append the error message under the corresponding field
                            $('#' + field + '-error').html(errorMessage);
                        });
                    } else {
                        $('.error-message').text('');
                        $("#response").text('');
                        // Handle success case
                        $("#response").text(response.success);

                        setTimeout(function() {
                            $("#response").hide();
                        }, 2000);
                    }
                },
                error: function() {
                    // Handle error
                },
                complete: function() {
                    $('#create_new').html('Create New');
                }
            });
        });
    })
</script>







</body>



</html>
