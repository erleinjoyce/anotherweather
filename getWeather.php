<?php
$lat = $_POST['lat'];
$long = $_POST['long'];
$key = "3d6bddb64b6420cb1767ebddf6f21e61";
$exclude = "minutely,hourly,alerts,flags";
$units = "uk2";
$lang = "en";

$url = "https://api.darksky.net/forecast/3d6bddb64b6420cb1767ebddf6f21e61/".$lat.",".$long."?exclude=".$exclude."&units=".$units."&lang=".$lang;
$json = file_get_contents($url);
$data = json_decode($json);

date_default_timezone_set($data->timezone);

$ico = $data->currently->icon;
$icoclass = "wi-day-sunny";
if ($ico == 'clear-day') { $icoclass = "wi-day-sunny"; }
else if ($ico == 'clear-night') { $icoclass = "wi-night-clear"; }
else if ($ico == 'rain') { $icoclass = "wi-rain"; }
else if ($ico == 'snow') { $icoclass = "wi-snow"; }
else if ($ico == 'sleet') { $icoclass = "wi-sleet"; }
else if ($ico == 'wind') { $icoclass = "wi-windy"; }
else if ($ico == 'fog') { $icoclass = "wi-fog"; }
else if ($ico == 'cloudy') { $icoclass = "wi-cloudy"; }
else if ($ico == 'partly-cloudy-day') { $icoclass = "wi-day-cloudy"; }
else if ($ico == 'partly-cloudy-night') { $icoclass = "wi-night-cloudy"; }
else if ($ico == 'hail') { $icoclass = "wi-hail"; }
else if ($ico == 'thunderstorm') { $icoclass = "wi-thunderstorm"; }
else if ($ico == 'tornado') { $icoclass = "wi-tornado"; }
else { $icoclass = "wi-na"; }
?>

<div class="headerbg">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="glass text-center">
					<div class="icon">
						<div class="icon-box">
			                <div class="wi <?= $icoclass; ?>"></div>
			            </div>
					</div>
					<h2 class="text-uppercase"><?= round($data->currently->temperature, 0); ?><i class="wi wi-celsius"></i>, <?= $data->currently->summary; ?></h2>
					<h3 class="text-uppercase"><?= date("D, M d, Y h:i A"); ?></h2>
					<h4><?= $data->timezone; ?></h4>	
				</div>

				<div class="glass-np mt-3">
					<div class="glassheader">More Data</div>
					<div class="glassbody">
						<div class="flextext">
							<div>
								<span class="wibox"><i class="wi wi-humidity"></i></span>
								<span><?= $data->currently->humidity; ?></span>
								<span>Humidity</span>
							</div>
							<div>
								<span class="wibox"><i class="wi wi-strong-wind"></i></span>
								<span><?= $data->currently->windSpeed; ?> mph</span>
								<span>Wind Speed</span>
							</div>
							<div>
								<span class="wibox"><i class="wi wi-cloud"></i></span>
								<span><?= round(((float)$data->currently->cloudCover * 100), 3) . '%'; ?></span>
								<span>Cloud Cover</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<?php $cnt=1; foreach ($data->daily->data as $d) {
					$ico = $d->icon;
					$icoclass = "wi-day-sunny";
					if ($ico == 'clear-day') { $icoclass = "wi-day-sunny"; }
					else if ($ico == 'clear-night') { $icoclass = "wi-night-clear"; }
					else if ($ico == 'rain') { $icoclass = "wi-rain"; }
					else if ($ico == 'snow') { $icoclass = "wi-snow"; }
					else if ($ico == 'sleet') { $icoclass = "wi-sleet"; }
					else if ($ico == 'wind') { $icoclass = "wi-windy"; }
					else if ($ico == 'fog') { $icoclass = "wi-fog"; }
					else if ($ico == 'cloudy') { $icoclass = "wi-cloudy"; }
					else if ($ico == 'partly-cloudy-day') { $icoclass = "wi-day-cloudy"; }
					else if ($ico == 'partly-cloudy-night') { $icoclass = "wi-night-cloudy"; }
					else if ($ico == 'hail') { $icoclass = "wi-hail"; }
					else if ($ico == 'thunderstorm') { $icoclass = "wi-thunderstorm"; }
					else if ($ico == 'tornado') { $icoclass = "wi-tornado"; }
					else { $icoclass = "wi-na"; }
				?>
					<?php if($cnt == 5) { ?>
						<button class="btn btn-sm btn-primary viewmorebtn" onclick="showmore()">+ View More</button>
					<?php } ?>
					<div class="glassothers <?php if($cnt > 4) echo 'moredata'; ?>">
						<div class="date">
							<p class="num"><?= date("d", $d->time); ?></p>
							<p><?= date("M", $d->time); ?></p>
						</div>
						<div class="data">
							<div class="weather"><div class="wi <?= $icoclass; ?>"></div> <?= $d->summary; ?></div>
							<div class="temp"><div class="wi wi-cloud"></div> <?= $d->temperatureMin; ?><div class="wi wi-celsius"></div> to <?= $d->temperatureMax; ?><div class="wi wi-celsius"></div></div>
							<div class="weather"><div class="wi wi-sunrise"></div> <?= date("h:i A", $d->sunriseTime); ?></div>
							<div class="weather"><div class="wi wi-sunset"></div> <?= date("h:i A", $d->sunsetTime); ?></div>
							<div class="weather"><div class="wi wi-humidity"></div> <?= $d->humidity; ?></div>
						</div>
					</div>
				<?php $cnt++; } ?>
			</div>
		</div>
	</div>
</div>