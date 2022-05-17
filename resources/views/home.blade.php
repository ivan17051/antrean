@extends('layouts.base')
@section('content')
<header class="content__title">
    <h1>Dashboard</h1>
    <small>Welcome to the unique Material Design admin web app experience!</small>

    <div class="actions">
        <a href="" class="actions__item zmdi zmdi-trending-up"></a>
        <a href="" class="actions__item zmdi zmdi-check-all"></a>

        <div class="dropdown actions__item">
            <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="" class="dropdown-item">Refresh</a>
                <a href="" class="dropdown-item">Manage Widgets</a>
                <a href="" class="dropdown-item">Settings</a>
            </div>
        </div>
    </div>
</header>

<div class="row quick-stats">
    <div class="col-sm-6 col-md-3">
        <div class="quick-stats__item bg-blue">
            <div class="quick-stats__info">
                <h2>987,459</h2>
                <small>Total Website Traffics</small>
            </div>

            <div class="quick-stats__chart sparkline-bar-stats">6,4,8,6,5,6,7,8,3,5,9,5</div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="quick-stats__item bg-amber">
            <div class="quick-stats__info">
                <h2>356,785K</h2>
                <small>Total Website Impressions</small>
            </div>

            <div class="quick-stats__chart sparkline-bar-stats">4,7,6,2,5,3,8,6,6,4,8,6</div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="quick-stats__item bg-purple">
            <div class="quick-stats__info">
                <h2>$58,778</h2>
                <small>Total Online Sales</small>
            </div>

            <div class="quick-stats__chart sparkline-bar-stats">9,4,6,5,6,4,5,7,9,3,6,5</div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="quick-stats__item bg-red">
            <div class="quick-stats__info">
                <h2>214</h2>
                <small>Total Support Tickets</small>
            </div>

            <div class="quick-stats__chart sparkline-bar-stats">5,6,3,9,7,5,4,6,5,6,4,9</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sales Statistics</h4>
                <h6 class="card-subtitle">Vestibulum purus quam scelerisque, mollis nonummy metus</h6>

                <div class="flot-chart flot-curved-line"></div>
                <div class="flot-chart-legends flot-chart-legends--curved"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Growth Rate</h4>
                <h6 class="card-subtitle">Commodo luctus nisi erat porttitor ligula eget lacinia odio semnec elit</h6>

                <div class="flot-chart flot-line"></div>
                <div class="flot-chart-legends flot-chart-legends--line"></div>
            </div>
        </div>
    </div>
</div>

