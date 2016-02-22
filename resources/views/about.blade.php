@extends('layout.main')

@section('login')
    @include('components.login')
@stop

@section('container')
<div class="container">
    <!-- Example row of columns-->
    <div class="row">
        <div class="col-md-12">
            <h2>1. IRRIGATION DEMAND CALCULATOR</h2>
            <p>
                A tool to calculate the irrigation water demand of a specific crop, on a specific soil under a specific climate.
            </p>
            <h3>Motivation</h3>
            <p class="justify">
                Given the limited water resources of arid and semi-arid regions, it is important to use the available water for irrigation most efficiently. In many regions of the world, information and guidelines on what, when and where to plant crops or on how to allocate water most efficiently are often missing or outdated.
            </p>
            <h3>How does it work?</h3>
            <p class="justify">
                Based on long-term climate data, the crop irrigation water demand is simulated according to Allen et al. (1998). For a given specified crop, planting date and soil properties the amount of water needed to maintain soil moisture contents above or equal a water stress threshold is calculated (= irrigation demand) for a crop-specific growing period. Thus, for example the optimal planting date for a certain crop, location and soil can be identified (see Figure 1).
            </p>
            <img src="{{ asset('img/planting_date.png') }}" class="img-responsive" style="width: 80%; height: 80%; margin: 0 auto">
            <div style="font-style: italic; text-align: center">
                Figure 1: Optimal planting date for maize near the town Arusha, Tanzania
            </div>
            <h3>What are the benefits?</h3>
            <ul>
                <li>Evaluation of the optimal crop choice under the given environment conditions.</li>
                <li>Evaluation of maximum cultivated area under the given irrigation water availability.</li>
                <li>Evaluation of optimal planting dates under the given environment conditions.</li>
                <li>Optimal and fair planning of water allocation (on- and off-farm).</li>
                <li>Minimization of unproductive losses and conflict due to inequitable water allocation.</li>
            </ul>
            <h3>Target audience</h3>
            <ul>
                <li>Institutions responsible for water allocations</li>
                <li>Institutions responsible for agricultural advice</li>
                <li>Farmers</li>
            </ul>

            <h2>2. WATER STRESS INDEX</h2>
            <p class="justify">
                Monitoring current soil moisture conditions and water demands via crowd sensing.
            </p>
            <h3>Motivation</h3>
            <p class="justify">
                Although farmers have a keen sense on the soil and plant conditions of/on their fields, they still often lack information on how much and at which moment additional irrigation is needed. At the same time, also the water administration lacks this kind of information to efficiently plan water allocations and so to minimize unproductive water losses. Although highly sophisticated soil moisture monitoring systems exist, those are usually associated with high costs and time consuming maintenance.
            </p>
            <img src="{{ asset('img/soil_moisture.png') }}" class="img-responsive" style="width: 80%; height: 80%; margin: 0 auto">
            <div style="font-style: italic; text-align: center">
                Figure 2: Reducing the uncertainty of soil moisture simulations through data assimilation with soft sensed measurements.
            </div>
            <h3>How does it work?</h3>
            <p class="justify">
                Based on real-time meteorological data (from satellites or stations), farmers can monitor soil moisture conditions and irrigation demands via a soil water model. Given the uncertainty of input and meteorological data, several model realizations are analyzed. Using crowd-sensed soil moisture (using the approach of the University of Zurich), the modeled values can be updated using data assimilation techniques (see figure 2) and the updated values sent to a central database, accessible for farmers and administrations.
            </p>
            <h3>What are the benefits?</h3>
            <ul>
                <li>Knowledge about current irrigation demand</li>
                <li>Knowledge of spatial distributed current soil moisture conditions and irrigation demand</li>
            </ul>
            <h3>Target audience</h3>
            <ul>
                <li>Farmers</li>
                <li>Institutions responsible for water allocations</li>
            </ul>
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

    <hr>

    <footer>
        <p>&copy; Hydrosolutions 2015-2016</p>
    </footer>
</div> <!-- /container -->
@stop