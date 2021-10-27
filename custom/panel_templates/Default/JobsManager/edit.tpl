{include file='header.tpl'}

<body id="page-top">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		{include file='sidebar.tpl'}

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main content -->
			<div id="content">

				<!-- Topbar -->
				{include file='navbar.tpl'}

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">


						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="m-0 text-dark">{$TITLE}</h1>
							</div>
							<div class="col">
								<div class="pb-3 float-md-right">
									<a href="{$CANCEL_URL}" class="btn btn-warning">{$CANCEL} <i
											class="nav-icon fas fa-arrow-circle-left"></i></a>
								</div>
							</div>
						</div>
					</div>

					<section class="content">
						{if isset($SUCCESS)}
							<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h5><i class="icon fa fa-check"></i> {$SUCCESS_TITLE}</h5>
								{$SUCCESS}
							</div>
						{/if}

						{if isset($ERRORS) && count($ERRORS)}
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h5><i class="icon fas fa-exclamation-triangle"></i> {$ERRORS_TITLE}</h5>
								<ul>
									{foreach from=$ERRORS item=error}
										<li>{$error}</li>
									{/foreach}
								</ul>
							</div>
						{/if}


						<form method="post">
							<div class="container">
								<div class="form-group form-control-sm">
									<div class="col-md-12">
										<label class="control-label">{$COMMAND}</label>
										<input class="form-control form-control-sm" type="text" name="command" id="command"
											value="{$JOB.command}" placeholder="php /home/user/web/ping.php">
									</div>
									<div class="row">


										<div class="col-md-2">
											<div class="col">
												<label class="control-label">{$MINUTE}</label>
												<input class="form-control form-control-sm" type="text" name="minute" id="minute"
													value="{$JOB.minute}">
											</div>
											<div class="col">
												<label class="control-label">{$HOUR}</label>
												<input class="form-control form-control-sm" type="text" name="hour" id="hour"
													value="{$JOB.hour}">
											</div>
											<div class="col">
												<label class="control-label">{$DAY}</label>
												<input class="form-control form-control-sm" type="text" name="day" id="day" value="{$JOB.day}">
											</div>
											<div class="col">
												<label class="control-label">{$MONTH}</label>
												<input class="form-control form-control-sm" type="text" name="month" id="month"
													value="{$JOB.month}">
											</div>
											<div class="col">
												<label class="control-label">{$WEEK}</label>
												<input class="form-control form-control-sm" type="text" name="day_week" id="day_week"
													value="{$JOB.day_week}">
											</div>
										</div>


										<div class="col-md-10">
											<div class="container text-center">
												<ul class="nav nav-tabs justify-content-center" style="margin: 40px;">
													<li class="mr-3"><a data-toggle="tab" href="#minute_gn">{$MINUTE}</a></li>
													<li class="mr-3"><a data-toggle="tab" href="#hour_gn">{$HOUR}</a></li>
													<li class="mr-3"><a data-toggle="tab" href="#day_gn">{$DAY}</a></li>
													<li class="mr-3"><a data-toggle="tab" href="#week_gn">{$WEEK}</a></li>
													<li class="mr-3"><a data-toggle="tab" href="#month_gn">{$MONTH}</a></li>
												</ul>

												<div class="tab-content justify-content-center">
													<div id="minute_gn" class="tab-pane active">
														<h6>{$MINUTE}</h6>
														<div class="col-md-3 mx-auto">
															<span>{$EXECUTE}:</span>
															<select id="minute_tab1" class="custom-select form-control-sm">
																<option value="*">{$EVERY_MINUTE}</option>
																<option value="*/2">{$EVERY_2_MINUTES}</option>
																<option value="*/5">{$EVERY} 5</option>
																<option value="*/10">{$EVERY} 10</option>
																<option value="*/15">{$EVERY} 15</option>
																<option value="*/30">{$EVERY} 30</option>
															</select>
															<button onclick="cronTabMinute()" style="margin-top: 20px;" class="btn btn-primary btn-sm"
																type="button" id="generate">{$GENERATE}</button>
														</div>
													</div>
													<div id="hour_gn" class="tab-pane">
														<h6>{$HOUR}</h6>
														<div class="col-md-3 mx-auto">
															<span>{$EXECUTE}:</span>
															<select id="hour_tab2" class="custom-select form-control-sm">
																<option value="*">{$EACH_HOUR}</option>
																<option value="*/2">{$EVERY_TWO_HOURS}</option>
																<option value="*/6">{$EVERY} 6</option>
																<option value="*/12">{$EVERY} 12</option>
															</select>
															<span>{$MINUTE}:</span>
															<select id="minute_tab2" class="custom-select form-control-sm">
																<option value="0">00</option>
																<option value="15">15</option>
																<option value="30">30</option>
																<option value="45">45</option>
															</select>
															<button onclick="cronTabHour()" style="margin-top: 20px;" class="btn btn-primary btn-sm"
																type="button" id="generate">{$GENERATE}</button>
														</div>
													</div>
													<div id="day_gn" class="tab-pane">
														<h6>{$DAY}</h6>
														<div class="col-md-3 mx-auto">
															<span>{$EXECUTE}:</span>
															<select id="day_tab3" class="custom-select form-control-sm">
																<option value="*">{$EVERYDAY}</option>
																<option value="31/2">{$EVERY_ODD_DAY}</option>
																<option value="*/2">{$EVERY_EVEN_DAY}</option>
																<option value="*/3">{$EVERY} 3</option>
																<option value="*/10">{$EVERY} 10</option>
																<option value="*/15">{$EVERY} 15</option>
															</select>
															<span>{$HOUR}:</span>
															<select id="hour_tab3" class="custom-select form-control-sm">
																<option value="0">00</option>
																<option value="1">01</option>
																<option value="2">02</option>
																<option value="3">03</option>
																<option value="4">04</option>
																<option value="5">05</option>
																<option value="6">06</option>
																<option value="7">07</option>
																<option value="8">08</option>
																<option value="9">09</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
																<option value="13">13</option>
																<option value="14">14</option>
																<option value="15">15</option>
																<option value="16">16</option>
																<option value="17">17</option>
																<option value="18">18</option>
																<option value="19">19</option>
																<option value="20">20</option>
																<option value="21">21</option>
																<option value="22">22</option>
																<option value="23">23</option>
															</select>
															<span>{$MINUTE}:</span>
															<select id="minute_tab3" class="custom-select form-control-sm">
																<option value="0">00</option>
																<option value="1">01</option>
																<option value="2">02</option>
																<option value="3">03</option>
																<option value="4">04</option>
																<option value="5">05</option>
																<option value="6">06</option>
																<option value="7">07</option>
																<option value="8">08</option>
																<option value="9">09</option>
																<option value="10">10</option>
																<option value="15">15</option>
																<option value="20">20</option>
																<option value="25">25</option>
																<option value="30">30</option>
																<option value="35">35</option>
																<option value="40">45</option>
																<option value="50">50</option>
																<option value="55">55</option>
															</select>
															<button onclick="cronTabDay()" style="margin-top: 20px;" class="btn btn-primary btn-sm"
																type="button" id="generate">{$GENERATE}</button>
														</div>

													</div>
													<div id="week_gn" class="tab-pane">
														<h6>{$WEEK}</h6>
														<div class="col-md-3 mx-auto">
															<span>{$EXECUTE}:</span>
															<select id="week_tab4" class="custom-select form-control-sm">
																<option value="*">{$EVERYDAY}</option>
																<option value="1,2,3,4,5">{$WORKING_DAY}</option>
																<option value="0,6">{$WEEKENDS}</option>
																<option value="1">{$MONDAY}</option>
																<option value="2">{$TUESDAY}</option>
																<option value="3">{$WEDNESDAY}</option>
																<option value="4">{$THURSDAY}</option>
																<option value="5">{$FRIDAY}</option>
																<option value="6">{$SATURDAY}</option>
																<option value="0">{$SUNDAY}</option>
															</select>
															<span>{$HOUR}:</span>
															<select id="hour_tab4" class="custom-select form-control-sm">
																<option value="0">00</option>
																<option value="1">01</option>
																<option value="2">02</option>
																<option value="3">03</option>
																<option value="4">04</option>
																<option value="5">05</option>
																<option value="6">06</option>
																<option value="7">07</option>
																<option value="8">08</option>
																<option value="9">09</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
																<option value="13">13</option>
																<option value="14">14</option>
																<option value="15">15</option>
																<option value="16">16</option>
																<option value="17">17</option>
																<option value="18">18</option>
																<option value="19">19</option>
																<option value="20">20</option>
																<option value="21">21</option>
																<option value="22">22</option>
																<option value="23">23</option>
															</select>
															<span>{$MINUTE}:</span>
															<select id="minute_tab4" class="custom-select form-control-sm">
																<option value="0">00</option>
																<option value="1">01</option>
																<option value="2">02</option>
																<option value="3">03</option>
																<option value="4">04</option>
																<option value="5">05</option>
																<option value="6">06</option>
																<option value="7">07</option>
																<option value="8">08</option>
																<option value="9">09</option>
																<option value="10">10</option>
																<option value="15">15</option>
																<option value="20">20</option>
																<option value="25">25</option>
																<option value="30">30</option>
																<option value="35">35</option>
																<option value="40">45</option>
																<option value="50">50</option>
																<option value="55">55</option>
															</select>
															<button onclick="cronTabWeek()" style="margin-top: 20px;" class="btn btn-primary btn-sm"
																type="button" id="generate">{$GENERATE}</button>
														</div>
													</div>
													<div id="month_gn" class="tab-pane">
														<h6>{$MONTH}</h6>
														<div class="col-md-3 mx-auto">
															<span>{$EXECUTE}:</span>
															<select id="month_tab5" class="custom-select form-control-sm">
																<option value="*">{$EVERY_MONTH}</option>
																<option value="1-11/2">{$EVERY_ODD_MONTH}</option>
																<option value="*/2">{$EVERY_EVEN_MONTH}</option>
																<option value="*/3">{$EVERY} 3</option>
																<option value="*/6">{$EVERY} 6</option>
																<option value="1">{$JAN}</option>
																<option value="2">{$FEB}</option>
																<option value="3">{$MAR}</option>
																<option value="4">{$APR}</option>
																<option value="5">{$MAY}</option>
																<option value="6">{$JUNE}</option>
																<option value="7">{$JULE}</option>
																<option value="8">{$AUG}</option>
																<option value="9">{$SEP}</option>
																<option value="10">{$OCT}</option>
																<option value="11">{$NOV}</option>
																<option value="12">{$DEC}</option>
															</select>
															<span>{$DAY}:</span>
															<select id="day_tab5" class="custom-select form-control-sm">
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
																<option value="13">13</option>
																<option value="14">14</option>
																<option value="15">15</option>
																<option value="16">16</option>
																<option value="17">17</option>
																<option value="18">18</option>
																<option value="19">19</option>
																<option value="20">20</option>
																<option value="21">21</option>
																<option value="22">22</option>
																<option value="23">23</option>
																<option value="24">24</option>
																<option value="25">25</option>
																<option value="26">26</option>
																<option value="27">27</option>
																<option value="28">28</option>
																<option value="29">29</option>
																<option value="30">30</option>
																<option value="31">31</option>
															</select>
															<span>{$HOUR}:</span>
															<select id="hour_tab5" class="custom-select form-control-sm">
																<option value="0">00</option>
																<option value="1">01</option>
																<option value="2">02</option>
																<option value="3">03</option>
																<option value="4">04</option>
																<option value="5">05</option>
																<option value="6">06</option>
																<option value="7">07</option>
																<option value="8">08</option>
																<option value="9">09</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
																<option value="13">13</option>
																<option value="14">14</option>
																<option value="15">15</option>
																<option value="16">16</option>
																<option value="17">17</option>
																<option value="18">18</option>
																<option value="19">19</option>
																<option value="20">20</option>
																<option value="21">21</option>
																<option value="22">22</option>
																<option value="23">23</option>
															</select>
															<span>{$MINUTE}:</span>
															<select id="minute_tab5" class="custom-select form-control-sm">
																<option value="0">00</option>
																<option value="1">01</option>
																<option value="2">02</option>
																<option value="3">03</option>
																<option value="4">04</option>
																<option value="5">05</option>
																<option value="6">06</option>
																<option value="7">07</option>
																<option value="8">08</option>
																<option value="9">09</option>
																<option value="10">10</option>
																<option value="15">15</option>
																<option value="20">20</option>
																<option value="25">25</option>
																<option value="30">30</option>
																<option value="35">35</option>
																<option value="40">45</option>
																<option value="50">50</option>
																<option value="55">55</option>
															</select>
															<button onclick="cronTabMonth()" style="margin-top: 20px;" class="btn btn-primary btn-sm"
																type="button" id="generate">{$GENERATE}</button>

														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-12 text-center">
											<input type="submit" class="btn btn-primary" value="{$SUBMIT}">
											<input type="hidden" name="token" value="{$TOKEN}">
										</div>

									</div>
								</div>
							</div>




						</form>






					</section>

				</div>

			</div>

			{include file='footer.tpl'}

		</div>
	</div>
	<!-- ./wrapper -->

	{include file='scripts.tpl'}

</body>

</html>