<div data-columns>
    <div class="card">
        <img class="card-img-top" src="public/demo/img/widgets/note.png" alt="">
        <div class="card-body">
            <h4 class="card-title">Pellentesque Ligula Fringilla</h4>
            <h6 class="card-subtitle">by Malinda Hollaway on 19th June 2015 at 09:10 AM</h6>

            <p>Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Nulla vitae elit libero, a pharetra.</p>
            <a href="" class="view-more text-left">View Article...</a>
        </div>
    </div>

    <div class="card widget-visitors">
        <div class="card-body">
            <h4 class="card-title">Realtime Visitors</h4>
            <h6 class="card-subtitle">Nullam dolor isnibh ultricies vehicula adipiscing</h6>

            <div class="widget-visitors__stats">
                <div>
                    <strong>23528</strong>
                    <small>Visitor for last 24 hours</small>
                </div>
                <div>
                    <strong>746</strong>
                    <small>Visitors last 30 minutes</small>
                </div>
            </div>

            <div class="widget-visitors__map map-visitors"></div>
        </div>

        <div class="listview listview--striped">
            <div class="listview__item">
                <div class="listview__content">
                    <p>Sunday, September 4, 21:44:02 (2 Mins 56 Seconds)</p>

                    <div class="listview__attrs">
                        <span><img class="widget-visitors__country" src="public/demo/img/flags/United_States_of_America.png" alt=""> United States</span>
                        <span>Firefox</span>
                        <span>Mac OSX</span>
                    </div>
                </div>
            </div>

            <div class="listview__item">
                <div class="listview__content">
                    <p>Sunday, September 4, 20:21:01 (5 Mins 12 Seconds)</p>

                    <div class="listview__attrs">
                        <span><img class="widget-visitors__country" src="public/demo/img/flags/Australia.png" alt=""> Australia</span>
                        <span>Chrome</span>
                        <span>Android</span>
                    </div>
                </div>
            </div>

            <div class="listview__item">
                <div class="listview__content">
                    <p>Sunday, September 4, 20:21:10 (10 Mins 43 Seconds)</p>

                    <div class="listview__attrs">
                        <span><img class="widget-visitors__country" src="public/demo/img/flags/Brazil.png" alt=""> Brazil</span>
                        <span>Edge</span>
                        <span>Windows</span>
                    </div>
                </div>
            </div>

            <div class="listview__item">
                <div class="listview__content">
                    <p>Sunday, September 4, 20:59:04 (1 Min 02 Seconds)</p>

                    <div class="listview__attrs">
                        <span><img class="widget-visitors__country" src="public/demo/img/flags/South_Korea.png" alt=""> South Korea</span>
                        <span>Chrome</span>
                        <span>Android</span>
                    </div>
                </div>
            </div>

            <div class="listview__item">
                <div class="listview__content">
                    <p>Sunday, September 4, 20:58:12 (3 Min 44 Seconds)</p>

                    <div class="listview__attrs">
                        <span><img class="widget-visitors__country" src="public/demo/img/flags/Japan.png" alt=""> Japan</span>
                        <span>Chrome</span>
                        <span>Windows</span>
                    </div>
                </div>
            </div>

            <div class="p-2"></div>
        </div>
    </div>

    <div class="card card--inverse widget-past-days">
        <div class="card-body">
            <h4 class="card-title">For the past 30 days</h4>
            <h6 class="card-subtitle">Pellentesque ornare sem lacinia quam</h6>
        </div>

        <div class="widget-past-days__main">
            <div class="flot-chart flot-chart--sm flot-past-days"></div>
        </div>

        <div class="listview listview--inverse listview--striped">
            <div class="listview__item">
                <div class="widget-past-days__info">
                    <small>Page Views</small>
                    <h3>47,896,536</h3>
                </div>

                <div class="widget-past-days__chart hidden-sm">
                    <div class="sparkline-bar-stats">6,9,5,6,3,7,5,4,6,5,6,4,2,5,8,2,6,9</div>
                </div>
            </div>

            <div class="listview__item">
                <div class="widget-past-days__info">
                    <small>Site Visitors</small>
                    <h3>24,456,799</h3>
                </div>

                <div class="widget-past-days__chart hidden-sm">
                    <div class="sparkline-bar-stats">5,7,2,5,2,8,6,7,6,5,3,1,9,3,5,8,2,4</div>
                </div>
            </div>

            <div class="listview__item">
                <div class="widget-past-days__info">
                    <small>Total Clicks</small>
                    <h3>13,965</h3>
                </div>

                <div class="widget-past-days__chart hidden-sm">
                    <div class="sparkline-bar-stats">5,7,2,5,2,8,6,7,6,5,3,1,9,3,5,8,2,4</div>
                </div>
            </div>

            <div class="listview__item">
                <div class="widget-past-days__info">
                    <small>Total Returns</small>
                    <h3>198</h3>
                </div>

                <div class="widget-past-days__chart hidden-sm">
                    <div class="sparkline-bar-stats">3,9,1,3,5,6,7,6,8,2,5,2,7,5,6,7,6,8</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card widget-calendar">
        <div class="widget-calendar__header">
            <div class="widget-calendar__year"></div>
            <div class="widget-calendar__day"></div>

            <div class="actions actions--inverse">
                <a href="calendar.html" class="actions__item"><i class="zmdi zmdi-refresh-alt"></i></a>
                <a href="calendar.html" class="actions__item"><i class="zmdi zmdi-plus"></i></a>
            </div>
        </div>

        <div class="widget-calendar__body"></div>
    </div>

    <div class="card card--inverse widget-pie">
        <div class="col-6 col-sm-4 col-md-6 col-lg-4 widget-pie__item">
            <div class="easy-pie-chart" data-percent="50" data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                <span class="easy-pie-chart__value">92</span>
            </div>
            <div class="widget-pie__title">Email<br> Scheduled</div>
        </div>

        <div class="col-6 col-sm-4 col-md-6 col-lg-4 widget-pie__item">
            <div class="easy-pie-chart" data-percent="11" data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                <span class="easy-pie-chart__value">11</span>
            </div>
            <div class="widget-pie__title">Email<br> Bounced</div>
        </div>

        <div class="col-6 col-sm-4 col-md-6 col-lg-4 widget-pie__item">
            <div class="easy-pie-chart" data-percent="52" data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                <span class="easy-pie-chart__value">52</span>
            </div>
            <div class="widget-pie__title">Email<br> Opened</div>
        </div>

        <div class="col-6 col-sm-4 col-md-6 col-lg-4 widget-pie__item">
            <div class="easy-pie-chart" data-percent="44" data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                <span class="easy-pie-chart__value">44</span>
            </div>
            <div class="widget-pie__title">Storage<br>Remaining</div>
        </div>

        <div class="col-6 col-sm-4 col-md-6 col-lg-4 widget-pie__item">
            <div class="easy-pie-chart" data-percent="78" data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                <span class="easy-pie-chart__value">78</span>
            </div>
            <div class="widget-pie__title">Web Page<br> Views</div>
        </div>

        <div class="col-6 col-sm-4 col-md-6 col-lg-4 widget-pie__item">
            <div class="easy-pie-chart" data-percent="32" data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                <span class="easy-pie-chart__value">32</span>
            </div>
            <div class="widget-pie__title">Server<br> Processing</div>
        </div>
    </div>

    <div class="card todo">
        <div class="card-body">
            <h4 class="card-title">Todo lists</h4>
            <h6 class="card-subtitle">Venenatis portauam Inceptos ameteiam</h6>
        </div>

        <div class="listview">
            <div class="listview__item">
                <div class="checkbox checkbox--char todo__item">
                    <input type="checkbox" id="todo-1">
                    <label for="todo-1" class="bg-red checkbox__char">F</label>

                    <div class="listview__content">
                        <div class="listview__heading">Fivamus sagittis lacus vel augue laoreet rutrum faucibus dolor</div>
                        <p>Today at 8.30 AM</p>
                    </div>

                    <div class="listview__attrs">
                        <span>#Messages</span>
                        <span>!!!</span>
                    </div>
                </div>

                <div class="actions listview__actions">
                    <div class="dropdown actions__item">
                        <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="">Mark as completed</a>
                            <a class="dropdown-item" href="">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="listview__item">
                <div class="checkbox checkbox--char todo__item">
                    <input type="checkbox" id="todo-2">
                    <label class="checkbox__char bg-light-blue" for="todo-2">N</label>

                    <div class="listview__content">
                        <div class="listview__heading">Nullam id dolor id nibh ultricies vehicula ut id elit</div>
                        <p>Today at 12.30 PM</p>
                    </div>

                    <div class="listview__attrs">
                        <span>#Clients</span>
                        <span>!!</span>
                    </div>
                </div>

                <div class="actions listview__actions">
                    <div class="dropdown actions__item">
                        <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="">Mark as completed</a>
                            <a class="dropdown-item" href="">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="listview__item">
                <div class="checkbox checkbox--char todo__item">
                    <input  type="checkbox" id="todo-3">
                    <label class="checkbox__char bg-amber" for="todo-3">C</label>

                    <div class="listview__content">
                        <div class="listview__heading">Cras mattis consectetur purus sit amet fermentum</div>
                        <p>Tomorrow at 10.30 AM</p>
                    </div>

                    <div class="listview__attrs">
                        <span>#Clients</span>
                        <span>!!</span>
                    </div>
                </div>

                <div class="actions listview__actions">
                    <div class="dropdown actions__item">
                        <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="">Mark as completed</a>
                            <a class="dropdown-item" href="">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="listview__item">
                <div class="checkbox checkbox--char todo__item">
                    <input  type="checkbox" id="todo-4">
                    <label class="checkbox__char bg-lime" for="todo-4">I</label>

                    <div class="listview__content">
                        <div class="listview__heading">Integer posuere erat a ante venenatis dapibus posuere velit aliquet</div>
                        <small>05/08/2017 at 08.00 AM</small>
                    </div>

                    <div class="listview__attrs">
                        <span>#Server</span>
                        <span>!</span>
                    </div>
                </div>

                <div class="actions listview__actions">
                    <div class="dropdown actions__item">
                        <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="">Mark as completed</a>
                            <a class="dropdown-item" href="">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="listview__item">
                <div class="checkbox checkbox--char todo__item">
                    <input  type="checkbox" id="todo-5">
                    <label class="checkbox__char bg-purple" for="todo-5">P</label>

                    <div class="listview__content">
                        <div class="listview__heading">Praesent commodo cursus magnavel scelerisque nisl consectetur</div>
                        <small>10/08/2016 at 04.00 AM</small>
                    </div>

                    <div class="listview__attrs">
                        <span>#Server</span>
                        <span>!!!</span>
                    </div>
                </div>

                <div class="actions listview__actions">
                    <div class="dropdown actions__item">
                        <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="">Mark as completed</a>
                            <a class="dropdown-item" href="">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <a href="todo-lists.html" class="view-more">View More</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Server Process Data</h4>
            <h6 class="card-subtitle">Fusce dapibus tellus cursus commodo tortor</h6>

            <div class="flot-chart flot-dynamic"></div>
        </div>
    </div>
</div>
@endsection

@section('jsx')
<script>
    
</script>
@endsection