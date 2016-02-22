@extends('layout.main')

@section('login')
    @include('components.login')
@stop

@section('container')
<div class="container">
    <!-- Example row of columns-->
    <div class="row">
        <div class="col-md-12">
            <h2>Contact</h2>
            <p class="justify">
                If you have questions or to be able to use the Toolbox please request an account by contacting us at <a href="mailto:steiner@hydrosolutions.ch" target="_top">steiner@hydrosolutions.ch</a>. You will then get all necessary access details for the Upload Section.
            </p>
            <p class="justify">
                Please also contact us if the model does not produce results or an error message without adequate instructions. The model is currently still under development and we welcome any feedback.
            </p>
        </div>
        <!--        <div class="col-md-4">-->
        <!--            <h2>Heading</h2>-->
        <!--            <p>Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info.</p>-->
        <!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
        <!--        </div>-->
        <!--        <div class="col-md-4">-->
        <!--            <h2>Heading</h2>-->
        <!--            <p>Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info.</p>-->
        <!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
        <!--        </div>-->
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <hr>

    <footer>
        <p>&copy; Hydrosolutions 2015-2016</p>
    </footer>
</div> <!-- /container -->
@stop