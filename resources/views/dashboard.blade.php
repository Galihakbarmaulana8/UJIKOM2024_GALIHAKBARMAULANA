@extends('admin')
@section('content')
<div class="right_col" role="main">
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="x-panel">
                    <div class="x-title">
                <!-- ... (previous HTML code) ... -->
                        <div class="content">
                            <!-- <h1>Welcome to Your Dashboard</h1> -->
                            <!-- <p>Explore the powerful features and tools at your fingertips to streamline your workflow and enhance productivity. Let's dive into what your dashboard has to offer:</p> -->
                        </div>
                        <!-- ... (remaining HTML code) ... -->

                    </div>
                </div>
            </div>
        </div>
        <div class="ln_solid"></div>
      <div class="row" style="display: inline-block;">
        <div class="top_tiles">
          <div class="animated flipInY col-lg-3.5 col-md-4 col-sm-7 ">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-users"></i></div>
              <div class="count">{{number_format($totaluser)}}</div>
              <h3>Users</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-7 ">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-life-ring"></i></div>
              <div class="count">{{number_format($totalproduk)}}</div>
              <h3>Products</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-7 ">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-shopping-cart"></i></div>
              <div class="count">{{number_format($totaltransaksi)}}</div>
              <h3>Transactions</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-7 col-md-7 col-sm-7 ">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-credit-card"></i></div>
              <div class="count">Rp.{{number_format($income)}}</div>
              <h3>Income</h3>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Transaction Summary <small>Weekly progress</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                  <div class="col-xl-6">
                      <div class="card mb-4">
                          <div class="card-header">
                              <i class="fas fa-chart-area me-1"></i>
                              Area Chart Example
                          </div>
                          <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                      </div>
                  </div>
                  <div class="col-xl-6">
                      <div class="card mb-4">
                          <div class="card-header">
                              <i class="fas fa-chart-bar me-1"></i>
                              Bar Chart Example
                          </div>
                          <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
@endsection
