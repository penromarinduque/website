@extends('pages.website.government.includes.layout')

@section('content')

@include('pages.website.government.includes.topnav')

@include('pages.website.government.includes.masterhead')

<div class="container-fluid bg-gray">
	<div class="container" style="margin-top: 20px;">
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a style="color: green; text-decoration: none;" href="/"> Home </a></li>
						<li class="breadcrumb-item"><a style="color: green; text-decoration: none;" href="#"> News & Events </a></li>
						<li class="breadcrumb-item active" aria-current="page"> News Clippings </li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="panel panel-success">
			<div class="panel-heading bg-green">
				<h3 class="panel-title" style="color: white;"><b> News Clippings </b></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8">
						<table class="table table-bordered">
							<tr>
								<td>
									<a href="#clippings" data-toggle="modal"> NEWS CLIPPINGS - DECEMBER 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - NOVEMBER 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - OCTOBER 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - SEPTEMBER 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - AUGUST 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - JULY 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - JUNE 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - MAY 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - APRIL 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - MARCH 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - FEBRUARY 2019 </a>
								</td>
							</tr>
							<tr>
								<td>
									<a href=""> NEWS CLIPPINGS - JANUARY 2019 </a>
								</td>
							</tr>
						</table>
					</div>
					<div class="col-md-4">
						<div style="padding: 3px; padding-top: 9px; padding-left: 10px; border: 1px solid #999;margin-bottom: 5px; box-shadow: 1px 5px 8px 1px #999;">
							<label>DECEMBER 2019</label>
						</div>
						<table class="table table-bordered" style="box-shadow: 1px 5px 10px 1px #999;">
							<thead>
								<tr>
									<th class="text-center">MON</th>
									<th class="text-center">TUE</th>
									<th class="text-center">WED</th>
									<th class="text-center">THU</th>
									<th class="text-center">FRI</th>
									<th class="text-center">SAT</th>
									<th class="text-center">SUN</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-center">
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
								</tr>
								<tr class="text-center">
									<td>8</td>
									<td>9</td>
									<td>10</td>
									<td>11</td>
									<td>12</td>
									<td>13</td>
									<td>14</td>
								</tr>
								<tr class="text-center">
									<td>15</td>
									<td>16</td>
									<td>17</td>
									<td>18</td>
									<td>19</td>
									<td>20</td>
									<td>21</td>
								</tr>
								<tr class="text-center">
									<td>22</td>
									<td>23</td>
									<td>24</td>
									<td>25</td>
									<td>26</td>
									<td>27</td>
									<td>28</td>
								</tr>
								<tr class="text-center">
									<td>29</td>
									<td>30</td>
									<td>31</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<div class="modal fade" id="clippings">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title"> News Clipping JANUARY 2019 </h4>
									</div>
									<div class="modal-body">
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>{{-- ./ Panel  --}}
	</div>
</div>

@include('pages.website.government.includes.agencyfooter')

@include('pages.website.government.includes.standardfooter')

@endsection
